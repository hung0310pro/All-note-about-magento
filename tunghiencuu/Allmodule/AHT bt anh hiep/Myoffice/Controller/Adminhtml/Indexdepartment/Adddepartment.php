<?php

namespace AHT\Myoffice\Controller\Adminhtml\Indexdepartment;

use AHT\Myoffice\Model\DepartmentFactory;

class Adddepartment extends \Magento\Backend\App\Action
{

	protected $_departmentFactory;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		DepartmentFactory $departmentFactory
	)
	{
		$this->_departmentFactory = $departmentFactory;
		parent::__construct($context);
	}

	public function execute()
	{
		$model = $this->_departmentFactory->create();
		$request = $this->getRequest();
		$data = $request->getPostValue();
		if (isset($data) && $data['name'] != null && $data['name'] != "") {
			$model->setData($data);
			$model->save();
			$this->messageManager->addSuccess(__('Thêm thành công'));
			return $this->_redirect('myoffice/indexdepartment/index');
		} else {
			$this->messageManager->addError(__("Department không phù hợp"));
			return $this->_redirect('myoffice/indexdepartment/showadd');
		}
	}
}