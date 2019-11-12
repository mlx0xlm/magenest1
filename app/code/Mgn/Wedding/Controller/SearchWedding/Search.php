<?php

namespace Mgn\Wedding\Controller\SearchWedding;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;
use Mgn\Wedding\Model\WeddingFactory;

class    Search extends Action
{
    protected $resultPageFactory, $wedding;

    public function __construct(
        WeddingFactory $wedding,
        Context $context,
        PageFactory $resultPageFactory
    )
    {
        $this->wedding = $wedding;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $wedding = $this->wedding->create()->getCollection();
        $bride_email = $data['brideEmail'];
        $groom_email = $data['groomEmail'];
        $wedding->addFieldToFilter(
            'bride_email',
            array('like' => $bride_email)
        )->addFieldToFilter(
            'groom_email',
            array('like' => $groom_email)
        )->getData();
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $resultJson->setData($wedding);
        return $resultJson;
    }
}