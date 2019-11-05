<?php
namespace Mgn\Tpt2\Controller\Manufacturer;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;
use Mgn\Tpt2\Model\ManufacturerFactory;

class Manufacturer extends Action
{
    protected $_resultPageFactory;
    protected $_resultJsonFactory;
    protected $manufacturer;

    public function __construct(Context $context, PageFactory $resultPageFactory, JsonFactory $resultJsonFactory, ManufacturerFactory $manufacturerFactory)
    {
        $this->manufacturer=$manufacturerFactory;
        $this->_resultPageFactory = $resultPageFactory;
        $this->_resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }

    public function execute()
    {

        $id=$this->getRequest()->getParams();
        $result = $this->_resultJsonFactory->create();
        $resultPage = $this->_resultPageFactory->create();
        $entity=$this->manufacturer->create()->load($id)->getData();
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $resultJson->setData($entity);
        $a=1;
        return $resultJson;/*tra ve 1 json*/
    }
}