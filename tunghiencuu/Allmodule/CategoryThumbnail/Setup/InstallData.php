<?php

namespace Convert\CategoryThumbnail\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Catalog\Setup\CategorySetupFactory;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    /**
     * Category setup factory
     *
     * @var CategorySetupFactory
     */
    private $categorySetupFactory;

    /**
     * Init
     *
     * @param CategorySetupFactory $categorySetupFactory
     */
    public function __construct(
        CategorySetupFactory $categorySetupFactory
    ) {
        $this->categorySetupFactory = $categorySetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();

        /** @var \Magento\Catalog\Setup\CategorySetup $categorySetup */
        $categorySetup = $this->categorySetupFactory->create(['setup' => $setup]);
        $categorySetup->addAttribute(
            'catalog_category',
            'category_thumbnails',
            [
                'type' => 'varchar',
                'label' => 'Category Thumbnail Image',
                'input' => 'image',
                'backend' => 'Magento\Catalog\Model\Category\Attribute\Backend\Image',
                'required' => false,
                'sort_order' => 100,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'General Information',
            ]
        );

        $categorySetup->addAttribute(
                \Magento\Catalog\Model\Category::ENTITY,
                'is_active_landings',
                [
                    'type' => 'int',
                    'label' => 'Is Landing',
                    'input' => 'select',
                    'sort_order' => 10,
                    'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                    'required' => false,
                    'user_defined' => false,
                    'default' => null,
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                    'group' => 'General Information',
                ]
            );

            $categorySetup->addAttribute(
                \Magento\Catalog\Model\Category::ENTITY,
                'categorytitles',
                [
                    'type' => 'varchar',
                    'label' => 'Category Title',
                    'input' => 'text',
                    'sort_order' => 100,
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                    'required' => false,
                    'user_defined' => false,
                    'default' => null,
                    'group' => 'General Information',
                ]
            );

        $setup->endSetup();
    }
}
