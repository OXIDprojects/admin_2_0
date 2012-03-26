<?php
class Admin2_Controller_Result
{
    /**
     * HTTP response code
     * @var string
     */
    protected $_responseCode;

    /**
     * Header properties
     * @var array
     */
    protected $_responseHeader = array();

    /**
     * Data to return
     * @var array
     */
    protected $_data;

    /**
     * Set response data
     *
     * @param string $data Response data
     *
     * @return void
     */
    public function setData($data)
    {
        $this->_data = (array) $data;
    }

    /**
     * Get response data
     *
     * @return array
     */
    public function getData()
    {
        return $this->_data;
    }

    /**
     * Set HTTP response code
     *
     * @param string $responseCode HTTP response code
     */
    public function setResponseCode($responseCode)
    {
        $this->_responseCode = (string) $responseCode;
    }

    /**
     * Get HTTP response code
     *
     * @return string
     */
    public function getResponseCode()
    {
        return $this->_responseCode;
    }

    /**
     * Get response header
     *
     * @return array Response header
     */
    public function getResponseHeader()
    {
        return $this->_responseHeader;
    }

    /**
     * Add a property to response header
     *
     * @param string $key     Key to add
     * @param string $value   Value to add
     * @param bool   $replace Whether to replace an existing key
     *
     * @return bool
     */
    public function addResponseHeader($key, $value, $replace = true)
    {
        if (isset($this->_responseHeader[$key]) && !$replace) {
            return false;
        }

        $this->_responseHeader[$key] = (string) $value;
        return true;
    }

    public function hasData()
    {
        return ($this->_data !== null) && (count($this->_data) > 0);
    }
}
