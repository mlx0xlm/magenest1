<?php
namespace Mgn\Cybergame\Model\ResourceModel\GameAccountList;
class	Collection	extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public	function	_construct()	{
        $this->_init('Mgn\Cybergame\Model\GamerAccountList',
            'Mgn\Cybergame\Model\ResourceModel\GamerAccountList');
    }
}