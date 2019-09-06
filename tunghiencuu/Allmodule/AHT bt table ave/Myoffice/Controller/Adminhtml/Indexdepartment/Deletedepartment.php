<?php

namespace AHT\Myoffice\Controller\Adminhtml\Indexdepartment;

use AHT\Myoffice\Model\DepartmentFactory;

class Deletedepartment extends \Magento\Backend\App\Action
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
		$id = $this->getRequest()->getParam('entity_id');
		if (isset($id)) {
			$model = $this->_departmentFactory->create();
			$model->load($id)->delete();
			$this->messageManager->addSuccess(__('Xóa thành công'));
			return $this->_redirect('myoffice/indexdepartment/index');
		}
	}
}