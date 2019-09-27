<?php

namespace AHT\BlogBig\Block\Adminhtml\BlogPortfolio;

use Magento\Backend\Block\Widget\Form\Container;

Class ShowUpdatePf extends Container
{
	protected function _construct()
	{
		$this->_blockGroup = "AHT_BlogBig";
		$this->_controller = "adminhtml_blogportfolio";
		$this->_mode = 'ShowUpdatePf';
		parent::_construct();
	}
}