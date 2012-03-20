<?php
abstract class Admin2_Model_Abstract
{

    private $_oDb = null;
    protected $_aTableNames = array('table'         => 'table', #root table of object
                                    'extendedTable' => 'keyToTable' # 1:n relation example: oxartextends -> oxid
    );

    public function __set($sFieldName, $sValue)
    {
        if (stripos($sFieldName, "__") === false) {
            $sFieldName = key($this->_getTableNames()) . '__' . $sFieldName;
        }
        $this->$sFieldName = $sValue;
    }

    public function __get($sFieldName)
    {
        if (stripos($sFieldName, "__") === false) {
            foreach ($this->_getTableNames() as $sTableName => $sKey)
            {
                $sFieldName = $sTableName . '__' . $sFieldName;
                if ($this->$sFieldName !== null) {
                    return $this->$sFieldName;
                }
            }
        }

        if ($this->$sFieldName !== null) {
            return $this->$sFieldName;
        }

        return null;

    }

    protected function _getTableNames()
    {
        return $this->_aTableNames;
    }

    protected function getConnection($blAssoc = true)
    {
        if ($this->_oDb === null) {
            $this->_oDb = oxDb::getDb($blAssoc);
        }

        return $this->_oDb;
    }

    protected function _loadField($sFieldName)
    {

    }

    protected function _loadFields($aFieldNames)
    {

    }

}
