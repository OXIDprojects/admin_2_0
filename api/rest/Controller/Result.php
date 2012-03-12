<?php
class Admin2_Controller_Result
{
    protected $_responseCode;

    protected $_responseHeader = array();

    protected $_data;

    public function setData($data)
    {
        $this->_data = (array) $data;
    }

    public function getData()
    {
        return $this->_data;
    }

    public function setResponseCode($responseCode)
    {
        $this->_responseCode = (string) $responseCode;
    }

    public function getResponseCode()
    {
        return $this->_responseCode;
    }

    public function setResponseHeader($responseHeader)
    {
        $this->_responseHeader = (string) $responseHeader;
    }

    public function getResponseHeader()
    {
        return $this->_responseHeader;
    }

    public function addResponseHeader($key, $value, $replace = true)
    {
        if (isset($this->_responseHeader[$key]) && !$replace) {
            return false;
        }

        $this->_responseHeader[$key] = (string) $value;
        return true;
    }
}
