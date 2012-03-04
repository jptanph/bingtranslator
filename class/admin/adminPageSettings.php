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
        $sPrefix = APP_ID . '_';
        usbuilder()->getFormAction($sPrefix . 'settings_form','adminExecSave');

        $oCommonGet = common()->modelGet();
        $oCommonExec = common()->modelExec();

        $aSettings = $oCommonGet->getData('settings', array('where' => " seq = {$aArgs['seq']}"));

         $aLangCode = array(
             'ar'=>'Arabic',
             'bg'=>'Bulgarian',
             'zh-CHS'=>'Chinese (Simplified)',
             'zh-CHT'=>'Chinese (Traditional)',
             'cs' => 'Czech',
             'da' => 'Danish',
             'nl' => 'Dutch',
             'en' => 'English',
             'et' => 'Estonian',
             'fi' => 'Finnish',
             'fr' => 'French',
             'de' => 'German',
             'el' => 'Greek',
             'ht' => 'Haitian Creole',
             'he' => 'Hebrew',
             'hi' => 'Hindi',
             'hu' => 'Hungarian',
             'id' => 'Indonesian',
             'it' => 'Italian',
             'ja' => 'Japanese',
             'ko' => 'Korean',
             'lv' => 'Latvian',
             'lt' => 'Lithuanian',
             'no' => 'Norwegian',
             'pl' => 'Polish',
             'pt' => 'Portuguese',
             'ro' => 'Romanian',
             'ru' => 'Russian',
             'sk' => 'Slovak',
             'sl' => 'Slovenian',
             'es' => 'Spanish',
             'sv' => 'Swedish',
             'th' => 'Thai',
             'tr' => 'Turkish',
             'uk' => 'Ukrainian',
             'vi' => 'Vietnamese'
         );

        $this->importJs(__CLASS__);
        $this->assign('sDef1',($aSettings['default_lang1']) ? $aSettings['default_lang1'] : '');
        $this->assign('sDef2',($aSettings['default_lang2']) ? $aSettings['default_lang2'] : '');
        $this->assign('aLangCode',$aLangCode);
        $this->assign('iSeq',$aArgs['seq']);
        $this->assign('sPrefix',$sPrefix);
        $this->view('adminPageSettings');
    }
}