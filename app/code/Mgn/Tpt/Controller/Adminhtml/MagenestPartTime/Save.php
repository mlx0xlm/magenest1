<?php
namespace Mgn\Tpt\Controller\Adminhtml\MagenestPartTime;
use Magento\Framework\App\Action\Context;
class Save extends \Magento\Framework\App\Action\Action
{
    protected $member;
    public function __construct(Context $context, \Mgn\Tpt\Model\MagenestPartTimeFactory $member)
    {
        $this->member = $member;
        parent::__construct($context);
    }
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $mem = $this->member->create();
        $mem->setData($data)->save();
        $this->messageManager->addSuccessMessage('Add Done !');
        $this->_redirect('tpt/magenestparttime');
    }
}