<?php

namespace AHT\Myoffice\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{

    private $employeeSetupFactory;

    public function __construct(
        \AHT\Myoffice\Setup\EmployeeSetupFactory $employeeSetupFactory
    )
    {
        $this->employeeSetupFactory = $employeeSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        /* Add 5 Attribute need 5 table attribue :
        aht_myoffice_employee_entity_datetime : dob
		aht_myoffice_employee_entity_decimal : salary
		aht_myoffice_employee_entity_int : service_years
		aht_myoffice_employee_entity_text : note
		aht_myoffice_employee_entity_varchar : vat_number
         */
        $employeeEntity = \AHT\Myoffice\Model\Employee::ENTITY;
        $employeeSetup = $this->employeeSetupFactory->create(['setup' => $setup]);
        $employeeSetup->installEntities();
        $employeeSetup->addAttribute(
            $employeeEntity, 'service_years', ['type' => 'int']
        );
        $employeeSetup->addAttribute(
            $employeeEntity, 'dob', ['type' => 'datetime']
        );
        $employeeSetup->addAttribute(
            $employeeEntity, 'salary', ['type' => 'decimal']
        );
        $employeeSetup->addAttribute(
            $employeeEntity, 'vat_number', ['type' => 'varchar']
        );
        $employeeSetup->addAttribute(
            $employeeEntity, 'note', ['type' => 'text']
        );


        $setup->endSetup();

    }
}
