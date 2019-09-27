<?php
// lấy dữ liệu
namespace AHT\BlogBig\Model\ResourcePortfolioModel\Portfolio;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	public function _construct()
	{
		$this->_init("AHT\BlogBig\Model\Portfolio", "AHT\BlogBig\Model\ResourcePortfolioModel\Portfolio");
	}
}