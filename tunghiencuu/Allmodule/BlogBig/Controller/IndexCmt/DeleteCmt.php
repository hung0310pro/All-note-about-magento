<?php

namespace AHT\BlogBig\Controller\IndexCmt;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use AHT\BlogBig\Model\CommentFactory;

class DeleteCmt extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	protected $_comment;

	public function __construct(
		Context $context,
		CommentFactory $comment,
		PageFactory $pageFactory)
	{
		$this->_pageFactory = $pageFactory;
		$this->_comment = $comment;
		return parent::__construct($context);
	}

	public function execute()
	{
		if (isset($_POST)) {
			$model = $this->_comment->create();
			$id = $_POST['i'];
			$model->load($id)->delete();
			echo 1;
		}
	}

}