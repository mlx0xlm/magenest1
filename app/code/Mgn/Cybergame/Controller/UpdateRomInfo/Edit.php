<?php

namespace Mgn\Cybergame\Controller\UpdateRomInfo;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;
use Mgn\Cybergame\Model\RomExtraOptionFactory;

class Edit extends Action
{
    protected $_resultPageFactory;
    protected $_resultJsonFactory;
    protected $RomExtraOptionFactory;

    public function __construct(Context $context, PageFactory $resultPageFactory, JsonFactory $resultJsonFactory, RomExtraOptionFactory $RomExtraOptionFactory)
    {
        $this->RomExtraOptionFactory = $RomExtraOptionFactory;
        $this->_resultPageFactory = $resultPageFactory;
        $this->_resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParams()['product'];
        $number = $this->getRequest()->getParams()['numberPc'];
        $price = $this->getRequest()->getParams()['price'];
        $entity = $this->RomExtraOptionFactory->create()->load($id);
        $entity->setData('number_pc',$number);
        $entity->setData('price',$price);
        $entity->save();
    }
}