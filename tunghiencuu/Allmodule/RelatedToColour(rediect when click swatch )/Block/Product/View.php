<?php
/**
 * Stussy_RelatedToColour
 *
 * @category  Catalog
 * @package   Stussy_RelatedToColour
 * @author    Convert Digital
 * @copyright 2019 Convert Digital
 * @version   1.0.0
 *
 */
namespace Stussy\RelatedToColour\Block\Product;

use Magento\Catalog\Block\Product\View as ParentView;
use Magento\Catalog\Block\Product\Context;
use Magento\Framework\Url\EncoderInterface as UrlEncoderInterface;
use Magento\Framework\Json\EncoderInterface as JsonEncoderInterface;
use Magento\Framework\Stdlib\StringUtils;
use Magento\Catalog\Helper\Product;
use Magento\Catalog\Model\ProductTypes\ConfigInterface;
use Magento\Framework\Locale\FormatInterface;
use Magento\Customer\Model\Session;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Swatches\Helper\Data as SwatchData;
use Magento\Swatches\Helper\Media as SwatchMedia;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Catalog\Model\Product as ProductInterface;
use Magento\Catalog\Helper\Image;
use Magento\Eav\Model\Entity\Attribute\Source\Table;
use Magento\Swatches\Model\Swatch;

/**
 * Class View
 *
 * @package Stussy\RelatedToColour\Block\Product
 */
class View extends ParentView
{

    /**
     * @var array
     */
    protected $_colourRelatedProducts = [];

    /**
     * @var SwatchData
     */
    protected $_swatchHelper;

    /**
     * @var SwatchData
     */
    protected $_swatchMedia;

    /**
     * View constructor.
     *
     * @param Context $context
     * @param UrlEncoderInterface $urlEncoder
     * @param JsonEncoderInterface $jsonEncoder
     * @param StringUtils $string
     * @param Product $productHelper
     * @param ConfigInterface $productTypeConfig
     * @param FormatInterface $localeFormat
     * @param Session $customerSession
     * @param ProductRepositoryInterface $productRepository
     * @param PriceCurrencyInterface $priceCurrency
     * @param SwatchData $swatchData
     * @param SwatchMedia $swatchMedia
     * @param array $data
     */
    public function __construct(
        Context $context,
        UrlEncoderInterface $urlEncoder,
        JsonEncoderInterface $jsonEncoder,
        StringUtils $string,
        Product $productHelper,
        ConfigInterface $productTypeConfig,
        FormatInterface $localeFormat,
        Session $customerSession,
        ProductRepositoryInterface $productRepository,
        PriceCurrencyInterface $priceCurrency,
        SwatchData $swatchData,
        SwatchMedia $swatchMedia,
        array $data = []
    )
    {
        parent::__construct(
            $context,
            $urlEncoder,
            $jsonEncoder,
            $string,
            $productHelper,
            $productTypeConfig,
            $localeFormat,
            $customerSession,
            $productRepository,
            $priceCurrency,
            $data
        );
        $this->_swatchHelper = $swatchData;
        $this->_swatchMedia = $swatchMedia;
    }

    /**
     * @param $productId
     * @return ProductInterface|bool
     */
    public function getProductById($productId)
    {
        if (!isset($this->_colourRelatedProducts[$productId])) {
            try {
                $product = $this->productRepository->getById($productId);
            } catch (NoSuchEntityException $exception) {
                $product = null;
            }
            $this->_colourRelatedProducts[$productId] = $product;
        }
        return $this->_colourRelatedProducts[$productId];
    }

    /**
     * @return bool
     */
    public function shouldShowRelatedColourOptions()
    {
        if ($this->getProduct()->getData('colour_by_related')) {
            return true;
        }
        return false;
    }

    /**
     * @return Image
     */
    public function getImageHelper()
    {
        return $this->_imageHelper;
    }

    /**
     * @param bool $addCurrent
     * @return array
     */
    public function getRelatedColourProductInformation($addCurrent = false)
    {
        $_product = $this->getProduct();
        $relatedProductIds = $_product->getRelatedProductIds();
        $relatedProducts = array();
        $imageHelper = $this->getImageHelper();
        foreach ($relatedProductIds as $relatedProductId) {
            $relatedProduct = $this->getProductById((int)$relatedProductId);
            /* check if not visible */
            if (!$relatedProduct->isVisibleInSiteVisibility() ) {
                continue;
            }
            $img = $imageHelper->init($relatedProduct, 'product_base_image')
                ->constrainOnly(TRUE)
                ->keepAspectRatio(TRUE)
                ->keepTransparency(TRUE)
                ->keepFrame(FALSE)
                ->resize(75, 75)
                ->getUrl();
            $optionId = $relatedProduct->getData('nav_colour2');
            $optionText = '';
            $attr = $relatedProduct->getResource()->getAttribute('nav_colour2');
            if ($attr->usesSource()) {
                /** @var Table $optionSource */
                $optionSource = $attr->getSource();
                $optionText = $optionSource->getOptionText($relatedProduct->getData('nav_colour2'));
            }
            $productDetails = array(
                'title' => $relatedProduct->getData('name'),
                'url' => $this->getProductUrl($relatedProduct),
                'image_url' => $img,
                'colour_label' => $optionText,
                'colour' => $this->getSwatchColourValue($optionId)
            );
            $relatedProducts[$optionText] = $productDetails;
            if ($addCurrent) {
                $productDetails = $this->getCurrentProductInformation();
                $relatedProducts[$productDetails['colour_label']] = $productDetails;
            }
        }
        ksort($relatedProducts);
        return $relatedProducts;
    }

    /**
     * @return array
     */
    public function getCurrentProductInformation()
    {
        $_product = $this->getProduct();
        $optionId = $_product->getData('nav_colour2');
        $optionText = '';
        $attr = $_product->getResource()->getAttribute('nav_colour2');
        if ($attr->usesSource()) {
            /** @var Table $optionSource */
            $optionSource = $attr->getSource();
            $optionText = $optionSource->getOptionText($_product->getData('nav_colour2'));
        }
        $currentProductDetails = [
            'title' => $_product->getData('name'),
            'url' => $this->getProductUrl($_product),
            'colour_label' => $optionText,
            'colour' => $this->getSwatchColourValue($optionId)
        ];
        return $currentProductDetails;
    }

    /**
     * @param $optionId
     * @return string
     */
    public function getSwatchColourValue($optionId)
    {
        $swatchData = $this->_swatchHelper->getSwatchesByOptionsId([$optionId]);
        if (isset($swatchData[$optionId]) && $swatchData[$optionId]['value']) {
            switch ($swatchData[$optionId]['type']) {
                case Swatch::SWATCH_TYPE_VISUAL_COLOR:
                    $return = $swatchData[$optionId]['value'];
                    break;
                case Swatch::SWATCH_TYPE_VISUAL_IMAGE:
                    $return = 'url(' . $this->_swatchMedia->getSwatchMediaUrl() . $swatchData[$optionId]['value'] . ')';
                    break;
                default:
                    $return = '#111111';
                    break;
            }
            return $return;
        }
        return '#111111';
    }
}
