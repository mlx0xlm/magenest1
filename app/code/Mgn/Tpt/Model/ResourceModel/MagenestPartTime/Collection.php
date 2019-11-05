<?php
namespace Mgn\Tpt\Model\ResourceModel\MagenestPartTime;
class	Collection	extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public	function	_construct()	{
        $this->_init('Mgn\Tpt\Model\MagenestPartTime',
            'Mgn\Tpt\Model\ResourceModel\MagenestPartTime');
    }
}