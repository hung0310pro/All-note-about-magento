<?php
namespace AHT\Myoffice\Model\ResourceModel;

class Employee extends \Magento\Eav\Model\Entity\AbstractEntity
{
    protected function _construct()
    {
        $this->_read = 'aht_myoffice_employe_read';
        $this->_write = 'aht_myoffice_employe_write';
    }

    public function getEntityType()
    {
        if (empty($this->_type)) {
            $this->setType(\AHT\Myoffice\Model\Employee::ENTITY);
        }
        return parent::getEntityType();
    }

}
