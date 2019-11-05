<?php
namespace Mgn\Dat\Setup;


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
        if ( version_compare($context->getVersion(), '1.1.4', '<' ))
        {
            $eavSetup = $this->EavSetup->create(['setup' => $setup]);
            $eavSetup->removeAttribute(\Magento\Customer\Model\Customer::ENTITY, "dat_is_approved");
            $attributeSetId = $eavSetup->getDefaultAttributeSetId(\Magento\Customer\Model\Customer::ENTITY);
            $attributeGroupId = $eavSetup->getDefaultAttributeGroupId(\Magento\Customer\Model\Customer::ENTITY);            $eavSetup->addAttribute(
                \Magento\Customer\Model\Customer::ENTITY,
                'dat_is_approved',
                [
                    'type' => 'int',
                    'label' => 'dat_is_approved',
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
            $attribute = $this->config->getAttribute(\Magento\Customer\Model\Customer::ENTITY, 'dat_is_approved');
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