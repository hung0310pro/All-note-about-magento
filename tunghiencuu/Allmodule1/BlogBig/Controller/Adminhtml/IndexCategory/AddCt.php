<?php

namespace AHT\BlogBig\Controller\Adminhtml\IndexCategory;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use AHT\BlogBig\Model\CategoryFactory;

class AddCt extends \Magento\Backend\App\Action
{
	protected $_pageFactory;
	protected $_category;

	public function __construct(
		Context $context,
		CategoryFactory $category,
		PageFactory $pageFactory)
	{
		$this->_category = $category;
		$this->_pageFactory = $pageFactory;
		return parent::__construct($context);
	}

	public function execute()
	{
		if (isset($_POST)) {
			$model = $this->_category->create();

			$request = $this->getRequest();
			$formData = $request->getPostValue();
			// muốn add kiểu này thì phải có name trùng vs tên cột
			$model->setData($formData);
			$model->save();

			// $model->getId() là lấy giá trị lastinsert Id
			$this->messageManager->addSuccess(__('Thêm thành công'));
			return $this->_redirect('blogbig/indexcategory/index');
		}
	}
}