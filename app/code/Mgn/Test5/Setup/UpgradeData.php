<?php

namespace Mgn\Test5\Setup;

use Magento\Catalog\Model\Product;
use Magento\Customer\Model\Customer;
use Magento\Customer\Model\ResourceModel\Attribute;
use Magento\Eav\Model\Config;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
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
        Config $eavConfig,
        Attribute $attributeResource
    )
    {
        $this->attributeResource = $attributeResource;
        $this->config = $eavConfig;
        $this->EavSetup = $eavSetupFactory;
        $this->storeManager = $storeManager;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.1.6', '<')) {

            $eavSetup = $this->EavSetup->create(['setup' => $setup]);
            $eavSetup->removeAttribute(\Magento\Customer\Model\Customer::ENTITY, "commission_");
            $attributeSetId = $eavSetup->getDefaultAttributeSetId(\Magento\Customer\Model\Customer::ENTITY);
            $attributeGroupId = $eavSetup->getDefaultAttributeGroupId(\Magento\Customer\Model\Customer::ENTITY);
            $eavSetup->addAttribute(
                \Magento\Customer\Model\Customer::ENTITY,
                'is_sales_agent',
                [
                    'type' => 'int',
                    'label' => 'is sales agent',
                    'input' => 'boolean',
                    "source" => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                    'required' => false,
                    'visible' => true,
                    'user_defined' => true,
                    'sort_order' => 0,
                    'position' => 0,
                    'system' => 0,
                ]
            );
            $attribute = $this->config->getAttribute(\Magento\Customer\Model\Customer::ENTITY, 'is_sales_agent');
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

        if ( version_compare($context->getVersion(), '1.2.3', '<' ))
        {
            $eavSetup = $this->EavSetup->create(['setup' => $setup]);
            $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, "sale_agent_id,");
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'sale_agent_id',
                [
                    'group' => 'General',
                    'type' => 'int',
                    'backend' => '',
                    "source" => 'Mgn\Test5\Block\SalesAgentDropdown',
                    'frontend' => '',
                    'label' => 'sale_agent_id',
                    'input' => 'select',
                    'class' => '',
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

//        if ( version_compare($context->getVersion(), '1.1.9', '<' ))
//        {
//            $eavSetup = $this->EavSetup->create(['setup' => $setup]);
//            $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, "commission_value,");
//            $eavSetup->addAttribute(
//                \Magento\Catalog\Model\Product::ENTITY,
//                'commission_value',
//                [
//                    'group' => 'General',
//                    'type' => 'text',
//                    'backend' => '',
//                    'frontend' => '',
//                    'label' => 'commission value',
//                    'input' => 'text',
//                    'class' => '',
//                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
//                    'visible' => true,
//                    'required' => false,
//                    'user_defined' => false,
//                    'default' => '0',
//                    'searchable' => false,
//                    'filterable' => false,
//                    'comparable' => false,
//                    'visible_on_front' => false,
//                    'used_in_product_listing' => false,
//                    'unique' => false,
//                    'apply_to' => ''
//                ]
//            );
//        }
//        if ( version_compare($context->getVersion(), '1.1.8', '<' ))
//        {
//            $eavSetup = $this->EavSetup->create(['setup' => $setup]);
//            $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, "commission_type,");
//            $eavSetup->addAttribute(
//                \Magento\Catalog\Model\Product::ENTITY,
//                'commission_type',
//                [
//                    'group' => 'General',
//                    'type' => 'int',
//                    'backend' => '',
//                    'frontend' => '',
//                    'label' => 'commission_type',
//                    'input' => 'select',
//                    "source" => 'Mgn\Test5\Model\Config\CommissionType',
//                    'class' => '',
//                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
//                    'visible' => true,
//                    'required' => false,
//                    'user_defined' => false,
//                    'default' => '0',
//                    'searchable' => false,
//                    'filterable' => false,
//                    'comparable' => false,
//                    'visible_on_front' => false,
//                    'used_in_product_listing' => false,
//                    'unique' => false,
//                    'apply_to' => ''
//                ]
//            );
//        }
//        if ( version_compare($context->getVersion(), '1.1.7', '<' ))
//        {
//            $eavSetup = $this->EavSetup->create(['setup' => $setup]);
//            $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, "sale_agent_id,");
//            $eavSetup->addAttribute(
//                \Magento\Catalog\Model\Product::ENTITY,
//                'sale_agent_id',
//                [
//                    'group' => 'General',
//                    'type' => 'text',
//                    'backend' => '',
//                    'frontend' => '',
//                    'label' => 'is_sales_agent',
//                    'input' => 'text',
//                    'class' => '',
//                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
//                    'visible' => true,
//                    'required' => false,
//                    'user_defined' => false,
//                    'default' => '0',
//                    'searchable' => false,
//                    'filterable' => false,
//                    'comparable' => false,
//                    'visible_on_front' => false,
//                    'used_in_product_listing' => false,
//                    'unique' => false,
//                    'apply_to' => ''
//                ]
//            );
//        }
//        if (version_compare($context->getVersion(), '1.1.6', '<')) {
//
//            $eavSetup = $this->EavSetup->create(['setup' => $setup]);
//            $eavSetup->removeAttribute(\Magento\Customer\Model\Customer::ENTITY, "is_sales_agent");
//            $attributeSetId = $eavSetup->getDefaultAttributeSetId(\Magento\Customer\Model\Customer::ENTITY);
//            $attributeGroupId = $eavSetup->getDefaultAttributeGroupId(\Magento\Customer\Model\Customer::ENTITY);
//            $eavSetup->addAttribute(
//                \Magento\Customer\Model\Customer::ENTITY,
//                'is_sales_agent',
//                [
//                    'type' => 'int',
//                    'label' => 'is sales agent',
//                    'input' => 'boolean',
//                    "source" => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
//                    'required' => false,
//                    'visible' => true,
//                    'user_defined' => true,
//                    'sort_order' => 0,
//                    'position' => 0,
//                    'system' => 0,
//                ]
//            );
//            $attribute = $this->config->getAttribute(\Magento\Customer\Model\Customer::ENTITY, 'is_sales_agent');
//            $attribute->setData('attribute_set_id', $attributeSetId);
//            $attribute->setData('attribute_group_id', $attributeGroupId);
//            $attribute->setData('used_in_forms', [
//                'adminhtml_customer',
//                'customer_account_create',
//                'customer_account_edit',
//                'checkout_register',
//                'adminhtml_checkout',
//            ]);
//
//            $this->attributeResource->save($attribute);
//        }


//        if (version_compare($context->getVersion(), '1.0.4', '<')) {
//            $eavSetup = $this->EavSetup->create(['setup' => $setup]);
//            $eavSetup->addAttribute(
//                Product::ENTITY,
//                'commission_type',
//                [
//                    'type' => 'int',
//                    'label' => 'commission type',
//                    'input' => 'select',
//                    "source" => 'Mgn\Test5\Model\Config\CommissionType',
//                    'required' => false,
//                    'visible' => true,
//                    'user_defined' => true,
//                    'sort_order' => 990,
//                    'position' => 990,
//                    'system' => 0,
//                ]
//            );
//            $attribute = $this->config->getAttribute(Customer::ENTITY, 'commission_type');
//            $attribute->setData('used_in_forms', [
//                'adminhtml_customer',
//                'customer_account_create',
//                'customer_account_edit',
//                'checkout_register',
//                'adminhtml_checkout',
//            ]);
//
//            $this->attributeResource->save($attribute);
//        }
//        if (version_compare($context->getVersion(), '1.0.5', '<')) {
//            $eavSetup = $this->EavSetup->create(['setup' => $setup]);
//            $eavSetup->addAttribute(
//                Product::ENTITY,
//                'commission_value',
//                [
//                    'type' => 'text',
//                    'label' => 'commission value',
//                    'input' => 'text',
//                    'required' => false,
//                    'visible' => true,
//                    'user_defined' => true,
//                    'sort_order' => 990,
//                    'position' => 990,
//                    'system' => 0,
//                ]
//            );
//            $attribute = $this->config->getAttribute(Customer::ENTITY, 'commission_value');
//            $attribute->setData('used_in_forms', [
//                'adminhtml_customer',
//                'customer_account_create',
//                'customer_account_edit',
//                'checkout_register',
//                'adminhtml_checkout',
//            ]);
//
//            $this->attributeResource->save($attribute);
//        }

    }
}