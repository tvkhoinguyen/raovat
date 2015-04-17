<?php
require_once(dirname(__FILE__).'/protected/config/config.php');
defined('YII_DEBUG') or define('YII_DEBUG',true);

// including Yii
define('ROOT', dirname(__FILE__));
require_once(dirname(__FILE__).'/framework/yii.php');

// we'll use a separate config file
$config=dirname(__FILE__).'/protected/config/cron.php';

// creating and running console application
Yii::createConsoleApplication($config);
SettingForm::applySettings();//override settings by values from database
Yii::app()->run();