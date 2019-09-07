<?php
namespace AHT\Myoffice\Model\ResourceModel;

class Department extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init(
            'aht_myoffice_department',
            'entity_id'
        );
    }
}
