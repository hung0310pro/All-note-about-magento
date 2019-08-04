<?php

namespace AHT\BlogBig\Block;

use Magento\Framework\View\Element\Template\Context;
use AHT\BlogBig\Model\PortfolioFactory;
use AHT\BlogBig\Model\ResourceCommentModel\Comment\CollectionFactory;

// đây kp là controller hay action nên k thể gọi tới tk ObjectManager bằng this như bt đc mà cần
// phải khai báo nếu muốn sử dụng.
use Magento\Framework\ObjectManagerInterface;


class DetailPf extends \Magento\Framework\View\Element\Template
{

	protected $_portfolioFactory;
	protected $_objectManager;
	protected $_commentCollection;
	protected $_currentCustomer;

	public function __construct(
		Context $context,
		PortfolioFactory $portfolioFactory,
		CollectionFactory $commentCollection,
		ObjectManagerInterface $objectManager)
	{
		$this->_objectManager = $objectManager;
		$this->_portfolioFactory = $portfolioFactory;
		$this->_commentCollection = $commentCollection;
		parent::__construct($context);
	}

	public function getDetailPf()
	{

		$id = $this->getRequest()->getParam("id");
		if (isset($id)) {
			$model = $this->_portfolioFactory->create();
			$detailPf = $model->load($id)->getData();
			return $detailPf;
		}
	}

	public function getCustomerId()
	{
		$customerSession = $this->_objectManager->create('Magento\Customer\Model\Session');
		if ($customerSession->isLoggedIn()) {
			$idCustomer = [];
			$idCustomer['id'] = $customerSession->getCustomer()->getId();
			$idCustomer['name'] = $customerSession->getCustomer()->getName();
			return $idCustomer;
		}
	}

	public function getComment()
	{
		$id = $this->getRequest()->getParam("id");

		if (isset($id)) {
			$model = $this->_commentCollection->create();
			$listComment = $model->addFieldToFilter("id_portfolio", ["eq" => $id])
				->addFieldToFilter("status_cmt", ["eq" => 1])
				->getData();
			return $listComment;
		}
	}



	// hàm này lấy link tới ảnh
	public function getBaseURLMedia()
	{
		$media = $this->_objectManager->get("Magento\Store\Model\StoreManagerInterface")
			->getStore()
			->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
		return $media;
	}


}