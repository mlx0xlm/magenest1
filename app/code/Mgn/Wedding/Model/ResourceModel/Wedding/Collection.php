<?php
namespace Mgn\Wedding\Model\ResourceModel\Wedding;
class	Collection	extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public	function	_construct()	{
        $this->_init('Mgn\Wedding\Model\Wedding',
            'Mgn\Wedding\Model\ResourceModel\Wedding');
    }
}