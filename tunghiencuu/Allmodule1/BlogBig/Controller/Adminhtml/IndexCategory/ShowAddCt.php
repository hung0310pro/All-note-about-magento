<?php

namespace AHT\BlogBig\Controller\Adminhtml\IndexCategory;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class ShowAddCt extends \Magento\Backend\App\Action
{
	protected $_pageFactory;

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