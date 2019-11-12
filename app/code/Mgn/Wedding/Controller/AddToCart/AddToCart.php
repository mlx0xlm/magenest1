<?php
namespace	Mgn\Wedding\Controller\AddToCart;
use Mgn\Wedding\Model\WeddingFactory;
class	AddToCart	extends	\Magento\Framework\App\Action\Action
{
    protected $formKey;
    protected $cart;
    protected $product;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Data\Form\FormKey $formKey,
        \Magento\Checkout\Model\Cart $cart,
        \Magento\Catalog\Model\Product $product,
        array $data = []) {
        $this->formKey = $formKey;
        $this->cart = $cart;
        $this->product = $product;
        parent::__construct($context);
    }

    public function execute()
    {
        $productId =2071;
        $params = array(
            'product' => $productId, //product Id
            'qty'   =>8//quantity of product
        );
        //Load the product based on productID
        $_product = $this->product->load($productId);
        $this->cart->addProduct($_product, $params);
        $this->cart->save();
    }
}