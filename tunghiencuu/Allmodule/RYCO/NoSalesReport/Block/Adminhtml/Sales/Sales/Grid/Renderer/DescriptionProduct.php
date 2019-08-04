<?php

namespace RYCO\NoSalesReport\Block\Adminhtml\Sales\Sales\Grid\Renderer;

use Magento\Framework\DataObject;
use Magento\Framework\ObjectManagerInterface;
use Magento\Catalog\Model\ProductRepository;
use \Magento\Catalog\Helper\Image as ImageHelper;

class DescriptionProduct extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
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


	public function render(DataObject $row)
	{
		if ($row->getType_id() == 'simple') {
			$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
			$product1 = $objectManager->create('Magento\ConfigurableProduct\Model\ResourceModel\Product\Type\Configurable')->getParentIdsByChild($row->getEntity_id());
			if (isset($product1[0]) && $product1[0] != null) {
				$product = '';
				try {
					$product = $this->_productRepository->getById($product1[0], false, $row->getStoreId(), false);
				} catch (\Exception $e) {
				}

				if (isset($product)) {
					return strip_tags($product->getDescription());
				}
			} else {
				$product = '';
				try {
					$product = $this->_productRepository->getById($row->getEntity_id(), false, $row->getStoreId(), false);
				} catch (\Exception $e) {
				}

				if (isset($product)) {
					return strip_tags($product->getDescription());
				}
			}
		} else {
			$product = '';
			try {
				$product = $this->_productRepository->getById($row->getEntity_id(), false, $row->getStoreId(), false);
			} catch (\Exception $e) {
			}

			if (isset($product)) {
				return strip_tags($product->getDescription());
			}
		}
	}
}