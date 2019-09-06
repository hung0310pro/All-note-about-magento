<?php

namespace AHT\Myoffice\Controller\Adminhtml\Indexemployee;

use AHT\Myoffice\Model\EmployeeFactory;

class AddEmployee extends \Magento\Backend\App\Action
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
		$model = $this->_employeeFactory->create();
		$request = $this->getRequest();
		$data = $request->getPostValue();
		if (isset($data)) {
			$model->setData($data);
			$model->save();
			$this->messageManager->addSuccess(__('Thêm thành công'));
			return $this->_redirect('myoffice/indexemployee/index');
		} else {
			$this->messageManager->addError(__("Employee không phù hợp"));
			return $this->_redirect('myoffice/indexemployee/showadd');
		}
	}
}