<?php

class MyDebug {

    public static function output($array) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";        
    }

    public static function outputDataProvider($DataProvider) {
        if(is_object($DataProvider)) {
            $result = array();
            $data = $DataProvider->data;
            foreach($data as $item){
                $result[] = $item->attributes;
            }
            self::output($result);
        }
    }
 
}