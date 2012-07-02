<?php
#require("../api/rest/lib/oAuth2/OAuth2.inc");

class adm2oauth extends OAuth2
{
  /**
   * Make sure that the client credentials is valid.
   *
   * @param $client_id
   *   Client identifier to be check with.
   * @param $client_secret
   *   (optional) If a secret is required, check that they've given the right one.
   *
   * @return
   *   TRUE if client credentials are valid, and MUST return FALSE if invalid.
   *
   * @see http://tools.ietf.org/html/draft-ietf-oauth-v2-10#section-2.1
   *
   * @ingroup oauth2_section_2
   */
    protected function checkClientCredentials($client_id, $client_secret = NULL)
    {
        // user already authenticated
        return true;
    }
    
  /**
   * Get the registered redirect URI of corresponding client_id.
   *
   * OAuth says we should store request URIs for each registered client.
   * Implement this function to grab the stored URI for a given client id.
   *
   * @param $client_id
   *   Client identifier to be check with.
   *
   * @return
   *   Registered redirect URI of corresponding client identifier, and MUST
   *   return FALSE if the given client does not exist or is invalid.
   *
   * @ingroup oauth2_section_3
   */
    protected function getRedirectUri($client_id)
    {
        return 'http://a20.oxid.tabsl.eu/api/rest/v1/Products/';
    }
    
  /**
   * Look up the supplied oauth_token from storage.
   *
   * We need to retrieve access token data as we create and verify tokens.
   *
   * @param $oauth_token
   *   oauth_token to be check with.
   *
   * @return
   *   An associative array as below, and return NULL if the supplied oauth_token
   *   is invalid:
   *   - client_id: Stored client identifier.
   *   - expires: Stored expiration in unix timestamp.
   *   - scope: (optional) Stored scope values in space-separated string.
   *
   * @ingroup oauth2_section_5
   */
    protected function getAccessToken($oauth_token)
    {
        $iExpireTime = $this->getTokenExpireTime($oauth_token);
        return array('expires' => $iExpireTime);
    }
    
  /**
   * Store the supplied access token values to storage.
   *
   * We need to store access token data as we create and verify tokens.
   *
   * @param $oauth_token
   *   oauth_token to be stored.
   * @param $client_id
   *   Client identifier to be stored.
   * @param $expires
   *   Expiration to be stored.
   * @param $scope
   *   (optional) Scopes to be stored in space-separated string.
   *
   * @ingroup oauth2_section_4
   */
    protected function setAccessToken($oauth_token, $client_id, $expires, $scope = NULL)
    {
        $oAdm2Rest = oxNew( "oxbase" );
        $oAdm2Rest->init( "adm2rest_access" );
        $oAdm2Rest->adm2rest_access__oxapiaccesskey = new oxField( $client_id );
        $oAdm2Rest->adm2rest_access__oxaccesstoken = new oxField( $oauth_token );
        $oAdm2Rest->adm2rest_access__oxtimetoexpire = new oxField( $expires );
        $oAdm2Rest->adm2rest_access__oxupdate = new oxField( time() );
        $oAdm2Rest->save();
        return $oAdm2Rest->getID();
    }

  protected function getSupportedGrantTypes() {
    return array(
      OAUTH2_GRANT_TYPE_AUTH_CODE,
    );
  }   
    
    
  /**
   * Creates an authcode
   *
   * @param $client_id
   *   Client identifier (oxuserid)
   * @param $redirect_uri
   *   Redirect URI
   */
    public function createNewAuthCode($client_id, $redirect_uri)
    {
        $aParams["response_type"] = 'code';
        $aParams["client_id"] = $client_id;
        $aParams["redirect_uri"] = $redirect_uri;
        $this->finishClientAuthorization(true, $aParams);
    }
    
    
    /*
	tabsl
     	url welche aufgerufen werden muss
	http://a20.oxid.tabsl.eu/api/rest/v1/Products?auth=login&client_id=9826aff0657076aa1774396a865e8d64&response_type=token&redirect_uri=http://a20.oxid.tabsl.eu/api/rest/v1/Products/?auth=check
     */
    public function checkApiLogin($oauth_code)
    {
        $sAction = oxConfig::getParameter( "auth" );
        
        if($sAction == "login")
        {
            $sApiKey = oxConfig::getParameter( "client_id" );
            if($sUserID = $this->checkUserApiAccess($sApiKey))
            {
                $aAuthData["a20auth_apikey"] = $sApiKey;
                $aAuthData["a20auth_userid"] = $sUserID;
                oxSession::setVar("a20auth", $aAuthData);
                $aParams = $this->getAuthorizeParams();
                $this->finishClientAuthorization(true, $aParams);
            }
        }
        elseif($sAction == "check")
        {
            $aAuthData = oxSession::getVar("a20auth");
            $sToken = $this->checkValidUserToken($aAuthData["a20auth_apikey"]);
            $aAuthData["a20auth_token"] = $sToken;
            oxSession::setVar("a20auth", $aAuthData);
            $sURL = "http://a20.oxid.tabsl.eu/api/rest/v1/Products/?auth=verify&oauth_token=".$sToken;
            oxUtils::getInstance()->redirect($sURL, false, 302);
            
        }
        elseif($sAction == "verify")
        {
            $this->verifyAccessToken();
        }
        else
        {
            header("HTTP/1.1 403 Forbidden");
            echo "HTTP/1.1 403 Forbidden";
            exit;
        }
    }
    
    protected function checkUserApiAccess($soxId) {
        return oxDb::getDb()->getOne("SELECT oxuserid FROM adm2rest_api WHERE oxapiaccess = 1 AND oxapiaccesskey = ".oxDb::getDb()->quote( $soxId ));
    }    

    protected function checkValidUserToken($soxId) {
        return oxDb::getDb()->getOne("SELECT oxaccesstoken FROM adm2rest_access WHERE FROM_UNIXTIME(oxtimetoexpire) >= NOW() AND oxapiaccesskey = ".oxDb::getDb()->quote( $soxId ));
    }  
    
    protected function getTokenExpireTime($soxId) {
        return oxDb::getDb()->getOne("SELECT oxtimetoexpire FROM adm2rest_access WHERE oxaccesstoken = ".oxDb::getDb()->quote( $soxId ));
    }  


}