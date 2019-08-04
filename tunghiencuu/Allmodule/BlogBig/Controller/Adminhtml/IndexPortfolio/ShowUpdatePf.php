<?php

namespace AHT\BlogBig\Controller\Adminhtml\IndexPortfolio;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class ShowUpdatePf extends \Magento\Backend\App\Action
{
	protected $_pageFactory;
	protected $_sachFactory;

	public function __construct(
		Context $context,
		PageFactory $pageFactory)
	{
		$this->_pageFactory = $pageFactory;
		return parent::__construct($context);
	}

	public function execute()
	{
		return $this->_pageFactory->create();
	}
}