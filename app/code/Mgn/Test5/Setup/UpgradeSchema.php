<?php
namespace Mgn\Test5\Setup;
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

        if (version_compare($context->getVersion(), '1.0.1', '<'))
        {
            $this->Test5($installer);
        }
        $installer->endSetup();

    }
    private function Test5(SchemaSetupInterface $installer)
    {
        {
            $tableName = 'Test5';

            $table = $installer->getConnection()->newTable(
                $installer->getTable($tableName)
            )->addColumn(
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                11,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'entity id'
            )
                ->addColumn(
                    'order_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    11,
                    ['nullable' => false],
                    'order id'
                )
                ->addColumn(
                    'order_item_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    11,
                    ['nullable' => false],
                    'order item id'
                )
                ->addColumn(
                    'sku',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => true],
                    'sku'
                )
                ->addColumn(
                    'order_item_price',
                    \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    [12,2],
                    ['unsigned' => true],
                    'order item price'
                )->addColumn(
                    'commission_percent',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    11,
                    ['unsigned' => true],
                    'commission percent'
                )->addColumn(
                    'commission_value',
                    \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    [12,2],
                    ['unsigned' => true],
                    'commission_value'
                );
            $installer->getConnection()->createTable($table);
        }
    }
}
