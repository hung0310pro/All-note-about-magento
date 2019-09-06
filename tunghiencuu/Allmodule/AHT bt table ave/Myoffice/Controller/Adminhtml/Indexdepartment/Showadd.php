<?php

namespace AHT\Myoffice\Controller\Adminhtml\Indexdepartment;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;


class Showadd extends \Magento\Backend\App\Action
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

