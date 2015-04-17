<?php

/*
 * DTOAN
 * SHOW LOGIN
 * 6-12-2013
 */
class ShowloginWidget extends CWidget
{
    public $is_login;
    public $full_name;
    public function run()
    {        
        $this->getCategory();
    }
    
    public function getCategory()
    {
            $view ='show_login';
            if($this->is_login=='login_success') $view ='login_success';
            $this->render($view,array('full_name'=>$this->full_name));
    }   
}