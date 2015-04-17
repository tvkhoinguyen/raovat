<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class FacebookUserIdentity extends CUserIdentity
{
    protected $_id;
    protected $_isAdmin = false;
    public $role_id;
    private $applicationId = FE;
    // const ERROR_NONE = 1;
    const ERROR_INACTIVE=3;
    const ERROR_PENDING=4;

    public $uid;
    const FB_ERROR=31;
    const ERROR_USERNAME_BLOCKED=32;

    function __construct($uid) 
    {
        $this->uid = $uid;
    }


    public function authenticate()
    {
        $model = Users::model()->find("fb_id = '$this->uid'");
        if(empty($model))
        {
            $this->errorCode = self::FB_ERROR; //not found account with FB_ID in db
        }else{
            if($model->role_id != ROLE_MEMBER)
            {
                $this->_isAdmin = false;
                $this->errorCode = self::FB_ERROR;
                //$this->errorMessage = 'Unknown account';

            }else if($model->status == STATUS_INACTIVE)
            {
                $this->_id = $model->id;
                $this->_isAdmin = false;
                $this->errorCode = self::ERROR_USERNAME_BLOCKED;
                // Yii::app()->user->setFlash('error-login-fb-block', "Your account has been blocked.");
                // Yii::app()->getRequest()->redirect(Yii::app()->createAbsoluteUrl('site/index', array('handle' => 'login')));
            }
            // elseif($model->member_status == NormalMember::STATUS_FACEBOOKACCOUNT){
            //     $this->_id = $model->id;
            //     $this->_isAdmin = false;
            //     $this->errorCode = self::ERROR_NONE;
            //     Yii::app()->user->login($this);
            //     Yii::app()->getRequest()->redirect(Yii::app()->createAbsoluteUrl('member/site/registersteptwo', array('member' => urlencode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, SECRET_KEY_B5ME, $model->id, MCRYPT_MODE_ECB)))));
            // }
            else{
                $this->_id = $model->id;
                $this->_isAdmin = false;
                $this->errorCode = self::ERROR_NONE;
            }
        }
        return $this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getIsAdmin()
    {
        return $this->_isAdmin;
    }

    public function getRoleId()
    {
        return $this->role_id;
    }
}