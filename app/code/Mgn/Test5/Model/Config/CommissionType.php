<?php
namespace	Mgn\Test5\Model\Config;

class CommissionType extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    public function getAllOptions()
    {
        $obj = \Magento\Framework\App\ObjectManager::getInstance();
        $option[] = array('label'=>'select','value'=>null);
        $option[] = array('label'=>'fixer','value'=>0);
        $option[] = array('label'=>'percent','value'=>1);
        $this->_options = $option;
        return $this->_options;
    }
}