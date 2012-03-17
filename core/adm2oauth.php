<?php
require("../api/rest/lib/oAuth2/OAuth2.inc");

class adm2oauth extends OAuth2
{
  /**
   * Make sure that the client credentials is valid.
   *
   * @param $clientId
   *   Client identifier to be check with.
   * @param $clientSecret
   *   (optional) If a secret is required, check that they've given the right one.
   *
   * @return
   *   TRUE if client credentials are valid, and MUST return FALSE if invalid.
   *
   * @see http://tools.ietf.org/html/draft-ietf-oauth-v2-10#section-2.1
   *
   * @ingroup oauth2_section_2
   */
    protected function checkClientCredentials($clientId, $clientSecret = NULL)
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
   * @param $clientId
   *   Client identifier to be check with.
   *
   * @return
   *   Registered redirect URI of corresponding client identifier, and MUST
   *   return FALSE if the given client does not exist or is invalid.
   *
   * @ingroup oauth2_section_3
   */
    protected function getRedirectUri($clientId)
    {
        return null;
    }

  /**
   * Look up the supplied oauth_token from storage.
   *
   * We need to retrieve access token data as we create and verify tokens.
   *
   * @param $oauthToken
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
    protected function getAccessToken($oauthToken)
    {

    }

  /**
   * Store the supplied access token values to storage.
   *
   * We need to store access token data as we create and verify tokens.
   *
   * @param $oauthToken
   *   oauth_token to be stored.
   * @param $clientId
   *   Client identifier to be stored.
   * @param $expires
   *   Expiration to be stored.
   * @param $scope
   *   (optional) Scopes to be stored in space-separated string.
   *
   * @ingroup oauth2_section_4
   */
    protected function setAccessToken($oauthToken, $clientId, $expires, $scope = NULL)
    {

    }

  /**
   * Creates an authcode
   *
   * @param $clientId
   *   Client identifier (oxuserid)
   * @param $redirectUri
   *   Redirect URI
   */
    public function createNewAuthCode($clientId, $redirectUri)
    {
        $aParams["response_type"] = 'code';
        $aParams["client_id"] = $clientId;
        $aParams["redirect_uri"] = $redirectUri;
        $this->finishClientAuthorization(true, $aParams);
    }



}