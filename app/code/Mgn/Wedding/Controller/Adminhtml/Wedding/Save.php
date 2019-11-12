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
        $sku=$wedding->getTitle();
        $product=$this->product->create();
        $product->setSku($id.$sku);
        $product->setName($sku);
        $product->setTypeId(\Magento\Catalog\Model\Product\Type::TYPE_SIMPLE);
        $product->setVisibility(4);
        $product->setPrice(1);
        $product->setAttributeSetId(4); // Default attribute set for products
        $product->setStatus(\Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED);
        $product->save();
        $this->messageManager->addSuccessMessage('Add Done !');
        $this->_redirect('wedding/wedding');
    }
}