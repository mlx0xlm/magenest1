<?php
namespace Mgn\CyberGame\Block\CheckCyberGame;

class CheckCyberGame extends \Magento\Framework\View\Element\Template
{
    protected $_customerSession;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\SessionFactory $customerSession,
        array $data = []
    ) {
        $this->_customerSession = $customerSession->create();
        parent::__construct($context, $data);
    }

    public function getLoggedinCustomerId() {
        if ($this->_customerSession->isLoggedIn()) {
            $a= $this->getCustomerData()->getCustomAttributes()['is_manager']->getValue();
            return $a;
        }
        return false;
    }

    public function getCustomerData() {
        if ($this->_customerSession->isLoggedIn()) {
            return $this->_customerSession->getCustomerData();
        }
        return false;
    }
}