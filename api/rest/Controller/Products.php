<?php

class Admin2_Controller_Products extends Admin2_Controller_Abstract
{
    public function get()
    {
        $productModel = new Admin2_Model_Product();
        $productData = $productModel->getProduct('dc5ffdf380e15674b56dd562a7cb6aec');
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
