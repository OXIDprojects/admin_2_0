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
 * Class for handling actions related to a product
 */
class Application_Model_Product extends Admin2_Model_Abstract
{
    /**
     * Retrieve product data.
     *
     * @param string $oxid OXID of the product.
     *
     * @return array|null
     */
    public function getProduct($oxid)
    {
        /**
         * @var oxArticle $product
         */
        $product = oxNew('oxarticle');
        $product->disableLazyLoading();
        $product->loadInLang($this->currentLanguageId, $oxid);
        $productData = array();
        $fields = $product->getFieldNames();
        if (!$product->isLoaded()) {
            return null;
        }

        foreach ($fields as $field) {
            $productData[$field] = $product->getFieldData($field);
        }

        return $productData;
    }

    /**
     * Retrieve product data.
     *
     * @param int $limit  Maximum length of list.
     * @param int $offset Offset of first list item.
     *
     * @return array|null
     */
    public function getProductList($limit = 50, $offset = 0)
    {
        /**
         * @var oxArticleList $productList
         */
        $productList = oxNew('oxarticlelist');
        $productList->setSqlLimit($offset, $limit);
        $oListObject = $productList->getBaseObject();//oxNew('oxarticle');
        $sFieldList = $oListObject->getSelectFields();
        $query = 'SELECT ' . $sFieldList . ' FROM ' . $oListObject->getViewName() . ' WHERE '
                . $oListObject->getViewName() . '.oxparentid = \'\'';
        $productList->selectString($query);

        $productsData = $productList->getArray();
        $productData = array();
        $c = 0;
        foreach ($productsData as $product) {
            $sOxid = $product->getProductId();
            $data = $this->getProduct($sOxid);
            if ($data !== null) {
                $c++;
                $productData['product' . $c] = $data;
            }
        }
        return $productData;
    }

    /**
     * Model-specific initialization code.
     *
     * @return null
     */
    public function init()
    {
        // Add your model-specific initialization code here, instead of overloading the constructor.
    }
}
