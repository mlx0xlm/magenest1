<?php
namespace Mgn\Tpt\Model\ResourceModel;
class    MagenestPartTime extends
    \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function _construct()
    {
        $this->_init('magenest_part_time', 'member_id');
    }
}