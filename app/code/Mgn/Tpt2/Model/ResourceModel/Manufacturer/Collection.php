<?php
namespace Mgn\Tpt2\Model\ResourceModel\Manufacturer;
class	Collection	extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public	function	_construct()	{
        $this->_init('Mgn\Tpt2\Model\Manufacturer',
            'Mgn\Tpt2\Model\ResourceModel\Manufacturer');
    }
}