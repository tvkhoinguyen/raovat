<?php

/**
 * @copyright (c) 2013, bb
 */
class ArrayHelper{
    
    /**
     * 
     * @param array $arrayChild
     * @param array $arrayParent
     * @return boolean
     * 
     * @copyright (c) 2013, bb 
     */
    public static function isArrayChildOfArray($arrayChild, $arrayParent)
    {
        foreach($arrayChild as $child)
        {
            if(!in_array($child, $arrayParent))
                return false;
        }
        return true;
    }
    
    /**     
     * @return array(1=>1, 2=>,...)
     * @copyright (c) 2013, bb
     */
    public static function getOrdersArray($iMax)
    {
        $aOrder = array();
        for($i=1;$i<$iMax;$i++)
            $aOrder[$i]=$i;
        return $aOrder;
    }
    
    /**
     * 
     * @param type $aEntry
     * @param type $iNumberOfArray
     * @return type
     * @copyright (c) 2013, bb
     */
    public static function divideArray($aEntry, $iNumberOfArray)
    {
        $iLengh = count($aEntry);
        $iItemsPerArray = $iLengh/$iNumberOfArray;
        $aResult = array();
        for($i = 0; $i < $iNumberOfArray; $i++)
        {
            $aResult[$i] = array_slice($aEntry, $i*$iItemsPerArray , ($i + 1) * $iItemsPerArray);
        }
        return $aResult;
    }
            
}
?>
