<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
    public $login_by;//email OR username OR something else
    
	public $nick_name;
    public $username;
	public $password;
	public $rememberMe;
    public $role_id;
    public $email;
    public $verifyCode;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that nick_name and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// nick_name and password are required
            // array($this->login_by.', password', 'required'),
			array(' email, password', 'required'),
            array('email', 'email', 'message' => 'Please enter a valid email.'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
            array('verifyCode','required','on'=>'captchaRequired'),
            array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'on'=>'captchaRequired'),
            //array('email', 'email'),
        );
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me',
            'email'=>'Email',
            'usename'=>'Username',
		);
	}

        protected function beforeValidate() 
        {
            $login_by = $this->login_by;
            $this->$login_by = trim($this->$login_by);
            return parent::beforeValidate();
        }
        
	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
            if(!$this->hasErrors()) // we only want to authenticate when no input errors
            {         
                $login_by = $this->login_by;
                $this->_identity=new UserIdentity($this->$login_by,$this->password);
                $this->_identity->login_by = $login_by;
                $this->_identity->authenticate();

                switch($this->_identity->errorCode)
                {
                    case UserIdentity::ERROR_NONE:
                        $duration = $this->rememberMe ? 3600*24*30 : 0; // 30 days
                        Yii::app()->user->login($this->_identity,$duration);
                        break;
                    case UserIdentity::ERROR_FAILURE_MAX_TIMES:
                        $times = Yii::app()->setting->getItem('loginLimitTimes');
                        $time_refresh = Yii::app()->setting->getItem('timeRefreshLogin');
                        $this->addError($login_by,"You can't login more than $times times. Wait $time_refresh minutes!.");
                        break;
                    case UserIdentity::ERROR_USERNAME_INVALID:
                        $this->addError($login_by, $this->$login_by. " is not valid.");
                        break;
                    case UserIdentity::ERROR_USERNAME_BLOCKED:
                        // $this->addError("username","Account has been blocked.");
                        $this->addError("email","Account has been blocked.");
                        break;
                    /*
                    case UserIdentity::ERROR_STATUS_NOTACTIV:
                        $this->addError("status",Yii::t("UserModule.user", "Votre compte n'est pas activer."));
                        break;
                    case UserIdentity::ERROR_STATUS_BAN:
                        $this->addError("status",Yii::t("UserModule.user", "Votre compte est banni."));
                        break;
                    */
                    case UserIdentity::ERROR_PASSWORD_INVALID:
                        $this->addError("password","Password is wrong. Please enter password again.");
                        break;
                }
            }
	}

}
