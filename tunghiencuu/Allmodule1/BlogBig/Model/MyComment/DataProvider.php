<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace AHT\BlogBig\Model\MyComment;

use AHT\BlogBig\Model\ResourceCommentModel\Comment\CollectionFactory;
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

	public function getData()
	{
		if (isset($this->loadedData)) {
			return $this->loadedData;
		}
		$items = $this->collection->getItems();
		/** @var \Magento\Cms\Model\Block $block */
		foreach ($items as $question) {
			$this->loadedData[$question->getId()] = $question->getData();
		}

		$data = $this->dataPersistor->get('myquestion');
		if (!empty($data)) {
			$question = $this->collection->getNewEmptyItem();
			$question->setData($data);
			$this->loadedData[$question->getId()] = $question->getData();
			$this->dataPersistor->clear('myquestion');
		}

		return $this->loadedData;
	}
}
