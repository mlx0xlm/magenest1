<?php
namespace Mgn\Test5\Block;

use Magento\Framework\View\Element\Template;

class CommissionReport extends Template
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

    public function getCommission()
    {
        $product=$this->product->create();
        $commission=$product->addFieldToFilter(
            'commission_value',
            array('gt' => 0)
        );
        return $commission;
    }
}