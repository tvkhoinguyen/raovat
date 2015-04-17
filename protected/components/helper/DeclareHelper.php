<?php
class DeclareHelper
{
    public static $statusFormat = array(STATUS_ACTIVE =>'Shown', STATUS_INACTIVE=>'Hidden');
    public static $yesNoFormat = array(TYPE_YES => 'Yes', TYPE_NO =>'No');
    public static $tilesFormat = array('Mr'=>'Mr.', 'Mrs'=>'Mrs.', 'Ms'=>'Ms.', 'Madam'=>'Madam', 'Dr'=>'Dr.');
    public static $gendersFormat = array('MALE'=>'Male', 'FEMALE'=>'Female');
    public static $allModule = array(null => 'Front End',
        'admin' => 'Admin',
        'member' => 'Member',
        'product' => 'Product',
        'auditTrail' => 'Audit Trail');

    public function getAjaxAction()
    {
        return array();
    }

    public static function getTiles($hasEmpty = true)
    {
        if($hasEmpty)
            $data = array(''=>'', 'Mr'=>'Mr.', 'Mrs'=>'Mrs.', 'Ms'=>'Ms.', 'Madam'=>'Madam', 'Dr'=>'Dr.');
        else
            $data = self::$tilesFormat;
        return $data;
    }

    public static function getAlphabet()
    {
        $data = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        return $data;
    }
    
    public static function getUserStatus($hasEmpty = false)
    {
        if($hasEmpty) return
            array(''=>'', '1' =>'Active','0' => 'Inactive');
    	return self::$statusFormat;
    }

    public static function getYesNo($emptyOption=false)
    {
        if($emptyOption)
            return array(''=>'',
                '1' =>	'Yes',
                '0'=>	'No');
        else
            return self::$yesNoFormat;
    }

    public static function getUserZone()
    {
    	return array("North" => "North", "South" => "South", "East" => "East", "West" => "West");
    }

    public static function getGenders($hasEmpty = true)
    {
        if($hasEmpty)
            $data = array(''=>'', 'MALE'=>'Male', 'FEMALE'=>'Female');
        else
            $data = self::$gendersFormat;
        return $data;
    }

}