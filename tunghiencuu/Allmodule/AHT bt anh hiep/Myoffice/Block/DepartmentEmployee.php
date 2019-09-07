<?php

namespace AHT\Myoffice\Block;

class DepartmentEmployee extends \Magento\Framework\View\Element\Template
{
	protected $_employeeCollectionFactory;
	protected $_departmentFactory;
	protected $_objectManager;

	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Magento\Framework\ObjectManagerInterface $objectManager,
		\AHT\Myoffice\Model\ResourceModel\Department\CollectionFactory $departmentCollectionFactory
	)
	{
		$this->_departmentFactory = $departmentCollectionFactory;
		$this->_objectManager = $objectManager;
		parent::__construct($context);
	}

	public function getDepartmentEmployee()
	{
		$listDepartment = $this->_departmentFactory->create();
		$array = [];
		$arrays = [];
		foreach ($listDepartment->getData() as $value) {
			$array[$value['entity_id']] = $value['name'];
		}

		foreach ($array as $key => $value) {
			// get attribute of table employee
			$employees = $this->_objectManager->create(
				'AHT\Myoffice\Model\ResourceModel\Employee\Collection'
			);
			$employees->addAttributeToSelect('*');
			$employees->addFieldToFilter('department_id', array('eq' => $key));
			$a = 0;
			/* $employees->toArray(); dùng addAttributeToSelect nên check bởi ->toArray()*/
			foreach ($employees as $val) {
				$a++;
				$arrays[$value][$a] = $val->getData();
			}
		}
		return $arrays;
	}

}
