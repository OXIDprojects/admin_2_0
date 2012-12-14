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
 * Controller handles payment actions
 */
class PaymentsController extends Admin2_Controller_Abstract
{
    /**
     * Get payment data
     *
     * Example call:
     * http://yourDomain/api/rest/v1/Payments/oxidcashondel.html
     *
     * @return void
     */
    public function get()
    {
        // OXIDs from demo payments for testing:
        //   oxidcashondel
        $paymentModel = new Application_Model_Payment();
        $entity = $this->_request->getEntity();
        $paymentData = null;
        if ($entity != null) {
            $paymentData  = $paymentModel->getPayment($entity);
        }

        if ($paymentData === null) {
    		$this->_response->setResponseCode(404);
    		$this->_response->setData(array('sMessage' => 'NOT FOUND'));
        	return;
        }
        $this->_response->setData(array('payment' => $paymentData));
    }

    /**
     * Get list of payments
     *
     * @return void
     */
    public function getList()
    {
        $paymentModel = new Application_Model_Payment();
        $limit = $this->_request->getParam('limit', 50);
        $offset = $this->_request->getParam('offset', 0);
        $paymentData = $paymentModel->getPaymentList($limit, $offset);
        $this->_response->setData(array('paymentList' => $paymentData));
    }

    /**
     * Save list of payments
     *
     * @return void
     */
    public function post()
    {
    	$aPayments = (array) $this->_request->getParam('apayments');
    	$aResults = array();
    	foreach ($aPayments as $aPaymentData) {
        	$paymentModel = new Application_Model_Payment();
	    	if (!$aPaymentData['oxpayments__oxid']) {
	    		$aPaymentData['oxpayments__oxid'] = -1; // create a new entry in case no entity is provided
	    	} 
	    	$paymentModel->savePayment($aPaymentData);
	    	$aPaymentData['oxpayments__oxid'] = $paymentModel->getId();
	    	$aResults[] = $aPaymentData;
    	}
    	$this->_response->setData(array('aPayments' => $aResults));
    }

    /**
     * Create or update a payment
     *
     * @return void
     */
    public function put()
    {
        $paymentModel = new Application_Model_Payment();
    	$aPaymentData = (array) $this->_request->getParams();
    	$oxid = $this->_request->getEntity();
    	if ($oxid) {
    		$aPaymentData['oxid'] = $oxid;
    		$ok = $paymentModel->savePayment($aPaymentData);
    		if ($ok) {
    			$this->_response->setData(array('sMessage' => 'OK'));
    		} else {
    			$this->_response->setResponseCode(400);
    			$this->_response->setData(array('sMessage' => 'NOT OK'));
    		}
   		} else {
    		$this->_response->setResponseCode(400);
    		$this->_response->setData(array('sMessage' => 'No entity given!'));
    	}
    }

    /**
     * Delete a payment
     *
     * @return void
     */
    public function delete()
    {
        $paymentModel = new Application_Model_Payment();
        $entity = $this->_request->getEntity();
        $paymentData = null;
        if ($entity != null) {
            $paymentData = $paymentModel->deletePayment($entity);
        }
        if ($paymentData === false) {
    		$this->_response->setResponseCode(404);
    		$this->_response->setData(array('sMessage' => 'NOT FOUND'));
        	return;
        }
    	$this->_response->setData(array('sMessage' => 'OK'));
    }
}
