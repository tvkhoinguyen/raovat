<?php
class MyFunctionCustom extends CActiveRecord
{
    public static function registerOpenGraph($property, $data) {
        Yii::app()->clientScript->registerMetaTag($data, null, null, array('property' => $property));
    }

    
    public static function geocode($portal_code){
        $portal_code = trim(''.$portal_code);
        $portal_code = 'Singapore '.$portal_code;
        $addressclean = str_replace (" ", "+", $portal_code);
        $details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . $addressclean . "&sensor=false";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $details_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $geoloc = json_decode(curl_exec($ch), true);

        if(!isset($geoloc['results'][0]))
            return '1.352083,103.819836';
        else
            return $geoloc['results'][0]['geometry']['location']['lat'].','.$geoloc['results'][0]['geometry']['location']['lng'];
    }

    public static function getMaxFileSizeImage() {
        return 3 * 1024 * 1000;
    }
    
    public function EventCalender($events='',$date='') {
        //This puts the day, month, and year in seperate variables
        if(empty($date))
            $date = date('Y-m-d');

        $day = date('d', strtotime($date)) ;
        $month = date('m', strtotime($date)) ;
        $year = date('Y', strtotime($date)) ;

        //Here we generate the first day of the month
        $first_day = mktime(0,0,0,$month, 1, $year) ;

        //This gets us the month name
        $title = date('F', $first_day) ;

        //Here we find out what day of the week the first day of the month falls on
        $day_of_week = date('D', $first_day) ;

        //Once we know what day of the week it falls on, we know how many blank days occure before it. If the first day of the week is a Sunday then it would be zero

        switch($day_of_week){
            case "Sun": $blank = 0; break;
            case "Mon": $blank = 1; break;
            case "Tue": $blank = 2; break;
            case "Wed": $blank = 3; break;
            case "Thu": $blank = 4; break;
            case "Fri": $blank = 5; break;
            case "Sat": $blank = 6; break;
        }

        //We then determine how many days are in the current month
        $days_in_month = cal_days_in_month(0, $month, $year) ;
        $calender = '';

        //Here we start building the table heads
        $calender.= '<table width="200" cellspacing="10" cellpadding="10">';
        $calender.= '<tr class="header"><td colspan="7"><h1 style="text-align:center;">'. $title.' '.$year.' </h1></td></tr>';
        $calender.= '<tr>
                        <th scope="col">S</th>
                        <th scope="col">M</th>
                        <th scope="col">T</th>
                        <th scope="col">W</th>
                        <th scope="col">T</th>
                        <th scope="col">F</th>
                        <th scope="col">S</th>
                   </tr>';

        //This counts the days in the week, up to 7
        $day_count = 1;

        $calender.= "<tr>";

        //first we take care of those blank days
        while ( $blank > 0 )
        {
            $calender.= "<td><span>&nbsp;</span></td>";
            $blank = $blank-1;
            $day_count++;
        }

        //sets the first day of the month to 1
        $day_num = 1;

        //count up the days, untill we've done all of them in the month
        while ( $day_num <= $days_in_month )
        {
            if(empty($events)){
                $status_of_calender= "<td><span>".$day_num."</span></td>";
            }else{
                $status_of_calender= "";
                $FlgEvent = false;
                foreach($events as $event) {
                    $day_of_event = date('d',strtotime($event['event_date']));
                    if ($day_of_event == $day_num){
                        $status_of_slot = $event->viewStatusOfSlot();
                        if($status_of_slot == 'Session Full'){
                            $status_of_calender .= '<td class="full"><span>'.$day_num.'</span></td>';
                            $FlgEvent = true;
                            break;
                        }
                        elseif ($status_of_slot == 'Session Almost Full'){
                            $status_of_calender .= '<td class="almostall"><span><a href="'.Yii::app()->createAbsoluteUrl("member/register/event/".$event["id"]).'">'.$day_num.'</a></span></td>';
                            $FlgEvent = true;
                            break;
                        }
                        else {
                            $status_of_calender .= '<td class="available"><span><a href="'.Yii::app()->createAbsoluteUrl("member/register/event/".$event["id"]).'">'.$day_num.'</a></span></td>';
                            $FlgEvent = true;
                            break;
                        }

                    }
                }
                if($FlgEvent == false)
                    $status_of_calender .= "<td><span>".$day_num."</span></td>";
            }

            $calender.= $status_of_calender;

            $day_num++;
            $day_count++;

            //Make sure we start a new row every week
            if ($day_count > 7)
            {
                $calender.= "</tr><tr>";
                $day_count = 1;
            }
        }

        //Finaly we finish out the table with some blank details if needed
        while ( $day_count >1 && $day_count <=7 )
        {
            $calender.= "<td><span>&nbsp;</span></td>";
            $day_count++;
        }
        $calender.= "</tr></table>";
        echo $calender;
    }


	/**
	 * Returns auto generate max id: ID0001.
	 * @param:$className: Users
	 * @param:$prefix_code: ID
	 * @param:$length_max_id: int: 6
	 * @param:$fieldName: name of field generate max id in database: ex: customer_id, user_no....
         * @how to do: $model->user_no = MyFunctionCustom::getNextId('Users','ID',6,'user_no');
	 */  		
    public static function getNextId($className,$prefix_code, $length_max_id, $fieldName){
        $prefix_code_length = strlen($prefix_code);
        $criteria = new CDbCriteria;
        $criteria->select='MAX(CONVERT(SUBSTR(t.'.$fieldName.','.($prefix_code_length+1).'),SIGNED)) as MAX_ID';
        $model_ = call_user_func(array($className, 'model'));
        $model = $model_->find($criteria);
        $max_id =  (null == $model->MAX_ID) ? 0 : $model->MAX_ID;
        $max_id++;
        $addition_zero_num 	= $length_max_id - strlen($max_id) - strlen($prefix_code);
        $code = $prefix_code;
        for($i=1;$i<=$addition_zero_num;$i++)
            $code.='0';
        $code.= $max_id;
        $code.= '}';
        return $code;
    }

    /* Nguyen Dung 2013-06-11
    * @return: unique verify_code in table User
    */
    public static function generateVerifyCode(){
        $verify_code = rand(100000, 1000000);
        $count = Users::model()->count('verify_code='.$verify_code.'');
        if($count>0){
            $verify_code = self::generateVerifyCode();
            return $verify_code;
        }else
            return $verify_code;
    }

    /* Nguyen Dung 2013-07-30
    * @return: for safe slug when query db
    */
    public static function safeField($field){
        $field = self::remove_vietnamese_accents($field);
        $field = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', $field);
        $remove = array("'", '"', ':');
        $field = str_replace($remove, '', $field);
        return  $field;
    }

    public static function remove_vietnamese_accents($str)
    {
        $accents_arr=array(
            "�","�","?","?","�","�","?","?","?","?","?","a",
            "?","?","?","?","?","�","�","?","?","?","�","?",
            "?","?","?","?",
            "�","�","?","?","i",
            "�","�","?","?","�","�","?","?","?","?","?","o",
            "?","?","?","?","?",
            "�","�","?","?","u","u","?","?","?","?","?",
            "?","�","?","?","?",
            "d",
            "�","�","?","?","�","�","?","?","?","?","?","A",
            "?","?","?","?","?",
            "�","�","?","?","?","�","?","?","?","?","?",
            "�","�","?","?","I",
            "�","�","?","?","�","�","?","?","?","?","?","O",
            "?","?","?","?","?",
            "�","�","?","?","U","U","?","?","?","?","?",
            "?","�","?","?","?",
            "�"
        );

        $no_accents_arr=array(
            "a","a","a","a","a","a","a","a","a","a","a",
            "a","a","a","a","a","a",
            "e","e","e","e","e","e","e","e","e","e","e",
            "i","i","i","i","i",
            "o","o","o","o","o","o","o","o","o","o","o","o",
            "o","o","o","o","o",
            "u","u","u","u","u","u","u","u","u","u","u",
            "y","y","y","y","y",
            "d",
            "A","A","A","A","A","A","A","A","A","A","A","A",
            "A","A","A","A","A",
            "E","E","E","E","E","E","E","E","E","E","E",
            "I","I","I","I","I",
            "O","O","O","O","O","O","O","O","O","O","O","O",
            "O","O","O","O","O",
            "U","U","U","U","U","U","U","U","U","U","U",
            "Y","Y","Y","Y","Y",
            "D"
        );

        return str_replace($accents_arr,$no_accents_arr,$str);
    }
    
    public static function getDiscountMethod($method_id) {
        $method = GocProductDiscounts::model()->listMethod;
        return $method[$method_id];
    }

    public static function getNextOrPrevId($currentId, $nextOrPrev, $modelName, $whereCondition=NULL)
    {
        $model = call_user_func(array($modelName, 'model'));

        $records=NULL;
        if($nextOrPrev == "prev")
            $order="order_display DESC";
        if($nextOrPrev == "next")
            $order="order_display ASC";

        if(empty($whereCondition))
            $records=$model->findAll(
                array('select'=>'*','order'=>$order)
            );
        else
            $records=$model->findAll(
                array('select'=>'*','condition'=>$whereCondition, 'order'=>$order)
            );

        foreach($records as $i=>$r)
            if($r->id == $currentId)
                return $records[$i+1]->id ? $records[$i+1] : NULL;


        return NULL;
    }
    
    public static function getInfoRecord($className,$id,$field_name=NULL){
        $ModelName = call_user_func(array($className,'model'));
        $model = $ModelName->findByPk($id);
        if($model){
            if(empty($field_name))  return $model;
            else return $model->$field_name;
        }
        return null;
    }

}
?>