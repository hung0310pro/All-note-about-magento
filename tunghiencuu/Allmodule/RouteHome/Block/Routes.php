<?php

namespace Convert\RouteHome\Block;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\ObjectManagerInterface;


class Routes extends \Magento\Framework\View\Element\Template
{

	protected $_varFactory;
	protected $_objectManager;

	public function __construct(
		Context $context,
		ObjectManagerInterface $objectManager
	)
	{
		$this->_objectManager = $objectManager;
		parent::__construct($context);
	}


}
