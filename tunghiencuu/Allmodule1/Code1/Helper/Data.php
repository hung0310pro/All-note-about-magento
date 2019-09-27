<?php

namespace Convert\Catalog\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Catalog\Model\ProductRepository;
use Magento\Cms\Block\Adminhtml\Page\Grid\Renderer\Action\UrlBuilder;

class Data extends AbstractHelper
{
	protected $_session;
	protected $_productloader;
	protected $_filesystem;
	protected $_imageFactory;
	protected $_coreRegistry;
	protected $_objectManager;
	protected $_productImageHelper;
	protected $_collectionFactory;
	protected $_productRepository;
	protected $_actionUrlBuilder;

	public function __construct(
		\Magento\Framework\App\Helper\Context $context,
		\Magento\Customer\Model\Session $session,
		\Magento\Catalog\Model\ProductFactory $_productloader,
		\Magento\Framework\Registry $coreRegistry,
		\Magento\Framework\ObjectManagerInterface $objectManager,
		CollectionFactory $collectionFactory,
		ProductRepository $productRepository,
		UrlBuilder $actionUrlBuilder,
		\Magento\Framework\Filesystem $filesystem,
		\Magento\Framework\Image\AdapterFactory $imageFactory,
		\Magento\Catalog\Helper\Image $productImageHelper,
		array $data = []
	)
	{
		$this->_session = $session;
		$this->_actionUrlBuilder = $actionUrlBuilder;
		$this->_productRepository = $productRepository;
		$this->_productloader = $_productloader;
		$this->_coreRegistry = $coreRegistry;
		$this->_collectionFactory = $collectionFactory;
		$this->_objectManager = $objectManager;
		$this->_filesystem = $filesystem;
		$this->_imageFactory = $imageFactory;
		$this->_productImageHelper = $productImageHelper;
		parent::__construct($context, $data);
	}

	public function isCustomerLoggedIn()
	{
		if ($this->_session->isLoggedIn()) {
			return 1;
		}
		return 0;
	}

	/**
	 * @param $id
	 * @return \Magento\Catalog\Model\Product
	 */
	public function getLoadProduct($id)
	{
		return $this->_productloader->create()->load($id);
	}

	public function getProduct()
	{
		return $this->_coreRegistry->registry('current_product');
	}

	public function getImage()
	{
		return 1;
	}


	public function getUrlMedia()
	{
		$media = $this->_objectManager->get("Magento\Store\Model\StoreManagerInterface")
			->getStore()
			->getBaseUrl();
		return $media;
	}

	/*	 Get Option id by Option Label (1)
		public function getOptionIdByLabel($attributeCode,$optionLabel)
		{
			$_product = $this->productFactory->create();
			$isAttributeExist = $_product->getResource()->getAttribute($attributeCode);
			$optionId = '';
			if ($isAttributeExist && $isAttributeExist->usesSource()) {
				$optionId = $isAttributeExist->getSource()->getOptionId($optionLabel);
			}
			return $optionId;
	}
    // cái này thuộc cái trên luôn, truyền value label và name attributecode
	$age = isset($_GET['age-range']) ? $_GET['age-range'] : 'n';

	$ageid = $this->getOptionIdByLabel('age_range_quiz', $age); (1)*/


	/*public function retrieveOptions($custom_attribute_code)(2)
	{
		$attribute = $this->eavConfig->getAttribute('catalog_product', $custom_attribute_code);
		$options = $attribute->getSource()->getAllOptions();

		$Agearray = [];
		$a = 0;
		foreach ($options as $key) {
			$Agearray[$a]['label'] = $key['label'];
			$Agearray[$a]['value'] = $key['value'];
			$a++;
		}
		return $Agearray;
	}
	(2) get all value of atribute (ví dụ như là dropdown attribute $arrayDehydration = $block->retrieveOptions('loss_of_dehydration');)*/

	/*public function encodesomthing(array $data)
	{
		$encodedata = $this->jsonHelper->jsonEncode($data);
		return $encodedata;
	}*/


	public function getBaseUrlMedia($routpath, $websiteIds, $product_redirect_to)
	{

		$_product = $this->_productloader->create();
		$url = 1;
		$media = $this->_objectManager->get("Magento\Store\Model\StoreManagerInterface")
			->getStores();
		// nếu là $websiteIds 2 thì check theo tk  $websiteIds
		if (count($websiteIds) == 2) {
			if ($websiteIds[1] == 2) {
				foreach ($media as $key => $value) {
					// đoạn này lấy url theo storeview code $key là id của storeview
					if ($value['code'] == 'poni') {
						$url = $this->_actionUrlBuilder->getUrl($routpath, $value['code'], $key);
					}
				}
			} else if ($websiteIds[1] == 3) {
				foreach ($media as $key => $value) {
					if ($value['code'] == 'esmi') {
						$url = $this->_actionUrlBuilder->getUrl($routpath, $value['code'], $key);
					}
				}
			} // nếu là $websiteIds 3 thì check theo tk  $product_redirect_to
		} else if (count($websiteIds) == 3) {
			// $product_redirect_to  là value của attribute đó (value của select option)
			// lấy text của attribute option (product_redirect_to: là atributecode)

			$attr = $_product->getResource()->getAttribute("product_redirect_to");
			if ($attr->usesSource()) {
				// lấy giá trị text của cái value tương ứng đó
				$optionText = $attr->getSource()->getOptionText($product_redirect_to);
			}

			if ($optionText == 'esmi') {
				foreach ($media as $key => $value) {
					if ($value['code'] == 'esmi') {
						// đoạn này lấy url theo storeview code $key là id của storeview
						$url = $this->_actionUrlBuilder->getUrl($routpath, $value['code'], $key);
					}
				}
			} else if ($optionText == 'poni') {
				foreach ($media as $key => $value) {
					if ($value['code'] == 'poni') {
						// đoạn này lấy url theo storeview code $key là id của storeview
						$url = $this->_actionUrlBuilder->getUrl($routpath, $value['code'], $key);
					}
				}
			}

		}
		return $url;
	}

	public function resizeImage($imageFile, $width = null, $height = null)
	{
		$absolutePath = $this->_filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA)->getAbsolutePath('catalog/product') . $imageFile;
		if (!file_exists($absolutePath)) return false;
		$imageResized = $this->_filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA)->getAbsolutePath('catalog/product/resized/' . $width . '/') . $imageFile;
		if (!file_exists($imageResized)) {
			$imageResize = $this->_imageFactory->create();
			$imageResize->open($absolutePath);
			$imageResize->constrainOnly(TRUE);
			$imageResize->keepTransparency(TRUE);
			$imageResize->keepFrame(FALSE);
			$imageResize->keepAspectRatio(TRUE);
			$imageResize->resize($width, $height);

			$destination = $imageResized;

			$imageResize->save($destination);
		}
		$resizedURL = $this->_objectManager->get("Magento\Store\Model\StoreManagerInterface")->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'catalog/product/resized/' . $width . '/' . $imageFile;
		return $resizedURL;
	}

}