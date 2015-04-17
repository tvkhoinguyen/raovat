<?php
/**
 * 
 * @todo Class for handle string
 * @author bb
 */

class DateHelper
{
    
    public static function getDayOfWeekArray()
    {
        return array('Mon'=>'Mon',
                    'Tue'=>'Tue',
                    'Wed'=>'Wed',
                    'Thu'=>'Thu',
                    'Fri'=>'Fri',
                    'Sat'=>'Sat',
                    'Sun'=>'Sun',
            );
    }

    public static function getMonth(){
        $data = array('1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December');
        return $data;
    }
    
    public static function getDayOfMonthArray()
    {
        $aResult = array();
        for($i = 1; $i<=31; $i++){
            $aResult[$i] = $i;
        }
        return $aResult;
    }

    public static function getHours()
    {
        $data = array();
        for ($i = 7; i <= 17; $i ++)
        {
            $hourText = $i;
            if ($i < 10)
                $hourText = '0' . $i;
            $data[] = array($i => $hourText);
        }
        return $data;
    }

    public static function getYear(){
        $cur_year = date('Y');
        for($i=$cur_year;$i<$cur_year+4;$i++){
            $data[$i]= $i;
        }
        return $data;
    }

    public static function getBirthYear(){
        $cur_year = date('Y');
        for($i=$cur_year;$i>$cur_year-43;$i--){
            $data[$i]= $i;
        }
        return $data;
    }

    public static function getHour(){
        for($i=7;$i<=17;$i++){
            if($i<10){
                $data[$i]= '0'.$i;
            }else $data[$i]= $i;
        }
        return $data;
    }

    public static function getMinute(){
        for($i=5;$i<=55;$i+=5){
            if($i<10){
                $data[$i]= '0'.$i;
            }else $data[$i]= $i;
        }
        return $data;
    }
    
    
    /**
     * 
     * @param type $string
     * @return dd/mm/Y -> Y-m-d
     * @author bb
     */
    public static function toDbDateFormat($string)
    {        
        $aDate = explode('/', $string);
        if(count($aDate) == 3)
            return $aDate[2].'-'.$aDate[1].'-'.$aDate[0];
        else return NULL;
    }

    /**
     * 
     * @param type $string
     * @return dd-mm-Y -> Y-m-d
     * @author bb
     */
    public static function toDbDateFormat_Ymd($string)
    {        
        $aDate = explode('-', $string);
        if(count($aDate) == 3)
            return $aDate[2].'-'.$aDate[1].'-'.$aDate[0];
        else return NULL;
    }
        
    /**
     * 
     * @param type $string
     * @return dd/mm/Y H:i -> Y-m-d H:i:s
     * @author bb
     */
    public static function toDbDateTimeFormat($string)
    {     
        $aString = explode(' ', $string);

        $aDate = explode('/', $aString[0]);
            $sDate = $aDate[2].'-'.$aDate[1].'-'.$aDate[0];
        return $sDate.' '. $aString[1].':00';
        
    }
    /**
     * 
     * @param type $string
     * @return Y-m-d H:i:s -> d/m/Y
     * @author Jason
     */
    public static function toDateFormat($string)
    {     
        $aString = explode(' ', $string);
        $aDate = explode('-', $aString[0]);
            $sDate = $aDate[2].'/'.$aDate[1].'/'.$aDate[0];
        return $sDate;
        
    }

    /**
     * 
     * @param type $string
     * @return Y-m-d H:i:s -> dd/mm/Y H:i
     * @author bb
     */
    public static function toDateTimePickerFormat($string)
    {     
        $aString = explode(' ', $string);
        $aDate = explode('-', $aString[0]);
            $sDate = $aDate[2].'/'.$aDate[1].'/'.$aDate[0];
            
        $aTime = explode(':', $aString[1]);
        $sTime = $aTime[0].':'. $aTime[1];
        return $sDate.' '. $sTime;
        
    }
    /**
     * 
     * @param type $string
     * @return Y-m-d H:i:s -> Y-m-d
     * @author Jason
     */
    public static function toDatePickerFormat($string)
    {     
        $aString = explode(' ', $string);
        return $aString[0];
    }
   
    /**
     * 
     * @param type $timestamp1
     * @param type $timestamp2
     * @param type $operator: ==, <=, >=, ..
     * @return int
     * @author bb
     */
    public static function compareDate($timestamp1, $timestamp2, $operator = '==')
    {   
        if(version_compare(strtotime(date('Y-m-d',$timestamp1)) -  strtotime(date('Y-m-d',$timestamp2)), 0,$operator))
            return 1;
        return 0;
    }
   
    /**
     * 
     * @param type $timestamp1: start date
     * @param type $timestamp2: end date
     * @param type $aDayOfWeek: array of Sun, Sat...
     * @return array "Y-m-d"
     * @author bb
     */
    public static function getDateByDayOfWeekInDateSpan($timestamp1, $timestamp2, $aDayOfWeek)
    {   
        $result = array();
        $resultFirstWeek = array();
        
        //find date in first weeek
        for($i = 0; $i<7; $i++)
        {
            
            $currentLoopDate = date ( 'Y-m-d', strtotime("+$i days",$timestamp1));
            $currentLoopDayOfWeek = date('D',  strtotime($currentLoopDate));
            
            if(strtotime(date('Y-m-d',  $timestamp2)) - strtotime($currentLoopDate) < 0)
                return $resultFirstWeek;
            
            if(in_array($currentLoopDayOfWeek, $aDayOfWeek))
            {
               $resultFirstWeek[] = $currentLoopDate;
            }
        }
        
        //find date in date span
        foreach($resultFirstWeek as $itemFirstWeek)//each Sun, Mon.. format(Y-m-d)
        {
            $i = 0;
            while (1)
            {
                
                $currentLoopDate = date ( 'Y-m-d', strtotime("+$i week",  strtotime($itemFirstWeek)));
                if(strtotime($currentLoopDate) - strtotime(date('Y-m-d',$timestamp2)) <= 0)
                {
                   $result[] = $currentLoopDate; 
                   $i ++;
                }else
                {                    
                    break;
                    $i = 0;
                }
            }
        }
        return $result;        
    }
    
    /**
     * 
     * @param type $timestamp1: start date
     * @param type $timestamp2: end date
     * @param type $aDayOfMonth: array of 1,2,31...
     * @return array "Y-m-d"
     * @author bb
     */
    public static function getDateByDayOfMonthInDateSpan($timestamp1, $timestamp2, $aDayOfMonth)
    {   
        $result = array();
        $iMonthSpan = self::getTimeSpan($timestamp1, $timestamp2, 'month');
        
        for($i = 0; $i <= $iMonthSpan; $i ++)
        {            
            foreach($aDayOfMonth as $dayOfMonth)
            {
                if(strlen($dayOfMonth) == 1)
                    $dayOfMonth = '0'.$dayOfMonth;
                                
                $startDateOfMonth  = date('Y-m', $timestamp1).'-01';                
                $currentLoopStartDate = date ( 'Y-m-d', strtotime("+$i month",  strtotime($startDateOfMonth)));                
                
                if(checkdate(date('m',  strtotime($currentLoopStartDate)), $dayOfMonth, date('Y',  strtotime($currentLoopStartDate)))) 
                {
                    $resultDate = date('Y',  strtotime($currentLoopStartDate)).'-'.date('m',  strtotime($currentLoopStartDate)).'-'.$dayOfMonth; 
                    if(strtotime($resultDate) - $timestamp1 >= 0)
                        $result[] = $resultDate;               
                }
            }
        }
        return $result;        
    }
    /**
     * 
     * @param timestamp $timestampStart
     * @param timestamp $timestampEnd
     * @param text $type: year, month, week, day...
     * @return int
     * @author bb
     */
    
    public static function getTimeSpan($timestampStart, $timestampEnd, $type = 'day')
    {
        $time = $timestampEnd - $timestampStart;
        $aType = array('decade' => 315576000,
                    'year' => 31557600,
                    'month' => 2629800,//===
                    'week' => 604800,
                    'day' => 86400,
                    'hour' => 3600,
                    'min' => 60,
                    'sec' => 1);
        return floor($time/$aType[$type]); 
    }
    
    /**
     * @todo Get date of next month by the given date. If no exist date in next month, it will return the last date of next month.
     * @param timestamp $date
     * @param string $count: number of month from the given date. Default is next month (1)
     * @author bb
     */
    public static function getDateOfNextMonthByDate($date, $count = '+1')
    {
        $startDateOfGivenMonth  = date('Y-m', $date).'-01';   
        $startDateOfNextMonth = date('Y-m-d', strtotime("$count month",strtotime($startDateOfGivenMonth)));

        if(!checkdate(date('m',  strtotime($startDateOfNextMonth)), date('d', $date), date('Y',  strtotime($startDateOfNextMonth)))) 
        {
            return date('Y-m-t', strtotime($startDateOfNextMonth));
        } 
        
        return date('Y-m', strtotime($startDateOfNextMonth)).'-'.date('d',$date);        
    }
   
    /**
     * 
     * @param string $data : 23/2/2013
     * @param type $formatDate
     * @return boolean
     * @author bb
     */
    public static function isValidDate($data, $formatDate = 'dd/mm/yyyy')
    {
        $data = trim($data);
        if($data == '')
            return false;
        
       
//          $patternDate = '/^(\d){2}(\/){1}(\d){2}(\/){1}(\d){4}$/';
//          $patternDate = '/([0-9]{1})\/([0-9]{1})\/([0-9]{4})/';
        $patternDate = '/^\d{1,2}\/\d{1,2}\/\d{4}/';

        if(!preg_match($patternDate,trim($data),$matches))
        {            
            return false;
        }
        else
        {
            $aData = explode('/', $data);
            if(!checkdate((int)$aData[1], (int)$aData[0], $aData[2]))
                return false;
        }
       
        return true;
    }
    
    public static function getDayHourMin($timestampStart, $timestampEnd)
    {
        $time = $timestampEnd - $timestampStart;
        if ($time < 0) {
            return array();
        }
        $aType = array(
                    'day' => 86400,
                    'hour' => 3600,
                    'min' => 60,
        );
        $extant = array();
        $extant['day'] =  floor($time/$aType['day']);
        $remain_hour = $time % $aType['day'];
        $extant['hour'] = floor($remain_hour/$aType['hour']);
        $remain_min = $remain_hour % $aType['hour'];
        $extant['min'] = floor($remain_min/$aType['min']);
        return $extant;
    }

    public static function testLeapYear($year) {
        $ret = (($year%400 == 0) || ($year%4 == 0 && $year%100 != 0)) ? true : false;
        return $ret;
    }

    public static function checkEnddate($date,$month){
        if($month == 2 && $date == 29){
            return true;
        }elseif($month == 2 && $date == 28){
            return true;
        }elseif($month%2 != 0 && $date == 31){
            return true;
        }elseif($month%2 == 0 && $month !=2 &&  $date == 30){
            return true;
        }
        return false;
    }

    public static function getDateFormatJquery(){
        return "dd/mm/yy";
    }

    public static function getDateFormatPhp(){
        return "d/m/Y";
    }

    //input : 1 || 2 || 3 .... 12
    //output: month_Name January
    // author Ng
    public static function returnMonthNameFromInt($tmp)
    {
        $res='';
        if(is_int($tmp) && $tmp>=0 && $tmp <=12)
        {
            switch ($tmp) 
            {
                case 1:
                    $res='January';
                    break;
                case 2:
                    $res='February';
                    break;
                case 3:
                    $res='March';
                    break;
                case 4:
                    $res='April';
                    break;
                case 5:
                    $res='May';
                    break;
                case 6:
                    $res='June';
                    break;
                case 7:
                    $res='July';
                    break;
                case 8:
                    $res='August';
                    break;
                case 9:
                    $res='September';
                    break;
                case 10:
                    $res='October';
                    break;
                case 11:
                    $res='November';
                    break;
                case 12:
                    $res='December';
                    break;
            }
        }
        return $res;
    }

    //input: Y-m-d or Y-m-d H:i:s  1991-10-30 11:11:01
    //output: monthName
    //author: Ng

    public static function returnMonthNameFromDate($string_date)
    {
        if($string_date=='0000-00-00' || $string_date=='0000-00-00 00:00:00' || is_null($string_date))
            return '';  
        if(is_string($string_date))
        {
            $month = substr($string_date, 5,2);
            $month = (int)$month;
            return self::returnMonthNameFromInt($month);
        }
    }

    //input: Y-m-d or Y-m-d H:i:s  1991-10-30 11:11:01
    //output: Year
    //author: Ng
    public static function returnYearFromDate($string_date)
    {
        if($string_date=='0000-00-00' || $string_date=='0000-00-00 00:00:00' || is_null($string_date))
            return '';  
        if(is_string($string_date))
        {
            $year = substr($string_date, 0,4);
            $year = (int)$year;
            return $year;
        }
    }
}
