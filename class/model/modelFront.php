<?php

require_once('builder/builderInterface.php');
define('SPREFIX','bingtranslator_');
define('BINGTRANSLATOR_SETTINGS' , SPREFIX . 'settings');

class modelFront extends modelFront
{
    protected function execGetSettings($aArgs)
    {
        $sSql = "SELECT * FROM " .  BINGTRANSLATOR_SETTINGS . " WHERE seq = {$aArgs['seq']}" ;
        return $this->query($sSql);
    }
}