<?php
class ImageExampleController extends AdminController
{
        /**
         * 
         * Example of update image
         * @copyright (c) 2014, bb
         * 
         */
	public function actionUpdate($id)
	{
//            try
//            {
		$model=$this->loadModel($id);
		if(isset($_POST['ImageExample']))
		{
			$model->attributes=$_POST['ImageExample'];   
			if($model->save())
                        {
                            $model->saveImages();                      
//                            $model->deleteCurrentImage('image1');//use this if you want to delete image when user click delete this image
                            $this->redirect(array('view','id'=>$model->id));
                        }
		}
		$this->render('update',array(
			'model'=>$model, 'actions' => $this->listActionsCanAccess,
		));
//            }
//            catch (Exception $e)
//            {
//                Yii::log("Exception ".  print_r($e, true), 'error');
//                throw  new CHttpException("Exception ".  print_r($e, true));     
//            }
	}
        
	public function actionView($id)
	{
                try{
                $this->render('view',array(
			'model'=>$this->loadModel($id), 'actions' => $this->listActionsCanAccess,
		));
                }
                catch (Exception $e)
                {
                    Yii::log("Exception ".  print_r($e, true), 'error');
                    throw  new CHttpException("Exception ".  print_r($e, true));     
                }
		
	}

	/**
         * 
         * Example of create image
         * @copyright (c) 2014, bb
         * 
         */
	public function actionCreate()
	{
//                try
//                {
		$model=new ImageExample('create');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ImageExample']))
		{
			$model->attributes=$_POST['ImageExample'];
			if($model->save())
                        {
                            $model->saveImages();         

                            $this->redirect(array('view','id'=>$model->id));
                        }
				
		}

		$this->render('create',array(
			'model'=>$model, 'actions' => $this->listActionsCanAccess,
		));
//                }
//                catch (Exception $e)
//                {
//                    Yii::log("Exception ".  print_r($e, true), 'error');
//                    throw  new CHttpException("Exception ".  print_r($e, true));     
//                }
	}

	
	public function actionDelete($id)
	{
                try
                {
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			if($model = $this->loadModel($id))
                        {
                            if($model->delete())
                                Yii::log("Delete record ".  print_r($model->attributes, true), 'info');
                        }

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else
                {
                    Yii::log("Invalid request. Please do not repeat this request again.");
                    throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
                }	
                }
                catch (Exception $e)
                {
                    Yii::log("Exception ".  print_r($e, true), 'error');
                    throw  new CHttpException("Exception ".  print_r($e, true));     
                }
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
//                try
//                {
		$model=new ImageExample('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ImageExample']))
			$model->attributes=$_GET['ImageExample'];

		$this->render('index',array(
			'model'=>$model, 'actions' => $this->listActionsCanAccess,
		));
//                }
//                catch (Exception $e)
//                {
//                    Yii::log("Exception ".  print_r($e, true), 'error');
//                    throw  new CHttpException("Exception ".  print_r($e, true));     
//                }
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
                try
                {
		$model=ImageExample::model()->findByPk($id);
		if($model===null)
                {
                    Yii::log("The requested page does not exist.");
                    throw new CHttpException(404,'The requested page does not exist.');
                }			
		return $model;
                }
                catch (Exception $e)
                {
                    Yii::log("Exception ".  print_r($e, true), 'error');
                    throw  new CHttpException("Exception ".  print_r($e, true));     
                }
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
                try
                {
		if(isset($_POST['ajax']) && $_POST['ajax']==='image-example-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
                }
                catch (Exception $e)
                {
                    Yii::log("Exception ".  print_r($e, true), 'error');
                    throw  new CHttpException("Exception ".  print_r($e, true));     
                }
	}
}
