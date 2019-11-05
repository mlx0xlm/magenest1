<?php
namespace Mgn\Tpt2\Setup;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;
use Mgn\Tpt2\Model\ManufacturerFactory as Manufacturer;

class UpgradeSchema implements \Magento\Framework\Setup\UpgradeSchemaInterface{

    protected $customerSetupFactory;
    private $attributeSetFactory;
    protected $manufacturer;
    public function __construct(
        CustomerSetupFactory $customerSetupFactory,
        AttributeSetFactory $attributeSetFactory,
        Manufacturer $manufacturer
    ) {
        $this->manufacturer=$manufacturer;
        $this->customerSetupFactory = $customerSetupFactory;
        $this->attributeSetFactory = $attributeSetFactory;
    }

    public function upgrade(SchemaSetupInterface $setup,ModuleContextInterface $context){
        $installer = $setup;
        $installer->startSetup();


        if (version_compare($context->getVersion(), '1.0.0', '<'))
        {

        }
        $installer->endSetup();
    }
    /*create table */
    private function addColumn(SchemaSetupInterface $installer)
    {
        $tableName = 'manufacturer_entity';

        $installer->getConnection()->getTable($tableName)
        ->addColumn(
            'manufacturer_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            11,
            ['unsigned' => true, 'nullable' => false],
            'manufacturer id'
        );
    }
    private function createTable(SchemaSetupInterface $installer)
    {
        {
            $tableName = 'manufacturer_entity';

            $table = $installer->getConnection()->newTable($installer->getTable($tableName)
            )->addColumn(
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                11,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'entity id'
            )
                ->addColumn(
                    'name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'name'
                )
                ->addColumn(
                    'enabled',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    1,
                    ['nullable' => false],
                    'enabled'
                )->addColumn(
                    'address_street',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'address'
                )->addColumn(
                    'address_city',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    100,
                    ['nullable' => false],
                    'address'
                )->addColumn(
                    'address_country',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    5,
                    ['nullable' => false],
                    'address'
                )->addColumn(
                    'contact_name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    100,
                    ['nullable' => false],
                    'contact name'
                )->addColumn(
                    'contact_phone',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    20,
                    ['nullable' => false],
                    'contact phone'
                );
            $installer->getConnection()->createTable($table);
        }
    }
}
