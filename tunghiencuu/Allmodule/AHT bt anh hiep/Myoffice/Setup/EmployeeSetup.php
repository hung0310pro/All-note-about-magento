<?php

namespace AHT\Myoffice\Setup;

use Magento\Eav\Setup\EavSetup;

class EmployeeSetup extends  EavSetup
{
   /* http://prntscr.com/ozygoo */
    public function getDefaultEntities() {
        $employeeEntity = \AHT\Myoffice\Model\Employee::ENTITY;
        $entities = [
            $employeeEntity => [
                'entity_model' => 'AHT\Myoffice\Model\ResourceModel\Employee',
                'table' => $employeeEntity . '_entity',
                'attributes' => [
                    'department_id' => [
                        'type' => 'static',
                    ],
                    'email' => [
                        'type' => 'static',
                    ],
                    'first_name' => [
                        'type' => 'static',
                    ],
                    'last_name' => [
                        'type' => 'static',
                    ],
                ],
            ],
        ];
        return $entities;
    }
}
