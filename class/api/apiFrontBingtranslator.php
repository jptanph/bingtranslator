<?php
require_once('builder/builderInterface.php');
require_once('accessTokenAuthentication.php');
require_once('httpTranslator.php');
require_once('bingTranslatorClass.php');

class apiFrontBingtranslator extends Controller_Api
{
    protected function post($aArgs)
    {
        usbuilder()->init($this, $aArgs);
        $aData = array();
        $oBingTrans = new bingTranslatorClass();
        $oBingTrans->init_tokens('johnsimplexi', 'h6JMhf32gavU7yc9QzhOzlsff3eDkey5jcwfRF0hcso=');
        $sLang = $oBingTrans->getDetectTextLanguage($aArgs['text1']);
        $aResult = $oBingTrans->getTranslation($aArgs['text1'],$sLang[0],$aArgs['lang2']);

        $aData['lang'] = $sLang;
        $aData['translation'] = $aResult;
        return $aData;
    }
}