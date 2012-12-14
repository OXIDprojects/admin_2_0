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
 * Class for handling actions related to a payment
 */
class Application_Model_Payment extends Admin2_Model_Abstract
{
    /**
     * Keeps all act. fields to store
     */
    protected $_aFieldArray = null;
    
    /**
     * Store the generated oxid
     */
    protected $_oxid = null;
    
    /**
     * retrieve the saved oxid
     */
    public function getId()
    {
    	return $this->_oxid;
    }
        
	/**
     * Retrieve payment data.
     *
     * @param string $oxid OXID of the payment.
     *
     * @return array|null
     */
    public function getPayment($oxid)
    {
        /**
         * @var oxPayment $payment
         */
        $payment = oxNew('oxpayment');
        $payment->disableLazyLoading();
        $found = $payment->loadInLang($this->_currentLanguageId, $oxid);
		if ($found) {
			return $this->oxidToArray($payment);
		}	
    }

    /**
     * Retrieve payment data.
     *
     * @param int $limit  Maximum length of list.
     * @param int $offset Offset of first list item.
     *
     * @return array|null
     */
    public function getPaymentList($limit = 50, $offset = 0)
    {
        /**
         * @var oxArticleList $paymentList
         * @var oxArticle $payment
         */
        $paymentList = oxNew('oxpaymentlist');
        $paymentList->setSqlLimit($offset, $limit);
        $listObject = $paymentList->getBaseObject();
        $listObject->disableLazyLoading();
        $fieldList = $listObject->getSelectFields();
        $query = 'SELECT ' . $fieldList . ' FROM ' . $listObject->getViewName();
        $paymentList->selectString($query);

        $paymentData = array();
        foreach ($paymentList as $payment) {
            $paymentData[$payment->getId()] = $this->oxidToArray($payment);
        }
        return $paymentData;
    }

    /**
     * Save payment data.
     *
     * @param array $aPaymentData the payment data
     *
     */
    public function savePayment($aParams)
    {
        $soxId = $aParams['oxpayments__oxid'];
        // checkbox handling
        if (!isset($aParams['oxpayments__oxactive']))
            $aParams['oxpayments__oxactive'] = 0;
        if (!isset($aParams['oxpayments__oxchecked']))
            $aParams['oxpayments__oxchecked'] = 0;

        $oPayment = oxNew("oxpayment");

        if ($soxId != "-1")
            $oPayment->loadInLang($this->_currentLanguageId, $soxId);
        else
           $aParams['oxpayments__oxid'] = null;

        $oPayment->setLanguage(0);
        $oPayment->assign($aParams);

        // setting add sum calculation rules
        $aRules = (array) oxConfig::getParameter("oxpayments__oxaddsumrules");
        $oPayment->oxpayments__oxaddsumrules = new oxField(array_sum($aRules));

        if (!is_array( $this->_aFieldArray))
            $this->_aFieldArray = oxRegistry::getUtils()->assignValuesFromText($oPayment->oxpayments__oxvaldesc->value);
        // build value
        $sValdesc = "";
        foreach ($this->_aFieldArray as $oField)
            $sValdesc .= $oField->name . "__@@";

        $oPayment->oxpayments__oxvaldesc = new oxField($sValdesc, oxField::T_RAW);
        $oPayment->setLanguage($this->_currentLanguageId);
        $ok = $oPayment->save();

        if ($ok) {
	        // set oxid if inserted
	        $this->_oxid = $oPayment->getId();
        }
        
        return $ok;
    }
    
    /**
     * @param string $oxid OXID of the payment.
     *
     * @return array|null
     */
    public function deletePayment($oxid)
    {
        $payment = oxNew('oxpayment');
        $success = $payment->delete($oxid);
        return $success ? $this->oxidToArray($payment) : $success;
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
