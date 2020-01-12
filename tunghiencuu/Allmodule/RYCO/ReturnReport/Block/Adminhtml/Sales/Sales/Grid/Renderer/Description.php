<?php

namespace RYCO\ReturnReport\Block\Adminhtml\Sales\Sales\Grid\Renderer;

use Magento\Framework\DataObject;
use Magento\Framework\ObjectManagerInterface;
use Magento\Catalog\Model\ProductRepository;


class Description extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{
    public function render(DataObject $row)
    {
        return $row->getDescription();
    }

}