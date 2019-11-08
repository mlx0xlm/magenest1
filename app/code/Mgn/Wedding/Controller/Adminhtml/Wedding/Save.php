<?php
namespace Mgn\Wedding\Controller\Adminhtml\Wedding;
use Magento\Framework\App\Action\Context;
use Magento\Catalog\Model\ProductFactory as productFactory;
class Save extends \Magento\Framework\App\Action\Action
{
    protected $wedding,$product;
    public function __construct(Context $context, \Mgn\Wedding\Model\WeddingFactory $Wedding, productFactory $product)
    {
        $this->product=$product;
        $this->wedding = $Wedding;
        parent::__construct($context);
    }
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $wedding = $this->wedding->create();
        $wedding->setData($data)->save();
        $id= $wedding->getId();
        $product=$this->product->create();
        $product->setData('wedding_id',$id);
        $product->setName('hihii');
        $product->setSku('sku');
        $product->save();
        $this->messageManager->addSuccessMessage('Add Done !');
        $this->_redirect('wedding/wedding');
    }
}