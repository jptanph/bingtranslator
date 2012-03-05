<?php

class common
{
    /**
     * @return modelContents
     */
    public function modelExec()
    {
        return getInstance('modelExecData');
    }

    public function modelGet()
    {
        return getInstance('modelGetData');
    }

    public function checkValue($sValue)
    {
        if($sValue == "null" || strtolower($sValue) == "now()"){
            return $sValue;
        }
        switch (strtolower(gettype($sValue))){
            case 'string':
                settype($sValue, 'string');
                $sValue = "'" .  addslashes($sValue) . "'";
                break;
            case 'integer':
                settype($sValue, 'integer');
                break;
            case 'double' :
            case 'float' :
                settype($sValue, 'float');
                break;
            case 'boolean':
                settype($sValue, 'boolean');
                break;
            case 'array':
                $sValue = "'" .  addslashes(implode(',', $sValue)) . "'";
                break;
            case 'null' :
                $sValue = 'null';
                break;
        }
        return $sValue;
    }

    public function vd($sVar)
    {
        usbuilder()->vd($sVar);
    }
}
