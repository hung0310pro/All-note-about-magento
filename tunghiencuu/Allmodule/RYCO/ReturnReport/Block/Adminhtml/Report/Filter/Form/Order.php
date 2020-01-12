<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace RYCO\ReturnReport\Block\Adminhtml\Report\Filter\Form;

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

	public function getAttributeSeason()
	{
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$productRepository = $objectManager->get('\Magento\Catalog\Model\Product\Attribute\Repository');
		$seasons = $productRepository->get('season')->getOptions();
		$myArray = [];
		foreach ($seasons as $seasonOption) {
			if ($seasonOption->getValue() != '') {
				$myArray[1] = 'All';
				$myArray[$seasonOption->getValue()] = $seasonOption->getLabel();

			}
		}
		return $myArray;
	}

	public function getAttributeType()
	{
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$productRepository = $objectManager->get('\Magento\Catalog\Model\Product\Attribute\Repository');
		$types = $productRepository->get('type')->getOptions();
		$myArray = [];
		foreach ($types as $typeOption) {
			if ($typeOption->getValue() != '') {
				$myArray[1] = 'All';
				$myArray[$typeOption->getValue()] = $typeOption->getLabel();

			}
		}
		return $myArray;
	}

	public function getAttributeBrand()
	{
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$productRepository = $objectManager->get('\Magento\Catalog\Model\Product\Attribute\Repository');
		$brands = $productRepository->get('ryco_brand')->getOptions();
		$myArray = [];
		foreach ($brands as $brandOption) {
			if ($brandOption->getValue() != '') {
				$myArray[1] = 'All';
				$myArray[$brandOption->getValue()] = $brandOption->getLabel();

			}
		}
		return $myArray;
	}


	public function getAttributeSupplier()
	{
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$productRepository = $objectManager->get('\Magento\Catalog\Model\Product\Attribute\Repository');
		$suppliers = $productRepository->get('brand')->getOptions();
		$myArray = [];
		foreach ($suppliers as $supplierOption) {
			if ($supplierOption->getValue() != '') {
				$myArray[1] = 'All';
				$myArray[$supplierOption->getValue()] = $supplierOption->getLabel();

			}
		}
		return $myArray;
	}

	public function getAttributeColour()
	{
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$productRepository = $objectManager->get('\Magento\Catalog\Model\Product\Attribute\Repository');
		$colours = $productRepository->get('color')->getOptions();
		$myArray = [];
		foreach ($colours as $colourOption) {
			if ($colourOption->getValue() != '') {
				$myArray[1] = 'All';
				$myArray[$colourOption->getValue()] = $colourOption->getLabel();

			}
		}
		return $myArray;
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
				'required' => false,
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
				'required' => false,
				'css_class' => 'admin__field-small',
				'class' => 'admin__control-text'
			]
		);

		$fieldset->addField(
			"sizes",
			"select",
			[
				"name" => "sizes",
				"label" => __("Size"),
				"required" => false,
				"options" => $this->getAttributeSize(),
			]
		);

		$fieldset->addField(
			"season",
			"select",
			[
				"name" => "season",
				"label" => __("Season"),
				"required" => false,
				"options" => $this->getAttributeSeason(),
			]
		);

		$fieldset->addField(
			"type",
			"select",
			[
				"name" => "type",
				"label" => __("Type"),
				"required" => false,
				"options" => $this->getAttributeType(),
			]
		);

		$fieldset->addField(
			"brand",
			"select",
			[
				"name" => "brand",
				"label" => __("Brand"),
				"required" => false,
				"options" => $this->getAttributeBrand(),
			]
		);

		$fieldset->addField(
			"supplier",
			"select",
			[
				"name" => "supplier",
				"label" => __("Supplier"),
				"required" => false,
				"options" => $this->getAttributeSupplier(),
			]
		);

		$fieldset->addField(
			"colour",
			"select",
			[
				"name" => "colour",
				"label" => __("Colour"),
				"required" => false,
				"options" => $this->getAttributeColour(),
			]
		);

		$fieldset->addField(
			"sku",
			"text",
			[
				"name" => "sku",
				"label" => __("SKU"),
				"required" => false,
				"note" => "Must write words separated by commas.",
			]
		);

		$fieldset->addField(
			"area",
			"text",
			[
				"name" => "area",
				"label" => __("Area"),
				"required" => false,
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
