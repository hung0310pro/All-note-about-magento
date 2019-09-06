<?php

namespace AHT\Myoffice\Controller\Adminhtml\Indexemployee;

use AHT\Myoffice\Model\EmployeeFactory;

class DeleteEmployee extends \Magento\Backend\App\Action
{

	protected $_employeeFactory;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		EmployeeFactory $employeeFactory
	)
	{
		$this->_employeeFactory = $employeeFactory;
		parent::__construct($context);
	}

	public function execute()
	{
		$id = $this->getRequest()->getParam('entity_id');
		if (isset($id)) {
			$model = $this->_employeeFactory->create();
			$model->load($id)->delete();
			$this->messageManager->addSuccess(__('Xóa thành công'));
			return $this->_redirect('myoffice/Indexemployee/index');
		}
	}
}