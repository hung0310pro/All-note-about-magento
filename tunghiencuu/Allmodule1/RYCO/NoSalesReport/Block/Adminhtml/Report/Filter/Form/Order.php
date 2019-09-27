<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace RYCO\NoSalesReport\Block\Adminhtml\Report\Filter\Form;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Registry;
use Magento\Catalog\Model\ProductRepository;


class Order extends \Magento\Backend\Block\Widget\Form\Generic
{
	/**
	 * Report type options
	 *
	 * @var array
	 */
	protected $_reportTypeOptions = [];

	protected $_collectionFactoryProduct;

	protected $_productRepository;


	public function __construct(
		Context $context,
		Registry $registry,
		FormFactory $formFactory,
		CollectionFactory $collectionFactoryProduct,
		ProductRepository $productRepository,
		array $data)
	{
		$this->_productRepository = $productRepository;
		$this->_collectionFactoryProduct = $collectionFactoryProduct;
		parent::__construct($context, $registry, $formFactory, $data);
	}


	/**
	 * Add report type option
	 *
	 * @param string $key
	 * @param string $value
	 * @return $this
	 * @codeCoverageIgnore
	 */
	public function addReportTypeOption($key, $value)
	{
		$this->_reportTypeOptions[$key] = __($value);
		return $this;
	}


	public function getAttributeSize()
	{
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$productRepository = $objectManager->get('\Magento\Catalog\Model\Product\Attribute\Repository');
		$sizes = $productRepository->get('size')->getOptions();
		$myArray = [];
		foreach ($sizes as $sizesOption) {
			if ($sizesOption->getValue() != '') {
				$myArray[1] = 'All';
				$myArray[$sizesOption->getValue()] = $sizesOption->getLabel();

			}
		}
		return $myArray;
	}

	/**
	 * Add fieldset with general report fields
	 *
	 * @return $this
	 */
	protected function _prepareForm()
	{
		$actionUrl = $this->getUrl('*/*/sales');

		/** @var \Magento\Framework\Data\Form $form */
		$form = $this->_formFactory->create(
			[
				'data' => [
					'id' => 'filter_form',
					'action' => $actionUrl,
					'method' => 'get'
				]
			]
		);

		$htmlIdPrefix = 'sales_report_';
		$form->setHtmlIdPrefix($htmlIdPrefix);
		$fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Filter')]);

		$dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);

		$fieldset->addField('store_ids', 'hidden', ['name' => 'store_ids']);


		$fieldset->addField(
			'from',
			'date',
			[
				'name' => 'from',
				'date_format' => $dateFormat,
				'label' => __('From'),
				'title' => __('From'),
				'required' => true,
				'css_class' => 'admin__field-small',
				'class' => 'admin__control-text'
			]
		);

		$fieldset->addField(
			'to',
			'date',
			[
				'name' => 'to',
				'date_format' => $dateFormat,
				'label' => __('To'),
				'title' => __('To'),
				'required' => true,
				'css_class' => 'admin__field-small',
				'class' => 'admin__control-text'
			]
		);

		$fieldset->addField(
			"size",
			"select",
			[
				"name" => "size",
				"label" => __("Size"),
				"required" => false,
				"options" => $this->getAttributeSize(),
			]
		);

		$fieldset->addField(
			"sku1",
			"text",
			[
				"name" => "sku1",
				"label" => __("SKU"),
				"required" => false,
				"note" => "Must write words separated by commas.",
			]
		);

		$fieldset->addField(
			"product_description",
			"text",
			[
				"name" => "product_description",
				"label" => __("Product Description"),
				"required" => false,
			]
		);


		$form->setUseContainer(true);
		$this->setForm($form);

		return parent::_prepareForm();
	}

	protected function _initFormValues()
	{
		$data = $this->getFilterData()->getData();

		foreach ($data as $key => $value) {
			if (is_array($value) && isset($value[0])) {
				$data[$key] = explode(',', $value[0]);
			}
		}
		$this->getForm()->addValues($data);
		return parent::_initFormValues();
	}
}
