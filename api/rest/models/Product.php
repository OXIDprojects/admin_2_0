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
        $product->loadInLang($this->_currentLanguageId, $oxid);

        return $this->oxidToArray($product);
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
         * @var oxArticle $product
         */
        $productList = oxNew('oxarticlelist');
        $productList->setSqlLimit($offset, $limit);
        $listObject = $productList->getBaseObject();
        $listObject->disableLazyLoading();
        $fieldList = $listObject->getSelectFields();
        $query = 'SELECT ' . $fieldList . ' FROM ' . $listObject->getViewName() . ' WHERE '
                . $listObject->getViewName() . '.oxparentid = \'\'';
        $productList->selectString($query);

        $productData = array();
        foreach ($productList as $product) {
            $productData[$product->getProductId()] = $this->oxidToArray($product);
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

    private function oxidToArray(oxBase $oxidObject)
    {
        $objectData = array();
        $fields = $oxidObject->getFieldNames();

        foreach ($fields as $field) {
            $objectData[$field] = $oxidObject->getFieldData($field);
        }

        return $objectData;
    }
}
