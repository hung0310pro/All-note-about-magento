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
namespace Stussy\RelatedToColour\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\ResourceModel\Product;
use Magento\Catalog\Model\Product as ProductInterface;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable;

/**
 * Class Data
 *
 * @package Stussy\RelatedToColour\Helper
 */
class Data extends AbstractHelper
{

    /**
     * @var ProductRepositoryInterface
     */
    protected $_productRepository;

    /**
     * @var array
     */
    protected $_productParents;

    /**
     * @var Product
     */
    protected $_resource;

    /**
     * @var Configurable
     */
    protected $_configurable;


    /**
     * Data constructor.
     *
     * @param Context $context
     * @param ProductRepositoryInterface $productRepository
     * @param Configurable $configurable
     * @param Product $productResource
     */
    public function __construct(
        Context $context,
        ProductRepositoryInterface $productRepository,
        Configurable $configurable,
        Product $productResource
    )
    {
        parent::__construct($context);
        $this->_productParents = [];
        $this->_configurable = $configurable;
        $this->_productRepository = $productRepository;
        $this->_resource = $productResource;
    }

    /**
     * @param $pid
     * @return bool|ProductInterface
     */
    public function getProductById($pid)
    {
        try {
            $product = $this->_productRepository->getById($pid);
        } catch (\Exception $exception) {
            $product = false;
        }
        return $product;
    }

    /**
     * @param $pid
     * @return bool|\Magento\Catalog\Api\Data\ProductInterface
     */
    public function getParentProductBySku($pid)
    {
        try {
            $product = $this->_productRepository->get($pid);
            $parentConfigObject = $this->_configurable->getParentIdsByChild($product->getId());
                if($parentConfigObject) {
                    $product = $this->_productRepository->getById($parentConfigObject[0]);
                    return $product;
                }
        } catch (\Exception $exception) {
            $product = false;
        }
        return $product;
    }

    /**
     * Get raw attribute value
     *
     * @param $productId
     * @param $code
     * @param $store
     */
    public function getAttributeValue($productId, $code, $store)
    {
        $this->_resource->getAttributeRawValue($productId, $code, $store);
    }

    /**
     * @param $product
     * @return bool
     */
    public function showShowMoreColour($product)
    {
        if (!$product->getData('colour_by_related')) {
            return false;
        }
        $_product = $this->getProductById($product->getId());
        if (!$_product) {
            return false;
        }
        $relatedProducts = $_product->getRelatedProductIds();
        if (!is_array($relatedProducts) || count($relatedProducts)<1) {
            return false;
        }
        return true;
    }
}
