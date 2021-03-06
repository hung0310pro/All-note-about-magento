<?php
namespace AHT\Myoffice\Model\ResourceModel\Department;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'AHT\Myoffice\Model\Department',
            'AHT\Myoffice\Model\ResourceModel\Department'
        );
    }
}
