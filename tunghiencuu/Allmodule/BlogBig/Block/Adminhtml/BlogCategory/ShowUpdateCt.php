<?php

namespace AHT\BlogBig\Block\Adminhtml\BlogCategory;

use Magento\Backend\Block\Widget\Form\Container;

// đường dẫn tới Form.php, container.php dòng 139

Class ShowUpdateCt extends Container
{
	protected function _construct()
	{
		$this->_blockGroup = "AHT_BlogBig";
		$this->_controller = "adminhtml_blogcategory";
		$this->_mode = 'ShowUpdateCt';
		$this->_objectId = "id";
		parent::_construct();
	}
}
