<?php
namespace Mgn\Dat\Model\ResourceModel;
class    Dat extends
    \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function _construct()
    {
        $this->_init('magenest_dat', 'id');
    }
}