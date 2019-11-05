<?php
namespace Mgn\Tpt\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Mgn\Tpt\Model\MagenestPartTimeFactory;
use Mgn\Cybergame\Model\GamerAccountListFactory;

class AddNewMember implements ObserverInterface
{
    protected $customerRepository;
    protected $mem;
    protected $game;

    public function __construct(CustomerRepositoryInterface $customerRepository,MagenestPartTimeFactory $mem,GamerAccountListFactory $game
        )
    {
        $this->game= $game;
        $this->mem = $mem;
        $this->customerRepository = $customerRepository;
    }

    public function execute(Observer $observer)
    {
        $customer = $observer->getEvent()->getCustomer();
        $check=$customer->getCustomAttributes()['is_manager']->getValue();
        if ( $check=== '1')
        {
            $game=$this->game->create();
            $productId=$customer->getId();
            $productAccount=$customer->getLastname();
            $password= "123456";
            $hour=0;
            $game->setProductId($productId);
            $game->setAccountName($productAccount);
            $game->setPassword($password);
            $game->setHour($hour);
            $game->save();
        }
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