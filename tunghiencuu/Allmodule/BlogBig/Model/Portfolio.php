<?php

namespace AHT\BlogBig\Model;

class Portfolio extends \Magento\Framework\Model\AbstractModel
{
	public function _construct()
	{
		$this->_init("AHT\BlogBig\Model\ResourcePortfolioModel\Portfolio");
	}
}