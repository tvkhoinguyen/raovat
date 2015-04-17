<?php
include_once 'define.php';
switch(APPLICATION_ENV) 
{
    case 'development':
        require_once 'development/components.php';
        require_once 'development/db.php';
        break;
    case 'testing':
        require_once 'testing/components.php';
        require_once 'testing/db.php';
        break;
    case 'staging':
        require_once 'testing/components.php';
        require_once 'testing/db.php';
        break;
    case 'production':
        require_once 'production/components.php';
        require_once 'production/db.php';
        break;
    
    default:
        break;
}

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=> $THEME_NAME,
        'theme'=> $THEME,
        'language' => 'en',
		
	// preloading 'log' component
	'preload'=>array('log', 'ELangHandler'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.extensions.yii-mail.*',
        'application.extensions.phpexcel.*',
        'application.extensions.phpexcel.PHPExcel.*',
		'application.extensions.EUploadedImage.*',
		'application.extensions.jmultiselect2side.*',
        'application.extensions.EPhpThumb.*',
        'application.extensions.MyDebug.*',
		'application.extensions.editMe.*',
        'application.extensions.ControllerActionsName.*',
	    'application.modules.auditTrail.models.AuditTrail',
        'application.extensions.toSlug.*',
    ),
	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
            'generatorPaths'=>array(
                'application.gii',   // a path alias
                'bootstrap.gii',
            ),
		),
        'admin',
        'member',
        'product',
        'auditTrail'=>array(
			'userClass' => 'Users', // the class name for the user object
			'userIdColumn' => 'id', // the column name of the primary key for the user
			'userNameColumn' => 'username', // the column name of the primary key for the user
		),
	),

	// application components
	'components'=>array(
        'session' => array(
            'class' => 'CDbHttpSession',
            'timeout' => 11800,

        ),
            
        'user'=>array(
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
            'class' => 'WebUser',
                        'loginUrl'=>array('/admin/site/login'),
        ),

        'urlManager'=>$COMPONENT_urlManager,

        'db'=>array(
            'connectionString' => "mysql:host=$MYSQL_HOSTNAME;dbname=$MYSQL_DATABASE",
            'emulatePrepare' => true,
            'username' => $MYSQL_USERNAME,
            'password' => $MYSQL_PASSWORD,
            'tablePrefix'=> $TABLE_PREFIX,
            'charset' => 'utf8',
            'enableProfiling'=>true,
            'enableParamLogging'=>true,
        ),

        'authManager'=>array(
            'class'=>'CDbAuthManager',
            'connectionID'=>'db',
        ),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					//'levels'=>'error, warning',
				),
                array(
                    'class' => 'DbLogRoute',
                    'connectionID' => 'db',
                    'autoCreateLogTable' => false,
                    'logTableName' => $TABLE_PREFIX."_logger",
                    'levels' => 'info, error'
                    // nota:categories removed from me
                    //'categories' => 'cclinica',
                ),
				// uncomment the following to show log messages on web pages
//				array(
//					'class'=>'CWebLogRoute',
//				),
                array(
                    'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
                    'ipFilters'=>array(isset($_COOKIE['debug']) ? '127.0.0.1':'0.0.0.0'),
                ),
			),
		),

        'mail' => array(
            'class' => 'application.extensions.yii-mail.YiiMail',
            'transportType'=>'smtp', /// case sensitive!
            'transportOptions'=>array(
                'host'=>'smtp.gmail.com',
                'username'=>'dungverz@gmail.com',
                'password'=>'dung!@#123',
                'port'=>'465',
                'encryption'=>'ssl',
                'timeout'=>'120',
            ),
            'viewPath' => 'application.mail',
            'logging' => true,
            'dryRun' => false
        ),

        'setting'=>array(
            'class' =>  'application.extensions.MyConfig.MyConfig',
            'cacheId'=>null,
            'useCache'=>false,
            'cacheTime'=>0,
            'tableName'=> $TABLE_PREFIX . '_settings',
            'createTable'=>false,
            'loadDbItems'=>true,
            'serializeValues'=>true,
            'configFile'=>'',
        ),

        'format'=>array(
            'class'=>'CmsFormatter',
        ),

        'ELangHandler' => array (
            'class' => 'application.extensions.langhandler.ELangHandler',
            'languages' => array('en','cn'),
            'strict' => true,
        ),

        'events'=>array(
            'class'=>'CmsEventList'
        ),

        'widgetFactory'=>array(
            'widgets'=>array(
                'CGridView'=>array(
//                    'cssFile'=>'/NoisyRadar/css/gridview.css',
                ),
            ),
        ),
            
        'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),            
            
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		'ckeditor_editMe'=>array(
            array(
                'Source',
            ),
            array(
                'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo',
            ),
            array(
                'Find', 'Replace', '-', 'SelectAll', '-', 'SpellChecker', 'Scayt' , 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat',
            ),
            '/',
            array(
                'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock',
            ),
            array(
                'Link', 'Unlink', 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe',
            ),
            array(
                 'Styles', 'Format', 'Font', 'FontSize',
            ),
            array(
                'TextColor', 'BGColor',
            ),
        ),
        'ckeditor'=>array(
            array("name"=>'document', "items"=>array('Source' )),
            array("name"=>'clipboard', "items"=>array('Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' )),
            '/',
            array("name"=>'basicstyles', "items"=>array('Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ) ),
            array("name"=>'paragraph', "items"=>array('NumberedList','BulletedList','-','Outdent','Indent','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ) ),
            array("name"=>'links', "items"=>array('Link','Unlink') ),
            array("name"=>'insert', "items"=>array('Image','Table','HorizontalRule' ) ),
            '/',
            array("name"=>'styles', "items"=>array('Styles','Format','Font','FontSize' ) ),
            array("name"=>'colors', "items"=>array('TextColor','BGColor' )),
        ),
        'ckeditor_simple'=>array(
            array("name"=>'clipboard', "items"=>array('Source','Undo','Redo' )),
            array("name"=>'basicstyles', "items"=>array('Bold','Italic') ),
            //array("name"=>'paragraph', "items"=>array('NumberedList','BulletedList','-','Outdent','Indent','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ) ),
        ),	
        'niceditor'=>array('bold','italic','underline','ol','ul'),
		'niceditoradv'=>array('bold','italic','underline','ol','ul','link','unlink','forecolor','bgcolor'),
        'niceditor_v_1'=>array('bold','italic','underline','ol','ul','fontSize','left','center','right','justify','forecolor','bgcolor','image','upload','link','unlink','xhtml'),
         'niceditor_v_2'=>array('bold','italic','underline','ul'),
          'niceditor_v_3'=>array('bold','italic','underline','ol','ul','link','unlink'),   
//        'niceditor'=>array('bold','italic'),
		'adminEmail'=>'webmaster@example.com',
		'autoEmail'=>'auto_mailer@starlets22.com',
        'dateFormat'=>'d/m/Y',
        'timeFormat'=>'H:i:s',
        'paypalURL'=>'https://www.paypal.com/cgi-bin/webscr',
        'paypalURL_sandbox'=>'https://www.sandbox.paypal.com/cgi-bin/webscr',
        'paypal_email_address'=>'kvan_1325843303_biz@verzdesign.com',
        'is_paypal_sandbox'=>1,
        'image_watermark'=>'bg_13394962316443.gif',
        'defaultPageSize'=>20,


        'twitter'=>'',
        'facebook'=>'',
        'linkedin'=>'',
        'rss'=>'',

        'meta_description'=>'',
        'meta_keywords'=>'',
		'reCaptcha'=>array(
		   'publicKey'=>'6Lfmj9ASAAAAAM2b4ePzdByLBIrX6bSU32ZnLgIR',
		   'privateKey'=>'6Lfmj9ASAAAAAAiZVwboS55FW1sKY1QWm-lGEEAV',
		),
	),
);