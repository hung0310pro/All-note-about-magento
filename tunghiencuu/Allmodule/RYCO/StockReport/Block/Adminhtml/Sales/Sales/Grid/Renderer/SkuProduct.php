<?php

namespace RYCO\StockReport\Block\Adminhtml\Sales\Sales\Grid\Renderer;

use Magento\Framework\DataObject;
use Magento\Framework\ObjectManagerInterface;
use Magento\Catalog\Model\ProductRepository;


class SkuProduct extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{
	/**
	 * get category name
	 * @param DataObject $row
	 * @return string
	 */

	protected $_objectManager;

	protected $_productRepository;

	protected $_storeConfig;

	public function __construct(
		\Magento\Backend\Block\Context $context,
		\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
		ObjectManagerInterface $objectManager,
		ProductRepository $productRepository,
		array $data = []
	)
	{
		$this->_objectManager = $objectManager;
		$this->_storeConfig = $scopeConfig;
		$this->_productRepository = $productRepository;
		parent::__construct($context, $data);
	}


	public function render(DataObject $row)
	{
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$product1 = $objectManager->create('Magento\ConfigurableProduct\Model\ResourceModel\Product\Type\Configurable')->getParentIdsByChild($row->getEntity_id());
		if (isset($product1[0]) && $product1[0] != null) {
			$product = '';
			try {
				$product = $this->_productRepository->getById($product1[0], false, $row->getStoreId(), false);
			} catch (\Exception $e) {
			}

			if (isset($product)) {
				$product1 = $this->_productRepository->getById($row->getEntity_id(), false, $row->getStoreId());
				return $product->getSku() . "<br>" . "Child SKU :" . $product1->getSku();
			}
		} else {
			$product = '';
			try {
				$product = $this->_productRepository->getById($row->getEntity_id(), false, $row->getStoreId(), false);
			} catch (\Exception $e) {
			}

			if (isset($product)) {
				return $product->getSku();
			}
		}
	}
}