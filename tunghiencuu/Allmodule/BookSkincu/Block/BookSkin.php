<?php

namespace Convert\BookSkin\Block;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\ObjectManagerInterface;
use \Magento\Variable\Model\VariableFactory;


class BookSkin extends \Magento\Framework\View\Element\Template
{

	protected $_varFactory;
	protected $_objectManager;

	public function __construct(
		Context $context,
		VariableFactory $varFactory,
		ObjectManagerInterface $objectManager
	)
	{
		$this->_varFactory = $varFactory;
		$this->_objectManager = $objectManager;
		parent::__construct($context);
	}


	public function getVariableValue()
	{
		/*$model = $this->_objectManager->get('Magento\Variable\Model\Variable')->loadByCode('aaa');
		$html_value = $model->getHtmlValue();
		return $html_value;*/
	}

}
