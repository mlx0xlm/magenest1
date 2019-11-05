<?php
namespace Mgn\Tpt2\Model\ResourceModel;
class    Manufacturer extends
    \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function _construct()
    {
        $this->_init('manufacturer_entity', 'entity_id');
    }
}