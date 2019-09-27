<?php

namespace AHT\BlogBig\Block\Adminhtml\BlogCategory\ShowAddCt;

use Magento\Backend\Block\Widget\Form\Generic;


class Form extends Generic
{
	public function _prepareForm()
	{
		// _formFactory ở trong cái Magento\Backend\Block\Widget\Form\Generic dùng cái kia
		// để tạo form.
		$form = $this->_formFactory->create(
			[
				"data" => [
					"id" => "edit_form",
					"action" => $this->getUrl("blogbig/indexcategory/addct"),
					"method" => "post",
				]
			]
		);

		$fieldset = $form->addFieldset(
			"base_fieldset",
			["legend" => __("Thêm Thể Loại"), "class" => "fieldset-wide"]
		);

		$fieldset->addField(
			"Tên Thể Loại",
			"text",
			[
				"name" => "namecategory",
				"label" => __("Tên Thể loại"),
				"required" => true,
			]
		);

		$fieldset->addField(
			"page_title",
			"text",
			[
				"name" => "page_title",
				"label" => __("Page Title"),
				"required" => true,
			]
		);

		$fieldset->addField(
			"meta_description",
			"textarea",
			[
				"name" => "meta_description",
				"label" => __("Meta Description"),
				"required" => true,
			]
		);

		$fieldset->addField(
			"meta_keywords",
			"textarea",
			[
				"name" => "meta_keywords",
				"label" => __("Meta Keywords"),
				"required" => true,
			]
		);

		$fieldset->addField(
			"quantity_portfolio",
			"text",
			[
				"name" => "quantity_portfolio",
				"label" => __("Quantity Portfolio"),
				"required" => true,
				"class" => "validate-number"
			]
		);

		$form->setUseContainer(true);
		$this->setForm($form);
		return parent::_prepareForm();
	}
}