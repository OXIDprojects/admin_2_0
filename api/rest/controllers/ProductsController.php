<?php

class ProductsController extends Admin2_Controller_Abstract
{
    /**
     * Get product data
     *
     * Example call:
     * http://yourDomain/api/rest/v1/Products/dc5ffdf380e15674b56dd562a7cb6aec.html
     *
     * @return void
     */
    public function get()
    {
        // OXIDs from demo products for testing:
        //   05848170643ab0deb9914566391c0c63
        //   dc5ffdf380e15674b56dd562a7cb6aec
        $productModel = new Application_Model_Product();
        $entity = $this->_request->getEntity();
        $productData = null;
        if ($entity != null){
            $productData  = $productModel->getProduct($entity);
        }

        if ($productData === null) {
            return;
        }
        $this->_result->setData(array('product' => $productData));
    }

    public function getList()
    {
        $productModel = new Application_Model_Product();
        $limit = $this->_request->getParam('limit',50);
        $offset = $this->_request->getParam('offset',0);
        $productData  = $productModel->getProductList($limit,$offset);
        $this->_result->setData(array('productList' => $productData));
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
