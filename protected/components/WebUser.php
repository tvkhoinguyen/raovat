<?php

class WebUser extends CWebUser {
	/**
     * The user is admin when is not guest and have value true of "isAdmin" parameter of "session"
	 * @return bool
	 */
        private $_model;
    
	public function getIsMember(){
		return !$this->getIsGuest() && Yii::app()->getSession()->get('LOGGED_USER') && (Yii::app()->user->role_id == ROLE_MEMBER);
	}
	 
	public function getIsAdmin(){
		return !$this->getIsGuest() && Yii::app()->getSession()->get('isAdmin');
	}

    /**
     * The user is member when is not guest and is not admin
     * @return bool
     */

    public function getRoleId(){
        if(Yii::app()->getSession()->get('roleId'))
            return Yii::app()->getSession()->get('roleId');
        return null;
    }
    
	
 	/**
	 * @param WebUserIdentity
	 * @param int
	 */
    public function login($identity, $duration=0) {
        parent::login($identity, $duration);
        Yii::app()->getSession()->add('isAdmin', $identity->getIsAdmin());
        Yii::app()->getSession()->add('roleId', $identity->getRoleId());
    }
 
 	/**
	 * @param boolean
	 */
    public function logout($destroySession = true) {
    	parent::logout($destroySession);
    }

    public function checkAccess($name, $userId = array())
    {
        if(!Yii::app()->user->isAdmin)
            return false;

        switch($name)
        {
            case 'view':
            case 'update':
            case 'create':
            case 'delete':
                return parent::checkAccess($name . '_' . ucfirst(Yii::app()->controller->id));
        }
        return parent::checkAccess($name, $userId);
    }
    
    function getEmail(){
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->email;
    }    
    
    function getFirst_Name(){
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->first_name;
    }    

    function getLast_Name(){
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->last_name;
    }    
    
    function getRole_Id(){        
        $user = $this->loadUser(Yii::app()->user->id);
        if(!is_null($user))
            return $user->role_id;
        return null;
    }    

    function getApplication_Id(){
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->application_id;
    }    
    
    function getStatus(){
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->status;
    }    

    function getGender(){
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->gender;
    }    
    
    function getPhone(){
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->phone;
    }    
    
    // ..... Add more attribute if need
  
    protected function loadUser($id=null)
    {
        if($this->_model===null)
        {
            if($id!==null)
                $this->_model=Users::model()->findByPk($id);
        }
        //to check role after - PDQuang
//        if(!isset($this->_model))
//            $this->_model = new Users;
//            close 2 rows above by Nguyen Dung
        return $this->_model;
    }  
    
    public function loginRequired() 
    {
        $app=Yii::app();
        $request=$app->getRequest();
        /*if(!$request->getIsAjaxRequest())
            $this->setReturnUrl($request->hostInfo.Yii::app()->baseUrl.'/'.$request->pathInfo); 
        
        $moduleInUrl  =  explode('/',$request->pathInfo);*/
        
        $module = isset(Yii::app()->controller->module)?Yii::app()->controller->module->id:'';
        switch ($module) 
        {
            case 'member':
                $login_url = Yii::app()->createAbsoluteUrl('site/index');
                break;
            /*case 'blog':
                $login_url = str_replace('?popup=user-login', '', Yii::app()->request->urlReferrer).'?popup=user-login';
                break;
            case 'clinic':
                $controller = Yii::app()->controller->id;
                $action = Yii::app()->controller->action->id;
                if($controller == "directory" && $action =="detail"){
                    if (strpos(Yii::app()->request->urlReferrer,'Clinics') !== false)
                        $login_url = str_replace('&popup=user-login', '', Yii::app()->request->urlReferrer).'&popup=user-login';
                    else
                        $login_url = str_replace('?popup=user-login', '', Yii::app()->request->urlReferrer).'?popup=user-login';
                }
                else
                    $login_url = Yii::app()->createAbsoluteUrl('/').'?popup=user-login';
                break;
            case 'doctorStaff':
                $login_url = Yii::app()->createAbsoluteUrl('/').'?popup=user-login';
                break;*/
            case 'admin':
                $login_url = Yii::app()->createAbsoluteUrl('admin/site/login');
                break;
            // default:
            //     $login_url = str_replace('?popup=user-login', '', Yii::app()->request->urlReferrer).'?popup=user-login';
            //     break;
        }
        Yii::app()->getRequest()->redirect($login_url);

        /*if(($url=$this->loginUrl)!==null) {
            if(is_array($moduleInUrl))
            if($moduleInUrl[0]=='member')
               // $url=array('/member/site/login');
                // $url=array('site/login');
                $url=array('site/index');
            
            
            if(is_array($url)) {
                $route=isset($url[0]) ? $url[0] : $app->defaultController;
                $url=$app->createUrl($route,array_splice($url,1));
            }
            $request->redirect($url);
        }
        else
        {
            Yii::log('Login Required');
            throw new CHttpException(403,Yii::t('yii','Login Required'));
        }  */          
    }
    
}
?>