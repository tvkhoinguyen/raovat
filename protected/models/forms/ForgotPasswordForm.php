<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'forgotpass' action of 'SiteController'.
 */
class ForgotPasswordForm extends CFormModel
{
	public $username;
	public $id;
	public $userModel;
	public $password;
    public $email;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('email', 'required'),
			array('email', 'email','checkMX'=>true),
		);
	}

    public static function generateKey($user)
    {
        if(empty($user->last_logged_in))
            $user->last_logged_in = '';
        return md5($user->id . $user->email . $user->last_logged_in);
    }

}