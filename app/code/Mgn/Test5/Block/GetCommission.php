<?php
namespace Mgn\Test5\Block;
use Magento\Framework\View\Element\Template;
use \Magento\Store\Model\StoreManagerInterface as storeManager;
class GetCommission extends Template
{
    protected $_customerSession;
    protected $storeManager, $product;
    public function __construct(
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    )
    {
        $this->product=$productCollectionFactory;
        $this->storeManager = $storeManager;
        $this->_customerSession = $customerSession;
        parent::__construct($context, $data);
    }
    public function getCustommer()
    {
        $om = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $om->create('\Magento\Customer\Model\Session');
        $id = $customerSession->getCustomer()->getData()['entity_id'];
        $commission=$this->product->create()->addAttributeToSelect('*')->addFieldToFilter('sale_agent_id',array('eq' => $id));
        return $commission;
    }
}