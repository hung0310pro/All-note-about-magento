<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace RYCO\ReturnReport\Block\Adminhtml\Sales;

class Sales extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Template file
     *
     * @var string
     */
    protected $_template = 'report/grid/container.phtml';

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_blockGroup = 'RYCO_ReturnReport';
        $this->_controller = 'adminhtml_sales_sales';
        $this->_headerText = __('Total Ordered Report');
        parent::_construct();

        $this->buttonList->remove('add');
        $this->addButton(
            'filter_form_submit',
            ['label' => __('Show Report'), 'onclick' => 'filterFormSubmit()', 'class' => 'primary']
        );
    }

    /**
     * Get filter URL
     *
     * @return string
     */
    public function getFilterUrl()
    {
        $this->getRequest()->setParam('filter', null);
        return $this->getUrl('*/*/sales', ['_current' => true]);
    }
}
