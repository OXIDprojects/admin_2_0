<?php
/**
 *  This file is part of Admin 2.0 project for OXID eShop CE/PE/EE.
 *
 *  The Admin 2.0 sourcecode is free software: you can redistribute it and/or modify
 *  it under the terms of the MIT License.
 *
 *  @link      http://admin20.de
 *  @copyright (C) 2012 :: Admin 2.0 Developers
 */

/**
 * Controller handles product actions
 */
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
        if ($entity != null) {
            $productData  = $productModel->getProduct($entity);
        }

        if ($productData === null) {
            return;
        }
        $this->_response->setData(array('product' => $productData));
    }

    /**
     * Get list of products
     *
     * @return void
     */
    public function getList()
    {
        $productModel = new Application_Model_Product();
        $limit = $this->_request->getParam('limit', 50);
        $offset = $this->_request->getParam('offset', 0);
        $productData  = $productModel->getProductList($limit, $offset);
        $this->_response->setData(array('productList' => $productData));
    }

    /**
     * Save list of products
     *
     * @return void
     */
    public function post()
    {
        $this->_response->setData(array('hello' => 'world!'));
    }

    /**
     * Create or update a product
     *
     * @return void
     */
    public function put()
    {
        $this->_response->setData(array('hello' => 'world!'));
    }

    /**
     * Delete a product
     *
     * @return void
     */
    public function delete()
    {
        $this->_response->setData(array('hello' => 'world!'));
    }
}
