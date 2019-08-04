<?php

namespace AHT\BlogBig\Model;

class Category extends \Magento\Framework\Model\AbstractModel

{
	public function _construct()
	{
		$this->_init("AHT\BlogBig\Model\ResourceCategoryModel\Category");
	}

}