<?php
namespace Mgn\Tpt\Setup;
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


        if (version_compare($context->getVersion(), '1.0.2', '<'))
        {
            $this->createTable($installer);
        }
        $installer->endSetup();
    }
    /*create table */
    private function createTable(SchemaSetupInterface $installer)
    {
        {
            $tableName = 'magenest_part_time';

            $table = $installer->getConnection()->newTable(
                $installer->getTable($tableName)
            )->addColumn(
                'member_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                11,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'member id'
            )
                ->addColumn(
                    'name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'movie name'
                )
                ->addColumn(
                    'address',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    500,
                    ['nullable' => true],
                    'address'
                )
                ->addColumn(
                    'phone',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    5,
                    ['unsigned' => true,'nullable' => false],
                    'rating'
                )->addColumn(
                    'created_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false,
                    'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT,
                    'comment' => 'Created at']
                );
            $installer->getConnection()->createTable($table);
        }

    }


}
