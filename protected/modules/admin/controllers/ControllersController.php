<?php
class ControllersController extends AdminController
{

	public $pluralTitle = 'Admin Rights';
	public $singleTitle = 'Admin Right';
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view', array(
			'model' => $this->loadModel($id), 'actions' => $this->listActionsCanAccess,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Controllers('create');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Controllers']))
		{
			$model->attributes = $_POST['Controllers'];
			if ($model->save())
			{
				$listRole = Roles::model()->getRoles();
				foreach($listRole as $role)
				{
					$allowActions = $_POST['allowaction'][$role->id];
					$existActionRole = ActionsRoles::model()->find('controller_id = ' . (int)$model->id . " AND roles_id = " . (int)$role->id . " AND can_access = 'allow'");
					if ($existActionRole)
					{
						$existActionRole->actions = implode(',', $allowActions);
						$existActionRole->update(array('actions'));
					}
					else
					{
						$newActionRole = new ActionsRoles();
						$newActionRole->controller_id = $model->id;
						$newActionRole->roles_id = $role->id;
						$newActionRole->can_access = 'allow';
						$newActionRole->actions = implode(',', $allowActions);
						$newActionRole->save();
						
					}
				}
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array(
			'model' => $model, 'actions' => $this->listActionsCanAccess,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Controllers']))
		{
			$model->attributes = $_POST['Controllers'];
			if ($model->save())
			{
				$listRole = Roles::model()->getRoles();
				foreach($listRole as $role)
				{
					$allowActions = $_POST['allowaction'][$role->id];
					$existActionRole = ActionsRoles::model()->find('controller_id = ' . (int)$model->id . " AND roles_id = " . (int)$role->id . " AND can_access = 'allow'");
					if ($existActionRole)
					{
						$existActionRole->actions = implode(',', $allowActions);
						$existActionRole->update(array('actions'));
					}
					else
					{
						$newActionRole = new ActionsRoles();
						$newActionRole->controller_id = $model->id;
						$newActionRole->roles_id = $role->id;
						$newActionRole->can_access = 'allow';
						$newActionRole->actions = implode(',', $allowActions);
						$newActionRole->save();
						
					}
				}
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
			'model' => $model, 'actions' => $this->listActionsCanAccess,
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
			// we only allow deletion via POST request
			if ($model = $this->loadModel($id))
			{
				if ($model->delete())
					Yii::log("Delete record " . print_r($model->attributes, true), 'info');
			}

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else
		{
			Yii::log("Invalid request. Please do not repeat this request again.");
			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model = new Controllers('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Controllers']))
			$model->attributes = $_GET['Controllers'];

		$this->render('index', array(
			'model' => $model, 'actions' => $this->listActionsCanAccess,
		));
	}

	public function actionGroup()
	{
		$model = new Controllers('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Controllers']))
			$model->attributes = $_GET['Controllers'];
		if (!isset($_GET['ajax']))
		{
			Yii::app()->session['type'] = 'ActionsRoles';
			Yii::app()->session['roles'] = 1;
		}

		$this->render('group', array(
			'model' => $model, 'actions' => $this->listActionsCanAccess,
		));
	}

	public function actionUser()
	{
		$model = new Controllers('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Controllers']))
			$model->attributes = $_GET['Controllers'];

		$this->render('user', array(
			'model' => $model, 'actions' => $this->listActionsCanAccess,
		));
	}
	
	public function actionGetControllerList()
	{
		
		$module = isset($_POST['module'])?$_POST['module']:'admin';
		$selectedValue = isset($_POST['selected'])?$_POST['selected']:'';
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
	
	public function actionGetAvailableAction()
	{
		$controller = isset($_POST['controller'])?$_POST['controller']:'';
		$module = isset($_POST['module'])?$_POST['module']:'';
		$allowActions = array();
		$actions =array();
		$listRole = array();
		$controllerTemp = '';
		
		if ($controller != '' && $module != '')
		{
			$controllerTemp .= $controller . 'Controller';
			$actions = Yii::app()->metadata->getActions($controllerTemp, $module);
			$contorllerObj = Controllers::model()->getControllerByName($controller);
			
			$listRole = Roles::model()->getRoles();
			if ($contorllerObj)
				$availableActions = ActionsRoles::model()->findAll('controller_id = ' . (int)$contorllerObj->id . ' AND can_access = \'allow\'');
			if (!empty($availableActions))
			{
				foreach($availableActions as $action)
					$allowActions[$action->roles_id] = explode(',', strtolower(str_replace(' ', '',$action->actions)));
			}
			
		}
		echo $this->renderPartial('_listaction', array('actions' => $actions, 'listRole' => $listRole, 'allowActions' => $allowActions
		));
		
	}
	
	

	

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model = Controllers::model()->findByPk($id);
		if ($model === null)
		{
			Yii::log("The requested page does not exist.");
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
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'controllers-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
