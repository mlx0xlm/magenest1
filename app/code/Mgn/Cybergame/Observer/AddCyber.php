<?php
namespace Mgn\Cybergame\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Mgn\Cybergame\Model\GamerAccountListFactory;

class AddCyber implements ObserverInterface
{
    protected $GamerAccountListFactory;
    protected $mem;

    public function __construct(CustomerRepositoryInterface $customerRepository,GamerAccountListFactory $mem
    )
    {
        $this->mem = $mem;
        $this->GamerAccountListFactory = $customerRepository;
    }

    public function execute(Observer $observer)
    {
        $orderIds = $observer->getEvent()->getOrderIds();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $order = $objectManager->create('Magento\Sales\Model\Order')->load($orderIds);
        $items= $order->getAllItems();
        $order = $observer->getOrder();
        $quote = $observer->getQuote();

        // Do whatever you want here

        return $this;
    }
}