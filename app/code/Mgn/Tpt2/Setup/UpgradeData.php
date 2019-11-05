<?php
namespace Mgn\Tpt2\Setup;


use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Store\Model\StoreManagerInterface;

class UpgradeData implements UpgradeDataInterface
{
    protected $eavSetup;

    protected $storeManager;

    public function __construct(
        EavSetupFactory $eavSetupFactory,
        StoreManagerInterface $storeManager
    )
    {
        $this->eavSetup = $eavSetupFactory;
        $this->storeManager = $storeManager;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if ( version_compare($context->getVersion(), '1.1.0', '<' ))
        {
            $eavSetup = $this->eavSetup->create(['setup' => $setup]);
            $eavSetup->removeAttribute(\Magento\Customer\Model\Customer::ENTITY, "dat_is_approved");
            $eavSetup->addAttribute(
                \Magento\Customer\Model\Customer::ENTITY,
                'dat_is_approved',
                [
                    'group' => 'General',
                    'type' => 'int',
                    'label' => 'Manufacturer',
                    'input' => 'boolean',
                    'required' => false,
                    'sort_order' => 50,
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                    'is_used_in_grid' => false,
                    'is_visible_in_grid' => false,
                    'is_filterable_in_grid' => false,
                    'visible' => true,
                    'is_html_allowed_on_front' => true,
                    'visible_on_front' => true
                ]
            );
        }
    }

}