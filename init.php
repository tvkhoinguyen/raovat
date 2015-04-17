<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config);


//init permissions
$auth= Yii::app()->authManager;

$auth->clearAll();

//-- admin ---
$auth->createRole('view_ManageAdmin');
$auth->createRole('update_ManageAdmin');
$auth->createRole('create_ManageAdmin');
//$auth->createRole('delete_ManageAdmin');
//------------

//-- setting ---
$auth->createRole('view_Banner');
$auth->createRole('update_Banner');
$auth->createRole('create_Banner');
$auth->createRole('delete_Banner');
//------------

//-- admin photograph ---
$auth->createRole('view_AdminPhotograph');
$auth->createRole('update_AdminPhotograph');
$auth->createRole('create_AdminPhotograph');
$auth->createRole('delete_AdminPhotograph');
//------------

//-- admin photograph ---
$auth->createRole('view_Photograph');
$auth->createRole('update_Photograph');
$auth->createRole('create_Photograph');
$auth->createRole('delete_Photograph');
//------------

//-- setting ---
$auth->createRole('view_Setting');
$auth->createRole('update_Setting');
//------------

//-- newsletters ---
$auth->createRole('view_Newsletter');
$auth->createRole('update_Newsletter');
$auth->createRole('create_Newsletter');
$auth->createRole('delete_Newsletter');
//------------

//-- block ---
$auth->createRole('view_Block');
$auth->createRole('update_Block');
$auth->createRole('create_Block');
$auth->createRole('delete_Block');
//------------

//-- pages ---
$auth->createRole('view_Pages');
$auth->createRole('update_Pages');
//$auth->createRole('create_Pages');
//$auth->createRole('delete_Pages');
//------------

//-- member ---
$auth->createRole('view_Member');
$auth->createRole('update_Member');
$auth->createRole('create_Member');
$auth->createRole('delete_Member');
//------------

//-- business ---
$auth->createRole('view_Business');
$auth->createRole('update_Business');
$auth->createRole('create_Business');
$auth->createRole('delete_Business');
//------------

//-- business contact ---
$auth->createRole('view_BusinessContact');
$auth->createRole('update_BusinessContact');
$auth->createRole('create_BusinessContact');
$auth->createRole('delete_BusinessContact');
//------------

//-- franchise ---
$auth->createRole('view_Franchise');
$auth->createRole('update_Franchise');
$auth->createRole('create_Franchise');
$auth->createRole('delete_Franchise');
//------------

//-- franchise contact ---
$auth->createRole('view_FranchiseContact');
$auth->createRole('update_FranchiseContact');
//$auth->createRole('create_FranchiseContact');
$auth->createRole('delete_FranchiseContact');
//------------

//-- otherBusiness ---
$auth->createRole('view_OtherBusiness');
$auth->createRole('update_OtherBusiness');
$auth->createRole('create_OtherBusiness');
$auth->createRole('delete_OtherBusiness');
//------------

//-- otherBusiness contact ---
$auth->createRole('view_OtherBusinessContact');
$auth->createRole('update_OtherBusinessContact');
//$auth->createRole('create_OtherBusinessContact');
$auth->createRole('delete_OtherBusinessContact');
//------------

//-- country ---
$auth->createRole('view_Country');
$auth->createRole('update_Country');
$auth->createRole('create_Country');
$auth->createRole('delete_Country');
//------------

//-- location ---
$auth->createRole('view_Location');
$auth->createRole('update_Location');
$auth->createRole('create_Location');
$auth->createRole('delete_Location');
//------------

//--assign
$auth->assign('view_ManageAdmin','1');
$auth->assign('update_ManageAdmin','1');
$auth->assign('create_ManageAdmin','1');
//$auth->assign('delete_ManageAdmin','1');

$auth->assign('view_Banner','1');
$auth->assign('update_Banner','1');
$auth->assign('create_Banner','1');
$auth->assign('delete_Banner','1');

$auth->assign('view_AdminPhotograph', '1');
$auth->assign('update_AdminPhotograph', '1');
$auth->assign('create_AdminPhotograph', '1');
$auth->assign('delete_AdminPhotograph', '1');

$auth->assign('view_Photograph', '1');
$auth->assign('update_Photograph', '1');
$auth->assign('create_Photograph', '1');
$auth->assign('delete_Photograph', '1');


$auth->assign('view_Setting','1');
$auth->assign('update_Setting','1');

$auth->assign('view_Newsletter', '1');
$auth->assign('update_Newsletter', '1');
$auth->assign('create_Newsletter', '1');
$auth->assign('delete_Newsletter', '1');

$auth->assign('view_Block', '1');
$auth->assign('update_Block', '1');
$auth->assign('create_Block', '1');
$auth->assign('delete_Block', '1');

$auth->assign('view_Pages', '1');
$auth->assign('update_Pages', '1');
//$auth->assign('create_Pages', '1');
//$auth->assign('delete_Pages', '1');

$auth->assign('view_Member', '1');
$auth->assign('update_Member', '1');
$auth->assign('create_Member', '1');
$auth->assign('delete_Member', '1');

$auth->assign('view_Business', '1');
$auth->assign('update_Business', '1');
$auth->assign('create_Business', '1');
$auth->assign('delete_Business', '1');

$auth->assign('view_Franchise', '1');
$auth->assign('update_Franchise', '1');
$auth->assign('create_Franchise', '1');
$auth->assign('delete_Franchise', '1');

$auth->assign('view_OtherBusiness', '1');
$auth->assign('update_OtherBusiness', '1');
$auth->assign('create_OtherBusiness', '1');
$auth->assign('delete_OtherBusiness', '1');


$auth->assign('view_BusinessContact', '1');
$auth->assign('update_BusinessContact', '1');
$auth->assign('create_BusinessContact', '1');
$auth->assign('delete_BusinessContact', '1');

$auth->assign('view_FranchiseContact', '1');
$auth->assign('update_FranchiseContact', '1');
//$auth->assign('create_FranchiseContact', '1');
$auth->assign('delete_FranchiseContact', '1');

$auth->assign('view_OtherBusinessContact', '1');
$auth->assign('update_OtherBusinessContact', '1');
//$auth->assign('create_OtherBusinessContact', '1');
$auth->assign('delete_OtherBusinessContact', '1');

$auth->assign('view_Country', '1');
$auth->assign('update_Country', '1');
$auth->assign('create_Country', '1');
$auth->assign('delete_Country', '1');

$auth->assign('view_Location', '1');
$auth->assign('update_Location', '1');
$auth->assign('create_Location', '1');
$auth->assign('delete_Location', '1');
