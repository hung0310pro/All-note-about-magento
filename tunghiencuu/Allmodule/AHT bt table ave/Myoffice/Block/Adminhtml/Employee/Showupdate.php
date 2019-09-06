<?php
namespace AHT\Myoffice\Block\Adminhtml\Employee;
use Magento\Backend\Block\Widget\Form\Container;
Class Showupdate extends Container
{
	protected function _construct()
	{
		$this->_blockGroup = "AHT_Myoffice";
		$this->_controller = "adminhtml_employee";
		$this->_mode = 'Showupdate';
		parent::_construct();
	}
}