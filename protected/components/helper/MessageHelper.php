<?php
/**
 * Created by PhpStorm.
 * User: Phuong Ho
 * Date: 9/5/14
 * Time: 9:18 AM
 */

class MessageHelper {
    const SUCCESS = 'success';
    const ERROR = 'error';
    const NOTICE = 'notice';
    /** display message
     * @key : error | success | notice
     */

    public static function getMessages() {
        foreach(Yii::app()->user->getFlashes() as $key => $message) {
            $html = '';
            $html .= '<div class="alert alert-'. $key .' alert-dismissible" role="alert">';
            $html .= '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>';
            $html .= $message;
            $html .= '</div>';
            echo $html;
        }

    }
    public static function setMessage($type, $message) {
        Yii::app()->user->setFlash($type, $message);
    }
} 