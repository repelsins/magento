<?php

namespace Magebit\ProductComments\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * Class InstallSchema
 * @package Magebit\ProductComments\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) {

        $installer = $setup;
        $installer->startSetup();

        /**
         * Create table 'product_comments'
         */

        $table = $installer->getConnection()->newTable(
            $installer->getTable('product_comments'))
            ->addColumn(
            'comment_id',
            Table::TYPE_BIGINT,
            20,
                ['auto_increment' => true, 'identity' => true, 'unsigned'=> true, 'nullable' => false, 'primary' => true ]
            )->addColumn(
                'product_id',
                Table::TYPE_SMALLINT,
                5,
                [ 'nullable' => false, 'unsigned'=> true,  'default' => 0 ]
            )->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                [ 'nullable' => false, 'default' => Table::TIMESTAMP_INIT ]
            )->addColumn(
                'email',
                Table::TYPE_TEXT,
                55,
                [ 'nullable' => false]
            )->addColumn(
                'name',
                Table::TYPE_TEXT,
                55,
                [ 'nullable' => false]
            )->addColumn(
                'comment',
                Table::TYPE_TEXT,
                55,
                [ 'nullable' => false ]
            )->addColumn(
                'status_id',
                Table::TYPE_SMALLINT,
                5,
                [ 'nullable' => false, 'unsigned'=> true,  'default' => 0 ]

            );

        $installer->getConnection()->createTable( $table );

        $installer->endSetup();
    }
}