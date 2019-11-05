<?php

namespace Mgn\Dat\Observer;
use Mgn\Dat\Model\DatFactory;
use Magento\Framework\Event\ObserverInterface;

class AddCustomer implements ObserverInterface
{
    protected $_customerRepositoryInterface;
    protected $dat;
    public function __construct(
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface,
        DatFactory $dat
    ) {
        $this->dat=$dat;
        $this->_customerRepositoryInterface = $customerRepositoryInterface;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {

        $customer = $observer->getEvent()->getCustomer();
        $approved= $customer->getCustomAttributes()['dat_is_approved']->getValue();
        if($approved==1)
        {
            $firstNam=$customer->getFirstname();
            $lastName=$customer->getLastname();
            $member=$this->dat->create();
            $member->setFirstName($firstNam);
            $member->setLastname($lastName);
            $member->save();
        }
    }
}