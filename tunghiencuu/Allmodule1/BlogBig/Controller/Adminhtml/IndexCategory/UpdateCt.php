<?php

namespace AHT\BlogBig\Controller\Adminhtml\IndexCategory;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use AHT\BlogBig\Model\CategoryFactory;

class UpdateCt extends \Magento\Backend\App\Action
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

	// thực thi update lại category
	// setNameCategory là set_namecolumn
	public function execute()
	{
		$id = $this->getRequest()->getParam('id');
		if (isset($id)) {
			$model = $this->_category->create();
			$nameTheloai = $this->getRequest()->getParam("namecategory");
			$page_title = $this->getRequest()->getParam("page_title");
			$meta_description = $this->getRequest()->getParam("meta_description");
			$meta_keywords = $this->getRequest()->getParam("meta_keywords");
			$quantity_portfolio = $this->getRequest()->getParam("quantity_portfolio");
			$model->load($id)->setNamecategory($nameTheloai)
				->setPage_title($page_title)
				->setMeta_description($meta_description)
				->setMeta_keywords($meta_keywords)
				->setQuantity_portfolio($quantity_portfolio)
				->save();
			$this->messageManager->addSuccess(__('Sửa thành công'));
			return $this->_redirect('blogbig/indexcategory/index');
		}
	}
}