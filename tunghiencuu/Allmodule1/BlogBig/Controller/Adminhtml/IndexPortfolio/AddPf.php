<?php

namespace AHT\BlogBig\Controller\Adminhtml\IndexPortfolio;

use AHT\BlogBig\Model\PortfolioFactory;

class AddPf extends \Magento\Backend\App\Action
{
	protected $imageUploader;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		PortfolioFactory $portfolioFactory
	)
	{
		$this->portfolioFactory = $portfolioFactory;
		parent::__construct($context);
	}

	public function execute()
	{
		$model = $this->portfolioFactory->create();
		// 1 và 2 là lấy hết dữ liệu từ form
		$request = $this->getRequest(); //(1)
		$data = $request->getPostValue();// (2)
		if (isset($data)) {
			if (empty($data['image'][0]['name']) || empty($data['thumbnail'][0]['name'])) {
				$this->messageManager->addErrorMessage(__('Bạn cần cho điền đủ image or thumbnail'));
				return $this->_redirect('blogbig/indexportfolio/showaddpf');
			} else {
				$model->setData($data);
				$model->setImage($data['image'][0]['name']);
				$model->setThumbnail($data['thumbnail'][0]['name']); // lưu tên ảnh
				$model->save();
				$this->messageManager->addSuccess(__('Thêm thành công'));
				return $this->_redirect('blogbig/indexportfolio/index');
			}
		} else {
			$this->messageManager->addError(__("Image không phù hợp"));
			return $this->_redirect('blogbig/indexportfolio/showaddpf');
		}
	}
}