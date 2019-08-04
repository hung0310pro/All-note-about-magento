<?php

namespace AHT\BlogBig\Block\BlogWidget\Widget;

use Magento\Widget\Block\BlockInterface;
use Magento\Framework\View\Element\Template\Context;
// use AHT\BlogBig\Model\PortfolioFactory hoặc viết ntn xong ở dưới phải có getColection()
use AHT\BlogBig\Model\ResourcePortfolioModel\Portfolio\CollectionFactory;

// đây kp là controller hay action nên k thể gọi tới tk ObjectManager bằng this như bt đc mà cần
// phải khai báo nếu muốn sử dụng.
use Magento\Framework\ObjectManagerInterface;


class Posts extends \Magento\Framework\View\Element\Template implements BlockInterface
{
	protected $_template = "widget/posts.phtml"; // cho vào widget để dễ quản lý
	protected $_portFolioFactory;
	protected $_objectManager;

	public function __construct(
		Context $context,
		CollectionFactory $portFolioFactory,
		ObjectManagerInterface $objectManager,
		array $data = []
	)
	{
		parent::__construct($context, $data);
		$this->_portFolioFactory = $portFolioFactory;
		$this->_objectManager = $objectManager;
	}

	// đổ ra dữ liệu xử lý trước khi load ra HTML
	// getData chỉ là đổ dữ liệu ra ngoài thôi
	protected function _beforeToHtml()
	{
		$model = $this->_portFolioFactory->create();
		$listPortfolio = $model->addFieldToFilter("status", ["eq" => 1])->getData();
		$this->setData("listPortfolio", $listPortfolio); // cho vào cái này để get ra bên posts.phtml ở view
		return parent::_beforeToHtml();
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