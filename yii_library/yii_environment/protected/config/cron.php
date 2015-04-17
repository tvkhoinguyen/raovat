<?php
include_once 'define.php';
switch(APPLICATION_ENV) 
{
    case 'development':
        require_once 'development/db.php';
        break;
    case 'testing':
        require_once 'testing/db.php';
        break;
    case 'staging':
        require_once 'testing/db.php';
        break;
    case 'production':
        require_once 'production/db.php';
        break;
    
    default:
        break;
}

return array(
    // This path may be different. You can probably get it from `config/main.php`.
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Cron',

    'preload'=>array('log'),

    'import'=>array(
        'application.components.*',
        'application.models.*',
        'ext.yii-mail.YiiMailMessage',
        'application.cms.components.*',
    ),
    // We'll log cron messages to the separate files
    'components'=>array(
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'logFile'=>'cron.log',
                    'levels'=>'error, warning',
                ),
                array(
                    'class'=>'CFileLogRoute',
                    'logFile'=>'cron_trace.log',
                    'levels'=>'trace',
                ),
            ),
        ),

        // Your DB connection
        'db'=>array(
            'connectionString' => "mysql:host=$MYSQL_HOSTNAME;dbname=$MYSQL_DATABASE",
            'emulatePrepare' => true,
            'username' => $MYSQL_USERNAME,
            'password' => $MYSQL_PASSWORD,
            'tablePrefix'=>$TABLE_PREFIX,
            'charset' => 'utf8',
            'enableProfiling'=>true,
            'enableParamLogging'=>true,
        ),

        'mail' => array(
            'class' => 'application.extensions.yii-mail.YiiMail',
            'transportType'=>'php', /// case sensitive!
            'transportOptions'=>array(
                'host'=>'localhost',
                'username'=>'',
                'password'=>'',
                'port'=>'25',
                'encryption'=>'none',
                'timeout'=>'120',
            ),
            'viewPath' => 'application.mail',
            'logging' => true,
            'dryRun' => false
        ),

        'request' => array(
            'hostInfo' => '127.0.0.1',
            'baseUrl' => ROOT,
            'scriptUrl' => '',
        ),

        'setting'=>array(
            'class' =>  'application.extensions.MyConfig.MyConfig',
            'cacheId'=>null,
            'useCache'=>false,
            'cacheTime'=>0,
            'tableName'=>$TABLE_PREFIX . '_settings',
            'createTable'=>false,
            'loadDbItems'=>true,
            'serializeValues'=>true,
            'configFile'=>'',
        ),
    ),
);