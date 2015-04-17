<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    const ERROR_USERNAME_BLOCKED=35; // verz custom by Nguyen Dung
    const ERROR_FAILURE_MAX_TIMES = 4;
    const ERROR_NONE=0;
    const ERROR_USERNAME_INVALID=1;
    const ERROR_PASSWORD_INVALID=2;
    const ERROR_UNKNOWN_IDENTITY=100;
    
    public $login_by;
    protected $_id;
    protected $_isAdmin = false;
	//private $applicationId = 2;
	//private $status = 1;
    public $role_id;


    /**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
        //user ip login more than X times can't login
		/*
        $iplogin = new IpLogins();
        $iplogin->deleteOldRecords();
        if(!$iplogin->limitLoginTimes($this->username, Yii::app()->request->getUserHostAddress()))
        {
            $this->errorCode = self::ERROR_FAILURE_MAX_TIMES;
            return !$this->errorCode;
        }
         */
		 
        //$record=Users::model()->findByAttributes(array('email'=>$this->username, 'application_id'=>$this->applicationId, 'status' => $this->status ));
        $login_by = $this->login_by;
        $record=Users::model()->findByAttributes(array($login_by=>$this->username));
        // $record=Users::model()->findByAttributes(array($login_by=>$this->email));

        if($record===null)
        {
            $this->errorCode=  self::ERROR_USERNAME_INVALID;
        }
        else if(trim($record->password_hash) != md5(trim($this->password)))
        {
            $this->errorCode=  self::ERROR_PASSWORD_INVALID;
            $record->login_attemp = $record->login_attemp + 1;
            $record->update();
        }
//        else if($record->role_id==ROLE_MEMBER && $record->status==0 )
//        {
//            $this->errorCode=  self::ERROR_USERNAME_BLOCKED;
//        }
//        else if($record->role_id==ROLE_MEMBER && $record->status==2 )
//        {
//            $this->errorCode=  self::ERROR_USERNAME_INVALID;
//        }
        else if($record->status==0 )
        {
            $this->errorCode=  self::ERROR_USERNAME_BLOCKED;
        }
        else
        {
            $this->_id=$record->id;
        //  $this->setState('title', $record->nick_name);
            $this->errorCode=self::ERROR_NONE;
            $this->_isAdmin = false;
            // Update last IP and time
            $record->last_logged_in = date('Y-m-d H:i:s');
            $record->ip_address = Yii::app()->request->getUserHostAddress();
            $record->login_attemp = 0;
            Yii::app()->session['LOGGED_USER'] = $record;
            if(!$record->update())
                Yii::log(print_r($record->getErrors(), true), 'error', 'UserIdentity.authenticate');
        }
        
        if($this->errorCode && $this->errorCode != self::ERROR_USERNAME_INVALID)
        {
            //write ip and username            
			/*
            $iplogin->username = $this->username;
            $iplogin->ip_address = Yii::app()->request->getUserHostAddress();
            $iplogin->time_login = time();
            $iplogin->save();       
			*/
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