<?php
require_once(dirname(__FILE__).'/protected/config/config.php');

// change the following paths if necessary
define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);
define('ROOT', dirname(__FILE__));
define('YII_PROTECTED_DIR',  ROOT . DS . 'protected');
define('YII_THEMES_DIR',  ROOT . DS . 'themes');
define('YII_UPLOAD_DIR',  ROOT . DS . 'upload');
define('YII_UPLOAD_FOLDER', 'upload');
$config=dirname(__FILE__).'/protected/config/main.php';

switch(APPLICATION_ENV) 
{
    case 'development':
        error_reporting(E_ALL & ~ E_NOTICE);
        $yii=dirname(__FILE__).'/../framework/yii.php';        
        break;
    case 'testing':
        error_reporting(E_ALL & ~ E_NOTICE);
        $yii=dirname(__FILE__).'/../framework/yii.php';
        break;
    case 'staging':
        error_reporting(0);
        $yii=dirname(__FILE__).'/../framework/yii.php';
        break;
    case 'production':
        error_reporting(0);
        $yii=dirname(__FILE__).'/framework/yii.php';
        break;
    
    default:
        break;
}

// remove the following lines when in production mode
define('YII_DEBUG', true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config);

SettingForm::applySettings();//override settings by values from database


Yii::app()->run();

