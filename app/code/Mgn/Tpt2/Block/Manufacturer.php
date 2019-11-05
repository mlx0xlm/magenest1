<?php
namespace Mgn\Tpt2\Block;

use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Element\Template;

class Manufacturer extends Template
{
    protected $manufacturer;
    public function getManufacturer()
    {
        $listManufacturer = $this->manufacturer->create()->getCollection();
        return $listManufacturer;
    }
}