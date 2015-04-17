<?php

class SiteController extends AdminController
{
    public $pluralTitle = 'Home';
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform  actions
                'actions'=>array('ForgotPassword', 'ResetPassword', 'Login', 'Logout', 'Error'),
                'users'=>array('*'),
            ),  
            array('allow',   //allow authenticated user to perform actions
                'actions'=>array('index'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),            
                      
        );
    }

    public function actionForgotPassword()
    {
        $model = new ForgotPasswordForm;
        if(isset($_POST['ForgotPasswordForm']))
        {
            $model->attributes=$_POST['ForgotPasswordForm'];
            if($model->validate()) 
            {
                //check Email
                $user = Users::model()->findByAttributes(array(
                    'email' => trim($model->email), 'application_id' => BE,
                ));
                if(!$user){
                    $model->addError('email','Email does not exist.');
                } else {
                    SendEmail::verifyResetPasswordToAdmin($user);
                }                                

            }
        }
		$this->render('forgotPassword',array('model'=>$model));
    }
	
    public function actionResetPassword()
    {
        $id = Yii::app()->request->getParam('id'); 
        $key = Yii::app()->request->getParam('key'); 
        $model = Users::model()->findByPk((int)$id);
        
        if($model !== null && $key == ForgotPasswordForm::generateKey($model))
        {
            $pass = StringHelper::getRandomString(6);
            $model->password_hash = md5($pass);
            $model->temp_password = $pass;
            $model->update();
            SendEmail::resetPasswordToAdmin($model);
        }
        else
        {
            Yii::log('Invalid request. Please do not repeat this request again.');
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
        $this->render('ResetPassword',array('model'=>$model));
        
    }    

	public function actionError()
	{
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
	}

	public function actionIndex()
	{
		$this->render('index');
	}

    /**
     * Displays the login page
     */
    public function actionLogin()
    {   
        // echo '<pre>';
        // print_r( 'aaaa'.Yii::app()->user->id);
        // echo '</pre>';
        // die;
        // Yii::app()->user->logout();
        // Yii::app()->controller->redirect(Yii::app()->createAbsoluteUrl('admin/site/login'));

        if(Yii::app()->user->id)
            $this->redirect( Yii::app()->createAbsoluteUrl('admin/site/index') );

        $model=new AdminLoginForm;
        if(isset($_POST['AdminLoginForm']))
	    {
            //var_dump($_POST['LoginForm']);die;
            $model->attributes=$_POST['AdminLoginForm'];
            if($model->validate())
            {
                // echo '<pre>';
                //     print_r(Yii::app()->user);
                //     echo '</pre>';

                // echo '<pre>';
                //     print_r(Yii::app()->user->id);
                //     echo '</pre>';
                    // die;

                if (strtolower(Yii::app()->user->returnUrl)!==strtolower(Yii::app()->baseUrl.'/'))
                    $this->redirect(Yii::app()->user->returnUrl);
                
                $user = Users::model()->findByPk(Yii::app()->user->id);
                // switch (Yii::app()->user->role_id )
                switch ($user->role_id )
                {
                    // echo '<pre>';
                    // print_r( 'user_id'.Yii::app()->user->id );
                    // echo '</pre>';

                    // echo '<pre>';
                    // print_r( 'role_id'.Yii::app()->user->role_id );
                    // echo '</pre>';

                    case ROLE_MANAGER:
                        $this->redirect(Yii::app()->createAbsoluteUrl('admin'));
                        break;
                    case ROLE_ADMIN:
                        $this->redirect(Yii::app()->createAbsoluteUrl('admin'));
                        break;
                    case ROLE_MOD:
                        $this->redirect(Yii::app()->createAbsoluteUrl('admin'));
                        break;

                    default:
                        $this->redirect(Yii::app()->createAbsoluteUrl('admin'));
                }
            }
        }
        $this->render('login', array('model'=>$model));
    }
    
    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        if(isset($_SESSION['LOGGED_USER']))
            unset($_SESSION['LOGGED_USER']);
        //xoa cookie
        if(isset($_COOKIE[VERZ_COOKIE_ADMIN])){
            setcookie(VERZ_COOKIE_ADMIN, '', 1);
            setcookie(VERZ_COOKIE_ADMIN, '', 1, '/');
        }        
        
        $this->redirect(Yii::app()->createAbsoluteUrl('admin/login/'));
    }
    
    
}