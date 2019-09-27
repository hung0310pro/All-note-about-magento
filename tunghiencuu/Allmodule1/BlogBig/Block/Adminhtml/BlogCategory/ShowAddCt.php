<?php

namespace AHT\BlogBig\Block\Adminhtml\BlogCategory;

use Magento\Backend\Block\Widget\Form\Container;

Class ShowAddCt extends Container
{
	protected function _construct()
	{
		// chỉ ra đường dẫn tới file showaddcategory nơi tạo ra form.
		$this->_blockGroup = "AHT_BlogBig";
		$this->_controller = "adminhtml_blogcategory";
		$this->_mode = 'ShowAddCt';
		parent::_construct();
	}
}