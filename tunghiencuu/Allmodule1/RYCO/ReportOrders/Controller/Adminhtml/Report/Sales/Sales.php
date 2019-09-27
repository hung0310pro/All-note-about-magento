<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Admin abstract reports controller
 *
 * @author     Magento Core Team <core@magentocommerce.com>
 */

namespace RYCO\ReportOrders\Controller\Adminhtml\Report\Sales;
use Magento\Backend\Helper\Data as BackendHelper;

class Sales extends \Magento\Backend\App\Action
{

	protected $_dateFilter;

	 private $backendHelper;

	public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,
		BackendHelper $backendHelperData = null,
		\Magento\Framework\Stdlib\DateTime\Filter\Date $dateFilter
    ) {
        parent::__construct($context);
        $this->_fileFactory = $fileFactory;
		$this->backendHelper = $backendHelperData ?: $this->_objectManager->get(BackendHelper::class);
        $this->_dateFilter = $dateFilter;
    }
	/**
	 * Sales report action
	 *
	 * @return void
	 *
	 *
	 *
	 */
	public function execute()
	{
		$this->_initAction()->_setActiveMenu(
			'Magento_Sales::sales_order'
		)->_addBreadcrumb(
			__('Sales Report'),
			__('Sales Report')
		);

		$gridBlock = $this->_view->getLayout()->getBlock('adminhtml_sales_sales.grid');
        $filterFormBlock = $this->_view->getLayout()->getBlock('grid.filter.form');

		$this->_initReportAction([$gridBlock, $filterFormBlock]);

		$this->_view->getPage()->getConfig()->getTitle()->prepend(__('Orders Report'));
		$this->_view->renderLayout();
	}

	/**
	 * Add report/sales breadcrumbs
	 *
	 * @return $this
	 */
	public function _initAction()
	{
		$this->_view->loadLayout();
		$this->_addBreadcrumb(__('Reports'), __('Reports'));
		$this->_addBreadcrumb(__('Sales'), __('Sales'));
		return $this;
	}

	public function _initReportAction($blocks)
	{
		if (!is_array($blocks)) {
			$blocks = [$blocks];
		}

		$params = $this->initFilterData();
		foreach ($blocks as $block) {
			if ($block) {
				$block->setFilterData($params);
			}
		}

		return $this;
	}

	private function initFilterData()
	{
		$requestData = $this->backendHelper
			->prepareFilterString(
				$this->getRequest()->getParam('filter')
			);

		$filterRules = ['from' => $this->_dateFilter, 'to' => $this->_dateFilter];
		$inputFilter = new \Zend_Filter_Input($filterRules, [], $requestData);

		$requestData = $inputFilter->getUnescaped();
		$requestData['store_ids'] = $this->getRequest()->getParam('store_ids');
		$requestData['group'] = $this->getRequest()->getParam('group');
		$requestData['website'] = $this->getRequest()->getParam('website');

		$params = new \Magento\Framework\DataObject();

		foreach ($requestData as $key => $value) {
			if (!empty($value)) {
				$params->setData($key, $value);
			}
		}
		return $params;
	}
}