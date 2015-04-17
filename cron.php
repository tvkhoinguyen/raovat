<?php
defined('YII_DEBUG') or define('YII_DEBUG',true);

// including Yii
define('ROOT', dirname(__FILE__));

//Verview
// require_once(ROOT.'/../../yii-framework-1.1.14/yii.php');
require_once(ROOT.'/../yii-framework-1.1.15/yii.php');
// $yii=dirname(__FILE__).'/../yii-framework-1.1.15/yii.php';


//Local Host
// require_once(ROOT.'/../yii-framework-1.1.15/yii.php');

// we'll use a separate config file
$config=dirname(__FILE__).'/protected/config/cron.php';

// creating and running console application
Yii::createConsoleApplication($config);
SettingForm::applySettings();//override settings by values from database
Yii::app()->run();