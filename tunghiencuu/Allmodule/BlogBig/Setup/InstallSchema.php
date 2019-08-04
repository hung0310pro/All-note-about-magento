<?php

namespace AHT\BlogBig\Setup;

use \Magento\Framework\Setup\SchemaSetupInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\DB\Ddl\Table;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
	public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
	{
		$setup->startSetup();
		$conn = $setup->getConnection();
		$tableName = $setup->getTable('category');
		$table = $conn->newTable($tableName)
			->addColumn(
				'id',
				Table::TYPE_INTEGER,
				null,
				[
					'identity' => true, // đại tiện cho auto increment
					'nullable' => false,
					'primary' => true,
					'unsigned' => true,
				]
			)
			->addColumn(
				'namecategory',
				Table::TYPE_TEXT,
				255,
				['nullable => false']
			)
			->addColumn(
				'page_title',
				Table::TYPE_TEXT,
				255,
				['nullable => false']
			)
			->addColumn(
				'meta_description',
				Table::TYPE_TEXT,
				255,
				['nullable => false']
			)
			->addColumn(
				'meta_keywords',
				Table::TYPE_TEXT,
				255,
				['nullable => false']
			)
			->addColumn(
				'quantity_portfolio',
				Table::TYPE_INTEGER,
				255,
				['nullable => false']
			)
			->setOption('charset', 'utf8');
		$conn->createTable($table);
		$tableName = $setup->getTable('portfolio');
		$table = $conn->newTable($tableName)
			->addColumn(
				'id',
				Table::TYPE_INTEGER,
				null,
				[
					'identity' => true,
					'nullable' => false,
					'primary' => true,
					'unsigned' => true,
				]
			)
			->addColumn(
				'id_category',
				Table::TYPE_INTEGER,
				null,
				[
					'nullable' => false,
				]
			)
			->addColumn(
				'thumbnail',
				Table::TYPE_TEXT,
				255,
				['nullable => false']
			)
			->addColumn(
				'image',
				Table::TYPE_TEXT,
				255,
				['nullable => false']
			)
			->addColumn(
				'client',
				Table::TYPE_TEXT,
				255,
				['nullable => false']
			)
			->addColumn(
				'project',
				Table::TYPE_TEXT,
				255,
				['nullable => false']
			)
			->addColumn(
				'skill',
				Table::TYPE_TEXT,
				255,
				['nullable => false']
			)
			->addColumn(
				'status',
				Table::TYPE_TEXT,
				255,
				['nullable => false']
			)
			->addColumn(
				'content',
				Table::TYPE_TEXT,
				255,
				['nullable => false']
			)
			->setOption('charset', 'utf8');
		$conn->createTable($table);
		$tableName = $setup->getTable('comment');
		$table = $conn->newTable($tableName)
			->addColumn(
				'id',
				Table::TYPE_INTEGER,
				null,
				[
					'identity' => true,
					'nullable' => false,
					'primary' => true,
					'unsigned' => true,
				]
			)
			->addColumn(
				'id_portfolio',
				Table::TYPE_INTEGER,
				null,
				[
					'nullable' => false,
				]
			)
			->addColumn(
				'your_name',
				Table::TYPE_TEXT,
				255,
				['nullable => false']
			)
			->addColumn(
				'comment',
				Table::TYPE_TEXT,
				255,
				['nullable => false']
			)
			->addColumn(
				'id_user',
				Table::TYPE_INTEGER,
				null,
				[
					'nullable' => false,
				]
			)
			->addColumn(
				'status_cmt',
				Table::TYPE_TEXT,
				255,
				['nullable => false']
			)
			->setOption('charset', 'utf8');
		$conn->createTable($table);
		$setup->endSetup();
	}
}