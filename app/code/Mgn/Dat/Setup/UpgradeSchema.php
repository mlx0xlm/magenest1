<?php
namespace Mgn\Dat\Setup;
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
            $this->magenest_dat($installer);
        }
        $installer->endSetup();

    }
    private function magenest_dat(SchemaSetupInterface $installer)
    {
        {
            $tableName = 'magenest_dat';

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
                    'customer_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    11,
                    ['nullable' => false],
                    'customer id'
                )
                ->addColumn(
                    'description',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => true],
                    'description'
                )
                ->addColumn(
                    'first_name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['unsigned' => true],
                    'First Name'
                )
                ->addColumn(
                    'last_name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['unsigned' => true],
                    'Last Name'
                )->addColumn(
                    'email',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['unsigned' => true],
                    'Email'
                )->addColumn(
                    'company',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    null,
                    ['unsigned' => true],
                    'company'
                )->addColumn(
                    'phone_number',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    15,
                    ['unsigned' => true],
                    'phone'

                )
            ->addColumn(
                'fax',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                20,
                ['unsigned' => true],
                'fax'
            )->addColumn(
                    'address',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    null,
                    ['unsigned' => true],
                    'address'
            )->addColumn(
                    'street',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    null,
                    ['unsigned' => true],
                    'street'
            )->addColumn(
                    'country',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    null,
                    ['unsigned' => true],
                    'country'
            )->addColumn(
                'city',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    50,
                    ['unsigned' => true],
                    'city'
            )->addColumn(
                    'postcode',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    20,
                    ['unsigned' => true],
                    'postcode'
            )->addColumn(
                    'total_sales',
                    \Magento\Framework\DB\Ddl\Table::TYPE_FLOAT,
                    11,
                    ['unsigned' => true],
                    'total sales'
             );
            $installer->getConnection()->createTable($table);
        }
    }
}
