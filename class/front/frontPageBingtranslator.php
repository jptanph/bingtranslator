<?php
require_once('builder/builderInterface.php');

class frontPageBingtranslator extends Controller_Front
{
    protected function run($aArgs)
    {
        usbuilder()->init($this, $aArgs);
        $sPrefix = APP_ID . '_';
        $iSequence = $this->getSequence();
        $oCommonGet = common()->modelGet();
        $oCommonExec = common()->modelExec();

        $aSettings = $oCommonGet->getData('settings', array('where' => " seq = $iSequence"));

        $aLangCode = array(
                'ar' => 'Arabic',
                'bg' => 'Bulgarian',
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

        $sHtml = "";
        $sHtml .= "<select id='from'>";
        foreach($aLangCode as $key=>$val){
            $sHtml .= "<option value='$key' " . ( ($key==$aSettings['default_lang1']) ? "selected='selected'" : '') . ">$val</option>";
        }
        $sHtml .= "</select>";

        $sHtml .= "<select id='to'>";
        foreach($aLangCode as $key=>$val){
            $sHtml .= "<option value='$key' " . ( ($key==$aSettings['default_lang2']) ? "selected='selected'" : '') . ">$val</option>";
        }
        $sHtml .= "</select><input type='button' value='Translate' onclick='frontPageBingtranslator.translate()'/><br /><textarea id='str' style='resize:none;width:360px;height:90px;'></textarea><br /><textarea id='result' style='resize:none;width:360px;height:90px;'></textarea>";

        $this->importJs(__CLASS__);
        $this->importJs('bingtranslator');
        $this->importCss(__CLASS__);
        $this->assign('bingtranslator',$sHtml);
    }

}