<?php
require_once('builder/builderInterface.php');

class frontPageBingtranslator extends Controller_Front
{
    protected function run($aArgs)
    {
        usbuilder()->init($this, $aArgs);
        $sPrefix = APP_ID . '_';
        $sHtml = "";
        $iSequence = $this->getSequence();
        $oCommonGet = common()->modelGet();
        $oCommonExec = common()->modelExec();

        $aSettings = $oCommonGet->getData('settings', array('where' => " seq = $iSequence"));

        usbuilder()->vd($aSettings);

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
        $sHtml .= "<div class='bingmenu'>\n";
        $sHtml .= "		<a href='#' class='bingmenua' onclick='frontPageBingtranslator.open_dialog()'>\n";
        $sHtml .= "			<span>B</span>\n";
        $sHtml .= "			<span>I</span>\n";
        $sHtml .= "			<span>N</span>\n";
        $sHtml .= "			<span>G</span>\n";
        $sHtml .= "		</a>\n";
        $sHtml .= "	</div>\n";
        $sHtml .= "	<div id='bingtranslator' class='bingtranslator'>\n";
        $sHtml .= "		<div class='bingtranslate_top'>\n";
        $sHtml .= "			<a href='#' class='bingtranslate_close' onclick='frontPageBingtranslator.close_dialog()'>X</a>\n";
        $sHtml .= "		</div>\n";
        $sHtml .= "		<div class='bingtranslate_body'>\n";
        $sHtml .= "			<form action='#' method='post'>\n";
        $sHtml .= "				<div class='translate_inputs'>\n";
        $sHtml .= "				<select name='language_from' id='def_lang1'  class='bingtranslator_select'>\n";
                                    foreach($aLangCode as $key=>$val){
                                        $sHtml .= "<option value='$key' " . ( ($key==$aSettings['default_lang1']) ? "selected='selected'" : '') . ">$val</option>\n";
                                    }
        $sHtml .= "					</select>\n";
        $sHtml .= "					<select name='language_to' id='def_lang2'  class='bingtranslator_select'>\n";
                                    foreach($aLangCode as $key=>$val){
                                        $sHtml .= "<option value='$key' " . ( ($key==$aSettings['default_lang2']) ? "selected='selected'" : '') . ">$val</option>\n";
                                    }
        $sHtml .= "					</select>\n";
        $sHtml .= "				</div>\n";
        $sHtml .= "				<a href='#none' class='current_lang' onclick='frontPageBingtranslator.reverse()'><span>EN</span></a>\n";
        $sHtml .= "				<textarea rows='2' cols='30' name='original_text' id='original_text' class='bingtranslator_textarea'></textarea>\n";
        $sHtml .= "                <div class='bingtranslator_tarea_bar'></div>\n";
        $sHtml .= "				<input type='button' onclick='frontPageBingtranslator.translate()' value='Translate' name='translate' id='translate'/>\n";
        $sHtml .= "				<div id='translated_text' class='translation_div'></div>\n";
        $sHtml .= "				<div class='bingtranslator_options' title='Copy Text'><b><span class='bingtranslator_copy' id='bingtranslator_copy' ></span></b></div>\n";
        $sHtml .= "			</form>\n";
        $sHtml .= "		</div>\n";
        $sHtml .= "	</div>\n";

        $this->importJs('jquery.selectBox');
        $this->importJs('jquery.zclip.min');
        $this->importJs('jquery.highlight-3');
        $this->importCss('jquery.selectBox');
        $this->importJs('curvycorners.src');
        $this->importJs(__CLASS__);
        $this->importCss(__CLASS__);
        $this->assign('bingtranslator',$sHtml);
    }

}


























//         $sHtml = "";
//         $sHtml .= "<select id='from'>";
//         foreach($aLangCode as $key=>$val){
//             $sHtml .= "<option value='$key' " . ( ($key==$aSettings['default_lang1']) ? "selected='selected'" : '') . ">$val</option>";
//         }
//         $sHtml .= "</select>";

//         $sHtml .= "<select id='to'>";
//         foreach($aLangCode as $key=>$val){
//             $sHtml .= "<option value='$key' " . ( ($key==$aSettings['default_lang2']) ? "selected='selected'" : '') . ">$val</option>";
//         }
//         $sHtml .= "</select><input type='button' value='Translate' onclick='frontPageBingtranslator.translate()'/><br /><textarea id='str' style='resize:none;width:360px;height:90px;'></textarea><br /><textarea id='result' style='resize:none;width:360px;height:90px;'></textarea>";
