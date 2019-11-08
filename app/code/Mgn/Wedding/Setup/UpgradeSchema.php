<?php
namespace Mgn\Wedding\Setup;
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
            $this->magenest_wedding_event($installer);
        }
        $installer->endSetup();

    }
    private function magenest_wedding_event(SchemaSetupInterface $installer)
    {
        {
            $tableName = 'magenest_wedding_event';

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
                    'title',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'title'
                )
                ->addColumn(
                    'commission',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    11,
                    ['nullable' => false],
                    'commission'
                )
                ->addColumn(
                    'bride_firstname',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => true],
                    'bride_firstname'
                )
                ->addColumn(
                    'bride_lastname',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['unsigned' => true],
                    'bride_lastname'
                )->addColumn(
                    'bride_email',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['unsigned' => true],
                    'bride_email'
                )->addColumn(
                    'sent_to_bride',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['unsigned' => true],
                    'sent to bride'
                )->addColumn(
                    'groom_firstname',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => true],
                    'groom_firstname'
                )
                ->addColumn(
                    'groom_lastname',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['unsigned' => true],
                    'groom_lastname'
                )->addColumn(
                    'groom_email',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['unsigned' => true],
                    'groom_email'
                )->addColumn(
                    'sent_to_groom',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['unsigned' => true],
                    'sent to groom'
                )->addColumn(
                    'message',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['unsigned'=>true],
                    'message'
                );
            $installer->getConnection()->createTable($table);
        }
    }
}
