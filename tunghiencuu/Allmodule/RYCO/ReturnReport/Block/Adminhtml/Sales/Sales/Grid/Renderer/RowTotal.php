<?php

namespace RYCO\ReturnReport\Block\Adminhtml\Sales\Sales\Grid\Renderer;

use Magento\Framework\DataObject;
use Magento\Framework\ObjectManagerInterface;
use Magento\Catalog\Model\ProductRepository;


class RowTotal extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{
	protected $_storeManager ;

	protected $_currencySymbol;

	public function __construct(
		\Magento\Backend\Block\Context $context,
		\Magento\Store\Model\StoreManagerInterface $storeManager,
		\Magento\Directory\Model\CurrencyFactory $currencySymbol,
		array $data = []
	)
	{
		$this->_currencySymbol = $currencySymbol;
		$this->_storeManager  = $storeManager;
		parent::__construct($context, $data);
	}

	public function render(DataObject $row)
	{


    $currencyCode = $this->_storeManager->getStore()->getCurrentCurrency()->getCode();
    $currency = $this->_currencySymbol->create()->load($currencyCode);
    echo $currencySymbol = $currency->getCurrencySymbol();

		$rowTotal = $row->getPriceInclTax() - $row->getDiscountAmount();
		return number_format($rowTotal,'2');
	}

}