<?php
class adm2rest_api extends oxAdminDetails
{
    /**
     * Executes parent method parent::render(), creates oxuser object and
     * returns name of template file "user_extend.tpl".
     *
     * @return string
     */
    public function render()
    {
        parent::render();
        
        $soxId = $this->getEditObjectId();
        if ( $soxId != "-1" && isset( $soxId ) ) {
            // load object
            $oUser = oxNew( "oxuser" );
            $oUser->load( $soxId );
            
            if($sAd2mRestOXID = $this->_checkApiUser($soxId))
            {
                $oAdm2Rest = oxNew( "oxbase" );
                $oAdm2Rest->init( "adm2rest_api" );
                $oAdm2Rest->load( $sAd2mRestOXID );
                $newOXID = $oAdm2Rest->getID();
            }
            else
            {
                $oAdm2Rest = oxNew( "oxbase" );
                $oAdm2Rest->init( "adm2rest_api" );
                $oAdm2Rest->adm2rest_api__oxuserid = new oxField( $soxId );
                $oAdm2Rest->adm2rest_api__oxupdate = new oxField( time() );
                $oAdm2Rest->save();
                $newOXID = $soxId;
            }

            
            //show country in active language
            $oCountry = oxNew( "oxCountry" );
            $oCountry->loadInLang( oxLang::getInstance()->getObjectTplLanguage(), $oUser->oxuser__oxcountryid->value );
            $oUser->oxuser__oxcountry = new oxField( $oCountry->oxcountry__oxtitle->value);

            $this->_aViewData["oxidAPI"] =  $newOXID;
            $this->_aViewData["edit"] =  $oAdm2Rest;
        }

        if ( !$this->_allowAdminEdit( $soxId ) ) {
            $this->_aViewData['readonly'] = true;
        }

        return "adm2rest_api.tpl";
    }
    
    /**
     * Generates api-key for user and save into db
     *
     * @return mixed
     */
    public function getApiKey()
    {
        $soxId = $this->getEditObjectId();
        $redirect_uri = $this->getConfig()->getShopUrl(null, true).'admin/index.php?stoken='.$this->getSession()->getSessionChallengeToken().'&cl=adm2rest_api&oxid='.$soxId.'&fnc=getApiKey';
        $sApiKey = oxConfig::getParameter( "code" );

        if(empty($sApiKey))
        {
            $oAdm2pAuth = new adm2oauth();
            $oAdm2pAuth->createNewAuthCode($soxId, $redirect_uri);
        }
        else
        {
            $sAd2mRestOxid = $this->_checkApiUser($soxId);
            $oAdm2Rest = oxNew( "oxbase" );
            $oAdm2Rest->init( "adm2rest_api" );
            $oAdm2Rest->load( $sAd2mRestOxid );
            $aParams['adm2rest_api__oxapiaccesskey'] = $sApiKey;
            $aParams['adm2rest_api__oxupdate'] = time();
            $oAdm2Rest->assign( $aParams );
            $oAdm2Rest->save();
        }
    }

    /**
     * Saves api information.
     *
     * @return mixed
     */
    public function save()
    {

        $soxId = $this->getEditObjectId();
        
        if ( !$this->_allowAdminEdit( $soxId ) )
            return false;

        $aParams       = oxConfig::getParameter( "editval" );
        $soxIdAPI      = oxConfig::getParameter( "oxidAPI" );

        if (!empty($soxIdAPI) &&  $soxIdAPI != "-1" )
        {
            $oAdm2Rest = oxNew( "oxbase" );
            $oAdm2Rest->init( "adm2rest_api" );
            $oAdm2Rest->load( $soxIdAPI );
            $aParams['adm2rest_api__oxupdate'] = time();
            $oAdm2Rest->assign( $aParams );
            $oAdm2Rest->save();
        }

    }
    
    /**
     * Checks if the user column already exists
     *
     * @param   string      oxuserid
     * @return  string
     */    
    protected function _checkApiUser($soxId) {
        return oxDb::getDb()->getOne("SELECT oxid FROM adm2rest_api WHERE oxuserid = ".oxDb::getDb()->quote( $soxId ));
    }
    
    
    
}
