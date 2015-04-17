<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class _BaseController extends CController {

    protected $listActionsCanAccess;
    protected $accessRules = array();
    public $_metaKeyword;
    public $_metaDescription;
    
    // param for MediaUpload
    public $formUploadName = "";
    public $folderImage = "";
    public $thumbKey = "";
    public $modelUploadName = "";
    public $modelUploadDetail = "";
    public $thumbDefault = "";

    public $showFullScreen = false; // hien thi full man hinh
    public $showBanner     = true; // hien thi banner

    //new check controller access rules - PDQuang
    protected function controllerRules($controller, $module = null) {
        $accessArray = array();
        $controller_model = Controllers::model()->find("controller_name like '$controller' and module_name like '$module'");
        if (!$controller_model)
            return array(array('deny'));
        
        $actions_role = ActionsRoles::model()->findAll(array('condition' => "controller_id = $controller_model->id  and can_access LIKE 'allow'",
            'order' => 'controller_id desc'));
        if ($actions_role) {
            foreach ($actions_role as $key => $action_role) {
                // Custom for action upload image
                $actions =  $action_role->actions . ', Upload';
                $array_action = array_map('trim', explode(",", trim($actions)));
                if (isset(Yii::app()->user->role_id) && empty($this->listActionsCanAccess) && $action_role->roles_id == Yii::app()->user->role_id) {
                    $this->listActionsCanAccess = $array_action;
                }
                $accessArray[] = array('allow',
                    'actions' => $array_action,
                    'users' => array('@'),
                    'expression' => 'Yii::app()->user->role_id == ' . $action_role->roles_id
                );
            }
        }
        $accessArray[] = array('deny');

        return $accessArray;
    }

    public function init() {
        parent::init();
    }

    /**
     * @return array action filters
     * This is user for access rule
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function beforeRender($view) {
        parent::beforeRender($view);
        if (isset(Yii::app()->user->id)) {
            $mUser = Users::model()->findByPk(Yii::app()->user->id);
            if (is_null($mUser) || $mUser->status == STATUS_INACTIVE) {
                Yii::app()->user->logout();
                Yii::app()->controller->redirect(Yii::app()->createAbsoluteUrl('site/login'));
            }
        }
        $this->rewriteForSeo();
        return true;
    }

    public function performAjaxValidationPopup() {
        $model = new Enquiry();
        if (isset($_POST['ajax'])) {
            if (isset($_POST['Enquiry'])) {
                $model->attributes = $_POST['Enquiry'];
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        }
    }

    public function getCurrentUrlWithoutParam() {
        $uriWithoutParam = $_SERVER['REQUEST_URI'];
        if (strpos($uriWithoutParam, '?') != false)
            $uriWithoutParam = substr($uriWithoutParam, 0, strpos($uriWithoutParam, '?'));
        return 'http://' . $_SERVER['SERVER_NAME'] . $uriWithoutParam;
    }

    public function rewriteForSeo() {
        $titlePage = '';
        $meta_description = '';
        $meta_keywords = '';
        $action = Yii::app()->controller->action->id;
        $controller = Yii::app()->controller->id;
        //set meta_description & meta_keywords for each page of Page
        if ($action == "view_page" && isset($_GET['slug'])):
            $page = Pages::findBySlug($_GET['slug']);
            if (!is_null($page))
                $titlePage = $page->title;

            $meta_description = trim($page->meta_desc);
            $meta_keywords = trim($page->meta_keywords);
        endif;

        $currentURL = $this->getCurrentUrlWithoutParam();
        $currentURL = trim($currentURL, '/');
        $seoObj = Seos::model()->find('url = \'' . str_replace("'", "''", $currentURL) . '\'');
        if ($seoObj) {
            $titlePage = $seoObj->title_tag;
            $meta_description = $seoObj->meta_desc;
            $meta_keywords = $seoObj->meta_keyword;
        }

        $titlePage = trim($titlePage);

        if (!empty($titlePage)) {
            $this->setPageTitle($titlePage);
        }
        if (!empty($meta_description)) {
            $this->setMetaDescription($meta_description);
        }
        if (!empty($meta_keywords)) {
            $this->setMetaKeywords($meta_keywords);
        }
    }

    public function getMetaKeywords() {
        if (!empty($this->_metaKeyword)) {
            return $this->_metaKeyword;
        } else {
            $setting = Yii::app()->setting;
            $default = $setting->getItem('metaKeywords');
            return $default;
        }
    }

    public function setMetaKeywords($value) {
        $this->_metaKeyword = $value;
    }

    public function getMetaDescription() {
        if (!empty($this->_metaDescription)) {
            return $this->_metaDescription;
        } else {
            $setting = Yii::app()->setting;
            $default = $setting->getItem('metaDescription');
            return $default;
        }
    }

    public function setMetaDescription($value) {
        $this->_metaDescription = $value;
    }
    
    /*
     * Austin added date 9/7/2014
     * Show nofify message if it has
     */

    public function renderNotifyMessage() {
        if (Yii::app()->user->hasFlash('beFormAction')) {
            echo '<div class="alert alert-success" role="alert">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'
            . Yii::app()->user->getFlash('beFormAction') .
            '</div>';
        }

        if (Yii::app()->user->hasFlash('beFormError')) {
            echo '<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'
            . Yii::app()->user->getFlash('beFormError') .
            '</div>';
        }
    }

    /*
     * Austin added date 9/7/2014
     * Set notify message
     * type will get from enum NotificationType
     */

    public function setNotifyMessage($type, $message) {
        if ($type == NotificationType::Error)
            Yii::app()->user->setFlash('beFormError', $message);
        elseif ($type == NotificationType::Success)
            Yii::app()->user->setFlash('beFormAction', $message);
    }

    public function setMessageError($message) 
    {
        Yii::app()->user->setFlash('message_error', $message);
    }
    public function getMessageError() 
    {
        if (Yii::app()->user->hasFlash('message_error')) {
            echo '<div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'
                . Yii::app()->user->getFlash('message_error') .
                '</div>';
        }
    }

    public function setMessageSuccess($message) 
    {
        Yii::app()->user->setFlash('message_success', $message);
    }
    public function getMessageSuccess() 
    {
        if (Yii::app()->user->hasFlash('message_success')) {
            echo '<div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'
                . Yii::app()->user->getFlash('message_success') .
                '</div>';
        }
    }
}

abstract class NotificationType {

    const Error = "beFormError";
    const Success = "beFormAction";
}

?>