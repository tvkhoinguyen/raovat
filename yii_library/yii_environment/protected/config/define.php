<?php 
$THEME_NAME = 'silverplan';
$THEME		= 'silverplan';
$TABLE_PREFIX = 'silverplan';

define('BE', 1);
define('FE', 2);

/**
 * <Define by Jason>
 * <Date: 20131002>
 */
define('DATE_DELETE_ORDER', 365);

define('ROLE_MANAGER', 1);
define('ROLE_ADMIN', 2);
define('ROLE_MEMBER', 3);

define('BANNER_1_WIDTH', 960);
define('BANNER_1_HEIGHT', 300);
define('BANNER_2_WIDTH', 230);
define('BANNER_2_HEIGHT', 69);

define('STATUS_INACTIVE', 0);
define('STATUS_ACTIVE', 1);
define('STATUS_NEW', 2);
define('STATUS_WAIT_ACTIVE_CODE', 3);

define('PASSW_LENGTH_MIN', 6);
define('PASSW_LENGTH_MAX', 32);
define('PHONE_LENGTH_MAX', 15);

define('IMAGE_ADMIN_WIDTH', 260);
define('IMAGE_ADMIN_HEIGHT', 200);

define('BANNER_CMS_ADMIN_WIDTH', 960);
define('BANNER_CMS_ADMIN_HEIGHT', 217);

define('IMAGE_ADMIN_THUMB_WIDTH', 117);
define('IMAGE_ADMIN_THUMB_HEIGHT', 90);


//max records in logger table
define('LOGGER_TABLE_MAX_RECORDS', 2000);

define('IMAGE_ADMIN_GALLERY_WIDTH', 560);
define('IMAGE_ADMIN_GALLERY_HEIGHT', 400);

define('IMAGE_ADMIN_GALLERY_THUMB_WIDTH', 153);
define('IMAGE_ADMIN_GALLERY_THUMB_HEIGHT', 111);

define('MAIL_CONTACT_US', 3);
define('MAIL_SEND_BUYER',11);
define('MAIL_SEND_ADMIN',4);
define('MAIL_APPLIED_EVENT',7);
define('MAIL_APPLIED_EVENT_TO_ADMIN',8);

define ('EDITOR_WIDTH','450px');
define ('EDITOR_HEIGHT','150px');

define ('PAGING_SEARCH',8);
define('PAGING_PROMOTION', 4);
define('PAGING_DOWNLOAD', 10);
define('MIN_LENGTH_AUTOCOMPLETE', 2);
define('MIN_LENGTH_AUTOCOMPLETE_ADMIN', 1);

//id page static
define ('PAGE_ABOUT_US',1);
define ('PAGE_STORE_LOCATOR',15);
define ('PAGE_CORPORATE_SITE',16);
define ('PAGE_SHIPPING',17);
define ('PAGE_TAX',18);
define ('PAGE_RETURN_EXCHANGE',19);
define ('PAGE_CAREERS',12);
define ('PAGE_FRANCHISING',20);
define ('PAGE_CORPORATE_SOCIAL',21);
define ('PAGE_LOYALTY_PROGRAM',22);
define ('PAGE_PRIVACY_POLICY',3);
define ('PAGE_TERM_OF_USE',2);
define ('PAGE_INDUSTRIES',4);
define ('PAGE_PARTNERS',5);
define ('PAGE_SERVICES',7);
define ('PAGE_CALENDAR',8);
define ('PAGE_NEW_ROOMS',9);
define ('PAGE_PROMOTIONS',10);
define ('PAGE_SUPPORT',11);
define ('PAGE_COMPANY_PROFILE',14);
define ('PAGE_CONTACT_US',13);
define ('PAGE_SITE_MAP',23);        
define ('PAGE_MISSION',24);        
define ('PAGE_OUR_VALUE',25);        
define ('PAGE_VALUE_PROP',26);        
define ('PAGE_FROM_DIRECTOR',27);   

define('USERNAME_LENGTH_MIN', 6);

define('GROUP_PUBLIC',2);
define('GROUP_MEMBER', 1);

define('BANNER_INDEX', 1);
define('BANNER_PARTNER', 3);
define('BANNER_PRODUCT', 4);
define('BANNER_GALLERY', 5);
define('BANNER_CONTACT', 6);
define('BANNER_CALENDAR', 7);
define('BANNER_SUPPORT', 9);
define('BANNER_PROMOTION', 10);

// Toan
define('VERZ_COOKIE_ADMIN', md5('verz_cookie_admin'));
define('VERZ_COOKIE', md5('verz_cookie'));
define('VERZLOGIN', md5('verz_login'));
define('VERZLPASS', md5('verz_pass'));
// Nguyen Dung
define('VERZ_COOKIE_MEMBER', md5('verz_cookie_member'));
define('VERZLOGIN_MEMBER', md5('verz_login_member'));
define('VERZLPASS_MEMBER', md5('verz_pass_member'));


//silver planet - Bao
define('PAYMENT_TYPE_PAYPAL', 'Paypal');
define('PAYMENT_TYPE_BANK_TRANSFER', 'Bank Transfer');

define('PAYMENT_STATUS_PENDING', 0);
define('PAYMENT_STATUS_PAID', 1);

define('TRANSACTION_JOIN_MEMBER', 'Join Member');
define('TRANSACTION_BUY_PACKAGE', 'Buy Shop');
define('TRANSACTION_BUY_PRODUCT', 'Buy Product');
define('TRANSACTION_RECEIVE_COMMISSION', 'Receive Commission');
define('TRANSACTION_REFUND_COINS', 'Back Sell Coins');

define('PAGE_PAYPAL_RETURN_COMPLETED', 33);
define('PAGE_PAYPAL_RETURN_UNCOMPLETED', 34);
define('PAGE_PAYPAL_CANCEL', 35);
define('PAGE_PAYMENT_BANK_TRANSFER', 36);
define('PAGE_AFFILIATE_SUBMISSION_FORM_SUCCESS', 37);

define('EMAIL_JOIN_MEMBER_SUCCESS', 9);
define('EMAIL_AFFILIATE_SUBMISSION_FORM_SUCCESS', 10);
define('EMAIL_BUY_COIN_SUCCESS', 6);

?>