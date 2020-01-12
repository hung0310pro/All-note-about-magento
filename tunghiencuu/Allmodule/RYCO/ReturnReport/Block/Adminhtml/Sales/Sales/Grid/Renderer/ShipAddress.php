<?php

namespace RYCO\ReturnReport\Block\Adminhtml\Sales\Sales\Grid\Renderer;

use Magento\Framework\DataObject;
use Magento\Framework\ObjectManagerInterface;
use Magento\Catalog\Model\ProductRepository;


class ShipAddress extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{
    /**
     * get category name
     * @param DataObject $row
     * @return string
     */

    protected $_objectManager;

    protected $_productRepository;

    protected $_storeConfig;

    public function __construct(
        \Magento\Backend\Block\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        ObjectManagerInterface $objectManager,
        ProductRepository $productRepository,
        array $data = []
    )
    {
        $this->_objectManager = $objectManager;
        $this->_storeConfig = $scopeConfig;
        $this->_productRepository = $productRepository;
        parent::__construct($context, $data);
    }


    public function render(DataObject $row)
    {
        if (isset($row)) {
            return $row->getFirstname() . " " . $row->getLastname() . "<br>" . $row->getStreet() . "<br>" . $row->getCity() . "," . $row->getPostcode() . "<br>" . $row->getCountryId() . "<br>T: " .$row->getTelephone();
        }
    }
}