<?php

namespace AHT\BlogBig\Controller\Adminhtml\IndexPortfolio;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use AHT\BlogBig\Model\PortfolioFactory;

class DeletePf extends \Magento\Backend\App\Action
{
	protected $_pageFactory;
	protected $_category;

	public function __construct(
		Context $context,
		PortfolioFactory $portfolio,
		PageFactory $pageFactory)
	{
		$this->_portfolio = $portfolio;
		$this->_pageFactory = $pageFactory;
		return parent::__construct($context);
	}

	public function execute()
	{
		$id = $this->getRequest()->getParam('id');
		if (isset($id)) {
			$model = $this->_portfolio->create();
			$model->load($id)->delete();
			$this->messageManager->addSuccess(__('Xóa thành công'));
			return $this->_redirect('blogbig/indexportfolio/index');

		}
	}
}