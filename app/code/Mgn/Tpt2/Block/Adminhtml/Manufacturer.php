<?php
namespace Mgn\Tpt2\Block\Adminhtml;

 use Magento\Framework\View\Element\Template\Context;
 use Mgn\Tpt2\Model\ManufacturerFactory;
 use \Magento\Framework\View\Element\Template;

 class Manufacturer extends Template
 {
     protected $manufacturer;
     public function __construct(Context $context,ManufacturerFactory $Manufacturer)
     {
         $this->manufacturer=$Manufacturer;
         parent::__construct($context);
     }
     public function manufacturer()
     {
         $listManufacturer = $this->manufacturer->create()->getCollection();
         return $listManufacturer;
     }
 }