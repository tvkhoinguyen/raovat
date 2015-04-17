<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class AdminController extends _BaseController
{

    /**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='/layouts/column2';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	/***
	 * define for icon 
	 * 
	 */
	public $iconList = 'glyphicon glyphicon-th-list';
	public $iconEdit = 'glyphicon glyphicon-pencil';
	public $iconCancel = 'glyphicon glyphicon-remove';
	public $iconSave = 'glyphicon glyphicon-floppy-disk';
	public $iconCreate = 'glyphicon glyphicon-plus';
	public $iconDelete = 'glyphicon glyphicon-trash';
	public $iconSearch = 'glyphicon glyphicon-search';
	public $iconBack = 'glyphicon glyphicon-arrow-left';

	/**
     * Handle the ajax request. This process changes the status of member to 1 (mean active)
     * @param type $id the id of member need changed status to 1
     */
    public function actionAjaxActivate($id) {
        if(Yii::app()->request->isPostRequest)
        {
            $model = $this->loadModel($id);
            if(method_exists($model, 'activate'))
            {
                $model->activate();
            }
            Yii::app()->end();
        }
        else
        {
            Yii::log('Invalid request. Please do not repeat this request again.');
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
            
    }

    /**
     * Handle the ajax request. This process changes the status of member to 0 (mean deactive)
     * @param type $id the id of member need changed status to 0
     */
    public function actionAjaxDeactivate($id) {
        if(Yii::app()->request->isPostRequest)
        {
            $model = $this->loadModel($id);
            if(method_exists($model, 'deactivate'))
            {
                $model->deactivate();
            }
            Yii::app()->end();
        }
        else
        {
            Yii::log('The requested page does not exist.');
            throw new CHttpException(404,'The requested page does not exist.');
        }
            
    }

    public function actionAjaxShow($id) {
        if(Yii::app()->request->isPostRequest)
        {
            $model = $this->loadModel($id);
            if(method_exists($model, 'activate'))
            {
                $model->showInMenu();
            }
            Yii::app()->end();
        }
        else
        {
            Yii::log('Invalid request. Please do not repeat this request again.');
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }            
    }

    public function actionAjaxNotShow($id) {
        if(Yii::app()->request->isPostRequest)
        {
            $model = $this->loadModel($id);
            if(method_exists($model, 'deactivate'))
            {
                $model->notShowInMenu();
            }
            Yii::app()->end();
        }
        else
        {
            Yii::log('Invalid request. Please do not repeat this request again.');
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }           
    }
	
	/**
     * Handle the ajax request. This process changes the approval to 1 (mean approved)
     * @param type $id the id of member need changed status to 1
     */
    public function actionAjaxApprove($id) {
        if(Yii::app()->request->isPostRequest)
        {
            $model = $this->loadModel($id);
            if(method_exists($model, 'approve'))
            {
                $model->approve();
            }
            Yii::app()->end();
        }
        else
        {
            Yii::log('Invalid request. Please do not repeat this request again.');
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }            
    }

    /**
     * Need override
     * @param $id
     * @return null
     */
    public function loadModel($id)
    {
        return null;
    }
    
    public function accessRules()
    {   
		if (empty($this->accessRules))
			$this->accessRules = $this->controllerRules(Yii::app()->controller->id, Yii::app()->controller->module->id);
        return $this->accessRules;
    }
    
   
     public function init()
     {

     	if(isset($this->pageTitle)&& !empty($this->pageTitle))
     	{
     	}

        parent::init();
        if(isset(Yii::app()->user->id))
        {
			$user = Users::model()->findByPk(Yii::app()->user->id);
			if(empty($user) || Yii::app()->user->status ==STATUS_INACTIVE ){
				Yii::app()->user->logout();
				$this->redirect(Yii::app()->createAbsoluteUrl('admin'));
			}
      	}             
    }  
	
	/*
	 * Austin added date 6/7/2014
	 * Render action button in backend screen
	 */
	public function renderControlNav()
	{
		//check role for menu
		
		$this->menu= ControllerActionsName::createMenusRoles($this->menu, $this->listActionsCanAccess);
		
		//generate action button
		$htmlNav = '<div class="navbar-right">
						<div class="btn-group btn-group-sm">';
		if (is_array($this->menu))
		{
			foreach ($this->menu as $menuItems)
			{
				$addIcon = '';
				if (strpos(strtolower($menuItems['label']), 'create') !== false)
					$addIcon = '<span class="glyphicon glyphicon-plus"></span> ';
				elseif (strpos(strtolower($menuItems['label']), 'update') !== false)
					$addIcon = '<span class="glyphicon glyphicon-pencil"></span> ';
				elseif (strpos(strtolower($menuItems['label']), 'manage') !== false)
					$addIcon = '<span class="glyphicon glyphicon-th-list"></span> ';
				elseif (strpos(strtolower($menuItems['label']), 'view') !== false)
					$addIcon = '<span class="glyphicon glyphicon-list-alt"></span> ';
				elseif (strpos(strtolower($menuItems['label']), 'delete') !== false)
					$addIcon = '<span class="glyphicon glyphicon-trash"></span> ';
				
				else
					if (isset($menuItems['icon']))
						$addIcon = '<span class="' . $menuItems['icon'] . '"></span> ';
				
				$htmlNav .= CHtml::link($addIcon . $menuItems['label'], $menuItems['url'],array('class' => 'btn btn-default'));
			}
		}
		$htmlNav .= '</div>'
			. '</div>'
			. '<div class="clr"></div>';
		return $htmlNav;
	}
	


	 /*
	 * Austin added date 9/7/2014
	 * Render delete all button in list screen
	 */
    public function renderDeleteAllButton()
	{
		if (in_array("DeleteAll", $this->listActionsCanAccess))
			echo CHtml::htmlButton('<span class="glyphicon glyphicon-trash"></span> Bulk Delete', array('class' => 'btn btn-default btn-sm deleteall-button', 'type' => 'button'));
	}
	
	/*
	 * Austin added date {date}
	 * Return index ulr of a controller
	 */
	public function baseControllerIndexUrl()
	{
		return Yii::app()->createAbsoluteUrl('admin/' . Yii::app()->controller->id);
	}
	
	public function makeLookUpList($singleArray)
	{
		$returnArray = array();
		if (!empty($singleArray) && is_array($singleArray))
		{
			foreach($singleArray as $item)
				$returnArray[$item] = $item;
		}
		return $returnArray;
	}
	
	public function actionRemoveImage($fieldName, $id)
	{
		try
		{
			$model = $this->loadModel((int) $id);
			$model->removeImage(array($fieldName));
			echo 'thumb_' . $fieldName;
		}
		catch (Exception $exc)
		{
			echo '';
		}
	}
	
	public function actionRemoveFile($fieldName, $id)
	{
		try
		{
			$model = $this->loadModel((int) $id);
			$model->removeFile(array($fieldName));
			echo 'thumb_' . $fieldName;
		}
		catch (Exception $exc)
		{
			echo '';
		}
	}
}
