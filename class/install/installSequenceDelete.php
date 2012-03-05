<?php
class installSequenceDelete
{
    public function run($aArgs)
    {
        $bResult = common()->modelAdmin()->deleteSettingsBySeq($aArgs['seq']);

        if ($bResult !== false) {
            return true;
        } else {
            return false;
        }
    }
}