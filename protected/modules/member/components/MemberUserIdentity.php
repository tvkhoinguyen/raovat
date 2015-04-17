<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class MemberUserIdentity extends UserIdentity
{
	//private $applicationId = 1;
	private $status = 1;
    public $role_id;
    public $application_id;

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
            $iplogin = new IpLogins();
            $iplogin->deleteOldRecords();
                    
            
        $record=Users::model()->findByAttributes(array('email'=>$this->username));
        if($record===null)
        {
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        }
        else if(trim($record->password_hash) != md5(trim($this->password)))
        {
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
			$record->login_attemp = $record->login_attemp + 1;
			$record->update();
        }
        else if($record->status==0 )
        {
            $this->errorCode=  self::ERROR_USERNAME_BLOCKED;
        }
        else
        {
            $this->_id=$record->id;
            $this->role_id = $record->role_id;
            $this->_isAdmin = false;
            $this->errorCode=self::ERROR_NONE;
            // Update last IP and time
            $record->last_logged_in = date('Y-m-d H:i:s');
			$record->login_attemp = 0;
            Yii::app()->session['LOGGED_USER'] = $record;
            if(!$record->update())
                Yii::log(print_r($record->getErrors(), true), 'error', 'MemberUserIdentity.authenticate');
        }
        
        if($this->errorCode && $this->errorCode != self::ERROR_USERNAME_INVALID)
        {
            //write ip and username            
            $iplogin->username = $this->username;
            $iplogin->ip_address = Yii::app()->request->getUserHostAddress();
            $iplogin->time_login = time();
            $iplogin->save();       
        }
        
        
        return !$this->errorCode;
	}

}