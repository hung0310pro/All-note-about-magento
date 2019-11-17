<?php


namespace Stussy\CrosssellProduct\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;


class Data extends AbstractHelper
{

	protected $_productRepositoryFactory;

	protected $_objectManager;

	protected $_storeConfig;

	protected $_storeManagerInterface;

	protected $_currencyFactory;

	protected $_productFactory;

	public function __construct(
		\Magento\Catalog\Api\ProductRepositoryInterfaceFactory $productRepositoryFactory,
		\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
		\Magento\Framework\ObjectManagerInterface $objectManager,
		\Magento\Store\Model\StoreManagerInterface $storeManagerInterface,
		\Magento\Directory\Model\CurrencyFactory $currencyFactory,
		\Magento\Catalog\Model\ProductFactory $productFactory,
		Context $context
	)
	{
		$this->_productFactory = $productFactory;
		$this->_productRepositoryFactory = $productRepositoryFactory;
		$this->_objectManager = $objectManager;
		$this->_storeManagerInterface = $storeManagerInterface;
		$this->_currencyFactory = $currencyFactory;
		$this->_storeConfig = $scopeConfig;
		parent::__construct($context);
	}

	// get information product by id
	public function getProductCustom($id)
	{
		return $this->_productRepositoryFactory->create()->getById($id);
	}

	// get url image of category product.
	public function getBaseURLMedia()
	{
		$media = $this->_objectManager->get("Magento\Store\Model\StoreManagerInterface")
			->getStore()
			->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
		return $media;
	}

	// get image default
	public function getPlaceholderImage()
	{
		return $this->_storeConfig->getValue('catalog/placeholder/image_placeholder');
	}

	// get Current Sympoy
	public function getCurrentSympoy()
	{
		$currencyCode = $this->_storeManagerInterface->getStore()->getCurrentCurrencyCode();
		$currency = $this->_currencyFactory->create()->load($currencyCode);
		$currencySymbol = $currency->getCurrencySymbol();
		return $currencySymbol;
	}

	// get label attribute product

	public function getOptionLabelByValue($attributeCode, $optionId)
	{
		$_product = $this->_productFactory->create();
		$isAttributeExist = $_product->getResource()->getAttribute($attributeCode);
		$optionText = '';
		if ($isAttributeExist && $isAttributeExist->usesSource()) {
			$optionText = $isAttributeExist->getSource()->getOptionText($optionId);
		}
		return $optionText;
	}

}
