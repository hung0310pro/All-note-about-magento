<?php
// insert, or nạp dl
namespace AHT\BlogBig\Model\ResourcePortfolioModel;

use Magento\Framework\Model\ResourceModel\Db\Context;

class Portfolio extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	public function __construct(Context $context)
	{
		parent::__construct($context);
	}

	public function _construct()
	{
		$this->_init('portfolio', 'id');
	}
}