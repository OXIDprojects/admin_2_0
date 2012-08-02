<?php
class admin2rest extends oxAdminDetails
{
    protected $_sThisTemplate = 'admin2/admin2rest.tpl';

    public function render()
    {
        $db = oxDb::getDb(true);
        $result = $db->query(
            'SELECT `apiKey`, `apiSecret` FROM `oxuser` WHERE `OXID` = ?',
            array(oxConfig::getParameter('oxid'))
        );
        $user = $result->FetchRow();
        $this->_aViewData['edit'] = $user;
        return parent::render();
    }

    public function save()
    {
        $admin2 = oxConfig::getParameter('admin2');
        $db = oxDb::getDb(true);
        $db->query(
            'UPDATE `oxuser` SET `apiKey` = ?, `apiSecret` = ? WHERE `OXID` = ?',
            array(
                $admin2['apiKey'],
                $admin2['apiSecret'],
                oxConfig::getParameter('oxid'),
            )
        );
    }
}
