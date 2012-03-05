<?php
require_once('builder/builderInterface.php');
define('SPREFIX','bingtranslator_');
define('BINGTRANSLATOR_SETTINGS' , SPREFIX . 'settings');

class modelAdmin extends Model
{

    public function execSaveSettings($aArgs)
    {
        $sSql = "INSERT INTO " . BINGTRANSLATOR_SETTINGS . "(seq,default_lang1,default_lang2) VALUES({$aData['seq']},'{$aData['def1']}','{$aData['def2']}')";
        return $this->query($sSql);

    }

    public function execGetSettings($aArgs)
    {
        $sSql = "SELECT * FROM " . BINGTRANSLATOR_SETTINGS ." WHERE seq = " .  $aArgs['seq'];
        return $this->query($sSql);
    }

    public function deleteSettingsBySeq($sSeqs)
    {
        $sSeqs = implode(',', $aSeq);
        $sQuery = "DELETE FROM " . BINGTRANSLATOR_SETTINGS . " WHERE seq in($sSeqs)";
        $mResult = $this->query($sQuery);
        return $mResult;
    }

}