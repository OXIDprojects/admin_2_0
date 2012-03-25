<?php

/**
 * Implements base controller functionality
 */
abstract class Admin2_Controller_Abstract
{
    /**
     * @var Admin2_Controller_Request_Abstract
     */
    protected $_request;

    /**
     * @var Admin2_Controller_Result
     */
    protected $_result;

    /**
     * Constructor
     *
     * @param Admin2_Controller_Request_Abstract $request The request
     * @param Admin2_Controller_Result           $result  The data to return
     */
    public function __construct(Admin2_Controller_Request_Abstract $request, Admin2_Controller_Result $result)
    {
        $this->_request = $request;
        $this->_result = $result;
        $this->init();
    }

    public function init()
    {
    }

    /**
     * Handle method GET
     * @abstract
     *
     * @return null
     */
    abstract public function get();

    /**
     * Handle method POST
     * @abstract
     *
     * @return null
     */
    abstract public function post();

    /**
     * Handle method PUT
     * @abstract
     *
     * @return null
     */
    abstract public function put();

    /**
     * Handle method DELETE
     * @abstract
     *
     * @return null
     */
    abstract public function delete();

    /**
     * @param \Admin2_Controller_Request_Abstract $request
     */
    public function setRequest(Admin2_Controller_Request_Abstract $request)
    {
        $this->_request = $request;
    }

    /**
     * @return \Admin2_Controller_Request_Abstract
     */
    public function getRequest()
    {
        return $this->_request;
    }

    /**
     * @param \Admin2_Controller_Result $result
     */
    public function setResult(Admin2_Controller_Result $result)
    {
        $this->_result = $result;
    }

    /**
     * @return \Admin2_Controller_Result
     */
    public function getResult()
    {
        return $this->_result;
    }
}
