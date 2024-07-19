<?php

namespace Magenest\Blog\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{

    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('magenest_blog')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_blog')
            )
                ->addColumn(
                    'id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'auto_increment' => true,
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true
                    ],
                    'Blog ID'
                )
                ->addColumn(
                    'author_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'unsigned' => true,
                        'nullable' => false,
                    ],
                    'Author ID'
                )
                ->addForeignKey(
                    $installer->getFkName('magenest_blog', 'author_id', 'admin_user', 'user_id'),
                    'author_id',
                    $setup->getTable('admin_user'),
                    'user_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->addColumn(
                    'title',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Blog Title'
                )
                ->addColumn(
                    'description',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    null,
                    [],
                    'Blog Description'
                )
                ->addColumn(
                    'content',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    null,
                    [],
                    'Blog Content'
                )
                ->addColumn(
                    'url_rewrite',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    null,
                    [],
                    'Blog Url Rewrite'
                )
                ->addColumn(
                    'status',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    [],
                    'Blog Status'
                )
                ->addColumn(
                    'created_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                    'Created At'
                )->addColumn(
                    'updated_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                    'Updated At')
                ->setComment('Magenest Blog Table');
            $installer->getConnection()->createTable($table);
        }
        $installer->getConnection()->addIndex(
            $installer->getTable('magenest_blog'),
            $setup->getIdxName(
                $installer->getTable('magenest_blog'),
                ['title', 'content'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            ),
            ['title','content'],
            \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
        );


        if (!$installer->tableExists('magenest_category')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_category')
            )
                ->addColumn(
                    'id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'auto_increment' => true,
                        'primary' => true,
                        'nullable' => false,
                        'identity' => true,
                    ],
                    'Magenest Category ID'
                )
                ->addColumn(
                    'name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    null,
                    [],
                    'Magenest Category Name'
                )
                ->setComment('Magenest Category Table');
            $installer->getConnection()->createTable($table);
        }
        $installer->getConnection()->addIndex(
            $installer->getTable('magenest_category'),
            $setup->getIdxName(
                $installer->getTable('magenest_category'),
                ['name'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            ),
            ['name'],
            \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
        );
        $installer->endSetup();
    }

}
