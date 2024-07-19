<?php

namespace Magenest\Blog\Setup;

class UpgradeSchema implements \Magento\Framework\Setup\UpgradeSchemaInterface {


    public function upgrade(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context )
    {
        $installer = $setup;

        $installer->startSetup();

        if (version_compare($context->getVersion(), '2.0.0', '<')) {
            if (!$installer->tableExists('magenest_blog_category')) {
                $table = $installer->getConnection()->newTable(
                    $installer->getTable('magenest_blog_category')
                )
                    ->addColumn(
                        'blog_id',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        [
                            'nullable' => false,
                        ],
                        'Blog ID'
                    )
                    ->addForeignKey(
                        $installer->getFkName('magenest_blog_category', 'blog_id', 'magenest_blog', 'id'),
                        'blog_id',
                        $setup->getTable('magenest_blog'),
                        'id',
                        \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                    )
                    ->addColumn(
                        'category_id',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        [
                            'nullable' => false
                        ],
                        'Category ID'
                    )
                    ->addForeignKey(
                        $installer->getFkName('magenest_blog_category', 'category_id', 'magenest_category', 'id'),
                        'category_id',
                        $setup->getTable('magenest_category'),
                        'id',
                        \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                    )
                    ->setComment('Magenest Category Blog');
                $installer->getConnection()->createTable($table);
            }
            $installer->endSetup();
        }
    }
}
