<?php

namespace AHT\BlogBig\Controller\Adminhtml\IndexPortfolio; // của mình

use Magento\Framework\Controller\ResultFactory;

class UploadImage extends \Magento\Backend\App\Action
{
	protected $imageUploader;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\AHT\BlogBig\Model\Image $imageUploader // của mình
	)
	{
		parent::__construct($context);
		$this->imageUploader = $imageUploader;
	}

	public function execute()
	{
		$imageId = $this->_request->getParam('param_name', 'image');
		try {
			$result = $this->imageUploader->saveFileToTmpDir($imageId);
			$result['cookie'] = [
				'name' => $this->_getSession()->getName(),
				'value' => $this->_getSession()->getSessionId(),
				'lifetime' => $this->_getSession()->getCookieLifetime(),
				'path' => $this->_getSession()->getCookiePath(),
				'domain' => $this->_getSession()->getCookieDomain(),
			];
		} catch (\Exception $e) {
			$result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
		}
		return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
	}
}