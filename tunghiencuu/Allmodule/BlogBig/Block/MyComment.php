<?php

namespace AHT\BlogBig\Block;

use Magento\Framework\View\Element\Template\Context;
use AHT\BlogBig\Model\ResourceCommentModel\Comment\CollectionFactory;

// đây kp là controller hay action nên k thể gọi tới tk ObjectManager bằng this như bt đc mà cần
// phải khai báo nếu muốn sử dụng.
use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\App\ResourceConnection;


class MyComment extends \Magento\Framework\View\Element\Template
{
	protected $_objectManager;
	protected $_comment;
	protected $_currentCustomer;
	protected $_resource;

	public function __construct(
		Context $context,
		CollectionFactory $comment,
		ResourceConnection $Resource,
		ObjectManagerInterface $objectManager)
	{
		$this->_objectManager = $objectManager;
		$this->_comment = $comment;
		$this->_resource = $Resource;
		parent::__construct($context);
	}

	public function getCustomerId()
	{
		$customerSession = $this->_objectManager->create('Magento\Customer\Model\Session');
		if ($customerSession->isLoggedIn()) {
			$idCustomer = [];
			$idCustomer['id'] = $customerSession->getCustomer()->getId();
			$idCustomer['name'] = $customerSession->getCustomer()->getName();
			return $idCustomer;
		}
	}

	public function getComment2()
	{
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
		$connection = $resource->getConnection();

		$sql = "SELECT * FROM comment left join portfolio on comment.id_portfolio = portfolio.id";
		$result = $connection->fetchAll($sql);
		echo "<pre>";
		print_r($result);
		echo "</pre>";

	}

	public function getComment()
	{
		if (!empty($this->getCustomerId())) {
			$model = $this->_comment->create();
			$second_table_name = $this->_resource->getTableName('portfolio');
			$model->getSelect()->joinLeft(array('second' => $second_table_name),
				'main_table.id_portfolio = second.id')
				->where("id_user=" . $this->getCustomerId()['id']);
			$model1 = $this->_comment->create();
			$mang3 = $model->getData();
			$mang1 = $model1->getData();
			$mang2 = [];
			foreach ($mang1 as $value) {
				$mang2[$value['id']]['id_cmt'] = $value['id'];
				$mang2[$value['id']]['comment'] = $value['comment'];
			}
			$mang4 = [];
			$a = 0;
			foreach ($mang2 as $value) {
				foreach ($mang3 as $val) {
					if ($val['comment'] == $value['comment']) {
						$a++;
						$mang4[$a]['id_cmt'] = $value['id_cmt'];
						$mang4[$a]['project'] = $val['project'];
						$mang4[$a]['status_cmt'] = $val['status_cmt'];
						$mang4[$a]['comment'] = $val['comment'];
					}
				}
			}
			return $mang4;
		}
	}
}