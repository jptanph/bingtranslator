<?php
class modelGetData extends Model
{
    /**
     * Get data
     * @param String $sTable
     * @param Array $aData
     * @param String $sRow
     * @return Array
     */

    public function getData($sTable = "settings", $aData = array(), $sRow = "row")
    {
        $sSql = "SELECT * FROM " . APP_ID . "_" . $sTable;

        if (isset($aData['where']) && $aData['where'] != ""){
            $sWhere = " WHERE ";

            if (is_array($aData['where'])){
                foreach ($aData['where'] as $sField => $sValue)
                    $sWhere .= ($sWhere != " WHERE " ? " AND " : "") . $sField . " = " . common()->checkValue($sValue);

                $sSql .= $sWhere;
            }
            else $sSql .= $sWhere . $aData['where'];
        }

        if (isset($aData['order']) && $aData['order'] != "")
            $sSql .= " ORDER BY " . $aData['order'];

        if (isset($aData['limit']) && isset($aData['offset']) && (int) $aData['limit'] != 0 && (int) $aData['offset'] != 0)
            $sSql .= " LIMIT " . $aData['offset'] . ", " . $aData['limit'];

        else if (isset($aData['limit']) && $aData['limit'] != "")
            $sSql .= " LIMIT " . $aData['limit'];

        if (isset($aData['select']) && $aData['select'] != "")
            $sSql = str_replace("*", $aData['select'], $sSql);

        return $this->query($sSql, $sRow);
    }

    /**
     * Get row count
     * @param Integer $iSequence
     * @param String $sTable
     * @param String $sWhere
     * @return Interger
     */

    public function getTotalRows($iSequence, $sTable = "settings", $sWhere = null)
    {
        if ($sWhere == null)
            $sWhere = " WHERE seq = " . $iSequence;
        else
            $sWhere = " WHERE seq = " . $iSequence . " AND " . $sWhere;

        $aResult = $this->query("SELECT COUNT(*) as rows FROM " . APP_ID . "_" . $sTable . $sWhere, "row");

        return $aResult['rows'];
    }
}