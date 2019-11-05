<?php

namespace Mgn\Tpt\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;
class AddToCart implements ObserverInterface
{
    private $request;
    protected $configWriter;
    protected $Scope;
    public function __construct(
        RequestInterface $request,
        WriterInterface $configWriter,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->request = $request;
        $this->configWriter = $configWriter;
        $this->Scope = $scopeConfig;

    }

    public function execute(EventObserver $observer)
    {
        $customer = $observer->getProduct();
        $product=$customer->getName();
        $myValue = $this->Scope->getValue('magenest/config/value', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
       if($myValue != $product)
       {
           $observer->getRequest()->setParam('product', false);
       }
        return $this;
    }
}