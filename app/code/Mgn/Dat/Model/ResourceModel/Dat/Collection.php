<?php
namespace Mgn\Dat\Model\ResourceModel\Dat;
class	Collection	extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public	function	_construct()	{
        $this->_init('Mgn\Dat\Model\Dat',
            'Mgn\Dat\Model\ResourceModel\Dat');
    }
}