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
        $oBingTrans = new bingTranslatorClass();
        $oBingTrans->init_tokens('johnsimplexi', 'h6JMhf32gavU7yc9QzhOzlsff3eDkey5jcwfRF0hcso=');
        $aResult = $oBingTrans->getTranslation($aArgs['text1'],$aArgs['lang1'],$aArgs['lang2']);
        return $aResult;
    }
}