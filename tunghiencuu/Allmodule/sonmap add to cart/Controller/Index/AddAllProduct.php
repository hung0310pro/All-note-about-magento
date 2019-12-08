<?php

namespace Gssi\Quotes\Controller\Index;

use Magento\Catalog\Model\ProductFactory;
use Magento\Checkout\Model\Cart;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Data\Form\FormKey;

class AddAllProduct extends Action
{
    /**
     * @var FormKey
     */
    protected $formKey;

    /**
     * @var Session
     */
    protected $checkoutSession;

    /**
     * @var Cart
     */
    protected $cart;

    /**
     * @var ProductFactory
     */
    protected $productFactory;

    /**
     * Constructor.
     *
     * @param Context                         $context
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Magento\Customer\Model\Session $customerSession
     * @param JsonFactory                     $resultJsonFactory
     * @param FormKey                         $formKey
     * @param Cart                            $cart
     * @param ProductFactory                  $productFactory
     */

    protected $_products;

    protected $_productRepository;

    public function __construct(
        Context $context,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Catalog\Model\Product $products,
        JsonFactory $resultJsonFactory,
        FormKey $formKey,
        Cart $cart,
        ProductFactory $productFactory
    ) {
        $this->checkoutSession = $checkoutSession;
        $this->_productRepository = $productRepository;
        $this->customerSession = $customerSession;
        $this->_products = $products;
        $this->formKey = $formKey;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->cart = $cart;
        $this->productFactory = $productFactory;
        parent::__construct($context);
    }

    public function loadMyProduct($sku)
	{
	    return $this->_productRepository->get($sku);
	}

    public function execute()
    {
        try {
            // Set result data and pass back
            $result = $this->resultJsonFactory->create();
            if (!$this->customerSession->getCustomer()->getId()) {
                $result->setData(['error' => __('Invalid session ID')]);
            }

            $productIds = $this->getRequest()->getParam('idproduct');
            $productSkus = $this->getRequest()->getParam('skuproduct');
            $amounts = $this->getRequest()->getParam('qty');
            $pricect = $this->getRequest()->getParam('pricect');
            $check = 0;
	        for ($i = 0; $i < count($productIds); $i++) {
                if($this->_products->getIdBySku($productSkus[$i])) { // check product có tồn tại sku không.

                    // get product by sku
	                $product = $this->loadMyProduct($productSkus[$i]);

	                // New product params (add with qty, product)
	                if ($amounts[$i] != null && $amounts[$i] != "" && $amounts[$i] > 0) {
		                $check++;
		                $params = [
			                'form_key' => $this->formKey->getFormKey(),
			                'product' => $product->getId(),
			                'qty' => $amounts[$i],
		                ];

                        // add custom price, not in db magento
		                $product->setPrice($pricect[$i]);
		                $product->setBasePrice($pricect[$i]);

		                // Save Product
		                $product->save();

		                // Add product to cart
		                $this->cart->addProduct($product, $params);
	                }
                }
            }

	        if($check > 0) {
		        //Save cart
		        $this->cart->save();
		        $this->messageManager->addSuccess(__('Products added succesfully'));
		        return $this->_redirect('quotes/index/index');
	        }else{
	        	$this->messageManager->addErrorMessage(__("Can't Add Products To Cart" ));
                return $this->_redirect('quotes/index/index');
	        }

        } catch (\Exception $e) {
        	$this->messageManager->addErrorMessage($e->getMessage());
            return $this->_redirect('quotes/index/index');
        }
    }
}