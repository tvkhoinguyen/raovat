<?php

class ManageadminController extends AdminController
{

	public $pluralTitle = 'Admin Accounts';
	public $singlelTitle = 'Admin Account';
	public $cannotDetele = array(2);

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
		$model = new Users('createAdmin');

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if (isset($_POST['Users']))
		{
			$model->attributes = $_POST['Users'];
			if ($model->validate())
			{
				$model->role_id = ROLE_ADMIN; //save role for admin
				$model->application_id = BE; //save user for back end
				$model->password_hash = md5($model->temp_password);
				$model->created_date = date('Y-m-d H:i:s');
				$model->save();
				$this->setNotifyMessage(NotificationType::Success, $this->singlelTitle . ' has been created');
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
		$model->scenario = 'editAdmin';

		$old_temp_password = $model->temp_password;
		$old_hash_pass = $model->password_hash;

		if (isset($_POST['Users']))
		{
			$model->attributes = $_POST['Users'];
			if ($model->validate())
			{
				if( empty($model->temp_password) && empty($model->password_confirm) )
				{
					$model->temp_password = $old_temp_password;
					$model->password_hash = $old_hash_pass; 
					//OR $model->password_hash=md5($old_temp_password);
				}else if( !empty($model->temp_password) && !empty($model->password_confirm) && $model->temp_password==$model->password_confirm )
				{
					$model->temp_password = $model->password_confirm;
					$model->password_hash = md5($model->temp_password);
				}

				$model->update();
				$this->setNotifyMessage(NotificationType::Success, $this->singlelTitle . ' has been updated');
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
		$cannotDetele[] = Yii::app()->user->id;

		if (Yii::app()->request->isPostRequest)
		{
			if (!in_array($id, $cannotDetele))
				if ($model = $this->loadModel($id))
				{
					if ($id == Yii::app()->user->id)
						throw new CHttpException(400, 'We can not delete this account.');

					if ($model->delete())
						Yii::log("Delete record " . print_r($model->attributes, true), 'info');
				}
			//Yii::app()->user->setFlash('beFormAction','Your selected record have been deleted');
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

	public function actionDeleteAll()
	{
		$deleteItems = $_POST['users-grid_c0'];
		$cannotDetele[] = Yii::app()->user->id;
		$shouldDelete = array_diff($deleteItems, $cannotDetele);

		if (!empty($shouldDelete))
		{
			Users::model()->deleteAll('id in (' . implode(',', $shouldDelete) . ')');
			$this->setNotifyMessage(NotificationType::Success, 'Your selected records have been deleted');
		}
		else
			$this->setNotifyMessage(NotificationType::Error, 'No records was deleted');

		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model = new Users('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Users']))
			$model->attributes = $_GET['Users'];
		$model->role_id = ROLE_ADMIN;
		$this->render('index', array(
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
		$model = Users::model()->findByPk($id);
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
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'admin-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionUpdate_my_profile()
	{
		if (Yii::app()->user->id == '')
			$this->redirect(array('login'));

		$model = $this->loadModel(Yii::app()->user->id);
		$model->scenario = 'updateMyProfile';
		//$model->md5pass = $model->password_hash;

		if (isset($_POST['Users']))
		{
                   
			$model->attributes = $_POST['Users'];
			if ($model->validate())
			{
				if ($model->save())
				{
					$this->setNotifyMessage(NotificationType::Success, 'Your profile information has been successfully updated.');
					$this->redirect(array('manageadmin/update_my_profile'));
				}
			}
		}

		$this->render('update_my_profile', array(
			'model' => $model,
		));
	}

	public function actionChange_my_password()
	{
		if (Yii::app()->user->id == '')
			$this->redirect(array('login'));

		$model = $this->loadModel(Yii::app()->user->id);
		$model->scenario = 'changeMyPassword';

		if (isset($_POST['Users']))
		{
			$model->attributes = $_POST['Users'];
			if ($model->validate())
			{
				$model->password_hash = md5($model->newPassword);
				$model->temp_password = $model->newPassword;
				if ($model->update(array('password_hash', 'temp_password')))
				{
					// SendEmail::noticeChangPasswordSucceedToAdmin($model);
					$this->setNotifyMessage(NotificationType::Success, 'Your password has been changed successfully');
					// $this->redirect(array('manageadmin/change_my_password'));
					$this->refresh();
				}
			}
		}

		$this->render('change_my_password', array(
			'model' => $model,
		));
	}

}
