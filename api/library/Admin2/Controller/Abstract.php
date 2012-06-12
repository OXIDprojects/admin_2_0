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
     * @var Admin2_Controller_Response
     */
    protected $_response;

    /**
     * Constructor
     *
     * @param Admin2_Controller_Request_Abstract $request  The request
     * @param Admin2_Controller_Response         $response The data to return
     *
     * @return Admin2_Controller_Abstract
     */
    public function __construct(Admin2_Controller_Request_Abstract $request, Admin2_Controller_Response $response)
    {
        $this->_request = $request;
        $this->_response = $response;
        $this->init();
    }

    /**
     * Controller initialization method.
     *
     * @return void
     */
    public function init()
    {
    }

    /**
     * Handle method GET
     *
     * @abstract
     *
     * @return void
     */
    abstract public function get();

    /**
     * Handle method POST
     *
     * @abstract
     *
     * @return void
     */
    abstract public function post();

    /**
     * Handle method PUT
     *
     * @abstract
     *
     * @return void
     */
    abstract public function put();

    /**
     * Handle method DELETE
     *
     * @abstract
     *
     * @return void
     */
    abstract public function delete();

    /**
     * Handle method GET without an entity.
     *
     * @abstract
     *
     * @return void
     */
    abstract public function getList();

    /**
     * Set the request object
     *
     * @param \Admin2_Controller_Request_Abstract $request The request object
     *
     * @return void
     */
    public function setRequest(Admin2_Controller_Request_Abstract $request)
    {
        $this->_request = $request;
    }

    /**
     * Get the request object
     *
     * @return \Admin2_Controller_Request_Abstract The request object
     */
    public function getRequest()
    {
        return $this->_request;
    }

    /**
     * Set response
     *
     * @param \Admin2_Controller_Response $response The response object
     *
     * @return void
     */
    public function setResponse(Admin2_Controller_Response $response)
    {
        $this->_response = $response;
    }

    /**
     * Get response
     *
     * @return \Admin2_Controller_Response The response object
     */
    public function getResponse()
    {
        return $this->_response;
    }
}
