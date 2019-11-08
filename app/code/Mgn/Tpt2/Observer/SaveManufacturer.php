<?php

namespace Mgn\Tpt2\Observer;
use Mgn\Tpt2\Model\ManufacturerFactory;
use Magento\Framework\Event\ObserverInterface;

class SaveManufacturer implements ObserverInterface
{
    protected $manufacturer;
    public function __construct(ManufacturerFactory $manufacturerFactory)
    {
        $this->manufacturer=$manufacturerFactory;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $_product = $observer->getProduct();  // you will get product object
        $ManufacturerId=$_product->getData()['manufacturer_id']; // for sku
        $id=$this->manufacturer->create()->getById($ManufacturerId);
        $a=1;
    }
}