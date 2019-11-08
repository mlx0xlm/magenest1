<?php
namespace Mgn\Wedding\Model\ResourceModel;
class    Wedding extends
    \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function _construct()
    {
        $this->_init('magenest_wedding_event', 'id');
    }
}