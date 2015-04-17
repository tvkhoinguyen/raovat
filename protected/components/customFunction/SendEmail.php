<?php
/**
 * All sendmail function should be placed here.
 * Custom For Each Project
 */
class SendEmail
{
    //KNguyen
    //User login and change user's password
    public static function changePassMailToUser($contactM)
    {
        
        $aBody = array(
            '{FULL_NAME}'=> $contactM->first_name.' '.$contactM->last_name,
            '{PASSWORD}' => $contactM->temp_password ,
            '{LINK_LOGIN}' =>'<a href="'. Yii::app()->createAbsoluteUrl('site/index').'" >here</a>',
        );

        $aSubject = array(
            '{FULL_NAME}'=>$contactM->first_name.' '.$contactM->last_name,
        );

        if( CmsEmail::sendmail(MAIL_CHANGE_PASSWORD_TO_USER, $aSubject, $aBody, $contactM->email  ))
        {}
        else
            $contactM->addError('email','Can not send email to: '.$contactM->email);

    }


    public static function mailRequestToAdmin($contactM)
    {
//         {FULL_NAME}: title+first+last
// {EMAIL}
// {PHONE}
// {TYPE_OF_SOLUTION}
// {CATEGORY}
// {PRINT_REQUIREMENT}
// {COLLECT_DATE}
// {ATTACHMENT}
        $aBody = array(
            '{RFQ_CODE}'=>$contactM->code,
            '{FULL_NAME}'=>$contactM->first_name.' '.$contactM->last_name,
            '{EMAIL}'=>$contactM->email,
            '{PHONE}'=>$contactM->phone,
            '{TYPE_OF_SOLUTION}'=>Request::$type_of_solution[$contactM->type_of_solution],
            '{CATEGORY}'=>$contactM->category,
            '{PRINT_REQUIREMENT}'=>$contactM->print_requirement,
            '{COLLECT_DATE}'=> DateHelper::toDateFormat( $contactM->collect_date ),
            '{ATTACHMENT}' => !empty($contactM->attachment) ? '<a href="'. Yii::app()->createAbsoluteUrl('/').'/upload/request/'.$contactM->id.'/'.$contactM->attachment.'" >here</a>' : '',
        );

        $aSubject = array(
            '{FULL_NAME}'=>$contactM->first_name.' '.$contactM->last_name,
        );

        if( CmsEmail::sendmail(MAIL_ADMIN_REQUEST, $aSubject, $aBody, Yii::app()->setting->getItem('adminEmail')  ))
        {}
        else
            $contactM->addError('email','Can not send email to: '.$contactM->email);
    }
    public static function mailRequestToUser($contactM)
    {
        $aBody = array(
            '{RFQ_CODE}'=>$contactM->code,
            '{FULL_NAME}'=>$contactM->first_name.' '.$contactM->last_name,
            '{EMAIL}'=>$contactM->email,
            '{PHONE}'=>$contactM->phone,
            '{TYPE_OF_SOLUTION}'=>Request::$type_of_solution[$contactM->type_of_solution],
            '{CATEGORY}'=>$contactM->category,
            '{PRINT_REQUIREMENT}'=>$contactM->print_requirement,
            '{COLLECT_DATE}'=> !empty($contactM->collect_date) ? DateHelper::toDateFormat( $contactM->collect_date ): "",
            '{ATTACHMENT}' => !empty($contactM->attachment) ? '<a href="'. Yii::app()->createAbsoluteUrl('/').'/upload/request/'.$contactM->id.'/'.$contactM->attachment.'" >here</a>' : '',
        );

        $aSubject = array(
            '{FULL_NAME}'=>$contactM->first_name.' '.$contactM->last_name,
        );

        if( CmsEmail::sendmail(MAIL_USER_REQUEST, $aSubject, $aBody, $contactM->email  ))
        {}
        else
            $contactM->addError('email','Can not send email to: '.$contactM->email);
    }
    
    
    public static function registerSucceedMailToUser($contactM)
    {
        //Send to User {EMAIL}: email {PASSWORD} {FULL_NAME} {LINK_LOGIN}: link login
        $aBody = array(
            '{FULL_NAME}'=>$contactM->full_name,
            '{EMAIL}'=>$contactM->email,
            '{PASSWORD}'=>$contactM->temp_password,
            '{LINK_LOGIN}' =>'<a href="'. Yii::app()->createAbsoluteUrl('site/index').'" >here</a>',
        );

        $aSubject = array(
            '{FULL_NAME}'=>$contactM->full_name,
        );

        if( CmsEmail::sendmail(MAIL_REGISTER_SUCCEED_TO_MEMBER, $aSubject, $aBody, $contactM->email  ))
        {}
        else
            $contactM->addError('email','Can not send email to: '.$contactM->email);
    }
    public static function registerSucceedMailToAdmin($contactM)
    {
        //{EMAIL}: email{PASSWORD}{FULL_NAME} 
        $aBody = array(
            '{FULL_NAME}'=>$contactM->full_name,
            '{EMAIL}'=>$contactM->email,
            '{PASSWORD}'=>$contactM->temp_password,
        );

        $aSubject = array(
            '{FULL_NAME}'=>$contactM->full_name,
        );

        if( CmsEmail::sendmail(MAIL_REGISTER_SUCCEED_TO_ADMIN, $aSubject, $aBody, Yii::app()->setting->getItem('adminEmail')  ))
        {}
        else
            $contactM->addError('email','Can not send email to: '.$contactM->email);
    }
    

    //adminChangeUserBE
    public static function adminChangeUserBE($model) 
    {
        // {FULL_NAME} 
        // {EMAIL} 
        // {PASSWORD} 
        // {CONTACT_FIRST_NAME} 
        // {CONTACT_LAST_NAME} 
        // {PHONE} 
        // {FAX} 
        // {COMPANY} 
        // {ADDRESS1} 
        // {ADDRESS2} 
        // {POSTAL_CODE} 
        // {CITY} {STATE} {COUNTRY}
        $aBody = array(
            '{FULL_NAME}' => $model->full_name,
            '{EMAIL}' => $model->email,
            '{PASSWORD}' => $model->temp_password,
            '{CONTACT_FIRST_NAME}' => $model->contact_first_name,
            '{CONTACT_LAST_NAME}' => $model->contact_last_name,

            '{PHONE}' => $model->phone,
            '{FAX}' => $model->fax,
            '{COMPANY}' => $model->company,
            '{ADDRESS1}' => $model->address1,
            '{ADDRESS2}' => $model->address2,
            '{POSTAL_CODE}' => $model->postal_code,
            '{CITY}' => $model->city,
            '{STATE}' => $model->state,
            '{COUNTRY}' => $model->area_code->area_name,
            '{STATUS}' => Yii::app()->format->status($model->status) ,

        );
        $aSubject = array();
        if( CmsEmail::sendmail(29, $aSubject, $aBody, $model->email ))
        {
            
        } else
            $contactM->addError('email','Can not send email to: '.$model->email);
    }
    /*
     * Huu Thoa
     */
    public static function adminResetPassword($model) {
        $aBody = array(
            '{NAME}' => $model->first_name,
            '{PASSWORD}' => $model->temp_password,
        );
        $aSubject = array();
        if( CmsEmail::sendmail(MAIL_ADMIN_RESET_PASS, $aSubject, $aBody, $model->email ))
        {
            
        } else
            $contactM->addError('email','Can not send email to: '.$model->email);
    }

    //registering successfully, send email to User - bb
    public static function registerSucceedToUser($mUser){
        $param = $mUser->getParamArray();
//        echo '<pre>';
//        print_r($param);
//        echo '<pre>';
//        exit;
        $loginLink = '<a href="' . Yii::app()->createAbsoluteUrl("site/login") . '">' . Yii::app()->createAbsoluteUrl("site/login") . '</a>';
        $param['{FULL_NAME}'] = !empty($mUser->full_name) ? $mUser->full_name : $mUser->first_name.' '.$mUser->last_name;
        $param['{PASSWORD}'] = $mUser->temp_password;
        $param['{LINK_LOGIN}'] = $loginLink;
        $param['{COUNTRY}'] = $mUser->area_code->area_name;

        if(CmsEmail::sendmail(MAIL_REGISTER_SUCCEED_TO_MEMBER, $param, $mUser->email)){

        }else $mUser->addError('status', 'Can not send email');
    }

    //KNguyen User MAIL_FORGET_PASSWORD
    //send email to User for forgetting password  - bb
    public static function forgotPasswordToUser($mUser)
    {
        $mUser->verify_code = Users::model()->checkVerifyCode(rand(100000, 1000000)); // Gen verify code and send qua mail or sms
        $mUser->update('verify_code');
        $resetlink = '<a href="' . Yii::app()->createAbsoluteUrl("site/resetPassword", array('verify_code'=>$mUser->verify_code)) . '">RESET PASSWORD NOW</a>';
        //
        $aBody = array(
            // '{FULL_NAME}'   => !empty($mUser->full_name) ? $mUser->full_name : $mUser->first_name.' '.$mUser->last_name,
            '{FULL_NAME}'   => $mUser->full_name,
            '{EMAIL}' => $mUser->email,
            '{RESET_LINK}'  => $resetlink,
        );
       $aSubject = array(
            '{FULL_NAME}'=> $mUser->full_name,
        );
        if(CmsEmail::sendmail(MAIL_FORGET_PASSWORD, $aSubject, $aBody, $mUser->email))
        {
        }else $mUser->addError('status', 'Can not send email');
    }

    //send email to User for changing password
    public static function changePassToUser($mUser){
        $name = $mUser->full_name;
        $login_link = '<a href="'.Yii::app()->createAbsoluteUrl("site/login").'">'.Yii::app()->createAbsoluteUrl("site/login").'</a>';
        $param = array(
            '{FULL_NAME}'=>$name,
            '{PASSWORD}'=>$mUser->temp_password,
            '{LINK_LOGIN}' =>$login_link,
        );

        if(CmsEmail::sendmail(MAIL_CHANGE_PASSWORD_TO_USER, $param, $mUser->email))
            Yii::app()->user->setFlash("success", "An email has sent to: $mUser->email. Please check email to get new password.");
        else
            $mUser->addError('email','Can not send email to: '.$mUser->email);

    }

    //Submitting contact form successfully, send email to confirm User
    //Contact Us send mail to User
    public static function confirmContactMailToUser($contactM)
    {
        // $enquiry = SpEnquiryTypes::model()->findByPk($contactM->enquiry_type);
        $param = array(
            '{NAME}'=>$contactM->name,
            '{EMAIL}'=>$contactM->email,
            '{PHONE}' => $contactM->phone,
            '{MESSAGE}' =>$contactM->message,
            '{COMPANY}' =>$contactM->company,
            // '{ENQUIRY}' => $enquiry->name
        );

        $aSubject = array(
            '{NAME}'=>$contactM->name,
            '{EMAIL}'=>$contactM->email,
            '{MESSAGE}' =>$contactM->message,
        );

        if(CmsEmail::sendmail(MAIL_CONTACT_US_TO_USER,$aSubject,$param, $contactM->email)){}
        else
            $contactM->addError('email','Can not send email to: '.$contactM->email);
    }

    //Submitting contact form successfully, send email to Administrator
    //Contact Us send mail to Admin
    public static function sendContactMailToAdmin($contactM)
    {
        // $enquiry = SpEnquiryTypes::model()->findByPk($contactM->enquiry_type);
        $aBody = array(
            '{NAME}'=>$contactM->name,
            '{EMAIL}'=>$contactM->email,
            '{MESSAGE}' =>$contactM->message,
            '{PHONE}' => $contactM->phone,
            '{COMPANY}' =>$contactM->company,
            // '{ENQUIRY}' => $enquiry->name
        );

        $aSubject = array(
            '{NAME}'=>$contactM->name,
        );

        if( CmsEmail::sendmail(MAIL_CONTACT_US_TO_ADMIN, $aSubject, $aBody, Yii::app()->params['adminEmail'])){}
        else
            $contactM->addError('email','Can not send email to: '.$contactM->email);
    }

    //Nguyen after submit Request, send mail to admin and user(who send request)
    public static function sendRequestMailToAdmin($contactM)
    {
        $aBody = array(
            '{CASE_ID}'=> $contactM->case_id,
            '{FULL_NAME}'=>$contactM->full_name,
            '{EMAIL}'=>$contactM->email,
            '{LINK}' =>'<a href="'. Yii::app()->createAbsoluteUrl('admin/manageRequests/view', array('id'=>$contactM->id)).'" >here</a>',
            '{WEBSITE}'=>'<a href="'. Yii::app()->createAbsoluteUrl('/').'" >'.Yii::app()->createAbsoluteUrl('/').'</a>',
            //{CASE_ID} {FULL_NAME} {EMAIL} {LINK} {WEBSITE}
        );

        $aSubject = array(
            // '{FULL_NAME}'=>$contactM->full_name,
        );

        if( CmsEmail::sendmail(MAIL_REQUEST_A_TUTOR_TO_ADMIN, $aSubject, $aBody, Yii::app()->setting->getItem('adminEmail')  )){}
        else
            $contactM->addError('email','Can not send email to: '.$contactM->email);
    }

    //Nguyen after submit Request, send mail to user(who send request)
    public static function sendRequestMailToUser($contactM)
    {
        $aBody = array(
            '{FULL_NAME}'=>$contactM->full_name,
            '{CASE_ID}'=>$contactM->case_id,
            '{WEBSITE}'=>'<a href="'. Yii::app()->createAbsoluteUrl('/').'" >'.Yii::app()->createAbsoluteUrl('/').'</a>',
            '{ADMIN_EMAIL}'=> Yii::app()->setting->getItem('adminEmail') ,
            '{PHONE}' => Yii::app()->setting->getItem('contact_number') ,
            //{FULL_NAME} {CASE_ID} {WEBSITE} {ADMIN_EMAIL}
        );

        $aSubject = array(
            // '{FULL_NAME}'=>$contactM->full_name,
        );

        if( CmsEmail::sendmail(MAIL_REQUEST_A_TUTOR_TO_USER, $aSubject, $aBody, $contactM->email  )){}
        else
            $contactM->addError('email','Can not send email to: '.$contactM->email);
    }

    //Nguyen admin approve request
    public static function sendApproveRequestMailToUser($contactM)
    {
        $aBody = array(
            '{FULL_NAME}'=>$contactM->full_name,
            '{CASE_ID}'=>$contactM->case_id,
            '{WEBSITE}'=>'<a href="'. Yii::app()->createAbsoluteUrl('/').'" >'.Yii::app()->createAbsoluteUrl('/').'</a>',
            // '{LINK}' =>'<a href="'. Yii::app()->createAbsoluteUrl('site/tutorDetail', array('id'=>$contactM->id)).'" >here</a>',
            //{FULL_NAME} {CASE_ID} {LINK} {WEBSITE}
        );

        $aSubject = array(
            // '{FULL_NAME}'=>$contactM->full_name,
        );

        if( CmsEmail::sendmail(MAIL_AFTER_APPROVE_REQUEST_TO_USER, $aSubject, $aBody, $contactM->email  )){}
        else
            $contactM->addError('email','Can not send email to: '.$contactM->email);
    }

    //Nguyen admin reject request
    public static function sendRejectRequestMailToUser($contactM)
    {
        $aBody = array(
            '{FULL_NAME}'=>$contactM->full_name,
            '{CASE_ID}'=>$contactM->case_id,
            '{WEBSITE}'=>'<a href="'. Yii::app()->createAbsoluteUrl('/').'" >'.Yii::app()->createAbsoluteUrl('/').'</a>',
            //{FULL_NAME} {CASE_ID} {WEBSITE}
        );

        $aSubject = array(
            // '{FULL_NAME}'=>$contactM->full_name,
        );

        if( CmsEmail::sendmail(MAIL_AFTER_REJECT_REQUEST_TO_USER, $aSubject, $aBody, $contactM->email  )){}
        else
            $contactM->addError('email','Can not send email to: '.$contactM->email);
    }


    public static function noticeContactMailToAdmin($contactM){
        $param = array(
            '{NAME}'=>$contactM->name,
            '{EMAIL}'=>$contactM->email,
            '{PHONE}' =>$contactM->phone,
            '{MESSAGE}' =>$contactM->message,
        );

        $aSubject = array(
            '{NAME}'=>$contactM->name,
            '{EMAIL}'=>$contactM->email,
            '{PHONE}' =>$contactM->phone,
            '{MESSAGE}' =>$contactM->message,
        );

        if(CmsEmail::sendmail(MAIL_CONTACT_US_TO_ADMIN,$aSubject,$param, Yii::app()->params['adminEmail'])){}
        else
            $contactM->addError('email','Can not send email to: '.$contactM->email);
    }

    //mail from Forgot Password at BE
    public static function verifyResetPasswordToAdmin($mUser){
        $name = $mUser->full_name;
        $key = ForgotPasswordForm::generateKey($mUser);
        $forgot_link = '<a href="'.Yii::app()->createAbsoluteUrl('/admin/site/resetPassword',array('id'=>$mUser->id, 'key'=>$key)).'">'.Yii::app()->createAbsoluteUrl('/admin/site/ResetPassword',array('id'=>$mUser->id, 'key'=>$key)).'</a>';

        $param = array(
            '{NAME}'=>$name,
            '{USERNAME}'=>$mUser->username,
            '{EMAIL}'=>$mUser->email,
            '{LINK}' =>$forgot_link,
        );
        $aSubject = array(
            '{NAME}'=>$name,
            '{USERNAME}'=>$mUser->username,
            '{EMAIL}'=>$mUser->email,
            '{LINK}' =>$forgot_link,
        );

        // if(CmsEmail::sendmail(MAIL_VERIFY_TO_RESET_PASSWORD_TO_ADMIN,$aSubject,$param, Yii::app()->setting->getItem('adminEmail') ))
        if(CmsEmail::sendmail(MAIL_VERIFY_TO_RESET_PASSWORD_TO_ADMIN,$aSubject,$param, $mUser->email ))
            Yii::app()->user->setFlash("success", "An email has sent to: $mUser->email. Please check email to verify this action.");
        else
            $mUser->addError('email','Can not send email.');
    }

    //mail to reset password after admin agreed verify email at BE
    public static function resetPasswordToAdmin($mUser){
        $name = $mUser->full_name;
        $login_link = '<a href="'.Yii::app()->createAbsoluteUrl("admin/site/login").'">'.Yii::app()->createAbsoluteUrl("admin/site/login").'</a>';
        $param = array(
            '{NAME}'=>$name,
            '{PASSWORD}'=>$mUser->temp_password,
            '{LINK_LOGIN}' =>$login_link,
        );

        $aSubject = array(
            '{NAME}'=>$name,
            '{PASSWORD}'=>$mUser->temp_password,
            '{LINK_LOGIN}' =>$login_link,
        );

        // if(CmsEmail::sendmail(MAIL_RESET_PASSWORD_TO_ADMIN,$aSubject,$param, Yii::app()->setting->getItem('adminEmail')  ))
        if(CmsEmail::sendmail(MAIL_RESET_PASSWORD_TO_ADMIN,$aSubject,$param, $mUser->email  ))
            Yii::app()->user->setFlash("success", "An email has sent to: $mUser->email. Please check email to get new password.");
        else
            $mUser->addError('email','Can not send email to: '.$mUser->email);
    }

    //mail to change password successfully from "Change password form" at BE
    public static function noticeChangPasswordSucceedToAdmin($mUser){
        $name = $mUser->full_name;
        $login_link = '<a href="'.Yii::app()->createAbsoluteUrl("admin/site/login").'">'.Yii::app()->createAbsoluteUrl("admin/site/login").'</a>';
        $param = array(
            '{NAME}'=>$name,
            '{PASSWORD}'=>$mUser->temp_password,
            '{LINK_LOGIN}' =>$login_link,
        );

        $aSubject = array(
            '{NAME}'=>$name,
            '{PASSWORD}'=>$mUser->temp_password,
            '{LINK_LOGIN}' =>$login_link,
        );

//        if(EmailHelper::send(MAIL_CHANGE_PASSWORD_TO_ADMIN,$aSubject,$param, Yii::app()->params['adminEmail']))
        if(CmsEmail::sendmail(MAIL_CHANGE_PASSWORD_TO_ADMIN,$aSubject,$param, Yii::app()->params['adminEmail']))
            Yii::app()->user->setFlash("success", "An email has sent to: $mUser->email. Please check email to get new password.");
        else
            $mUser->addError('email','Can not send email to: '.$mUser->email);
    }
    
    //HTram
    //send email to member - register to download exam papers
    public static function registerSucceedToParent($mUser){
        $loginLink = '<a href="' . Yii::app()->createAbsoluteUrl("/") . '">' . Yii::app()->createAbsoluteUrl("/") . '</a>';
        $aBody = array(
            '{FULL_NAME}'   => !empty($mUser->full_name) ? $mUser->full_name : $mUser->first_name.' '.$mUser->last_name,
            '{PASSWORD}'    => $mUser->temp_password,
            '{LINK_LOGIN}'   => $loginLink,
            '{COUNTRY}'    => $mUser->area_code->area_name,
            '{PHONE}'       => $mUser->phone,
            '{EMAIL}' => $mUser->email,
        );
       $aSubject = array(
            '{FULL_NAME}'=> $mUser->full_name,
        );
        if(CmsEmail::sendmail(MAIL_REGISTER_SUCCEED_TO_MEMBER_TO_DOWNLOAD, $aSubject, $aBody, $mUser->email)){

        }else $mUser->addError('status', 'Can not send email');
        
    }
     //HTram
    //send email to admin - member register to download exam papers
    
    public static function registerSucceedToAdmin($mUser){
        $role = "";
        if($mUser->role_id == Users::ROLE_TUTOR){
            $role = "Tutor";
        }elseif($mUser->role_id == Users::ROLE_PARENT){
            $role = "Member to download Exam Pappers";
        }
        
        $aBody = array(
            '{FULL_NAME}'   => !empty($mUser->full_name) ? $mUser->full_name : $mUser->first_name.' '.$mUser->last_name,
            '{PASSWORD}'    => $mUser->temp_password,
            '{ROLE_USER}'   => $role,
            '{COUNTRY}'    => $mUser->area_code->area_name,
            '{PHONE}'       => $mUser->phone,
            '{EMAIL}' => $mUser->email,
        );
       $aSubject = array(
            '{FULL_NAME}'=> $mUser->full_name,
        );
        if(CmsEmail::sendmail(MAIL_REGISTER_SUCCEED_TO_ADMIN, $aSubject, $aBody, Yii::app()->params['adminEmail'])){

        }else $mUser->addError('status', 'Can not send email');
    }
    //hbao
    public static function sendSucRegToTutor($tutor)
    {
        $aBody = array(
            '{FULL_NAME}'=>$tutor->full_name,
            // '{EMAIL}'=>$tutor->email,
            // '{PHONE}' =>$tutor->phone,
            // '{MOBILE}' =>$tutor->mobile,
            // '{GENDER}' =>$tutor->gender,
            // '{COUNTRY}' =>$tutor->country_fk->area_name,
            // '{NRIC}' =>$tutor->nric,
            // '{RACE}' =>$tutor->race_fk->name,
            // '{DOB}' =>date('d/m/Y', strtotime($tutor->date_of_birth)),
            // '{ADDRESS1}' =>$tutor->address1,
            // '{ADDRESS2}' =>$tutor->address2,
            // '{POSTAL_CODE}' =>$tutor->postal_code,
            // '{EDUCATION_STATUS}' =>$tutor->education_status_fk->name,
            // '{EXPERIENCE}' =>$tutor->experience,
            // '{TOTAL_YEARS_OF_EXP}' =>$tutor->total_years_of_experience_fk->name,
            // '{DESC1}' =>$tutor->desc1,
            // '{DESC2}' =>$tutor->desc2,
            // '{TOTAL_YEARS_OF_EXP}' =>$tutor->total_years_of_experience_fk->name,
            // '{LOCATIONS}' =>$tutor->viewLocation(),
            // '{PRICE_PRIMARY13}' =>Yii::app()->format->price($tutor->price_primary13),
            // '{PRICE_PRIMARY46}' =>Yii::app()->format->price($tutor->price_primary46),
            // '{PRICE_SECONDARY12}' =>Yii::app()->format->price($tutor->price_secondary12),
            // '{PRICE_SECONDARY34}' =>Yii::app()->format->price($tutor->price_secondary34),
            // '{PRICE_JC1}' =>Yii::app()->format->price($tutor->price_jc1),
            // '{PRICE_JC2}' =>Yii::app()->format->price($tutor->price_jc2),
            // '{PRICE_OTHERS}' =>Yii::app()->format->price($tutor->price_others),
            // '{TIMESLOT}' =>$tutor->viewTimeslot(),
            // '{SUBJECTS}' =>$tutor->viewSubjects(),
        );

        $aSubject = array(
            '{FULL_NAME}'=>$tutor->full_name,
        );
        if( CmsEmail::sendmail(MAIL_SUC_REG_TO_TUTOR, $aSubject, $aBody, $tutor->email  )){}
        else
            $tutor->addError('email','Can not send email to: '.$tutor->email);
    }
    //hbao
    public static function sendSucRegToAdmin($tutor)
    {
        $aBody = array(
            '{FULL_NAME}'=>$tutor->full_name,
            // '{EMAIL}'=>$tutor->email,
            // '{PHONE}' =>$tutor->phone,
            // '{MOBILE}' =>$tutor->mobile,
            // '{GENDER}' =>$tutor->gender,
            // '{COUNTRY}' =>$tutor->country_fk->area_name,
            // '{NRIC}' =>$tutor->nric,
            // '{RACE}' =>$tutor->race_fk->name,
            // '{DOB}' =>date('d/m/Y', strtotime($tutor->date_of_birth)),
            // '{ADDRESS1}' =>$tutor->address1,
            // '{ADDRESS2}' =>$tutor->address2,
            // '{POSTAL_CODE}' =>$tutor->postal_code,
            // '{EDUCATION_STATUS}' =>$tutor->education_status_fk->name,
            // '{EXPERIENCE}' =>$tutor->experience,
            // '{TOTAL_YEARS_OF_EXP}' =>$tutor->total_years_of_experience_fk->name,
            // '{DESC1}' =>$tutor->desc1,
            // '{DESC2}' =>$tutor->desc2,
            // '{TOTAL_YEARS_OF_EXP}' =>$tutor->total_years_of_experience_fk->name,
            // '{LOCATIONS}' =>$tutor->viewLocation(),
            // '{PRICE_PRIMARY13}' =>Yii::app()->format->price($tutor->price_primary13),
            // '{PRICE_PRIMARY46}' =>Yii::app()->format->price($tutor->price_primary46),
            // '{PRICE_SECONDARY12}' =>Yii::app()->format->price($tutor->price_secondary12),
            // '{PRICE_SECONDARY34}' =>Yii::app()->format->price($tutor->price_secondary34),
            // '{PRICE_JC1}' =>Yii::app()->format->price($tutor->price_jc1),
            // '{PRICE_JC2}' =>Yii::app()->format->price($tutor->price_jc2),
            // '{PRICE_OTHERS}' =>Yii::app()->format->price($tutor->price_others),
            // '{TIMESLOT}' =>$tutor->viewTimeslot(),
            // '{SUBJECTS}' =>$tutor->viewSubjects(),
        );

        $aSubject = array(
            '{FULL_NAME}'=>$tutor->full_name,
        );
        if( CmsEmail::sendmail(MAIL_SUC_REG_TO_ADMIN, $aSubject, $aBody, Yii::app()->params['adminEmail']  )){}
        else
            $tutor->addError('email','Can not send email to: '.Yii::app()->params['adminEmail']);
    }
    //hbao
    public static function approveTutorRegister($tutor)
    {
        $sub_link = '<a href="' . Yii::app()->createAbsoluteUrl("tutor/subscription/index") . '">' . Yii::app()->createAbsoluteUrl("tutor/subscription/index") . '</a>';
        $aBody = array(
            '{FULL_NAME}'=>$tutor->full_name,
            '{EMAIL}'=>$tutor->email,
            '{PHONE}' =>$tutor->phone,
            '{MOBILE}' =>$tutor->mobile,
            '{GENDER}' =>$tutor->gender,
            '{COUNTRY}' =>$tutor->country_fk->area_name,
            '{NRIC}' =>$tutor->nric,
            '{RACE}' =>$tutor->race_fk->name,
            '{DOB}' =>date('d/m/Y', strtotime($tutor->date_of_birth)),
            '{ADDRESS1}' =>$tutor->address1,
            '{ADDRESS2}' =>$tutor->address2,
            '{POSTAL_CODE}' =>$tutor->postal_code,
            '{EDUCATION_STATUS}' =>$tutor->education_status_fk->name,
            '{EXPERIENCE}' =>$tutor->experience,
            '{TOTAL_YEARS_OF_EXP}' =>$tutor->total_years_of_experience_fk->name,
            '{DESC1}' =>$tutor->desc1,
            '{DESC2}' =>$tutor->desc2,
            '{TOTAL_YEARS_OF_EXP}' =>$tutor->total_years_of_experience_fk->name,
            '{LOCATIONS}' =>$tutor->viewLocation(),
            '{PRICE_PRIMARY13}' =>Yii::app()->format->price($tutor->price_primary13),
            '{PRICE_PRIMARY46}' =>Yii::app()->format->price($tutor->price_primary46),
            '{PRICE_SECONDARY12}' =>Yii::app()->format->price($tutor->price_secondary12),
            '{PRICE_SECONDARY34}' =>Yii::app()->format->price($tutor->price_secondary34),
            '{PRICE_JC1}' =>Yii::app()->format->price($tutor->price_jc1),
            '{PRICE_JC2}' =>Yii::app()->format->price($tutor->price_jc2),
            '{PRICE_OTHERS}' =>Yii::app()->format->price($tutor->price_others),
            '{TIMESLOT}' =>$tutor->viewTimeslot(),
            '{SUBJECTS}' =>$tutor->viewSubjects(),
            '{SUB_LINK}'=> $sub_link,
        );

        $aSubject = array(
            '{FULL_NAME}'=>$tutor->full_name,
        );
        if( CmsEmail::sendmail(MAIL_APPROVE_TUTOR_REGISTRATION, $aSubject, $aBody, $tutor->email  )){}
        else
            $tutor->addError('email','Can not send email to: '.$tutor->email);
    }
    //hbao
    public static function rejectTutorRegister($tutor)
    {
        $aBody = array(
            '{FULL_NAME}'=>$tutor->full_name,
            '{EMAIL}'=>$tutor->email,
            '{PHONE}' =>$tutor->phone,
            '{MOBILE}' =>$tutor->mobile,
            '{GENDER}' =>$tutor->gender,
            '{COUNTRY}' =>$tutor->country_fk->area_name,
            '{NRIC}' =>$tutor->nric,
            '{RACE}' =>$tutor->race_fk->name,
            '{DOB}' =>date('d/m/Y', strtotime($tutor->date_of_birth)),
            '{ADDRESS1}' =>$tutor->address1,
            '{ADDRESS2}' =>$tutor->address2,
            '{POSTAL_CODE}' =>$tutor->postal_code,
            '{EDUCATION_STATUS}' =>$tutor->education_status_fk->name,
            '{EXPERIENCE}' =>$tutor->experience,
            '{TOTAL_YEARS_OF_EXP}' =>$tutor->total_years_of_experience_fk->name,
            '{DESC1}' =>$tutor->desc1,
            '{DESC2}' =>$tutor->desc2,
            '{TOTAL_YEARS_OF_EXP}' =>$tutor->total_years_of_experience_fk->name,
            '{LOCATIONS}' =>$tutor->viewLocation(),
            '{PRICE_PRIMARY13}' =>Yii::app()->format->price($tutor->price_primary13),
            '{PRICE_PRIMARY46}' =>Yii::app()->format->price($tutor->price_primary46),
            '{PRICE_SECONDARY12}' =>Yii::app()->format->price($tutor->price_secondary12),
            '{PRICE_SECONDARY34}' =>Yii::app()->format->price($tutor->price_secondary34),
            '{PRICE_JC1}' =>Yii::app()->format->price($tutor->price_jc1),
            '{PRICE_JC2}' =>Yii::app()->format->price($tutor->price_jc2),
            '{PRICE_OTHERS}' =>Yii::app()->format->price($tutor->price_others),
            '{TIMESLOT}' =>$tutor->viewTimeslot(),
            '{SUBJECTS}' =>$tutor->viewSubjects(),
        );

        $aSubject = array(
            '{FULL_NAME}'=>$tutor->full_name,
        );
        if( CmsEmail::sendmail(MAIL_REJECT_TUTOR_REGISTRATION, $aSubject, $aBody, $tutor->email  )){}
        else
            $tutor->addError('email','Can not send email to: '.$tutor->email);
    }
    //hbao
    public static function sendSubscription($tutor, $requests)
    {
        $suggestions = "<div>";
        if(!empty($requests))
            foreach ($requests as $request) {
                $suggestions .= "<hr/>";
                $suggestions .= "<div><a href = '".Yii::app()->createAbsoluteUrl('tutor/default/assignments')."'>$request->request_title</a></div>";
                $suggestions .= "<table>";
                $suggestions .= "<tr><td>Frequency: </td><td>$request->lession_per_week lesson/week, $request->hour_per_lession hours/lesson</td></tr>";
                $suggestions .= "<tr><td>Timing: </td><td>{$request->viewTimeslot()}</td></tr>";
                $suggestions .= "<tr><td>Price: </td><td>".Yii::app()->format->price($request->budget_per_hour)."</td></tr>";
                $suggestions .= "<tr><td>Case ID: </td><td>$request->case_id</td></tr>";
                $suggestions .= "<tr><td>Remarks: </td><td>$request->remarks</td></tr>";
                $suggestions .= "</table>";
            }
        $suggestions .= "</div>";
        $aBody = array(
            '{FULL_NAME}'=>$tutor->full_name,
            '{REQUESTS}' => $suggestions,
        );

        $aSubject = array(
            '{FULL_NAME}'=>$tutor->full_name,
        );
        if( CmsEmail::sendmail(MAIL_SUBSCRIPTION, $aSubject, $aBody, array($tutor->email))){}
        else
            $tutor->addError('email','Can not send email to: '.$tutor->email);
    }
    
    //tbinh
    //send client(parent) info to tutor
    public static function paymentSuccessToTutor($request){
        $tutor = $request->tutor_fk;
        $request = $request->request_fk;
        $aBody = array(
            '{FULL_NAME}' => !empty($request->full_name) ? $request->full_name : $request->first_name.' '.$request->last_name,
            '{LEVEL}' => ($request->level==0)? "All" : SubjectCategories::model()->findByPk($request->level)->name,
            '{SUBJECT}' => $request->renderHtmlLevelSubject(),
            '{FREQUENCY_OF_LESSONS_A_WEEK}' => $request->lession_per_week,
            '{DURATION_OF_EACH_WEEK}' => $request->hour_per_lession,
            '{SCHEDULE}' => $request->renderHtmlTimeSlotMail(),
            '{DATE_TO_START}' => 'Not set',
            '{TIME_TO_START}' => $request->getStartTime(),
            '{TUITION_FEE}' => $request->price,
            '{EMAIL}' => $request->email,
            '{ADMINNAME}'=>Yii::app()->params['adminName'],
            '{ADMINEMAIL}'=>Yii::app()->params['adminEmail'],
            '{PHONE}'=> Yii::app()->params['contact_number']

        );
       $aSubject = array(
            '{FULL_NAME}'=> $request->full_name,
        );
        if(CmsEmail::sendmail(MAIL_PAYMENT_SUCCESS_TUTOR, $aSubject, $aBody, $tutor->email)){

        }else $mUser->addError('status', 'Can not send email');
    }
    
    //tbinh
    public static function paymentSuccessToParent($request){
        $tutor = $request->tutor_fk;
        $request = $request->request_fk;
        $aBody = array(
            '{FULL_NAME}'=>$tutor->full_name,
            '{EMAIL}'=>$tutor->email,
            '{PHONE}' =>$tutor->phone,
            '{MOBILE}' =>$tutor->mobile,
            '{GENDER}' =>$tutor->gender,
            '{COUNTRY}' =>$tutor->country_fk->area_name,
            '{NRIC}' =>$tutor->nric,
            '{RACE}' =>$tutor->race_fk->name,
            '{DOB}' =>date('d/m/Y', strtotime($tutor->date_of_birth)),
            '{ADDRESS1}' =>$tutor->address1,
            '{ADDRESS2}' =>$tutor->address2,
            '{POSTAL_CODE}' =>$tutor->postal_code,
            '{EDUCATION_STATUS}' =>$tutor->education_status_fk->name,
            '{EXPERIENCE}' =>$tutor->experience,
            '{TOTAL_YEARS_OF_EXP}' =>$tutor->total_years_of_experience_fk->name,
            '{DESC1}' =>$tutor->desc1,
            '{DESC2}' =>$tutor->desc2,
            '{TOTAL_YEARS_OF_EXP}' =>$tutor->total_years_of_experience_fk->name,
            '{LOCATIONS}' =>$tutor->viewLocation(),
            '{PRICE_PRIMARY13}' =>Yii::app()->format->price($tutor->price_primary13),
            '{PRICE_PRIMARY46}' =>Yii::app()->format->price($tutor->price_primary46),
            '{PRICE_SECONDARY12}' =>Yii::app()->format->price($tutor->price_secondary12),
            '{PRICE_SECONDARY34}' =>Yii::app()->format->price($tutor->price_secondary34),
            '{PRICE_JC1}' =>Yii::app()->format->price($tutor->price_jc1),
            '{PRICE_JC2}' =>Yii::app()->format->price($tutor->price_jc2),
            '{PRICE_OTHERS}' =>Yii::app()->format->price($tutor->price_others),
            '{TIMESLOT}' =>$tutor->viewTimeslot(),
            '{SUBJECTS}' =>$tutor->viewSubjects(),
        );
        $aSubject = array(
            '{FULL_NAME}'=> $tutor->full_name,
        );
        if(CmsEmail::sendmail(MAIL_PAYMENT_SUCCESS_PARENT, $aSubject, $aBody, $request->email)){

        }else $mUser->addError('status', 'Can not send email');
        
    }

    /**
     * Author: @Huu Thoa
     * @param $model
     * @param $items
     */
    public static function sendNotifyOrderMemberPaypal($model, $items){
        $billing_address = json_decode($model->billing_address);
        $aBody = array(
            '{DATE}' => Yii::app()->format->date($model->created_date),
            '{CUSTOMER_NAME}' => $billing_address->contact_first_name.' '.$billing_address->contact_last_name, 
            '{INVOICE_NO}' => $model->order_no,
            '{ITEMS}' => $items,
            '{BILLING_ADDRESS}' => $billing_address->address1,
            '{REGN_NUMBER}' => Yii::app()->params['regnNumber']
        );

        $aSubject = array(
        );

        $sTo = $billing_address->email;
        CmsEmail::sendmail(MAIL_ORDER_PAYPAL_SUCCESS_MEMBER, $aSubject, $aBody, $sTo);
    }

    /**
     * Author: @Huu Thoa
     * @param $model
     * @param $items
     */
    public static function sendNotifyOrderAdminPaypal($model, $items){
        $billing_address = json_decode($model->billing_address);
        $link = '<a href="'.Yii::app()->createAbsoluteUrl("admin/orders/view", array("id" => $model->id)).'">'.Yii::app()->createAbsoluteUrl("admin/orders/view", array("id" => $model->id)).'</a>';
        $aBody = array(
            '{ORDER_NO}' => $model->order_no,
            '{ITEMS}' => $items,
            '{CUSTOMER_NAME}' => $billing_address->contact_first_name.' '.$billing_address->contact_last_name, 
            '{BILLING_ADDRESS}' => $billing_address->address1,
            '{LINK}' => $link
        );

        $aSubject = array(
        );

        $sTo = Yii::app()->params['adminEmail'];
        CmsEmail::sendmail(MAIL_ORDER_PAYPAL_SUCCESS_ADMIN, $aSubject, $aBody, $sTo);
    }

    /**
     * Author: @Phuong Ho
     * @param $model
     * @param $items
     * @param $status
     */
    public static function sendNotifyOrderUpdateStatusToMember($model, $items, $status){
        $link = '<a href="'.Yii::app()->createAbsoluteUrl("site/viewOrder", array("order_id" => base64_encode($model->id))).'">'.Yii::app()->createAbsoluteUrl("site/viewOrder", array("order_id" => base64_encode($model->id))).'</a>';
        $billing_address = json_decode($model->billing_address);
        $shipping_address = json_decode($model->shipping_address);
        $member_name = $billing_address->contact_first_name . ' ' . $billing_address->contact_last_name;
        switch($status) {
            case ORDER_STATUS_IN_SHIPMENT:
                $status = 'Pending Delivery';
                break;
            case ORDER_STATUS_IN_DELIVERED:
                $status = 'Delivered Successfully';
                break;
            case ORDER_STATUS_REFUNDED:
                $status = 'Refunded';
                break;
            case ORDER_STATUS_CANCELLED:
                $status = 'Cancelled';
                break;
            case ORDER_STATUS_ORDERED:
                $status = 'Ordered Successfully';
                break;
        }
        $aBody = array(
            '{NAME}' => $member_name,
            '{ITEMS}'=>$items,
            '{STATUS}' => $status,
        );        

        $aSubject = array(
            '{NAME}' => $member_name,
            '{ORDER_NO}' => $model->order_no,
        );

        $sTo = $billing_address->email;
        CmsEmail::sendmail(MAIL_ORDER_UPDATE_STATUS_ADMIN, $aSubject, $aBody, $sTo);
    }


    /**
     * DTOAN
     * Send Mail enquiry to sender
     */
    
    public static function sendMailEnquiryToSender($enquiry){
        $aBody = array(
            '{ENQUIRY_CODE}'  => $enquiry->code,
            '{ENQUIRY_DATE}'  => Yii::app()->format->date($enquiry->created_date),
            '{ENQUIRY_NAME}'  => strip_tags(trim($enquiry->enquirer_name)),
            '{ENQUIRY_EMAIL}' => strip_tags(trim($enquiry->enquirer_email)),
            '{ENQUIRY_PHONE}' => strip_tags(trim($enquiry->enquirer_phone)),
            '{ENQUIRY_MESSAGE}' => nl2br(strip_tags(trim($enquiry->message))),
            '{PROPERTY_TYPE}' => PropertyType::model()->getInfoRecordWithTable(array('id'=>$enquiry->property_type),'name'),
            '{PROPERTY_PRICE}'=> MasterPriceList::model()->getInfoRecordWithTable(array('id'=>$enquiry->property_price),'from_to'),
            '{PRICE_PSF}'     => MasterPrice::model()->getInfoRecordWithTable(array('id'=>$enquiry->property_price),'from_to'),
            '{FLOOR_AREA}'    => MasterFloorArea::model()->getInfoRecordWithTable(array('id'=>$enquiry->property_price),'from_to'),
            '{CONDITIONS}'    => MasterCondition::model()->getInfoRecordWithTable(array('id'=>$enquiry->property_price),'name'),
            '{DEVELOPER}'     => MasterDeveloper::model()->getInfoRecordWithTable(array('id'=>$enquiry->property_price),'name'),
            '{TENURES}'       => MasterTenures::model()->getInfoRecordWithTable(array('id'=>$enquiry->property_price),'name'),
            '{LEAVE_TERM}'    => MasterLeaseTerm::model()->getInfoRecordWithTable(array('id'=>$enquiry->property_price),'name'),

        );

        $aSubject = array(
            '{ENQUIRY_NAME}'=> $mDesigner->interior_name,
        );

        $sTo = Yii::app()->params['adminEmail'];
        CmsEmail::sendmail(MAIL_ENQUIRY_TO_SENDER, $aSubject, $aBody, $sTo);
    }

    /**
     * DTOAN
     * Send Mail enquiry to designer
     */
    
    public static function sendMailEnquiryToDesinger($enquiry,$mDesigner){
        $aBody = array(
            '{INTERIOR_NAME}' => $mDesigner->interior_name,
            '{ENQUIRY_CODE}'  => $enquiry->code,
            '{ENQUIRY_DATE}'  => Yii::app()->format->date($enquiry->created_date),
            '{ENQUIRY_NAME}'  => strip_tags(trim($enquiry->enquirer_name)),
            '{ENQUIRY_EMAIL}' => strip_tags(trim($enquiry->enquirer_email)),
            '{ENQUIRY_PHONE}' => strip_tags(trim($enquiry->enquirer_phone)),
            '{ENQUIRY_MESSAGE}' => nl2br(strip_tags(trim($enquiry->message))),
            '{PROPERTY_TYPE}' => PropertyType::model()->getInfoRecordWithTable(array('id'=>$enquiry->property_type),'name'),
            '{PROPERTY_PRICE}'=> MasterPriceList::model()->getInfoRecordWithTable(array('id'=>$enquiry->property_price),'from_to'),
            '{PRICE_PSF}'     => MasterPrice::model()->getInfoRecordWithTable(array('id'=>$enquiry->property_price),'from_to'),
            '{FLOOR_AREA}'    => MasterFloorArea::model()->getInfoRecordWithTable(array('id'=>$enquiry->property_price),'from_to'),
            '{CONDITIONS}'    => MasterCondition::model()->getInfoRecordWithTable(array('id'=>$enquiry->property_price),'name'),
            '{DEVELOPER}'     => MasterDeveloper::model()->getInfoRecordWithTable(array('id'=>$enquiry->property_price),'name'),
            '{TENURES}'       => MasterTenures::model()->getInfoRecordWithTable(array('id'=>$enquiry->property_price),'name'),
            '{LEAVE_TERM}'    => MasterLeaseTerm::model()->getInfoRecordWithTable(array('id'=>$enquiry->property_price),'name'),

        );

        $aSubject = array(
            '{INTERIOR_NAME}'=> $mDesigner->interior_name,
        );

        $sTo = $mDesigner->email;
        CmsEmail::sendmail(MAIL_ENQUIRY_TO_DESINGER, $aSubject, $aBody, $sTo);
    }
    /**
     * DTOAN
     * Send Mail enquiry to admin
     */
    
    public static function sendMailEnquiryToAdmin($enquiry){
        $aBody = array(
            '{ENQUIRY_CODE}'  => $enquiry->code,
            '{ENQUIRY_DATE}'  => Yii::app()->format->date($enquiry->created_date),
            '{ENQUIRY_NAME}'  => strip_tags(trim($enquiry->enquirer_name)),
            '{ENQUIRY_EMAIL}' => strip_tags(trim($enquiry->enquirer_email)),
            '{ENQUIRY_PHONE}' => strip_tags(trim($enquiry->enquirer_phone)),
            '{ENQUIRY_MESSAGE}' => nl2br(strip_tags(trim($enquiry->message))),
            '{PROPERTY_TYPE}' => PropertyType::model()->getInfoRecordWithTable(array('id'=>$enquiry->property_type),'name'),
            '{PROPERTY_PRICE}'=> MasterPriceList::model()->getInfoRecordWithTable(array('id'=>$enquiry->property_price),'from_to'),
            '{PRICE_PSF}'     => MasterPrice::model()->getInfoRecordWithTable(array('id'=>$enquiry->property_price),'from_to'),
            '{FLOOR_AREA}'    => MasterFloorArea::model()->getInfoRecordWithTable(array('id'=>$enquiry->property_price),'from_to'),
            '{CONDITIONS}'    => MasterCondition::model()->getInfoRecordWithTable(array('id'=>$enquiry->property_price),'name'),
            '{DEVELOPER}'     => MasterDeveloper::model()->getInfoRecordWithTable(array('id'=>$enquiry->property_price),'name'),
            '{TENURES}'       => MasterTenures::model()->getInfoRecordWithTable(array('id'=>$enquiry->property_price),'name'),
            '{LEAVE_TERM}'    => MasterLeaseTerm::model()->getInfoRecordWithTable(array('id'=>$enquiry->property_price),'name'),

        );

        $aSubject = array(
            '{ENQUIRY_NAME}'=> $mDesigner->interior_name,
        );

        $sTo = Yii::app()->params['adminEmail'];
        CmsEmail::sendmail(MAIL_ENQUIRY_TO_ADMIN, $aSubject, $aBody, $sTo);
    }
    
    public static function snatchNow($email, $link, $deal_name) {
        $aBody = array(
            '{EMAIL_ADDRESS}' => $email,
            '{DEAL_NAME}' => $deal_name,
            '{DEAL_LINK}' => '<a href="'.$link.'">'.$link.'</a>'
        );
        $aSubject = array(
            );
        $sTo = Yii::app()->params['adminEmail'];
        CmsEmail::sendmail(MAIL_SNATCH_NOW, $aSubject, $aBody, $sTo);
    }

}
?>
