<?php

namespace AHT\Myoffice\Model\Config;

use Magento\Framework\Option\ArrayInterface;
use AHT\Myoffice\Model\DepartmentFactory;

class ListDepartment implements ArrayInterface
{
	protected $_departmentFactory;

	public function __construct(DepartmentFactory $departmentFactory)
	{
		$this->_departmentFactory = $departmentFactory;
	}

	public function toOptionArray()
	{
		$getListDp = $this->_departmentFactory->create();
		$listDp = $getListDp->getCollection()->getData();
		$mang = [];
		foreach ($listDp as $value) {
			$mang[] = array(
				'value' => $value["entity_id"],
				'label' => $value["name"]
			);
		}
		return $mang;
	}
}