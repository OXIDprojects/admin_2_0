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

    public function __construct(Admin2_Controller_Request_Abstract $request, Admin2_Controller_Result $result)
    {
        $this->_request = $request;
        $this->_result = $result;
        $this->init();
    }

    public function init()
    {
    }

    abstract public function get();
    abstract public function post();
    abstract public function put();
    abstract public function delete();

    /**
     * @param \Admin2_Controller_Request_Abstract $request
     */
    public function setRequest($request)
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
    public function setResult($result)
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
