<?php

class ValidateHelper
{
    // validate a phone number
    public static function isPhone($phone)
    {
        if (!is_string($phone))
            return false;
        if (preg_match("/^([1]-)?[0-9]{3}-[0-9]{3}-[0-9]{4}$/i", $phone))
            return true;
        return false;
    }

    // validate a email address
    public static function isEmail($email)
    {
        if (!is_string($email))
            return false;
        if (preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i",
            $email))
            return true;
        return false;
    }

    // Name must be from letters, dashes, spaces and must not start with dash
    public static function isName($string)
    {
        if (preg_match("/^[A-Z][a-zA-Z -]+$/", $string) === 0)
            return false;
        return true;
    }

    // Passport must be 10 or 12 digits
    public static function isPassport($string)
    {
        if (preg_match("/^d{10}$|^d{12}$/", $string) === 0)
            return false;
        return true;
    }

    // Zip must be 4 digits
    public static function isZip($string)
    {
        if (preg_match("/^d{4}$/", $string) === 0)
            return false;
        return true;
    }

    // User must be bigger that 5 chars and contain only digits, letters and underscore
    public static function isUser($string)
    {
        if (preg_match("/^[0-9a-zA-Z_]{5,}$/", $string) === 0)
            return false;
        return true;
    }

    // Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit
    public static function isPassword($string)
    {
        if (preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $string)
            === 0)
            return false;
        return true;
    }

    public static function  isTimeStamp($timestamp)
    {
        return ((string) (int) $timestamp === $timestamp)
            && ($timestamp <= PHP_INT_MAX)
            && ($timestamp >= ~PHP_INT_MAX);
    }

    //Validate for users over 18 only
    /* Nguyen Dung 2013-06-11
     * @param: String $dob: birthday : 1987-11-15
     * @param: Int $allowAge: 18 or small...
     * @return: true if Age over 18 else return false
     */
    public static function validateAge($dob, $allowAge )
    {
        // $then will first be a string-date
        $dob = strtotime($dob);
        //The age to be over, over +18
        $min = strtotime('+18 years', $dob);
        if(time() < $min)
            return false; // Not 18
        return true; // over 18
    }

}


?>
