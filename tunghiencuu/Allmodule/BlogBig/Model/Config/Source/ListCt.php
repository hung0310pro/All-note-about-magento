<?php

namespace AHT\BlogBig\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use AHT\BlogBig\Model\CategoryFactory;

class ListCt implements ArrayInterface
{
	protected $_categoryFactory;

	public function __construct(CategoryFactory $categoryFactory)
	{
		$this->_categoryFactory = $categoryFactory;
	}

	public function toOptionArray()
	{
		$getListCt = $this->_categoryFactory->create();
		$listCt = $getListCt->getCollection()->getData();
		$mang = [];
		foreach ($listCt as $value) {
			$mang[] = array(
				'value' => $value["id"],
				'label' => $value["namecategory"]
			);
		}
		return $mang;
	}
}