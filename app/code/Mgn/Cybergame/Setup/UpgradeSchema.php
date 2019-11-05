<?php
namespace Mgn\Cybergame\Setup;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;

class UpgradeSchema implements \Magento\Framework\Setup\UpgradeSchemaInterface{

    protected $customerSetupFactory;
    private $attributeSetFactory;

    public function __construct(
        CustomerSetupFactory $customerSetupFactory,
        AttributeSetFactory $attributeSetFactory
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->attributeSetFactory = $attributeSetFactory;
    }

    public function upgrade(SchemaSetupInterface $setup,ModuleContextInterface $context){
        $installer = $setup;
        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.0.4', '<'))
        {
            $this->room_extra_option($installer);
        }
        $installer->endSetup();
        if (version_compare($context->getVersion(), '1.0.4', '<'))
        {
            $setup->startSetup();
            $setup->getConnection();
            $setup->getTable('customer_grid_flat')
                ->addColumn(
                    'status',
                    ['type' => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                        'length' => '11',
                        'nullable' => false,
                        'default' => '3',
                        'comment' => 'Retailers Is Allow Status']
                )->addForeignKey(
                    $setup->getFkName('customer_grid_flat', 'entity_id', 'customer_entity_varchar', 'entity_id'),
                    'entity_id',
                    $setup->getTable('customer_entity_varchar'),
                    'entity_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                );
            $setup->endSetup();
        }
    }
    private function room_extra_option(SchemaSetupInterface $installer)
    {
        {
            $tableName = 'room_extra_option';

            $table = $installer->getConnection()->newTable(
                $installer->getTable($tableName)
            )->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                11,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'id'
            )
                ->addColumn(
                    'product_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    11,
                    ['nullable' => false],
                    'product id'
                )
                ->addColumn(
                    'number_pc',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    255,
                    ['nullable' => true],
                    'number_pc'
                )
                ->addColumn(
                    'address',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['unsigned' => true],
                    'address'
                )
                ->addColumn(
                    'food_price',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    11,
                    ['unsigned' => true],
                    'food_price'
                )->addColumn(
                    'drink_price',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    20,
                    ['unsigned' => true],
                    'drink_price'
                )->addColumn(
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
                    'Updated At'
                );
            $installer->getConnection()->createTable($table);
        }
    }
    private function gamer_account_list(SchemaSetupInterface $installer)
    {
        {
            $tableName = 'room_extra_option';

            $table = $installer->getConnection()->newTable(
                $installer->getTable($tableName)
            )->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                11,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'id'
            )
                ->addColumn(
                    'product_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    11,
                    ['nullable' => false],
                    'product id'
                )
                ->addColumn(
                    'account_name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => true],
                    'account_name'
                )
                ->addColumn(
                    'password',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['unsigned' => true],
                    'password'
                )
                ->addColumn(
                    'hour',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    255,
                    ['unsigned' => true],
                    'Last Name'
                )->addColumn(
                    'hour',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    20,
                    ['unsigned' => true],
                    'hour'
                )->addColumn(
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
                    'Updated At'
                );
            $installer->getConnection()->createTable($table);
        }
    }
}
