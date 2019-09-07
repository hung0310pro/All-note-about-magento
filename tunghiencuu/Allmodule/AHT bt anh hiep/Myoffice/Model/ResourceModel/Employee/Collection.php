<?php
namespace AHT\Myoffice\Model\ResourceModel\Employee;

class Collection extends \Magento\Eav\Model\Entity\Collection\AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'AHT\Myoffice\Model\Employee',
            'AHT\Myoffice\Model\ResourceModel\Employee'
        );
    }
}
