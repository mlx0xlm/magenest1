<?php
namespace Mgn\Dat\Controller\GetInfoCustomer;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use \Magento\Customer\Model\CustomerFactory;
use Magento\Framework\Controller\ResultFactory;

class GetData extends Action
{
    protected $customer;
    public function __construct(Context $context,CustomerFactory $customerFactory)
    {
        $this->customer=$customerFactory;
        parent::__construct($context);
    }
    function execute()
    {
        $id=$this->getRequest()->getParams();
        $custom=$this->customer->create()->load($id);
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $resultJson->setData($custom);
        return $resultJson;
    }
}