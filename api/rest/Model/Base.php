<?php
abstract class Admin2_Model_Base
{
    const sCoreClassName = 'oxBase';

    protected $_oCoreObject;

    protected $_blIsMultiLangObject = false;

    public function __construct()
    {
        #initiate coreObject
        $this->setCoreObject($this->getCoreClassName());
    }

    /**
     * @param     $sOxid
     * @param int $iLang
     */
    public function load($sOxid, $iLang = 0)
    {
        $oCoreObject = $this->getCoreObject();

        if ($this->getIsMultiLangObject()) {
            $oCoreObject->loadInLang($iLang, $sOxid);
        } else {
            $oCoreObject->load($sOxid);
        }
    }

    public function getFieldData($sFieldName)
    {

    }

    public function getLanguage()
    {

    }

    public function getId()
    {

    }

    public function getShopId()
    {

    }

    /**
     * @param int $iLang
     */
    public function setLanguage($iLang = 0)
    {
        $oCoreObject = $this->getCoreObject();
        if ($this->getIsMultiLangObject()) {
            $oCoreObject->setLanguage($iLang);
        }

    }

    public function assign($aParams)
    {

    }

    public function delete($sOxid)
    {

    }

    public function save()
    {

    }

    /**
     * returns coreObject
     * @return null|object
     */
    public function getCoreObject()
    {
        if ($this->_oCoreObject instanceof oxBase) {
            return $this->_oCoreObject;
        } else {
            return null;
        } // throw Exception?
    }

    /**
     * set coreObject
     *
     * @param $sCoreName
     */
    public function setCoreObject($sCoreName)
    {
        $oCoreObject = oxNew($sCoreName);

        $this->setIsMultiLangObject($oCoreObject instanceof oxI18n);

        if ($oCoreObject instanceof oxBase) {
            $this->_oCoreObject = $oCoreObject;
        } else {
            // throw Exception?
        }
    }

    /**
     * @return string
     */
    public function getCoreClassName()
    {
        return $this::sCoreClassName;
    }

    /**
     * @param $blIsMultiLangObject
     */
    public function setIsMultiLangObject($blIsMultiLangObject)
    {
        $this->_blIsMultiLangObject = (bool) $blIsMultiLangObject;
    }

    /**
     * @return bool
     */
    public function getIsMultiLangObject()
    {
        return $this->_blIsMultiLangObject;
    }

}
