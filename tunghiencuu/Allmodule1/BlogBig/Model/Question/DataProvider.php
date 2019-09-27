<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace AHT\BlogBig\Model\Question;

use AHT\BlogBig\Model\ResourcePortfolioModel\Portfolio\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magento\Framework\ObjectManagerInterface;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\ModifierPoolDataProvider
{
	/**
	 * @var \Magento\Cms\Model\ResourceModel\Block\Collection
	 */
	protected $collection;

	protected $_objectManager;

	/**
	 * @var DataPersistorInterface
	 */
	protected $dataPersistor;

	/**
	 * @var array
	 */
	protected $_loadedData;

	/**
	 * Constructor
	 *
	 * @param string $name
	 * @param string $primaryFieldName
	 * @param string $requestFieldName
	 * @param CollectionFactory $blockCollectionFactory
	 * @param DataPersistorInterface $dataPersistor
	 * @param array $meta
	 * @param array $data
	 * @param PoolInterface|null $pool
	 */
	public function __construct(
		$name,
		$primaryFieldName,
		$requestFieldName,
		CollectionFactory $questionCollectionFactory,
		DataPersistorInterface $dataPersistor,
		ObjectManagerInterface $objectManager,
		array $meta = [],
		array $data = [],
		PoolInterface $pool = null
	)
	{
		$this->_objectManager = $objectManager;
		$this->collection = $questionCollectionFactory->create();
		$this->dataPersistor = $dataPersistor;
		parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
	}

	/**
	 * Get data
	 *
	 * @return array
	 */
	public function getBaseURLMedia()
	{
		$media = $this->_objectManager->get("Magento\Store\Model\StoreManagerInterface")
			->getStore()
			->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
		return $media;
	}

	// trả về dữ liệu khi muốn update
	public function getData()
	{
		if (isset($this->_loadedData)) {
			return $this->_loadedData;
		}
		$urlMedia = $this->getBaseUrlMedia(); // lấy link tới hình ảnh
		$link = $urlMedia . "test/tmp";

		$items = $this->collection->getItems();  // cái này hình như lấy ra các cột??

		foreach ($items as $brand) {
			$brandData = $brand->getData();
			$brand_img = $brandData['image'];
			$brand_thum = $brandData['thumbnail'];
			unset($brandData['image']);
			unset($brandData['thumbnail']);
			$brandData['image'][0]['name'] = $brand_img;
			$brandData['image'][0]['url'] = $link . "/" . $brand_img;
			$brandData['thumbnail'][0]['name'] = $brand_thum;
			$brandData['thumbnail'][0]['url'] = $link . "/" . $brand_thum;
			$this->_loadedData[$brandData['id']] = $brandData;
		}
		return $this->_loadedData;
	}
}
