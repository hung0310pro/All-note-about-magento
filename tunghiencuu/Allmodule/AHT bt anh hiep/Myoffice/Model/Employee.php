<?php
namespace AHT\Myoffice\Model;

class Employee extends \Magento\Framework\Model\AbstractModel
{

    const ENTITY = 'aht_myoffice_employee';

    protected function _construct()
    {
        $this->_init('AHT\Myoffice\Model\ResourceModel\Employee');
    }

}
