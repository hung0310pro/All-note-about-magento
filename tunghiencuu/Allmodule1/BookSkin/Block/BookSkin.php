<?php

namespace Convert\BookSkin\Block;

use Magento\Framework\View\Element\Template;
use Magento\Variable\Model\VariableFactory;

class BookSkin extends Template
{

	protected $_varFactory;

	public function __construct(
		Template\Context $context,
		array $data = [],
		VariableFactory $varFactory
	)
	{
		$this->_varFactory = $varFactory;
		$this->_isScopePrivate = true;
		parent::__construct($context, $data);
	}

	public function getSkinConcernValue()
	{
		return $this->_varFactory->create()->loadByCode('Skin-Concern')->getHtmlValue();
	}

	public function getSkinTypeValue()
	{
		return $this->_varFactory->create()->loadByCode('Are-you-dry-or-oily')->getHtmlValue();
	}
}
