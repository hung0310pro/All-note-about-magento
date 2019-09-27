<?php

namespace AHT\BlogBig\Setup;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Model\Entity\Attribute\Source\Boolean;

class UpgradeData implements UpgradeDataInterface
{
	private $eavSetupFactory;

	public function __construct(EavSetupFactory $eavSetupFactory)
	{
		$this->eavSetupFactory = $eavSetupFactory;
	}

	public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
		$setup->startSetup();
		if ($context->getVersion() && version_compare($context->getVersion(), '1.0.5')) {

			$eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

			$eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY,
				'course_start',
				[
					'group' => 'Custom Attribute',
					'label' => 'Enable Start Date',
					'type' => 'datetime',
					'input' => 'date',
					'input_renderer' => 'Velanapps\Test\Block\Adminhtml\Form\Element\Datetime',
					'class' => 'validate-date',
					'backend' => 'Magento\Catalog\Model\Attribute\Backend\Startdate',
					'required' => false,
					'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
					'visible' => true,
					'required' => false,
					'user_defined' => true,
					'default' => '',
					'searchable' => true,
					'filterable' => true,
					'filterable_in_search' => true,
					'visible_in_advanced_search' => true,
					'comparable' => false,
					'visible_on_front' => false,
					'used_in_product_listing' => true,
					'unique' => false
				]
			);
		}

		$setup->endSetup();
	}
}