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
         $oBingTrans->init_tokens('johnsimplexi', 'h6JMhf32gavU7yc9QzhOzlsff3eDkey5jcwfRF0hcso=');
        // $aResult = $oBingTrans->getTranslation('The world is full of sorrow','en','de');

         $aLangCode = array(
                 'ar',
                 'bg',
                 'zh-CHS',
                 'zh-CHT',
                 'cs',
                 'da',
                 'nl',
                 'en',
                 'et',
                 'fi',
                 'fr',
                 'de',
                 'el',
                 'ht',
                 'he',
                 'hi',
                 'hu',
                 'id',
                 'it',
                 'ja',
                 'ko',
                 'lv',
                 'lt',
                 'no',
                 'pl',
                 'pt',
                 'ro',
                 'ru',
                 'sk',
                 'sl',
                 'es',
                 'sv',
                 'th',
                 'tr',
                 'uk',
                 'vi'
         );
         $aLang = $oBingTrans->getLanguages($aLangCode);
         usbuilder()->vd(json_encode($aLang));

//         $this->importJs(__CLASS__);
//         $this->view('adminPageSettings');

    }

}