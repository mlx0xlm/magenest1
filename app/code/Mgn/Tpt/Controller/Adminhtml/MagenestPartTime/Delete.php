<?php
namespace Mgn\Tpt\Controller\Adminhtml\MagenestPartTime;
use Mgn\Tpt\Model\MagenestPartTimeFactory;
use Magento\Backend\App\Action;

class Delete extends Action
{
    protected $member;
    public function __construct( Action\Context $context, MagenestPartTimeFactory $Member)
    {
        $this->member = $Member;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getParam("selected"); /*lấy request từ bên trang member*/
        $count = 0;
        foreach ($data as $item)
        {
            $model = $this->member->create()->load($item);
            if ($model->getId())
            {
                $model->delete();
                $count++;
            }
        }
        $this->messageManager->addSuccess('A total of '.$count.' record(s) has been removed successfully, ');
        $this->_redirect('tpt/magenestparttime');
        return;
    }
}