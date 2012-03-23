<?php
class Admin2_Model_Product extends Admin2_Model_Abstract
{
    /**
     * Retrieves a data about one product.
     *
     * @param string $oxid OXID of the product.
     *
     * @return array
     */
    public function getProduct($oxid)
    {
        /**
         * @var oxArticle $product
         */
        $product = oxNew('oxarticle');
        $product->loadInLang($this->currentLanguageId, $oxid);
        $productData = array();
        $fields = $product->getFieldNames();

        foreach ($fields as $field) {
            $productData[$field] = $product->getFieldData($field);
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