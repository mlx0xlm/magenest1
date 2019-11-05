<?php
namespace Mgn\Cybergame\Setup;


use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Store\Model\StoreManagerInterface;

class UpgradeData implements UpgradeDataInterface
{
    protected $EavSetup;
    protected $config;
    protected $storeManager;
    protected $attributeResource;

    public function __construct(
        EavSetupFactory $eavSetupFactory,
        StoreManagerInterface $storeManager,
        \Magento\Eav\Model\Config $eavConfig,
        \Magento\Customer\Model\ResourceModel\Attribute $attributeResource
    )
    {
        $this->attributeResource=$attributeResource;
        $this->config=$eavConfig;
        $this->EavSetup = $eavSetupFactory;
        $this->storeManager = $storeManager;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {

        if ( version_compare($context->getVersion(), '1.0.5', '<' ))
        {
            $eavSetup = $this->EavSetup->create(['setup' => $setup]);
            $eavSetup->removeAttribute(\Magento\Customer\Model\Customer::ENTITY, "is_cybergame");
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'is_cybergame',
                [
                    'group' => 'General',
                    'type' => 'int',
                    'backend' => '',
                    'frontend' => '',
                    'label' => 'Is CyberGame',
                    'input' => 'boolean',
                    'class' => '',
                    'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                    'visible' => true,
                    'required' => false,
                    'user_defined' => false,
                    'default' => '0',
                    'searchable' => false,
                    'filterable' => false,
                    'comparable' => false,
                    'visible_on_front' => false,
                    'used_in_product_listing' => false,
                    'unique' => false,
                    'apply_to' => ''
                ]
            );
        }
        if ( version_compare($context->getVersion(), '1.0.3', '<' ))
        {
            $eavSetup = $this->EavSetup->create(['setup' => $setup]);
            $eavSetup->removeAttribute(\Magento\Customer\Model\Customer::ENTITY, "is_manager");
            $attributeSetId = $eavSetup->getDefaultAttributeSetId(\Magento\Customer\Model\Customer::ENTITY);
            $attributeGroupId = $eavSetup->getDefaultAttributeGroupId(\Magento\Customer\Model\Customer::ENTITY);
            $eavSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            'is_manager.',
            [
                'type' => 'int',
                'label' => 'is_manager.',
                'input' => 'boolean',
                "source"   => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                'required' => false,
                'visible' => true,
                'user_defined' => true,
                'sort_order' => 990,
                'position' => 990,
                'system' => 0,
            ]
        );
            $attribute = $this->config->getAttribute(\Magento\Customer\Model\Customer::ENTITY, 'is_manager.');
            $attribute->setData('attribute_set_id', $attributeSetId);
            $attribute->setData('attribute_group_id', $attributeGroupId);
            $attribute->setData('used_in_forms', [
                'adminhtml_customer',
                'customer_account_create',
                'customer_account_edit',
                'checkout_register',
                'adminhtml_checkout',
            ]);

            $this->attributeResource->save($attribute);
        }
    }

}