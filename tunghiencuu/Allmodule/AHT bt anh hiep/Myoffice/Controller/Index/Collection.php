<?php

namespace AHT\Myoffice\Controller\Index;

class Collection extends \Magento\Framework\App\Action\Action {

    protected $employeeFactory;
    protected $departmentFactory;

    public function __construct(
    \Magento\Framework\App\Action\Context $context, 
    \AHT\Myoffice\Model\EmployeeFactory $employeeFactory, 
    \AHT\Myoffice\Model\DepartmentFactory $departmentFactory
    ) {
        $this->employeeFactory = $employeeFactory;
        $this->departmentFactory = $departmentFactory;
        return parent::__construct($context);
    }

    public function execute() {

        $collection = $this->departmentFactory->create()
                ->getCollection();
        $derpartmentIds = [];
        foreach ($collection as $derpartment) {
            $derpartmentIds[$derpartment->getId()] = [];
        }
        foreach ($derpartmentIds as $id => $data) {
            $collectionEmployee = $this->_objectManager->create(
                    'AHT\Myoffice\Model\ResourceModel\Employee\Collection'
            );
            $collectionEmployee->addAttributeToSelect('*');
            $collectionEmployee->addFieldToFilter('department_id', array('eq' => $id));
            foreach($collectionEmployee as $e) {
                $derpartmentIds[$id][] = $e->getData();
            }
        }
	    echo "<pre>";
	    print_r($derpartmentIds);
	    echo "</pre>";

	    die();
    }

}
