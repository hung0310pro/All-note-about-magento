<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace RYCO\StockReport\Block\Adminhtml\Sales\Sales;

use function Couchbase\passthruEncoder;
use Magento\Framework\ObjectManagerInterface;
use Magento\Catalog\Model\ProductRepository;


class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
	/**
	 * @var string
	 */
	protected $_template = 'RYCO_StockReport::widget/grid/extended.phtml';

	/**
	 * @param \Magento\Backend\Block\Template\Context $context
	 * @param \Magento\Backend\Helper\Data $backendHelper
	 * @param \Magento\Sales\Model\ResourceModel\Order\Grid\CollectionFactory $collectionFactory
	 * @param array $data
	 */
	protected $_productRepository;

	protected $_objectManager;

	protected $_productCollectionFactory;

	protected $_collectionFactory;

	public function __construct(
		\Magento\Backend\Block\Template\Context $context,
		\Magento\Backend\Helper\Data $backendHelper,
		\Magento\Sales\Model\ResourceModel\Order\Item\CollectionFactory $collectionFactory,
		\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
		ObjectManagerInterface $objectManager,
		ProductRepository $productRepository,
		array $data = []
	)
	{
		$this->_productCollectionFactory = $productCollectionFactory;
		$this->_collectionFactory = $collectionFactory;
		$this->_productRepository = $productRepository;
		$this->_objectManager = $objectManager;
		parent::__construct($context, $backendHelper, $data);
	}

	/**
	 * Pseudo constructor
	 *
	 * @return void
	 */
	protected function _construct()
	{
		parent::_construct();
		$this->setFilterVisibility(false);
	}

	/**
	 * @return \Magento\Framework\Data\Collection
	 */
	public function getCollection()
	{
		if ($this->_collection === null) {
			$this->setCollection($this->_productCollectionFactory->create()->addAttributeToSelect('*'));
		}
		return $this->_collection;
	}

	/**
	 * @return $this|\Magento\Backend\Block\Widget\Grid
	 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
	 * @SuppressWarnings(PHPMD.NPathComplexity)
	 */

	protected function _prepareCollection()
	{
		$collectionProduct = $this->getCollection();
		$collection = $this->_collectionFactory->create();
		$filterData = $this->getFilterData();

		if (empty($filterData->getData())) {
			$collectionProduct->addFieldToFilter('entity_id', ['eq' => 0]);
		} else {
			if (count($filterData->getData()) > 0 && !empty($filterData->getData())) {


				$where = '';

				if ((isset($filterData['from']) && $filterData['to'])) {
					$where .= ' (o.created_at BETWEEN "' . $filterData['from'] . '" AND "' . $filterData['to'] . '")';
				}

				$collection->getSelect()->join(
					['o' => 'sales_order'],
					'main_table.order_id = o.entity_id',
					[]
				);

				$myArray = [];
				if ($where) {
					$collection->getSelect()->where($where);
					$a = 0;
					foreach ($collection->getData() as $value) {
						if (!in_array($value['product_id'], $myArray)) {
							$myArray[$a] = $value['product_id'];
							$a++;
						}
					}
				}


				$arraySku = [];
				if (isset($filterData['sku1']) && !empty($filterData['sku1'])) {
					$collectionProduct1 = $this->getCollection();
					$sku = explode(",", $filterData['sku1']);
					foreach ($sku as $key => $value) {
						$collection1 = clone $collectionProduct1;
						$collection1->addFieldToFilter('sku', array("eq" => $value));
						if ($collection1->getData()[0]['type_id'] == "configurable") {
							$configProduct = $this->_objectManager->create('Magento\Catalog\Model\Product')->load($collection1->getData()[0]['entity_id']);
							$_children = $configProduct->getTypeInstance()->getUsedProducts($configProduct);
							foreach ($_children as $child) {
								array_push($arraySku, $child->getID());
							}
						} else {
							array_push($arraySku, $collection1->getData()[0]['entity_id']);
						}
						$collection1->clear()->getSelect()->reset('where');
					}
				}

				if (count($myArray) > 0) {
					$collectionProduct->addFieldToFilter('entity_id', array("nin" => array($myArray)));
				}
				if (isset($filterData['sku1'])) {
					$collectionProduct->addFieldToFilter('entity_id', array('in' => array($arraySku)));
				}

				if (isset($filterData['size'])) {
					if ($filterData['size'] != 1) {
						$collectionProduct->addAttributeToFilter('size', array('eq' => $filterData['size']));
					}
				}

				if (isset($filterData['season'])) {
					if ($filterData['season'] != 1) {
						$collectionProduct->addAttributeToFilter('season', array('eq' => $filterData['season']));
					}
				}

				if (isset($filterData['type'])) {
					if ($filterData['type'] != 1) {
						$collectionProduct->addAttributeToFilter('type', array('eq' => $filterData['type']));
					}
				}
				if (isset($filterData['brand'])) {
					if ($filterData['brand'] != 1) {
						$collectionProduct->addAttributeToFilter('ryco_brand', array('eq' => $filterData['brand']));
					}
				}
				if (isset($filterData['supplier'])) {
					if ($filterData['supplier'] != 1) {
						$collectionProduct->addAttributeToFilter('brand', array('eq' => $filterData['supplier']));
					}
				}
				if (isset($filterData['colour'])) {
					if ($filterData['colour'] != 1) {
						$collectionProduct->addAttributeToFilter('color', array('eq' => $filterData['colour']));
					}
				}

				if (isset($filterData['product_description'])) {
					$collectionProduct->addAttributeToFilter('description', array('like' => '%' . $filterData['product_description'] . '%'));
				}

				$collectionProduct->addAttributeToFilter('status', array('eq' => 1))->joinField('stock_item', 'cataloginventory_stock_item', 'qty', 'product_id = entity_id', 'qty != 0')->setOrder('entity_id', 'DESC');
			}

		}
		return parent::_prepareCollection();
	}

	/**
	 * {@inheritdoc}
	 *
	 * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
	 */
	protected function _prepareColumns()
	{

		$this->addColumn(
			'name',
			[
				'header' => __('Product Name'),
				'index' => 'name',
				'type' => 'text',
				'sortable' => false,
				'renderer' => 'RYCO\StockReport\Block\Adminhtml\Sales\Sales\Grid\Renderer\NameProduct'
			]
		);

		$this->addColumn(
			'thumbnail',
			[
				'header' => __('Thumbnail'),
				'sortable' => false,
				'index' => 'entity_id',
				'renderer' => 'RYCO\StockReport\Block\Adminhtml\Sales\Sales\Grid\Renderer\Image'

			]
		);

		$this->addColumn(
			'qty',
			[
				'header' => __('Qty'),
				'index' => 'qty',
				'type' => 'text',
				'sortable' => false,
				'renderer' => 'RYCO\StockReport\Block\Adminhtml\Sales\Sales\Grid\Renderer\QtyProduct'
			]
		);

		$this->addColumn(
			'sku',
			[
				'header' => __('Product SKU'),
				'index' => 'sku',
				'type' => 'text',
				'sortable' => false,
				'renderer' => 'RYCO\StockReport\Block\Adminhtml\Sales\Sales\Grid\Renderer\SkuProduct'
			]
		);

		$this->addColumn(
			'sizepr',
			[
				'header' => __('Size'),
				'index' => 'sizepr',
				'type' => 'text',
				'sortable' => false,
				'renderer' => 'RYCO\StockReport\Block\Adminhtml\Sales\Sales\Grid\Renderer\SizeProduct'
			]
		);


		$this->addColumn(
			'description',
			[
				'header' => __('Description'),
				'index' => 'description',
				'type' => 'text',
				'sortable' => false,
				'renderer' => 'RYCO\StockReport\Block\Adminhtml\Sales\Sales\Grid\Renderer\DescriptionProduct'
			]
		);

		return parent::_prepareColumns();
	}

	/**
	 * @return array
	 */
}