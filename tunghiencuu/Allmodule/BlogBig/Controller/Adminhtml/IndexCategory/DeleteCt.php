<?php

namespace AHT\BlogBig\Controller\Adminhtml\IndexCategory;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use AHT\BlogBig\Model\CategoryFactory;

class DeleteCt extends \Magento\Backend\App\Action
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
		$id = $this->getRequest()->getParam('id');
		if (isset($id)) {
			$model = $this->_category->create();
			$model->load($id)->delete();
			$this->messageManager->addSuccess(__('Xóa thành công'));
			return $this->_redirect('blogbig/indexcategory/index');

		}
	}
}