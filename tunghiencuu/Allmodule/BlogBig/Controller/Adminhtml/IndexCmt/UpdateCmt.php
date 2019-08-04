<?php

namespace AHT\BlogBig\Controller\Adminhtml\IndexCmt;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use AHT\BlogBig\Model\CommentFactory;

class UpdateCmt extends \Magento\Backend\App\Action
{
	protected $_pageFactory;
	protected $_comment;

	public function __construct(
		Context $context,
		CommentFactory $comment,
		PageFactory $pageFactory)
	{
		$this->_comment = $comment;
		$this->_pageFactory = $pageFactory;
		return parent::__construct($context);
	}

	public function execute()
	{
		$id = $this->getRequest()->getParam('id');
		if (isset($id)) {
			$model = $this->_comment->create();
			$status = $this->getRequest()->getParam("status_cmt");
			$model->load($id)->setStatus_cmt($status)
				->save();
			$this->messageManager->addSuccess(__('Sửa thành công'));
			return $this->_redirect('blogbig/indexcmt/index');
		}
	}
}