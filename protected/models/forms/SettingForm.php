<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class SettingForm extends CFormModel {

    //email
    public $transportType; //php or smtp
    public $smtpHost;
    public $smtpUsername;
    public $smtpPassword;
    public $smtpPort;
    public $encryption;
    public $adminEmail;
    public $autoEmail;
    public $mailSenderName;
    //general
    public $currencySign;
    public $dateFormat;
    public $timeFormat;
    public $loginLimitTimes;
    public $timeRefreshLogin;
    public $defaultPageSize;
    public $googleAnalytics;
    // public $regnNumber;
    public $maxDayPrintSolution;
    //contact info
    public $companyName;
    public $companyAddress;
    public $mobileNumber;
    public $phoneNumber;
    public $faxNumber;
    public $emailContact;
    public $openHour;
    //paypal
    public $paypalURL;
    public $paypalBusinessEmail;
    public $paypalMode;
    public $paypalMinimum;
    public $paypalCurrency;
    //page setting
    public $baseUrl;
    public $projectName;
    public $defaultPageTitle;
    public $metaDescription;
    public $metaKeywords;
    public $twitter;
    public $facebook;
    public $tumblr;
    public $instagram;
    public $linkedin;
    public $rss;
    public $copyrightOnFooter;
    //mailchimp
    public $mailchimpOn;
    public $mailchimpApiKey;
    public $mailchimpListId;
    public $mailchimpTitleGroups;
    //Nguyen
//    public $f_address;
//    public $f_email;
//    public $f_phone;
//
//    public $link_see_us_youtube;
//    public $pageSizeListTin;
    
    //Rao vat thang bom
    public $rao_vat_sdt_trai;	
    public $rao_vat_sdt_phai;	
    public $rao_vat_email;	
    public $rao_vat_link_tin_tuc;	
    public $rao_vat_link_forum;	
    public $rao_vat_link_quang_cao;	

    public $pagesize_raovat_hot;
    public $pagesize_raovat_khac;

    public static $smtpFields = array('host' => 'smtpHost', 'username' => 'smtpUsername', 'password' => 'smtpPassword',
        'port' => 'smtpPort', 'encryption' => 'encryption');

    /*
     * Austin added date 6/7/2014
     * First element of array is Group Name
     * Items inside are controls in each tab. You should put enough attributes as below to get rid errors
     * Now it just support control text, textarea, editor (add html class my-editor-basic or my-editor-full), image, dropdown
     * Feel free to add more 
     */
    public function attributeLabels()
    {
        return array(
            'link_see_us_youtube'=>'Link See Us on Youtube',
        );
    }

    public static $settingDefine = array(
        "pagesetting" => array(
            'label' => 'Website',
            'htmlOptions' => array(),
            'items' => array(
                array('name' => 'baseUrl', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => 'required'),
                array('name' => 'projectName', 'controlTyle' => 'text', 'notes' => 'For backend only', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => ''),
                // array('name' => 'regnNumber', 'controlTyle' => 'text', 'notes' => 'For backend only', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => 'required'),
                array('name' => 'defaultPageTitle', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => 'required'),
                array('name' => 'metaDescription', 'controlTyle' => 'textarea', 'notes' => '', 'unit' => '', 'htmlOptions' => array('cols' => 77, 'rows' => 4), 'rules' => ''),
                array('name' => 'metaKeywords', 'controlTyle' => 'textarea', 'notes' => '', 'unit' => '', 'htmlOptions' => array('cols' => 77, 'rows' => 4), 'rules' => ''),
                // array('name' => 'twitter', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => ''),
                // array('name' => 'facebook', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => ''),
                // array('name' => 'tumblr', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => ''),
                // array('name' => 'instagram', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => ''),
                // array('name' => 'googleAnalytics', 'controlTyle' => 'textarea', 'notes' => '', 'unit' => '', 'htmlOptions' => array('cols' => 77, 'rows' => 4), 'rules' => ''),
                // array('name' => 'copyrightOnFooter', 'controlTyle' => 'textarea', 'notes' => '', 'unit' => '', 'htmlOptions' => array('class' => 'my-editor-basic'), 'rules' => ''),
            ),
        ),
        "generalsetting" => array(
            'label' => 'General',
            'htmlOptions' => array(),
            'items' => array(
                // array('name' => 'pageSizeListTin', 'controlTyle' => 'text', 'notes' => 'Số lượng tin hiển thị trong mỗi danh mục', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => ''),
                array('name' => 'currencySign', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => ''),
                array('name' => 'dateFormat', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => 'required'),
                array('name' => 'timeFormat', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => 'required'),
                array('name' => 'loginLimitTimes', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => 'required,numerical'),
                array('name' => 'timeRefreshLogin', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => 'required,numerical'),
                array('name' => 'defaultPageSize', 'controlTyle' => 'text', 'notes' => '', 'unit' => 'records per page', 'htmlOptions' => array('size' => 80), 'rules' => 'required,numerical'),
                // array('name' => 'max_quantity_cart', 'controlTyle' => 'text', 'notes' => '', 'unit' => 'records per page', 'htmlOptions' => array('size' => 80), 'rules' => 'required,numerical'),
                // array('name' => 'maxDayPrintSolution', 'controlTyle' => 'text', 'notes' => '', 'unit' => 'day', 'htmlOptions' => array('size' => 80), 'rules' => 'required,numerical'),
            ),
        ),
        "emailsetting" => array(
            'label' => 'Email',
            'htmlOptions' => array(),
            'items' => array(
                array('name' => 'mailSenderName', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => 'required'),
                array('name' => 'adminEmail', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => 'required,email'),
                array('name' => 'autoEmail', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => 'required,email'),
                array('name' => 'transportType', 'controlTyle' => 'dropdown', 'notes' => '', 'unit' => '', 'htmlOptions' => array(), 'data' => array('' => 'PHP', 'smtp' => 'Smtp'), 'rules' => ''),
                array('name' => 'smtpHost', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => ''),
                array('name' => 'smtpUsername', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => ''),
                array('name' => 'smtpPassword', 'controlTyle' => 'password', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => ''),
                array('name' => 'smtpPort', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => ''),
                array('name' => 'encryption', 'controlTyle' => 'dropdown', 'notes' => '', 'unit' => '', 'data' => array('' => 'None', 'ssl' => 'SSL', 'tls' => 'TLS'), 'rules' => ''),
            ),
        ),
        // "contactsetting" => array(
        //     'label' => 'Contact',
        //     'htmlOptions' => array(),
        //     'items' => array(
        //         array('name' => 'companyName', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => ''),
        //         array('name' => 'companyAddress', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => ''),
        //         array('name' => 'mobileNumber', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => ''),
        //         array('name' => 'phoneNumber', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => ''),
        //         array('name' => 'faxNumber', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => ''),
        //         array('name' => 'emailContact', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => ''),
        //         // array('name' => 'openHour', 'controlTyle' => 'textarea', 'notes' => '', 'unit' => '', 'htmlOptions' => array('cols' => 77, 'rows' => 4, 'class' => 'my-editor-basic'), 'rules' => ''),
        //     ),
        // ),

        // "paypalsetting" => array(
        //     'label' => 'Paypal',
        //     'htmlOptions' => array(),
        //     'items' => array(
        //         array('name' => 'paypalURL', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => ''),
        //         array('name' => 'paypalBusinessEmail', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => ''),
        //         array('name' => 'paypalMode', 'controlTyle' => 'dropdown', 'notes' => '', 'unit' => '', 'htmlOptions' => array(), 'data' => array('live' => 'Live Paypal', 'test' => 'Test Paypal'), 'rules' => ''),
        //         array('name' => 'paypalMinimum', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => ''),
        //         array('name' => 'paypalCurrency', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => ''),
        //     ),
        // ),
        "header_top" => array(
            'label' => 'Rao Vat Header',
            'htmlOptions' => array(),
            'items' => array(
                array('name' => 'rao_vat_sdt_trai', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => 'required'),
                array('name' => 'rao_vat_sdt_phai', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => 'required'),
                array('name' => 'rao_vat_email', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => 'required'),
                array('name' => 'rao_vat_link_tin_tuc', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => 'required'),
                array('name' => 'rao_vat_link_forum', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => 'required'),
                array('name' => 'rao_vat_link_quang_cao', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => 'required'),
            ),
        ),
        "phan_trang" => array(
            'label' => 'Page Size',
            'htmlOptions' => array(),
            'items' => array(
                array('name' => 'pagesize_raovat_hot', 'controlTyle' => 'text', 'notes' => 'Số tin trên 1 trang của Rao vặt HOT', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => 'required, numerical'),
                array('name' => 'pagesize_raovat_khac', 'controlTyle' => 'text', 'notes' => 'Số tin trên 1 trang của Rao vặt Khác', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => 'required, numerical'),
            ),
        ),
        
//        "footer_info" => array(
//            'label' => 'Footer Infomation',
//            'htmlOptions' => array(),
//            'items' => array(
//                array('name' => 'f_address', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => 'required'),
//                array('name' => 'f_email', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => 'required'),
//                array('name' => 'f_phone', 'controlTyle' => 'text', 'notes' => '', 'unit' => '', 'htmlOptions' => array('size' => 80), 'rules' => 'required'),
//            ),
//        ),
    );

    public function rules() {
        $return = array();
        // for reuired attribute
        $requiredRule = self::getRules('required');
        if ($requiredRule != '')
            $return [] = array($requiredRule, 'required');

        // for numerical attribute
        $numerical = self::getRules('numerical');
        if ($numerical != '')
            $return [] = array($numerical, 'numerical', 'integerOnly' => true);

        // for email attribute
        $email = self::getRules('email');
        if ($email != '')
            $return [] = array($email, 'email');

        // for file attribute
        $file = self::getRules('file');
        if ($file != '') {
            $return[] = array($file, 'file', 'on' => 'updateSettings',
                'allowEmpty' => true,
                'types' => 'jpg,gif,png,tiff',
                'wrongType' => 'Only jpg,gif,png,tiff allowed',
                'maxSize' => 1024 * 1024 * 3, // 8MB
                'tooLarge' => 'The file was larger than 3MB. Please upload a smaller file.',
            );
            $return[] = array('$file', 'match', 'pattern' => '/^[^\\/?*:&;{}\\\\]+\\.[^\\/?*:&;{}\\\\]{3}$/', 'message' => 'Upload files name cannot include special characters: &%$#', 'on' => 'updateSettings');
        }
        // for safe attribute
        $return[] = array(implode(',', self::getAllAttributes()), 'safe');
        return $return;
    }

    /*
     * Austin added date 6/7/2014
     * Override configurations.
     * This function is called in index.php and cron.php in root 
     */

    public static function applySettings() {
        $attributeList = self::getAllAttributes();
        if ($attributeList && is_array($attributeList)) {
            foreach ($attributeList as $item) {
                //check tranport type
                if ($item == 'transportType' && Yii::app()->setting->getItem($item)) {
                    Yii::app()->mail->transportType = Yii::app()->setting->getItem($item);
                }
                //get SMTP info
                if (Yii::app()->mail->transportType == 'smtp') {
                    if (in_array($item, self::$smtpFields)) {
                        if (Yii::app()->setting->getItem($item)) {
                            foreach (self::$smtpFields as $k => $v) {
                                if ($v == $item)
                                    Yii::app()->mail->transportOptions[$k] = Yii::app()->setting->getItem($item);
                            }
                        }
                    }
                }
                else {
                    Yii::app()->mail->transportOptions = '';
                }

                // none SMTP fields
                if (!in_array($item, self::$smtpFields) && Yii::app()->setting->getItem($item)) {
                    Yii::app()->params[$item] = Yii::app()->setting->getItem($item);
                }
            }
        }
    }

    /*
     * Austin added date 6/7/2014
     * get all attributes from setting array
     */

    public static function getAllAttributes() {
        $attributes = array();
        if (self::$settingDefine && is_array(self::$settingDefine)) {
            foreach (self::$settingDefine as $item) {
                $itemObj = (object) $item;
                if ($itemObj->items && is_array($itemObj->items)) {
                    foreach ($itemObj->items as $setItem) {
                        $setItem = (object) $setItem;
                        $attributes[] = $setItem->name;
                    }
                }
            }
        }
        return $attributes;
    }

    /*
     * Austin added date 7/7/2014
     * Build model vaidate rule
     */

    protected static function getRules($ruleName) {
        $attributes = array();
        if (self::$settingDefine && is_array(self::$settingDefine)) {
            foreach (self::$settingDefine as $item) {
                $itemObj = (object) $item;
                if ($itemObj->items && is_array($itemObj->items)) {
                    foreach ($itemObj->items as $setItem) {
                        $setItem = (object) $setItem;
                        if (strpos($setItem->rules, $ruleName) !== false)
                            $attributes[] = $setItem->name;
                    }
                }
            }
        }
        return implode(',', $attributes);
    }

}
