<?php
namespace Mgn\Cybergame\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Mgn\Cybergame\Model\GamerAccountListFactory;

class AddAccount implements ObserverInterface
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
        $customer = $observer->getEvent()->getCustomer();
        $name=$customer->getFirstName();
        $lName=$customer->getLastName();
        $address=$customer->getEmail();
        $phone='111111';
        $member=$this->mem->create();
        $member->setName($name.' '.$lName);
        $member->setPhone($phone);
        $member->setAddress($address);
        $member->save();
    }
}