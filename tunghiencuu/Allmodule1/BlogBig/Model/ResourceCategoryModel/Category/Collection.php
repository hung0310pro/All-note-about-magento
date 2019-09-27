<?php
// lấy dữ liệu
namespace AHT\BlogBig\Model\ResourceCategoryModel\Category;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	public function _construct()
	{
		$this->_init("AHT\BlogBig\Model\Category", "AHT\BlogBig\Model\ResourceCategoryModel\Category");
	}
	
}