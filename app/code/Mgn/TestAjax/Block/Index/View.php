<?php
namespace Mgn\TestAjax\Block\Index;

use Magento\Framework\View\Element\Template;

class View extends Template
{
    protected $product;
    public function __construct(Template\Context $context,
    \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory)
    {
        $this->product=$productCollectionFactory;
        parent::__construct($context);
    }

    protected function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    public function getProducts()
    {
        $productId=$this->product->create();
        $productId->addAttributeToSelect('*')->setPageSize(3);
        return $productId;
    }
}