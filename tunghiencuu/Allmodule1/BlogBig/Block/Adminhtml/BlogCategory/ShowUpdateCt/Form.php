<?php

namespace AHT\BlogBig\Block\Adminhtml\BlogCategory\ShowUpdateCt;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use AHT\BlogBig\Model\CategoryFactory;

class Form extends Generic
{
	protected $_tagsStatus;
	protected $_category;

	public function __construct(
		Context $context,
		Registry $registry,
		FormFactory $formFactory,
		CategoryFactory $category,
		array $data)
	{
		$this->_category = $category;
		parent::__construct($context, $registry, $formFactory, $data);
	}

	public function _prepareForm()
	{

		$model = $this->_category->create(); // trỏ tới model gốc.
		$id = $this->getRequest()->getParam('id');
		$informationCt = $model->load($id)->getData();

		$form = $this->_formFactory->create(
			[
				"data" => [
					"id" => "edit_form",
					"action" => $this->getUrl("blogbig/indexcategory/updatect"),
					"method" => "post",
				]
			]
		);

		$fieldset = $form->addFieldset(
			"base_fieldset",
			["legend" => __("Chỉnh Sửa Thể Loại"), "class" => "fieldset-wide"]
		);

		$fieldset->addField(
			"Id",
			"hidden",
			[
				"name" => "id",
				"label" => __("Id"),
				"value" => $informationCt['id'],
				"required" => true,
			]
		);

		$fieldset->addField(
			"Thể Loại",
			"text",
			[
				"name" => "namecategory",
				"value" => $informationCt['namecategory'],
				"label" => __("Thể Loại"),
				"required" => true,
			]
		);

		$fieldset->addField(
			"page_title",
			"text",
			[
				"name" => "page_title",
				"label" => __("Page Title"),
				"value" => $informationCt['page_title'],
				"required" => true,
			]
		);

		$fieldset->addField(
			"meta_description",
			"textarea",
			[
				"name" => "meta_description",
				"label" => __("Meta Description"),
				"value" => $informationCt['meta_description'],
				"required" => true,
			]
		);

		$fieldset->addField(
			"meta_keywords",
			"textarea",
			[
				"name" => "meta_keywords",
				"label" => __("Meta Keywords"),
				"value" => $informationCt['meta_keywords'],
				"required" => true,
			]
		);

		$fieldset->addField(
			"quantity_portfolio",
			"text",
			[
				"name" => "quantity_portfolio",
				"label" => __("Quantity Portfolio"),
				"value" => $informationCt['quantity_portfolio'],
				"required" => true,
				"class" => "validate-number"
			]
		);

		$form->setUseContainer(true);
		$this->setForm($form);
		return parent::_prepareForm();
	}
}