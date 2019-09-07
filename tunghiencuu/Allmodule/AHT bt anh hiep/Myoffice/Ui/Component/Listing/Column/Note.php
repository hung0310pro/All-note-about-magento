<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace AHT\Myoffice\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;

/**
 * @api
 * @since 100.0.2
 */
class Note extends \Magento\Ui\Component\Listing\Columns\Column
{
	/**
	 * Column name
	 */
	const NAME = 'column.price';

	/**
	 * @var \Magento\Framework\Locale\CurrencyInterface
	 */
	protected $localeCurrency;

	protected $_objectManager;

	/**
	 * @param ContextInterface $context
	 * @param UiComponentFactory $uiComponentFactory
	 * @param \Magento\Framework\Locale\CurrencyInterface $localeCurrency
	 * @param \Magento\Store\Model\StoreManagerInterface $storeManager
	 * @param array $components
	 * @param array $data
	 */
	public function __construct(
		ContextInterface $context,
		UiComponentFactory $uiComponentFactory,
		\Magento\Framework\ObjectManagerInterface $objectManager,
		\Magento\Framework\Locale\CurrencyInterface $localeCurrency,
		\Magento\Store\Model\StoreManagerInterface $storeManager,
		array $components = [],
		array $data = []
	)
	{
		parent::__construct($context, $uiComponentFactory, $components, $data);
		$this->localeCurrency = $localeCurrency;
		$this->_objectManager = $objectManager;
		$this->storeManager = $storeManager;
	}

	/**
	 * Prepare Data Source
	 *
	 * @param array $dataSource
	 * @return array
	 */
	public function prepareDataSource(array $dataSource)
	{

		$items = $this->_objectManager->create(
			'AHT\Myoffice\Model\ResourceModel\Employee\Collection'
		);
		$items->addAttributeToSelect('*');

		$data = [
			'items' => array_values($items->toArray()),
		];
		$data1['data'] = $data;
		return $data1;
	}
}
