<?php

include_once 'config.local.php';

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

Yii::setPathOfAlias('bootstrap', dirname(__FILE__) . '/../extensions/bootstrap');

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => $THEME_NAME,
    'theme' => $THEME,
    'language' => 'en',
    // preloading 'log' component
    'preload' => array('log', 'ELangHandler'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.models.core.*',
        'application.models.forms.*',
        'application.models.menus.*',
        'application.models.cms.*',
        'application.models.base.*',
        'application.models.lookup.*',
        'application.models.newsletter.*',
        'application.models.raovat.*',
        'application.components.*',
        'application.components.customFunction.*',
        'application.components.format.*',
        'application.components.helper.*',
        'application.components.widget.*',
        'application.extensions.yii-mail.*',
        'application.extensions.EUploadedImage.*',
        'application.extensions.EPhpThumb.*',
        'application.extensions.MyDebug.*',
        //'application.extensions.editMe.*',
        'application.extensions.ControllerActionsName.*',
        'application.modules.auditTrail.models.AuditTrail',
        'application.extensions.toSlug.*',
        'application.components.paypal.*',
    ),
    'modules' => array(
        'gii' => array(
            'class' => 'application.modules.gii.GiiModule',
            'password' => false,
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
            'generatorPaths' => array(
                'application.modules.gii', // a path alias
            ),
        ),
        'admin',
        'member',
        'auditTrail' => array(
            'userClass' => 'Users', // the class name for the user object
            'userIdColumn' => 'id', // the column name of the primary key for the user
            'userNameColumn' => 'username', // the column name of the primary key for the user
        ),
    ),
    // application components
    'components' => array(
        'session' => array(
            'class' => 'CDbHttpSession',
            'timeout' => 11800,
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'class' => 'WebUser',
            'loginUrl' => array('/admin/site/login'),
            // 'loginUrl' => array('site/index'),
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
             // 'enablePrettyUrl' => true,
             // 'suffix' => '.html',
            'rules' => array(
                '/' => 'site/index',
                'forgot-password' => 'site/forgotPassword',
                'get-news/<type:[a-zA-Z0-9-]+>' => 'site/getListTin',
                'contact-us' => 'site/contactUs',


                'dang-tin'=>'site/dangTin',
                'detail/<slug:[a-zA-Z0-9-]+>.html'=>'site/tinDetail',
                'chuyen-muc/<j_slug:[a-zA-Z0-9-]+>'=>'site/listTin',
                'chuyen-muc'=>'site/listTin',
                // 'newsletter' => 'site/newsletter',

                // 'tin-tuc-chi-tiet/<p_slug:[a-zA-Z0-9-]+>/<p_slug:[a-zA-Z0-9-]+>'=>'site/listTin',
                // 'tin-tuc-chuyen-muc-<ThoiSu_page:[a-zA-Z0-9-]+>/<p_slug:[a-zA-Z0-9-]+>/<c_slug:[a-zA-Z0-9-]+>'=>'site/listTin',
                // 'tin-tuc-chuyen-muc/<p_slug:[a-zA-Z0-9-]+>/<c_slug:[a-zA-Z0-9-]+>'=>'site/listTin',

                // 'tin-tuc-chuyen-muc-<ThoiSu_page:[a-zA-Z0-9-]+>/<p_slug:[a-zA-Z0-9-]+>'=>'site/listTin',
                // 'tin-tuc-chuyen-muc/<p_slug:[a-zA-Z0-9-]+>'=>'site/listTin',

                // 'tin-chi-tiet/<slug:[a-zA-Z0-9-]+>.html'=>'site/tinDetail',

                // 'videos' => 'site/video',
                // 'video/<slug:[a-zA-Z0-9-]+>' => 'site/listVideo',

                // 'my-cart' => 'site/myCart',
                // 'checkout' => 'checkout/index',
                // 'print-solution' => 'printSolutions/index',
                
                // 'account-infomation' => 'member/site/myProfile',
                // 'my-profile' => 'member/site/profileInfo',
                // 'my-order' => 'member/site/myOrder',
                // // 'special-deals' => 'site/specialDeals',
                // 'special-detail/<slug:[a-zA-Z0-9-]+>' => 'site/specialDetail',

                // 'news-event/<type:[a-zA-Z0-9-]+>' => 'site/newsEvent',
                // 'news-event' => 'site/newsEvent',
                // 'news-event-detail/<slug:[a-zA-Z0-9-]+>' => 'site/newsEventDetail',

                // 'interior-designers-<page:\w+>' => 'site/listdesigner/',
                // 'interior-designers' => 'site/listdesigner/',
                // 'designers-detail/<slug:[a-zA-Z0-9-]+>' => 'site/designerdetail',

                // 'search-<page:\w+>/keyword/<keyword:\w+>' => 'site/search',
                // 'search/' => 'site/search',


                
                '<action:(error|unsubscribe|applicationForm|login|logout|register|resetPassword|catalogue)>' => 'site/<action>',
                'admin' => array('admin/site'),
                'page/<slug:[a-zA-Z0-9-]+>' => array('cms/index'),
                'admin/<action:(login|logout|error|changePassword)>' => 'admin/site/<action>',
                'member/<action:(error|change_password)>' => 'member/site/<action>',
                'member/change-password' => 'member/site/changePassword',
                'member/update-profile' => 'member/site/updateProfile',
                'member/verify_register/<id>' => 'member/site/verify_register',

                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<url:(admin|member)>' => '<url>/site/',
                '<url>' => '<url>/site/index',
            ),

        ),
        'db' => array(
            'connectionString' => "mysql:host=$MYSQL_HOSTNAME;dbname=$MYSQL_DATABASE",
            'emulatePrepare' => true,
            'username' => $MYSQL_USERNAME,
            'password' => $MYSQL_PASSWORD,
            'tablePrefix' => $TABLE_PREFIX,
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true,
        ),
        'authManager' => array(
            'class' => 'CDbAuthManager',
            'connectionID' => 'db',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                //'levels'=>'error, warning',
                ),
                array(
                    'class' => 'DbLogRoute',
                    'connectionID' => 'db',
                    'autoCreateLogTable' => false,
                    'logTableName' => $TABLE_PREFIX . "_logger",
                    'levels' => 'info, error'
                ),
                array(
                    'class' => 'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
                    'ipFilters' => array(isset($_COOKIE['debug']) ? '127.0.0.1' : '0.0.0.0'),
                ),
            ),
        ),
        'mail' => array(
            'class' => 'application.extensions.yii-mail.YiiMail',
            'transportType' => 'smtp', /// case sensitive!
            'transportOptions' => array(
                'host' => 'smtp.gmail.com',
                'username' => 'dungverz@gmail.com',
                'password' => 'dung!@#123',
                'port' => '465',
                'encryption' => 'ssl',
                'timeout' => '120',
            ),
            'viewPath' => 'application.mail',
            'logging' => true,
            'dryRun' => false
        ),
        'setting' => array(
            'class' => 'application.extensions.MyConfig.MyConfig',
            'cacheId' => null,
            'useCache' => false,
            'cacheTime' => 0,
            'tableName' => $TABLE_PREFIX . '_settings',
            'createTable' => false,
            'loadDbItems' => true,
            'serializeValues' => true,
            'configFile' => '',
        ),
        'format' => array(
            'class' => 'CustomFormatter',
        ),
        'ELangHandler' => array(
            'class' => 'application.extensions.langhandler.ELangHandler',
            'languages' => array('en', 'cn'),
            'strict' => true,
        ),
        'events' => array(
            'class' => 'CmsEventList'
        ),
        'widgetFactory' => array(
            'widgets' => array(
                'CGridView' => array(
//                    'cssFile'=>'/NoisyRadar/css/gridview.css',
                ),
            ),
        ),
        'bootstrap' => array(
            'class' => 'bootstrap.components.Bootstrap',
        ),
        'facebook' => array(
            'class' => 'ext.yii-facebook-opengraph.SFacebook',
            'appId' => '1524975341053257', // needed for JS SDK, Social Plugins and PHP SDK
            'secret' => '4b92b0f6e57238ed54975478c49fcbf4', // needed for the PHP SDK
            // 'appId'=>'689703291114663', // needed for JS SDK, Social Plugins and PHP SDK
            // 'secret'=>'a4f01d29497d1c4b40d3663c1714042c', // needed for the PHP SDK
            //'fileUpload'=>false, // needed to support API POST requests which send files
            //'trustForwarded'=>false, // trust HTTP_X_FORWARDED_* headers ?
            //'locale'=>'en_US', // override locale setting (defaults to en_US)
            //'jsSdk'=>true, // don't include JS SDK
            //'async'=>true, // load JS SDK asynchronously
            //'jsCallback'=>false, // declare if you are going to be inserting any JS callbacks to the async JS SDK loader
            'status' => true, // JS SDK - check login status
//            'cookie'=>true, // JS SDK - enable cookies to allow the server to access the session
//            'oauth'=>true,  // JS SDK - enable OAuth 2.0
//            'xfbml'=>true,  // JS SDK - parse XFBML / html5 Social Plugins
        //'frictionlessRequests'=>true, // JS SDK - enable frictionless requests for request dialogs
        //'html5'=>true,  // use html5 Social Plugins instead of XFBML
        //'ogTags'=>array(  // set default OG tags
        //'title'=>'MY_WEBSITE_NAME',
        //'description'=>'MY_WEBSITE_DESCRIPTION',
        //'image'=>'URL_TO_WEBSITE_LOGO',
        //),
        ),
        'metadata' => array('class' => 'Metadata'),
        'widgetFactory' => array(
            'widgets' => array(
                'CGridView' => array(
//                    'cssFile'=>'/NoisyRadar/css/gridview.css',
                ),
                'XUpload' => array(
                    'formView' => 'application.views.layouts.inc.upload_form',
                    'downloadView' => 'application.views.layouts.inc.download_template',
                    'uploadView' => 'application.views.layouts.inc.upload_template',
                    'options' => array(
                        'maxFileSize' => 10 * 1024 * 1024,
                        'acceptFileTypes' => 'js:/\.(gif|jpg|jpeg|png|pdf)$/i'
                    )
                ),
            ),
        ),
        'pdf' => array(
            'class' => 'ext.yii-pdf.EYiiPdf',
            'params' => array(
                'HTML2PDF' => array(
                    'librarySourcePath' => 'application.vendors.html2pdf.*',
                    'classFile' => 'html2pdf.class.php', // For adding to Yii::$classMap
                    'defaultParams' => array(// More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                        'orientation' => 'P', // landscape or portrait orientation
                        'format' => 'A4', // format A4, A5, ...
                        'language' => 'en', // language: fr, en, it ...
                        'unicode' => true, // TRUE means clustering the input text IS unicode (default = true)
                        'encoding' => 'UTF-8', // charset encoding; Default is UTF-8
                        'marges' => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
                    )
                )
            )
        ),
    ),
    'aliases' => array(
        'xupload' => 'application.widgets.xupload'
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        'ckeditor_full' => "[['Source', 'Bold', 'Italic', 'Underline', 'RemoveFormat', 'PasteText', 'PasteFromWord'],['NumberedList', 'BulletedList', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],['Link', 'Unlink', 'Image'],['Styles', 'Format', 'Font', 'FontSize'],['TextColor', 'BGColor', 'Table']]",
        'ckeditor_basic' => "[
                            [ 'Source','Bold', 'Italic','Underline', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight','JustifyBlock', 'RemoveFormat', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ],
                            [ 'FontSize', 'TextColor', 'BGColor' ]
                    ]",

        'ckeditor_basic_nguyen_custom' => "[
                            [ 'Source','Bold', 'Italic','Underline', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight','JustifyBlock' ],
                    ]",

        'niceditor' => array('bold', 'italic', 'underline', 'ol', 'ul'),
        'niceditor_v_1' => array('bold', 'italic', 'underline', 'ol', 'ul', 'fontSize', 'left', 'center', 'right', 'justify', 'forecolor', 'bgcolor', 'image', 'upload', 'link', 'unlink'),
        'adminEmail' => '',
        'autoEmail' => '',
        'dateFormat' => 'd/m/Y',
        'timeFormat' => 'H:i:s',
        'paypalURL' => '',
        'paypalURL_sandbox' => '',
        'paypal_email_address' => '',
        'is_paypal_sandbox' => 1,
        'image_watermark' => '',
        'defaultPageSize' => 20,
        'twitter' => '',
        'facebook' => '',
        'linkedin' => '',
        'rss' => '',
        'meta_description' => '',
        'meta_keywords' => '',
        'reCaptcha' => array(
            'publicKey' => '6Lfmj9ASAAAAAM2b4ePzdByLBIrX6bSU32ZnLgIR',
            'privateKey' => '6Lfmj9ASAAAAAAiZVwboS55FW1sKY1QWm-lGEEAV',
        ),
        'thumb' => array(
            'catalogue' => array(
                '121x86',
                '735x520',
            )
        ),
    ),
);
