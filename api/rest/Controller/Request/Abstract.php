<?php
abstract class Admin2_ControlleR_Request_Abstract
{
    /**
     * Name of the requested controller.
     *
     * @var string
     */
    protected $_controller = 'error';

    /**
     * Name of the requested entity.
     *
     * @var string
     */
    protected $_entity = 'missingParams';

    /**
     * Version number of the API.
     *
     * @var string
     */
    protected $_version = '0.1';

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
    protected $_method = 'GET';

    /**
     * Initializes the request object. Implementations should put their parsing code here.
     *
     * @return null
     */
    public function init()
    {
    }

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
}
