<?php

class BackmenusController extends AdminController
{

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
		$roles = $model->rolesMenus;
		$sRoles = '';
		$this->render('view', array(
			'model' => $model,
			'sRoles' => $sRoles, 'actions' => $this->listActionsCanAccess,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Menus;
		$backendRoles = Roles::model()->findAll('application_id=' . BE);
		$selectedRoles =  RolesMenus::model()->findAll('menu_id="' . $model->id . '"');
		
		if (isset($_POST['Menus']))
		{
			$allowRoles = isset($_POST['allowrole']) ? $_POST['allowrole'] : array();
			$model->attributes = $_POST['Menus'];
			if ($model->save())
			{
				RolesMenus::model()->deleteAll('menu_id="' . $model->id . '"');
				if (!empty($allowRoles))
				{
					foreach ($allowRoles as $role)
					{
						$rolesMenus = new RolesMenus;
						$rolesMenus->role_id = $role;
						$rolesMenus->menu_id = $model->id;
						$rolesMenus->save();
					}
				}
				$this->redirect(array('view', 'id' => $model->id));
			}
		
		}
		$this->render('create', array(
			'model' => $model, 'actions' => $this->listActionsCanAccess, 'roles' => $backendRoles, 'selectedRoles' => $selectedRoles, 
		));
		
		
	}

	public function actionGetactioncheckbox()
	{
		if (isset($_POST['controller']) && isset($_POST['module']))
		{
			$actions = ControllerActionsName::getActions($_POST['controller'], $_POST['module']);
			if ($actions != null)
			{
				$array_action = array_map('trim', explode(",", trim($actions)));
				MyDebug::output($array_action);
			}
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);
		$backendRoles = Roles::model()->findAll('application_id=' . BE);
		$selectedRoles =  RolesMenus::model()->findAll('menu_id="' . $model->id . '"');
		
		if (isset($_POST['Menus']))
		{
			$allowRoles = isset($_POST['allowrole']) ? $_POST['allowrole'] : array();
			$model->attributes = $_POST['Menus'];
			if ($model->save())
			{
				RolesMenus::model()->deleteAll('menu_id="' . $model->id . '"');
				if (!empty($allowRoles))
				{
					foreach ($allowRoles as $role)
					{
						$rolesMenus = new RolesMenus;
						$rolesMenus->role_id = $role;
						$rolesMenus->menu_id = $model->id;
						$rolesMenus->save();
					}
				}
				$this->redirect(array('view', 'id' => $model->id));
			}
		
		}
		$this->render('update', array(
			'model' => $model, 'actions' => $this->listActionsCanAccess, 'roles' => $backendRoles, 'selectedRoles' => $selectedRoles, 
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest)
		{
			RolesMenus::model()->deleteAll(array('condition' => 'menu_id = ' . $id));
			$this->loadModel($id)->delete();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
		{
			Yii::log('Invalid request. Please do not repeat this request again.');
			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model = new Menus('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Menus']))
			$model->attributes = $_GET['Menus'];

		$this->render('admin', array(
			'model' => $model, 'actions' => $this->listActionsCanAccess,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model = Menus::model()->findByPk($id);
		if ($model === null)
		{
			Yii::log('The requested page does not exist.');
			throw new CHttpException(404, 'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'menus-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionGetControllerList()
	{

		$module = isset($_POST['module']) ? $_POST['module'] : 'admin';
		$selectedValue = isset($_POST['selected']) ? $_POST['selected'] : '';
		$html = '<option>--Select One--</option>';
		if ($module != '')
		{
			$controlers = Yii::app()->metadata->getControllers($module);
			if (!empty($controlers))
			{
				foreach ($controlers as $item)
				{
					$item = substr($item, 0, strlen($item) - 10);
					if (strtolower($selectedValue) == strtolower($item))
					{
						$html .= '<option selected value="' . $item . '">' . $item . '</option>';
					}
					else
					{
						$html .= '<option value="' . $item . '">' . $item . '</option>';
					}
				}
			}
		}
		echo $html;
	}

	public function actionGetActionList()
	{
		$controller = isset($_POST['controller']) ? $_POST['controller'] : '';
		$module = isset($_POST['module']) ? $_POST['module'] : '';
		$selectedValue = isset($_POST['selected']) ? $_POST['selected'] : '';
		$actions = array();
		$html = '<option>--Select One--</option>';
		$controllerTemp = '';
		if ($controller != '' && $module != '')
		{
			$controllerTemp .= $controller . 'Controller';
			$actions = Yii::app()->metadata->getActions($controllerTemp, $module);

			if (!empty($actions))
			{
				foreach ($actions as $action)
				{
					//$action = substr($action, 6);
					if (strtolower($selectedValue) == strtolower($action))
					{
						$html .= '<option selected value="' . $action . '">' . $action . '</option>';
					}
					else
					{
						$html .= '<option value="' . $action . '">' . $action . '</option>';
					}
				}
			}
		}
		echo $html;
	}

}
