<?php

namespace AHT\BlogBig\Controller\IndexCmt;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use AHT\BlogBig\Model\CommentFactory;

class AddCmt extends \Magento\Framework\App\Action\Action
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
			$name = $_POST['name'];
			$comment = $_POST['comment'];
			$id_portfolio = $_POST['id_portfolio'];
			$id_user = $_POST['id_user'];
			$model->addData([
				"your_name" => $name,
				"comment" => $comment,
				"id_user" => $id_user,
				"status" => 0,
				"id_portfolio" => $id_portfolio,
			])->save();

		}
	}

}