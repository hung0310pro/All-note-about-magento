<?php

namespace AHT\BlogBig\Block\Adminhtml\BlogPortfolio\ShowUpdatePf;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use AHT\BlogBig\Model\CategoryFactory;
use AHT\BlogBig\Model\PortfolioFactory;

class Form extends Generic
{

	protected $_category;
	protected $_listCt;
	protected $_portfolio;

	// cái này phải có đủ các biến đổi với tk Generic
	public function __construct(
		Context $context,
		Registry $registry,
		FormFactory $formFactory,
		PortfolioFactory $portfolio,
		CategoryFactory $category,
		array $data)
	{
		$this->_portfolio = $portfolio;
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
		$model = $this->_portfolio->create(); // trỏ tới model gốc.
		$id = $this->getRequest()->getParam('id');
		$informationPf = $model->load($id)->getData();

		if ($informationPf['status'] == 1) {
			$a = true;
		} else {
			$a = false;
		}

		$form = $this->_formFactory->create(
			[
				"data" => [
					"id" => "edit_form",
					"action" => $this->getUrl("blogbig/indexportfolio/updatepf"),
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
				"value" => "image/" . $informationPf['thumbnail'],
			]
		);

		$fieldset->addField(
			"id",
			"hidden",
			[
				"name" => "id",
				"label" => __("id"),
				"value" => $informationPf['id'],
			]
		);

		$fieldset->addField(
			"image",
			"image",
			[
				"name" => "image",
				"label" => __("Image"),
				"value" => "image/" . $informationPf['image'],
			]
		);

		$fieldset->addField(
			"client",
			"text",
			[
				"name" => "client",
				"label" => __("Client"),
				"value" => $informationPf['client'],
				"required" => true,
			]
		);

		$fieldset->addField(
			"project",
			"text",
			[
				"name" => "project",
				"label" => __("Project"),
				"value" => $informationPf['project'],
				"required" => true,
			]
		);

		$fieldset->addField(
			"skill",
			"textarea",
			[
				"name" => "skill",
				"label" => __("Skill"),
				"value" => $informationPf['skill'],
				"required" => true,
			]
		);

		$fieldset->addField(
			"status",
			"checkbox",
			[
				"name" => "status",
				"label" => __("Status"),
				"value" => $informationPf['status'],
				"checked" => $a,
			]
		);

		$fieldset->addField(
			"content",
			"textarea",
			[
				"name" => "content",
				"label" => __("Content"),
				"value" => $informationPf['content'],
				"required" => true,
			]
		);

		$fieldset->addField(
			"id_category",
			"select",
			[
				"name" => "id_category",
				"label" => __("Id_category"),
				"value" => $informationPf['id_category'],
				"required" => true,
				"options" => $this->toOptionArray(),
			]
		);

		$form->setUseContainer(true);
		$this->setForm($form);
		return parent::_prepareForm();
	}
}