<?php

namespace AHT\Myoffice\Block\Adminhtml\Employee\Showupdate;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Framework\Data\FormFactory;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;

class Form extends Generic
{

	protected $_department;
	protected $_listCt;
	protected $_objectManager;

	public function __construct(
		Context $context,
		Registry $registry,
		FormFactory $formFactory,
		\Magento\Framework\ObjectManagerInterface $objectManager,
		\AHT\Myoffice\Model\Department $department,
		array $data)
	{
		$this->_objectManager = $objectManager;
		$this->_department = $department;
		parent::__construct($context, $registry, $formFactory, $data);
	}

	public function toOptionArray()
	{
		$items = $this->_objectManager->create(
			'AHT\Myoffice\Model\ResourceModel\Department\Collection'
		);

		$ret = [];
		foreach ($items->getData() as $value) {
			$ret[0] = "---";
			$ret[$value['entity_id']] = $value['name'];
		}
		return $ret;
	}

	public function _prepareForm()
	{
		$dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
		$id = $this->getRequest()->getParam('entity_id');

		$employees = $this->_objectManager->create(
			'AHT\Myoffice\Model\ResourceModel\Employee\Collection'
		);
		$employees->addAttributeToSelect('*');
		$employees->addFieldToFilter('entity_id', array('eq' => $id));

		$informationE = $employees->toArray();

		$form = $this->_formFactory->create(
			[
				"data" => [
					"id" => "edit_form",
					"action" => $this->getUrl("myoffice/indexemployee/addemployee"),
					"method" => "post",
				]
			]
		);

		$fieldset = $form->addFieldset(
			"base_fieldset",
			["legend" => __("Add New Employee"), "class" => "fieldset-wide"]
		);


		$fieldset->addField(
			"Department",
			"select",
			[
				"name" => "department_id",
				"label" => __("Department"),
				"required" => true,
				"value" => $informationE[$id]['department_id'],
				"options" => $this->toOptionArray(),
			]
		);

		$fieldset->addField(
			"Email",
			"text",
			[
				"name" => "email",
				"label" => __("Email"),
				"required" => true,
				"value" => $informationE[$id]['email'],
			]
		);

		$fieldset->addField(
			"First Name",
			"text",
			[
				"name" => "first_name",
				"label" => __("First Name"),
				"required" => true,
				"value" => $informationE[$id]['first_name'],
			]
		);

		$fieldset->addField(
			"Last Name",
			"text",
			[
				"name" => "last_name",
				"label" => __("Last Name"),
				"required" => true,
				"value" => $informationE[$id]['last_name'],
			]
		);

		$fieldset->addField(
			"Note",
			"textarea",
			[
				"name" => "note",
				"label" => __("Note"),
				"required" => true,
				"value" => $informationE[$id]['note'],
			]
		);

		$fieldset->addField(
			'Dob',
			'date',
			[
				'name' => 'dob',
				'date_format' => $dateFormat,
				'label' => __('Dob'),
				'title' => __('Dob'),
				'required' => true,
				'css_class' => 'admin__field-small',
				'class' => 'admin__control-text',
				"value" => $informationE[$id]['dob'],
			]
		);

		$fieldset->addField(
			"Salary",
			"text",
			[
				"name" => "salary",
				"label" => __("Salary"),
				"required" => true,
				"value" => $informationE[$id]['salary'],
			]
		);

		$fieldset->addField(
			"Service Years",
			"text",
			[
				"name" => "service_years",
				"label" => __("Service Years"),
				"required" => true,
				"value" => $informationE[$id]['service_years'],
			]
		);

		$form->setUseContainer(true);
		$this->setForm($form);
		return parent::_prepareForm();
	}

}