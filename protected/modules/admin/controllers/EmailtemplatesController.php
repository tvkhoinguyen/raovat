<?php

class EmailtemplatesController extends AdminController
{

	public $pluralTitle  = 'Email Templates';
	public $singlelTitle  = 'Email Template';
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
		$model = new EmailTemplates;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if (isset($_POST['EmailTemplates']))
		{
			$model->attributes = $_POST['EmailTemplates'];
			if ($this->checkParam($model->parameter_description, $model->email_body) == false)
			{
				$model->addError('email_body', 'incorrect parameter');
			}
			else
			{
				if ($model->save())
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
		$this->performAjaxValidation($model);

		if (isset($_POST['EmailTemplates']))
		{
			$model->attributes = $_POST['EmailTemplates'];
			if ($this->checkParam($model->parameter_description, $model->email_body) == false)
			{
				$model->addError('email_body', 'incorrect parameter');
			}
			else
			{
				if ($model->save())
					$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
			'model' => $model, 'actions' => $this->listActionsCanAccess,
		));
	}
        
        public function actionInvoice($id) {
            $model = $this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if (isset($_POST['EmailTemplates']))
		{
			$model->attributes = $_POST['EmailTemplates'];
			if ($model->save()) {
                            $this->setNotifyMessage(NotificationType::Success, 'Update invoice template successfully');
                            $this->redirect(array('invoice', 'id' => $model->id));
                        } else {
                            
                        }
		}

		$this->render('invoice', array(
			'model' => $model, 'actions' => $this->listActionsCanAccess,
		));
        }

        public function checkParam($parameter, $body)
	{
		$pattern = '#\{(.*?)\}#';
		preg_match_all($pattern, $parameter, $match_p);
		preg_match_all($pattern, $body, $match_b);
		$flag = true;
		if (!empty($match_b) && !(empty($match_p)))
		{
			foreach ($match_b[0] as $val)
			{
				if (in_array($val, $match_p[0]))
				{
					$flag = true;
				}
				else
				{
					$flag = false;
					break;
				}
			}
		}
		return $flag;
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
			Yii::log('Invalid request. Please do not repeat this request again.');
			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model = new EmailTemplates('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['EmailTemplates']))
			$model->attributes = $_GET['EmailTemplates'];

		$this->render('index', array(
			'model' => $model, 'actions' => $this->listActionsCanAccess,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new EmailTemplates('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['EmailTemplates']))
			$model->attributes = $_GET['EmailTemplates'];

		$this->render('admin', array(
			'model' => $model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model = EmailTemplates::model()->findByPk((int) $id);
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
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'email-templates-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
