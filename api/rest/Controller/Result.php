<?php
/**
 * Result container. We need this class to have a single object capable of storing result content and/or error information
 */
class Admin2_Controller_Result
{
    /**
     * Actual result contents. It could be an object, array or any useful content
     *
     * @var mixed
     */
    protected $_mContents;

    /**
     * Indicates if this result object contains any errors
     *
     * @var bool
     */
    protected $_blError = false;

    /**
     * Error object
     *
     * @var Admin2_Controller_Error
     */
    protected $_oError = null;

    /**
     * Sets the result contents
     *
     * @param $mContents string Actual result contents
     *
     * @return null
     */
    public function setContents($mContents)
    {
        $this->_mContents = $mContents;
    }

    /**
     * Returns actual result contents.
     * This contents is to be parsed into appropriate format (ie JSON) and passed back to user.
     *
     * @return mixed
     */
    public function getContents()
    {
        return $this->_mContents;
    }

    /**
     * Sets erorr values
     *
     * @param Exception $oException Exception object
     */
    public function setError(Exception $oException)
    {
        $this->_blError = true;
        $this->_oError = new Admin2_Controller_Error();
        $this->_oError->code = $oException->getCode();
        //TODO: implement HTTP code handling here, so we can return close
        $this->_oError->httpCode = "400";
        $this->_oError->message = $oException->getMessage();
    }

    /**
     * Indicates if this result containts any error
     *
     * @return bool
     */
    public function isError()
    {
        return $this->_blError;
    }

    /**
     * Returns error message
     *
     * @return Admin2_Controller_Error|null
     */
    public function getError()
    {
        return $this->_oError;
    }
}
