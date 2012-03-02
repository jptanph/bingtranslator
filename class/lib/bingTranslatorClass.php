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

    public function getTranslation($sText,$sLangFrom,$sLangTo)
    {
        $sParams = "text=" . urlencode($sText) . "&to=" . $sLangTo . "&from=" . $sLangFrom;

        $sTranslateUrl = "http://api.microsofttranslator.com/v2/Http.svc/Translate?$sParams";

        $sCurlResponse = $this->_curlRequest($sTranslateUrl);

        return $this->_xml_load_str($sCurlResponse);
    }

    public function getLanguages($aLangCode)
    {
        $sLocale = 'en';
        $sTranslateUrl = "http://api.microsofttranslator.com/V2/Http.svc/GetLanguageNames?locale=$sLocale";

        $sRequestXml = $this->_createXML($aLangCode);

        $sCurlResponse = $this->_curlRequest($sTranslateUrl, $sRequestXml);

        return $this->_xml_load_str($sCurlResponse);
    }

    private function _curlRequest($sTranslateUrl, $sPostData = '')
    {
        return $this->_oTranslatorObj->curlRequest($sTranslateUrl, $this->_sToken,$sPostData);
    }

    private function _createXML($var)
    {
        return $this->_oTranslatorObj->createReqXML($var);
    }

    private function _xml_load_str($sCurlResponse)
    {
        $oXml = simplexml_load_string($sCurlResponse);

        $aJe = json_encode($oXml);
        return json_decode($aJe,TRUE);

    }
}
