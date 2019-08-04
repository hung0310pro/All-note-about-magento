<?php

namespace RYCO\ReportOrders\Block\Adminhtml\Sales\Sales\Grid\Renderer;

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

	protected $_productloader;

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


		if ($row->getProduct_type() == 'configurable') {
			$_product = $this->_productFactory->create();
			$mySize = [];
			$mySize1 = [];
			$a = 0;
			foreach ($row->getProduct_options() as $key => $value) {
				$a++;
				if (is_array($value) && $key == "attributes_info") {
					$mySize[$a] = $value;
				}
			}

			foreach ($mySize as $key => $value) {
				foreach ($value as $val) {
					if ($val['label'] == "Size") {
						$mySize1[] = $val['option_value'];
					}
				}
			}
			$isAttributeExist = $_product->getResource()->getAttribute('size');
			if ($isAttributeExist->usesSource()) {
				$optionText = $isAttributeExist->getSource()->getOptionText($mySize1[0]);
				return $optionText;
			}
		} else {
			$product = $this->getLoadProduct($row->getProduct_id());

			$dataSize = $product->getData('size');

			$attrSale = $product->getResource()->getAttribute('size');

			if ($attrSale->usesSource()) {
				$valueSale = $attrSale->getSource()->getOptionText($dataSize);
				return $valueSale;
			}

		}


	}
}