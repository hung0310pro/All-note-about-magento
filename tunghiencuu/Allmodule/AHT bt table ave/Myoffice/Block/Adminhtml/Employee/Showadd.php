<?php
namespace AHT\Myoffice\Block\Adminhtml\Employee;
use Magento\Backend\Block\Widget\Form\Container;
Class Showadd extends Container
{
	protected function _construct()
	{
		// chỉ ra đường dẫn tới file showaddsach nơi tạo ra form.
		$this->_blockGroup = "AHT_Myoffice";
		$this->_controller = "adminhtml_employee"; // name folder chứa blog ???
		$this->_mode = 'Showadd';
		parent::_construct();
	}
}