<?php
// lấy dữ liệu
namespace AHT\BlogBig\Model\ResourceCommentModel\Comment;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

	public function _construct()
	{
		$this->_init("AHT\BlogBig\Model\Comment", "AHT\BlogBig\Model\ResourceCommentModel\Comment");
	}
	
}