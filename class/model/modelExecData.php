<?php

class modelExecData extends Model
{
    /**
     * Execute custom query
     * @param String $sTable
     * @param String $sRow
     * @return Boolean, String, Array, Integer
     */

    public function execQuery($sQuery, $sRow = "row")
    {
        return $this->query($sQuery, $sRow);
    }

    /**
     * Delete data
     * @param String $sTable
     * @param String $sWhere
     * @return Boolean
     */

    public function delete($sTable, $sWhere)
    {
        $sSql = "DELETE FROM " . APP_ID . "_" . $sTable . " WHERE " . $sWhere;
        return $this->query($sSql);
    }

    /**
     * Upadate data
     * @param String $sTable
     * @param Array $aData
     * @param String $sWhere
     * @return Boolean
     */

    public function update($sTable, $aData, $sWhere = "")
    {
        $sSql = $this->getUpdateQuery($sTable, $aData, $sWhere);

        if($sSql !== false) {
            return $this->query($sSql);
        } else return false;
    }

    /**
     * Insert data
     * @param String $sTable
     * @param Array $aData
     * @return Boolean
     */

    public function insert($sTable, $aData)
    {
        $sSql = $this->getInsertQuery($sTable, array($aData));

        if($sSql !== false) {
            return $this->query($sSql);
        } else return false;
    }

    private static function getInsertQuery($sTable, $aData)
    {
        if(!count($aData)) return false;

        $i = 0;
        $aInsert = array();
        $aField = array();
        foreach($aData as $sKey => $aValue) {

            $aInsertData = array();
            foreach($aValue as $sField => $sValue)
            {
                if($i == 0) $aField[] = $sField;
                $aInsertData[] = common()->checkValue($sValue);
            }
            $aInsert[] = '(' . implode(',', $aInsertData) . ')';
            $i++;
        }
        return "INSERT INTO " . APP_ID . "_" . $sTable . " (" . implode(',', $aField) . ") VALUES " . implode(',', $aInsert);
    }

    private static function getUpdateQuery($sTable, $aData, $sWhere = "")
    {
        $sString = "";
        if(!count($aData)) return;

        foreach($aData as $sField => $sValue)
        {
            $sString .= $sField . " = " . common()->checkValue($sValue) . ",";
        }
        return "UPDATE " . APP_ID . "_" . $sTable . " SET " . substr($sString, 0, -1) . " " . ($sWhere ? " WHERE " . $sWhere : "");
    }

    public function deleteContentsBySeq($iSequence, $aTable)
    {
        $sSeqs = implode(',', $iSequence);

        if (is_array($aTable)){
            foreach ($aTable as $sTable)
                $mResult = $this->delete($sTable, "seq IN (" . $sSeqs . ")");
        }
        else $mResult = $this->delete($aTable, "seq IN (" . $sSeqs . ")");

        return $mResult;
    }
}