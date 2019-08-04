<?php

namespace AHT\BlogBig\Block;

use Magento\Framework\View\Element\Template\Context;
use AHT\BlogBig\Model\ResourcePortfolioModel\Portfolio\CollectionFactory;
use AHT\BlogBig\Model\CategoryFactory;

// đây kp là controller hay action nên k thể gọi tới tk ObjectManager bằng this như bt đc mà cần
// phải khai báo nếu muốn sử dụng.
use Magento\Framework\ObjectManagerInterface;


class CategoryPf extends \Magento\Framework\View\Element\Template
{
	protected $_collectionFactory;
	protected $_categoryFactory;
	protected $_objectManager;

	public function __construct(
		Context $context,
		CollectionFactory $collectionFactory,
		CategoryFactory $categoryFactory,
		ObjectManagerInterface $objectManager)
	{
		$this->_categoryFactory = $categoryFactory;
		$this->_objectManager = $objectManager;
		$this->_collectionFactory = $collectionFactory;
		parent::__construct($context);
	}

	// lấy các thông số liên quan tới tk category mình cần
	public function getCategoryNeed()
	{
		$id = $this->getRequest()->getParam("id");
		$model1 = $this->_categoryFactory->create();
		$categoryNeed = $model1->load($id)->getData();
		return $categoryNeed;
	}

	// lấy cái portfolio tương ứng vs cái category đó
	public function getCategoryPf()
	{
		$id = $this->getRequest()->getParam("id");
		$model = $this->_collectionFactory->create();
		$listCategoryPf = $model->addFieldToFilter("id_category", ["eq" => $id])
			->addFieldToFilter("status", ["eq" => 1])
			->getData();
		return $listCategoryPf;
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
