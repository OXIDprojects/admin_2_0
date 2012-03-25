<?php
abstract class Admin2_Controller_Request_Abstract
{
    /**
     * Name of the requested controller.
     *
     * @var string
     */
    protected $_controller = null;

    /**
     * Name of the requested entity.
     *
     * @var string
     */
    protected $_entity = null;

    /**
     * Version number of the API.
     *
     * @var string
     */
    protected $_version = null;

    /**
     * Format of the response.
     *
     * @var string
     */
    protected $_format = 'json';

    /**
     * Name of the rquest method.
     *
     * @var string
     */
    protected $_method = null;

    /**
     * Request parameter.
     *
     * @var array
     */
    protected $_params = array();

    /**
     * Initializes the new instance.
     *
     * @return \Admin2_Controller_Request_Abstract
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * Initializes the request object. Implementations should put their parsing code here.
     *
     * @return null
     */
    abstract public function init();

    /**
     * Returns the controller name.
     *
     * @return string
     */
    public function getContoller()
    {
        return $this->_controller;
    }

    /**
     * Returns the name of the entity.
     *
     * @return string
     */
    public function getEntity()
    {
        return $this->_entity;
    }

    /**
     * Returns the version number.
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->_version;
    }

    /**
     * Returns the response format.
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->_format;
    }


    /**
     * Returns the method.
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->_method;
    }

    /**
     * Returns the value of a request paramter or the default value.
     *
     * @param string $key     Name of the request parameter.
     * @param mixed  $default Default value, if the request parameter is not set.
     *
     * @return mixed
     */
    public function getParam($key, $default = null)
    {
        if (isset($this->_params[$key])) {
            return $this->_params[$key];
        }

        return $default;
    }
}
