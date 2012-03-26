<?php

class ProductsController extends Admin2_Controller_Abstract
{
    /**
     * Get product data
     *
     * Example call:
     * http://yourDomain/api/rest/v1/products.html?productId=dc5ffdf380e15674b56dd562a7cb6aec
     *
     * @return null
     */
    public function get()
    {
        // OXIDs from demo products for testing:
        //   05848170643ab0deb9914566391c0c63
        //   dc5ffdf380e15674b56dd562a7cb6aec
        $oxid         = $this->_request->getParam('productId');
        $productModel = new Application_Model_Product();
        $productData  = $productModel->getProduct($this->_request->getEntity());
        if ($productData === null) {
            return;
        }

        $this->_result->setData(array('product' => $productData));
    }

    public function post()
    {
        $this->_result->setData(array('hello' => 'world!'));
    }

    public function put()
    {
        $this->_result->setData(array('hello' => 'world!'));
    }

    public function delete()
    {
        $this->_result->setData(array('hello' => 'world!'));
    }
}
