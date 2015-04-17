<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class AdminUserIdentity extends UserIdentity
{

	private $status = 1;
	public $role_id;
	public $application_id = BE;

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
//		//user ip login more than X times can't login
//		$iplogin = new IpLogins();
//		$iplogin->deleteOldRecords();
		//if(!$iplogin->limitLoginTimes($this->username, Yii::app()->request->getUserHostAddress()))
//		if (!$iplogin->limitLoginTimes($this->username, Yii::app()->request->getUserHostAddress()))
//		{
//			$this->errorCode = self::ERROR_FAILURE_MAX_TIMES;
//			return !$this->errorCode;
//		}
		$record = Users::model()->findByAttributes(array('username' => $this->username,
			'status' => $this->status,
			'application_id' => $this->application_id,
		));
		if ($record === null)
		{
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		}
		else if (trim($record->password_hash) != md5(trim($this->password)))
		{
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
			$record->login_attemp = $record->login_attemp + 1;
			$record->update();
		}
		else if ($record->status == 0)
		{
			$this->errorCode = self::ERROR_USERNAME_BLOCKED;
		}
		else
		{
			$this->_id = $record->id;
			$this->role_id = $record->role_id;
			$this->_isAdmin = true;
			$this->errorCode = self::ERROR_NONE;
			// Update last IP and time
			$record->last_logged_in = date('Y-m-d H:i:s');
			$record->login_attemp = 0;
			Yii::app()->session['LOGGED_USER'] = $record;
			if (!$record->update())
				Yii::log(print_r($record->getErrors(), true), 'error', 'AdminUserIdentity.authenticate');

			/**
			 * DTOAN ghostkissboy12@gmail.com
			 * set cookie
			 */
			if (isset($_POST['AdminLoginForm']['rememberMe']))
			{
				if ($_POST['AdminLoginForm']['rememberMe'] == 1)
				{
					$expire = time() + 7 * 24 * 60 * 60;
					$array[VERZLOGIN] = $record->username;
					$array[VERZLPASS] = $record->temp_password;
					setcookie(VERZ_COOKIE_ADMIN, json_encode($array), $expire);
				}
			}
		}

//		if ($this->errorCode && $this->errorCode != self::ERROR_USERNAME_INVALID)
//		{
//			//write ip and username            
//			$iplogin->username = $this->username;
//			$iplogin->ip_address = Yii::app()->request->getUserHostAddress();
//			$iplogin->time_login = time();
//			$iplogin->save();
//		}


		return !$this->errorCode;
	}

}
