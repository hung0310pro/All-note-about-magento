<?php

namespace RYCO\ReportOrders\Block\Adminhtml\Sales\Sales\Grid\Renderer;

use Magento\Framework\DataObject;
use Magento\Framework\ObjectManagerInterface;
use Magento\Catalog\Model\ProductRepository;
use \Magento\Catalog\Helper\Image as ImageHelper;

class Image extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{
	/**
	 * get category name
	 * @param DataObject $row
	 * @return string
	 */

	protected $_objectManager;

	protected $_productRepository;

	protected $_storeConfig;

	/**
	 * @var \Magento\Catalog\Helper\Image $imageHelper
	 */
	protected $imageHelper;

	public function __construct(
		\Magento\Backend\Block\Context $context,
		\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
		ObjectManagerInterface $objectManager,
		ProductRepository $productRepository,
		ImageHelper $imageHelper,
		array $data = []
	)
	{
		$this->_objectManager = $objectManager;
		$this->_storeConfig = $scopeConfig;
		$this->_productRepository = $productRepository;
		$this->imageHelper = $imageHelper;
		parent::__construct($context, $data);
	}

	public function getPlaceholderImage()
	{
		return $this->_storeConfig->getValue('catalog/placeholder/image_placeholder');
	}

	public function getBaseURLMedia()
	{
		$media = $this->_objectManager->get("Magento\Store\Model\StoreManagerInterface")
			->getStore()
			->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
		return $media;
	}

	public function getBaseURLMedia2()
	{
		$media = $this->_objectManager->get("Magento\Store\Model\StoreManagerInterface")
			->getStore()
			->getBaseUrl();
		return $media;
	}

	public function render(DataObject $row)
	{

		$link = $this->getBaseURLMedia();
		$product = '';

		$link1 = $link . "catalog/product/placeholder/" . $this->getPlaceholderImage();
		try {
			$product = $this->_productRepository->getById($row->getProduct_id(), false, $row->getStoreId(), false);
		} catch (\Exception $e) {
		}
		if ($product && $product->getThumbnail() != "" && $product->getThumbnail() != null) {
			$img = $this->imageHelper->init($product, 'small_image')->setImageFile($product->getImage())->resize(200)->getUrl();
			return '<img src="' . $img . '" />';
			/*return sprintf(
				'<img style="width: 200px;" src="' . $link . 'catalog/product/' . $product->getThumbnail() . '">'
			);*/
		} else {
			return '<img style="width:150px;" src="' . $link1 . '"/>';
		}
	}

}