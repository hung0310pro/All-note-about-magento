<?php

namespace Convert\CategoryThumbnail\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

class Data extends AbstractHelper
{
	const ATTRIBUTE_NAME = "category_thumbnail";

	const ATTRIBUTE_NAME_MOBLE = "category_mobile_thumbnail";

	/**
	 * Store manager
	 *
	 * @var \Magento\Store\Model\StoreManagerInterface
	 */
	protected $_storeManager;

	/**
	 * @var \Magento\Framework\Url\Helper\Data
	 */
	protected $urlHelper;

	protected $_registry;

	protected $customerSession;

	public function __construct(
		Context $context,
		\Magento\Catalog\Model\CategoryFactory $_categoryloader,
		\Magento\Store\Model\StoreManagerInterface $storeManager,
		\Magento\Framework\Registry $registry,
		\Magento\Customer\Model\Session $customerSession,
		\Magento\Framework\Url\Helper\Data $urlHelper
	)
	{
		parent::__construct($context);
		$this->_categoryloader = $_categoryloader;
		$this->_storeManager = $storeManager;
		$this->_registry = $registry;
		$this->urlHelper = $urlHelper;
		$this->customerSession = $customerSession;
	}

	public function getLoadCategory($id)
	{
		return $this->_categoryloader->create()->load($id);
	}

	public function getMediaUrl()
	{
		return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
	}

	/**
	 * Retrieve image URL by category
	 *
	 * @return string
	 */
	public function getImageUrl(\Magento\Catalog\Model\Category $category)
	{
		$image = $category->getData(self::ATTRIBUTE_NAME);

		return $this->getUrl($image);
	}

	public function getImageMobileUrl(\Magento\Catalog\Model\Category $category)
	{
		$image = $category->getData(self::ATTRIBUTE_NAME_MOBLE);

		return $this->getUrl($image);
	}

	/**
	 * Retrieve URL
	 *
	 * @return string
	 */
	public function getUrl($value)
	{
		$url = false;
		if ($value) {
			if (is_string($value)) {
				$url = $this->_storeManager->getStore()->getBaseUrl(
						\Magento\Framework\UrlInterface::URL_TYPE_MEDIA
					) . 'catalog/category/' . $value;
			} else {
				throw new \Magento\Framework\Exception\LocalizedException(
					__('Something went wrong while getting the image url.')
				);
			}
		}

		return $url;
	}

	/**
	 * Checking customer login status
	 *
	 * @return bool
	 * @api
	 */
	public function isLoggedIn()
	{
		return $this->customerSession->isLoggedIn();
	}

	public function getBaseUrl($path)
	{
		return $this->_storeManager->getStore()->getBaseUrl(
				\Magento\Framework\UrlInterface::URL_TYPE_WEB
			) . $path;
	}

	/**
	 * Get store identifier
	 *
	 * @return  int
	 */
	public function getStoreId()
	{
		return $this->_storeManager->getStore()->getId();
	}
}
