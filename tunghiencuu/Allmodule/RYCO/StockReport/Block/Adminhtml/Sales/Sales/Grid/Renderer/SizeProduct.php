<?php

namespace RYCO\StockReport\Block\Adminhtml\Sales\Sales\Grid\Renderer;

use Magento\Framework\DataObject;
use Magento\Framework\ObjectManagerInterface;
use Magento\Catalog\Model\ProductRepository;


class SizeProduct extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{
	/**
	 * get category name
	 * @param DataObject $row
	 * @return string
	 */

	protected $_objectManager;

	protected $_productRepository;

	protected $_storeConfig;

	protected $_productFactory;

	public function __construct(
		\Magento\Backend\Block\Context $context,
		\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
		ObjectManagerInterface $objectManager,
		ProductRepository $productRepository,
		\Magento\Catalog\Model\ProductFactory $productFactory,
		array $data = []
	)
	{
		$this->_objectManager = $objectManager;
		$this->_storeConfig = $scopeConfig;
		$this->_productFactory = $productFactory;
		$this->_productRepository = $productRepository;
		parent::__construct($context, $data);
	}

	public function getLoadProduct($id)
	{
		return $this->_productFactory->create()->load($id);
	}


	public function render(DataObject $row)
	{
		$product = $this->getLoadProduct($row->getEntity_id());

		$dataSize = $product->getData('size');

		$attrSale = $product->getResource()->getAttribute('size');

		if ($attrSale->usesSource()) {
			$valueSale = $attrSale->getSource()->getOptionText($dataSize);
			return $valueSale;
		} else {
			return "";
		}
	}
}