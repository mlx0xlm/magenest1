<?php
namespace Mgn\Test5\Block;
class SalesAgentDropdown extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    protected $_customerFactory;
    public function __construct(
    \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customerFactory
) {
    $this->_customerFactory = $customerFactory;
}
    public function getAllOptions()
    {
        $obj = \Magento\Framework\App\ObjectManager::getInstance();
        $option[] = array('label'=>'select','value'=>null);
        $option[] = array('label'=>'fixer','value'=>0);
        $option[] = array('label'=>'percent','value'=>1);
        $this->_options = $this->getAvailableGroups();
        return $this->_options;
    }
    private function getAvailableGroups()
    {
        $collection = $this->_customerFactory->create()->getData();
        $result = [];
        $result[] = ['value' => ' ', 'label' => 'Select...'];
        foreach ($collection as $group) {
            $result[] = ['value' => $group['entity_id'], 'label' => $group['lastname']];
        }
        return $result;
    }
}
