<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace RYCO\ReportOrders\Block\Adminhtml\Sales\Sales;

use Magento\Framework\ObjectManagerInterface;
use Magento\Catalog\Model\ProductRepository;


class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
	/**
	 * @var string
	 */
	protected $_template = 'RYCO_ReportOrders::widget/grid/extended.phtml';

	/**
	 * @param \Magento\Backend\Block\Template\Context $context
	 * @param \Magento\Backend\Helper\Data $backendHelper
	 * @param \Magento\Sales\Model\ResourceModel\Order\Grid\CollectionFactory $collectionFactory
	 * @param array $data
	 */
	protected $_productRepository;

	protected $_objectManager;

	public function __construct(
		\Magento\Backend\Block\Template\Context $context,
		\Magento\Backend\Helper\Data $backendHelper,
		\Magento\Sales\Model\ResourceModel\Order\Item\CollectionFactory $collectionFactory,
		ObjectManagerInterface $objectManager,
		ProductRepository $productRepository,
		array $data = []
	)
	{
		$this->_collectionFactory = $collectionFactory;
		$this->_productRepository = $productRepository;
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
			$collection = $this->_collectionFactory->create();
			$collection->getSelect()->join(
				['o' => 'sales_order'],
				'main_table.order_id = o.entity_id',
				['increment_id', 'o_created_at' => 'o.created_at']
			)->join(
				['b' => 'sales_order_address'],
				'main_table.order_id = b.parent_id AND b.address_type = "shipping"',
				['b.*']
			)->joinLeft(
				['p' => 'catalog_product_entity'],
				'main_table.product_id = p.entity_id',
				['psku' => 'p.sku']
			)->join(
				['eav' => 'eav_attribute'],
				'eav.attribute_code = "description" AND eav.entity_type_id = 4',
				[]
			)->joinLeft(
				['pt' => 'catalog_product_entity_text'],
				'eav.attribute_id = pt.attribute_id AND main_table.product_id = pt.entity_id',
				['description' => 'pt.value']
			);
			$this->setCollection($collection);
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
		$collection = $this->getCollection();
		$collection->getSelect()->__toString();
		echo $collection->getSelect();
		$filterData = $this->getFilterData();
		if (empty($filterData->getData())) {
			$collection->addFieldToFilter('item_id', ['eq' => 0]);
		} else {
			if (isset($filterData) && !empty($filterData)) {
				$collection->getSelect()->reset('where');
				$where = '';
				if ((isset($filterData['from']) && $filterData['from']) &&
					(isset($filterData['to']) && $filterData['to'])
				) {
					$where .= ' AND (o.created_at BETWEEN "' . $filterData['from'] . '" AND "' . $filterData['to'] . '")';
				} else if (isset($filterData['from']) && $filterData['from']) {
					$where .= ' AND (o.created_at > "' . $filterData['from'] . '" OR o.created_at = "' . $filterData['from'] . '")';
				} else if (isset($filterData['to']) && $filterData['to']) {
					$where .= ' AND (o.created_at < "' . $filterData['to'] . '" OR o.created_at = "' . $filterData['to'] . '")';
				}

				if (isset($filterData['area']) && $filterData['area']) {
					$where .= ' AND ((b.telephone LIKE "%' . $filterData['area'] . '%") OR  (b.street LIKE "%' . $filterData['area'] . '%") OR (b.city LIKE "%' . $filterData['area'] . '%" ) OR (b.country_id LIKE "%' . $filterData['area'] . '%") OR (b.postcode LIKE "%' . $filterData['area'] . '%"))';
				}

				if (isset($filterData['product_description']) && $filterData['product_description']) {
					$where .= ' AND (pt.value LIKE "%' . $filterData['product_description'] . '%" OR pt.value = "" OR pt.value IS NULL)';
				}
				if (isset($filterData['sku']) && $filterData['sku']) {
					$skus = explode(",", $filterData['sku']);
					$arraySku = [];
					$aSkus = [];
					foreach ($skus as $val) {
						if (!in_array($val, $aSkus)) {
							$aSkus[] = $val;
							$arraySku[] = "'$val'";
						}
					}
					$where .= ' AND p.sku in (' . implode(",", $arraySku) . ')';
				}

				$collection->getSelect()->where('main_table.parent_item_id IS NULL ' . $where)->order('o.increment_id DESC');
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
			'o_created_at',
			[
				'header' => __('Purchase Date'),
				'index' => 'o_created_at',
				'type' => 'date',
				'sortable' => false,
				'header_css_class' => 'col-orders',
				'column_css_class' => 'col-orders'
			]
		);
		$this->addColumn(
			'increment_id',
			[
				'header' => __('ID'),
				'index' => 'increment_id',
				'type' => 'text',
				'sortable' => false,
				'header_css_class' => 'col-orders',
				'column_css_class' => 'col-orders'
			]
		);
		$this->addColumn(
			'thumbnail',
			[
				'header' => __('Thumbnail'),
				'sortable' => false,
				'index' => 'entity_id',
				'renderer' => 'RYCO\ReportOrders\Block\Adminhtml\Sales\Sales\Grid\Renderer\Image'

			]
		);
		$this->addColumn(
			'qty_ordered',
			[
				'header' => __('Quantity sold'),
				'index' => 'qty_ordered',
				'type' => 'number',
				'sortable' => false
			]
		);

		$this->addColumn(
			'price_incl_tax',
			[
				'header' => __('Subtotal'),
				'index' => 'price_incl_tax',
				'type' => 'currency',
				'sortable' => false,
			]
		);

		$this->addColumn(
			'name',
			[
				'header' => __('Product Name'),
				'index' => 'name',
				'type' => 'text',
				'sortable' => false,
			]
		);

		$this->addColumn(
			'psku',
			[
				'header' => __('Product SKU'),
				'index' => 'psku',
				'type' => 'text',
				'sortable' => false
			]
		);

		$this->addColumn(
			'size',
			[
				'header' => __('Size'),
				'index' => 'size',
				'type' => 'text',
				'sortable' => false,
				'renderer' => 'RYCO\ReportOrders\Block\Adminhtml\Sales\Sales\Grid\Renderer\SizeProduct'
			]
		);

		$this->addColumn(
			'description',
			[
				'header' => __('Description'),
				'index' => 'description',
				'type' => 'text',
				'sortable' => false,
				'renderer' => 'RYCO\ReportOrders\Block\Adminhtml\Sales\Sales\Grid\Renderer\Description'
			]
		);

		$this->addColumn(
			'shipping_address',
			[
				'header' => __('Ship Address'),
				'index' => 'shipping_address',
				'type' => 'text',
				'sortable' => false,
				'renderer' => 'RYCO\ReportOrders\Block\Adminhtml\Sales\Sales\Grid\Renderer\ShipAddress'
			]
		);
		return parent::_prepareColumns();
	}

	/**
	 * @return array
	 */


	public function getCountTotals()
	{
		$filterData = $this->getFilterData();
		if (!empty($filterData->getData())) {
			$collection = $this->_collectionFactory->create();
			$where = "";
			if ((isset($filterData['from']) && $filterData['from']) &&
				(isset($filterData['to']) && $filterData['to'])
			) {
				$where .= ' AND (r.created_at BETWEEN "' . $filterData['from'] . '" AND "' . $filterData['to'] . '")';
			} else if (isset($filterData['from']) && $filterData['from']) {
				$where .= ' AND (r.created_at > "' . $filterData['from'] . '" OR r.created_at = "' . $filterData['from'] . '")';
			} else if (isset($filterData['to']) && $filterData['to']) {
				$where .= ' AND (r.created_at < "' . $filterData['to'] . '" OR r.created_at = "' . $filterData['to'] . '")';
			}
			if (isset($filterData['sku']) && $filterData['sku']) {
				$skus = explode(",", $filterData['sku']);
				$arraySku = [];
				$aSkus = [];
				foreach ($skus as $val) {
					if (!in_array($val, $aSkus)) {
						$aSkus[] = $val;
						$arraySku[] = "'$val'";
					}
				}
				$where .= ' AND p.sku in (' . implode(",", $arraySku) . ')';
			}

			if (isset($filterData['product_description']) && $filterData['product_description']) {
				$where .= ' AND (pt.value LIKE "%' . $filterData['product_description'] . '%" OR pt.value = "" OR pt.value IS NULL)';
			}
			if (isset($filterData['area']) && $filterData['area']) {
				$where .= ' AND ((b.telephone LIKE "%' . $filterData['area'] . '%") OR  (b.street LIKE "%' . $filterData['area'] . '%") OR (b.city LIKE "%' . $filterData['area'] . '%" ) OR (b.country_id LIKE "%' . $filterData['area'] . '%") OR (b.postcode LIKE "%' . $filterData['area'] . '%"))';
			}

			$collection->getSelect()->join(
				['o' => 'sales_order_grid'],
				'main_table.order_id = o.entity_id',
				[]
			)->join(
				['r' => 'sales_order'],
				'main_table.order_id = r.entity_id',
				['total_qty' => 'SUM(qty_ordered)']
			)->join(
				['b' => 'sales_order_address'],
				'main_table.order_id = b.parent_id AND b.address_type = "shipping"',
				[]
			)->joinLeft(
				['p' => 'catalog_product_entity'],
				'main_table.product_id = p.entity_id',
				[]
			)->join(
				['eav' => 'eav_attribute'],
				'eav.attribute_code = "description" AND eav.entity_type_id = 4',
				[]
			)->joinLeft(
				['pt' => 'catalog_product_entity_text'],
				'eav.attribute_id = pt.attribute_id AND main_table.product_id = pt.entity_id',
				[]
			)->columns(['total' => 'SUM(price_incl_tax)'])->where('parent_item_id is null' . $where)->order('r.increment_id DESC');

			$collectionData = $collection->toArray();
			if ($collectionData['totalRecords']) {
				$this->setTotalRecords($collectionData['totalRecords']);
				$this->setTotalQty($collectionData['items'][0]['total_qty']);
				$this->setTotal($collectionData['items'][0]['total']);
				return true;
			}
		}
		return parent::getCountTotals();
	}

	public function formatPrice($value)
	{
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of Object Manager
		$priceHelper = $objectManager->create('Magento\Framework\Pricing\Helper\Data');
		return $priceHelper->currency($value, true, false);
	}
}