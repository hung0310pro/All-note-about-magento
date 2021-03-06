<?php

namespace AHT\Myoffice\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $employeeEntityTable = \AHT\Myoffice\Model\Employee::ENTITY . '_entity';
        $departmentEntityTable = 'aht_myoffice_department';

        $setup->getConnection()
            ->addForeignKey(
                $setup->getFkName($employeeEntityTable, 'department_id', $departmentEntityTable, 'entity_id'),
                $setup->getTable($employeeEntityTable),
                'department_id',
                $setup->getTable($departmentEntityTable),
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            );


        $setup->endSetup();
    }
}
