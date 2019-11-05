<?php
namespace Mgn\Cybergame\Model\ResourceModel\RomExtraOption;
class	Collection	extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public	function	_construct()	{
        $this->_init('Mgn\Cybergame\Model\RomExtraOption',
            'Mgn\Cybergame\Model\ResourceModel\RomExtraOption');
    }
}