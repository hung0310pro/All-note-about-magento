<?php
// insert, or nạp dl
namespace AHT\BlogBig\Model\ResourceCategoryModel;

use Magento\Framework\Model\ResourceModel\Db\Context;

class Category extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	public function __construct(Context $context)
	{
		parent::__construct($context);
	}


	public function _construct()
	{
		$this->_init('category', 'id');
	}

}