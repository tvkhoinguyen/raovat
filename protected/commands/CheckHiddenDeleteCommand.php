<?php
class CheckHiddenDeleteCommand extends CConsoleCommand
{
    public function run($arg)
    {
        //save last_working in setting table
        Yii::app()->setting->setDbItem('last_working', date('Y-m-d H:i:s'));
        $this->doJob($arg);
    }
    
    protected function doJob($arg)
    {
        TinRaoVat::cronJobCheckHiddenDelete();
    }
}