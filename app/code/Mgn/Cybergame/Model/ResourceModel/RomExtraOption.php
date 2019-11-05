<?php
namespace Mgn\Cybergame\Model\ResourceModel;
class    RomExtraOption extends
    \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function _construct()
    {
        $this->_init('room_extra_option', 'id');
    }
}