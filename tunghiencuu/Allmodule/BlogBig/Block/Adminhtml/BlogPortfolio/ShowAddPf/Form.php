<?php
/*
namespace AHT\BlogBig\Block\Adminhtml\BlogPortfolio\ShowAddPf;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use AHT\BlogBig\Model\CategoryFactory;

class Form extends Generic
{

	protected $_category;
	protected $_listCt;

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

	public function toOptionArray()
	{
		$model = $this->_category->create();
		$listCt = $model->getCollection()->getData();

		$ret = [];
		foreach ($listCt as $value) {
			$ret[0] = "---";
			$ret[$value['id']] = $value['namecategory'];
		}
		return $ret;
	}


	public function _prepareForm()
	{

		$form = $this->_formFactory->create(
			[
				"data" => [
					"id" => "edit_form",
					"action" => $this->getUrl("blogbig/indexportfolio/addpf"),
					"method" => "post",
					"enctype" => "multipart/form-data"
				]
			]
		);

		$fieldset = $form->addFieldset(
			"base_fieldset",
			["legend" => __("Thêm Portfolio"), "class" => "fieldset-wide"]
		);

		$fieldset->addField(
			"thumbnail",
			"image",
			[
				"name" => "thumbnail",
				"label" => __("Thumbnail"),
				"required" => true,
			]
		);

		$fieldset->addField(
			"image",
			"image",
			[
				"name" => "image",
				"label" => __("Image"),
				"required" => true,
			]
		);

		$fieldset->addField(
			"client",
			"text",
			[
				"name" => "client",
				"label" => __("Client"),
				"required" => true,
			]
		);

		$fieldset->addField(
			"project",
			"text",
			[
				"name" => "project",
				"label" => __("Project"),
				"required" => true,
			]
		);

		$fieldset->addField(
			"skill",
			"textarea",
			[
				"name" => "skill",
				"label" => __("Skill"),
				"required" => true,
			]
		);

		$fieldset->addField(
			"status",
			"checkbox",
			[
				"name" => "status",
				"class" => "btn btn-success active",
				"label" => __("Status"),
				"value" => "1",
			]
		);

		$fieldset->addField(
			"content",
			"textarea",
			[
				"name" => "content",
				"label" => __("Content"),
				"required" => true,
			]
		);

		$fieldset->addField(
			"id_category",
			"select",
			[
				"name" => "id_category",
				"label" => __("Id_category"),
				"required" => true,
				"options" => $this->toOptionArray(),
			]
		);

		$form->setUseContainer(true);
		$this->setForm($form);
		return parent::_prepareForm();
	}
}*/