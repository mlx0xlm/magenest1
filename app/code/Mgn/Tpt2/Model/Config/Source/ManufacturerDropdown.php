<?php
namespace Mgn\Tpt2\Model\Config\Source;
class ManufacturerDropdown extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * Get all options
     * @return array
     */
    public function getAllOptions()
    {
        $obj = \Magento\Framework\App\ObjectManager::getInstance();
        $Manufacturer = $obj->create('Mgn\Tpt2\Model\Manufacturer');
        $tags = $Manufacturer->getCollection();
        foreach($tags as $tag){

                $label = $tag->getName();
                $value = $tag->getEntity_id();
                $option[] = array('label'=>$label,'value'=>$value);

        }
        $this->_options = $option;
        return $this->_options;
    }
}