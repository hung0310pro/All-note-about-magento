<?php

namespace AHT\BlogBig\Controller\IndexCategory;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use AHT\BlogBig\Model\CategoryFactory;

class CategoryPf extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	protected $_categoryFactory;

	public function __construct(
		Context $context,
		PageFactory $pageFactory,
		CategoryFactory $categoryFactory)
	{
		$this->_categoryFactory = $categoryFactory;
		$this->_pageFactory = $pageFactory;
		return parent::__construct($context);
	}

	public function execute()
	{
		$model = $this->_categoryFactory->create();
		$id = $this->getRequest()->getParam("id");
		$pageTitle = $model->load($id)->getData();
		$resultPage = $this->_pageFactory->create();
		$resultPage->getConfig()->getTitle()->prepend(__($pageTitle["page_title"]));
		return $resultPage;
	}
}