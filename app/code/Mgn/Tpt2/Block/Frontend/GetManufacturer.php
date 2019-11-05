<?php
namespace Mgn\Tpt2\Block\Frontend;
use Magento\Catalog\Model\Product;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Mgn\Tpt2\Model\ManufacturerFactory;
class GetManufacturer extends Template
{

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var Product
     */
    protected $manufacturer;
    private $product;

    public function __construct(Template\Context $context,
                                ManufacturerFactory $manufacturerFactory,
                                Registry $registry,
                                array $data)
    {
        $this->registry = $registry;
        $this->manufacturer=$manufacturerFactory;
        parent::__construct($context, $data);
    }


    private function getProduct()
    {
        if (is_null($this->product)) {
            $this->product = $this->registry->registry('product');

            if (!$this->product->getId()) {
                throw new LocalizedException(__('Failed to initialize product'));
            }
        }

        return $this->product;
    }

    public function getProductName()
    {
//        $id= $this->getProduct()['manufacturer_id'];
//        $manufacturer_id=$this->manufacturer->create()->load($id);
//        $result=$manufacturer_id->getData()['name'];
//        return $result;
        $id= $this->getProduct()['is_cybergame'];

        return $id;
    }
}