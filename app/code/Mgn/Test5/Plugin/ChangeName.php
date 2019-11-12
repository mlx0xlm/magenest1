<?php

namespace Mgn\Test5\Plugin;
use Magento\Customer\Helper\Session\CurrentCustomer;
use Magento\Customer\Helper\View;
class ChangeName
{
    protected $currentCustomer;
    private $customerViewHelper;

    public function __construct(
        CurrentCustomer $currentCustomer,
        View $customerViewHelper
    ) {
        $this->currentCustomer = $currentCustomer;
        $this->customerViewHelper = $customerViewHelper;
    }

    public function afterGetSectionData()
    {
        $customer = $this->currentCustomer->getCustomer();
        $a=1;
        if ($customer->getCustomAttributes()['is_sales_agent']->getValue())
        {
            return [
                'fullname' => 'SA:'.$this->customerViewHelper->getCustomerName($customer),
                'firstname' => $customer->getFirstname(),
                'websiteId' => $customer->getWebsiteId(),
            ];
        }
        else
        {
            return [
                'fullname' => $this->customerViewHelper->getCustomerName($customer),
                'firstname' => $customer->getFirstname(),
                'websiteId' => $customer->getWebsiteId(),
            ];
        }
    }

}