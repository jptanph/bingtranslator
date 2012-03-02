<?php
require_once('builder/builderInterface.php');
require_once('accessTokenAuthentication.php');
require_once('httpTranslator.php');
require_once('bingTranslatorClass.php');


class adminPageSettings extends Controller_Admin
{
    public function run($aArgs)
    {
        usbuilder()->init($this, $aArgs);
        $oBingTrans = new bingTranslatorClass();
//         $oBingTrans->init_tokens('johnsimplexi', 'h6JMhf32gavU7yc9QzhOzlsff3eDkey5jcwfRF0hcso=');
//         $aResult = $oBingTrans->execTranslate('Hello World','en','de');

//         $this->importJs(__CLASS__);
//         $this->view('adminPageSettings');

    }

}