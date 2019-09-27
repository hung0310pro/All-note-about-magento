<?php

namespace AHT\BlogBig\Controller\Adminhtml\IndexPortfolio;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use AHT\BlogBig\Model\PortfolioFactory;

class UpdatePf extends \Magento\Backend\App\Action
{
	protected $_pageFactory;
	protected $_portfolio;

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
		$model = $this->_portfolio->create();
		$id = $this->getRequest()->getParam('id');
		// lấy hết dữ liệu từ form
		$request = $this->getRequest(); //(1)
		$data = $request->getPostValue();// (2)
		if (isset($data)) {
			$model->setData($data);
			$model->setImage($data['image'][0]['name']);
			$model->setThumbnail($data['thumbnail'][0]['name']); // lưu tên ảnh
			$model->load($id)->save();
			$this->messageManager->addSuccess(__('Chỉnh sửa thành công'));
			return $this->_redirect('blogbig/indexportfolio/index');
		}
	}
}