<?php

namespace AHT\BlogBig\Controller\IndexCmt;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class IndexCmt extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	protected $_coreRegistry;

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
