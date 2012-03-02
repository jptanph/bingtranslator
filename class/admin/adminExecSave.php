<?php
require_once('builder/builderInterface.php');
class adminExecSave extends Controller_AdminExec
{
    protected function run($aArgs)
    {
        usbuilder()->init($this, $aArgs);
        $oCommonGet = common()->modelGet();
        $oCommonExec = common()->modelExec();
        $sUrlSettings = usbuilder()->getUrl('adminPageSettings');

        $iTotal = $oCommonGet->getTotalRows($aArgs['seq']);

        $aData = array(
            'default_lang1' => $aArgs['def1'],
            'default_lang2'  => $aArgs['def2']
        );

        if( $iTotal > 0 )
        {
            $bResult = $oCommonExec->update('settings', $aData , " seq = {$aArgs['seq']}");
        }
        else
        {
            $aData['seq'] = $aArgs['seq'];
            $bResult = $oCommonExec->insert('settings',$aData);
        }

        if($bResult===false)
        {
            usbuilder()->message('Saved failed!', 'warning');
        }
        else
        {
            usbuilder()->message('Saved succesfully!', 'success');
        }

        usbuilder()->jsMove($sUrlSettings);
    }
}