<?php

/**
 * Implements base controller functionality
 */
class Admin2_Controller_Base
{
    /**
     * Result object
     *
     * @var Admin2_Controller_Result
     */
    protected $_oResult = null;

    /**
     * Request method
     *
     * @var string
     */
    protected $_sRequestMethod = null;

    /**
     * Request entity. It could be an item ID or action to be executed
     *
     * @var string
     */
    protected $_sEntity = null;

    /**
     * Additional parameters taken from request URL ($_REQUEST)
     *
     * @var array
     */
    protected $_aParams = array();

    /**
     * Object primary key supplied to executeItem() method (like in call /api/rest/products/1234 )
     *
     * @var null
     */
    protected $_sId = null;

    /**
     * Selects and executes appropriate controller method. Formats the result.
     *
     * @param string $sRequestMethod HTTP call method (GET, POSTS, DELETE, )
     * @param string $sEntity
     * @param string $aParams
     *
     * @return null
     */
    public function execute($sRequestMethod, $sEntity, $aParams)
    {
        $this->_sRequestMethod = $sRequestMethod;
        $this->_sEntity = $sEntity;
        $this->_aParams = $aParams;

        $this->_oResult = new Admin2_Controller_Result();

        $sMethod = $this->_getMethod();

        if (!$sMethod) {
            $this->_oResult->setErrorNotFound();
        } else {
            try {
                //executes actual method
                $this->_oResult->setContent($this->$sMethod());
            } catch (Exception $oE) {
                $this->_oResult->setError($oE);
            }
        }
    }

    /**
     * Returns result object
     *
     * @return Admin2_Controller_Result|null
     */
    public function getResult()
    {
        return $this->_oResult;
    }

    /**
     * Selects appropriate method name by supplied Entity value.
     * In case entity value is "search", it would look for method loadSearch in $this Controller. (eg. /api/rest/product/search?q=hi call)
     *
     * If method does not exists it assumes that entity means object id (eg. /api/rest/product/1234 call)
     * And returns "loadItem"/"saveItem" method
     *
     * Otherwise it would return "loadDefault" method name (eg. /api/rest/products call).
     *
     * @return string
     */
    protected function _getMethod()
    {
        $sMethod = "loadDefault";
        $sEntity = $this->_sEntity;


        if ($this->_sEntity) {
            if (method_exists($this, "load" . $sEntity)) {
                $sMethod = "load" . $sEntity;
            } else {
                $this->_sId = $sEntity;
                $sMethod = "loadItem";
            }
        }

        return $sMethod;
    }


    /**
     * Default controller execution (eg. /api/rest/products call).
     * The result returned by this method is supposed to be returned for front end client.
     *
     * @return mixed
     */
    protected function loadDefault()
    {
        return null;
    }

    /**
     * Controller method selecting one item (eg. /api/rest/products/1234 call)
     * The result returned by this method is supposed to be returned for front end client.
     *
     * @return mixed
     */
    protected function loadItem()
    {
        return null;
    }

    /**
     * Saves one item (eg. when doing POST to /api/rest/products/1234)
     * The result returned by this method is supposed to be returned for front end client.
     *
     * @return null
     */
    protected function saveItem()
    {
        return null;
    }
}