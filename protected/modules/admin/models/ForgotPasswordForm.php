<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'forgotpass' action of 'SiteController'.
 */
class ForgotPasswordForm extends CFormModel
{
	public $name;
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
			// name, email, subject and body are required
			array('email', 'required'),
			array('email', 'email','checkMX'=>true),
			// email has to be a valid email address
			/*
			array('email', 'length', 'min'=>6, 'max'=>50,
                'tooShort'=>Yii::t("translation", "{attribute} is too short (minimum is 6 characters, maximum is 50 characters)."),
                'tooLong'=>Yii::t("translation", "{attribute} is too long (minimum is 6 characters, maximum is 50 characters).")),
            
			array(
                'email', 'match', 'not' => true, 'pattern' => '/[^a-zA-Z0-9_]/',
                'message' => 'Email must consist of letters, numbers and _ only'
            ),
				*/
		);
	}

    public static function generateKey($user)
    {
        if(empty($user->last_logged_in))
            $user->last_logged_in = '';
        return md5($user->id . $user->email . $user->last_logged_in);
    }

}