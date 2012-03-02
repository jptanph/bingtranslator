<?php


class bingTranslatorClass
{
    private $_oAuthObj;
    private $_oTranslatorObj;
    private $_sToken;

    public function __construct()
    {
        $this->_authObj =  new AccessTokenAuthentication();
        $this->_oTranslatorObj = new httpTranslator();

    }

    public function init_tokens($clientID, $clientSecret)
    {
        $authUrl      = "https://datamarket.accesscontrol.windows.net/v2/OAuth2-13/";
        $scopeUrl     = "http://api.microsofttranslator.com";
        $grantType    = "client_credentials";

        $sAccessToken =  $this->_authObj->getTokens($grantType, $scopeUrl, $clientID, $clientSecret, $authUrl);
        $this->_sToken = "Authorization: Bearer ".  $sAccessToken;
    }

    public function execTranslate($sText,$sLangFrom,$sLangTo)
    {
        $sParams = "text=" . urlencode($sText) . "&to=" . $sLangTo . "&from=" . $sLangFrom;

        $sTranslateUrl = "http://api.microsofttranslator.com/v2/Http.svc/Translate?$sParams";

        $sCurlResponse = $this->_oTranslatorObj->curlRequest($sTranslateUrl, $this->_sToken);

        return simplexml_load_string($sCurlResponse);
    }
}
