<?php

class TinRaoVatHiddenController extends AdminController
{
    public $pluralTitle = 'Tin Rao Vặt';
    public $singleTitle = 'Tin Rao Vặt';
    public $cannotDelete = array();
    public function actionCreate()
    {
        $model = new TinRaoVat('create_be');
        $user = Users::model()->findByPk(Yii::app()->user->id);
        $model->post_user_name = $user->full_name;
        $model->post_user_id = Yii::app()->user->id;


        if (isset($_POST['TinRaoVat'])) {
            $model->attributes = $_POST['TinRaoVat'];
            if($model->save())
			{ 	
                if($model->status==STATUS_ACTIVE)
                {
                    $model->updated_date_status = date('Y-m-d H:i:s');
                    $model->update( array('updated_date_status') );
                }
                $model->saveImage('image1');
                $model->saveImage('image2');
				$this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been created');
                $this->redirect(array('view', 'id'=> $model->id));
			}
			else
				$this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be created for some reasons');
        }
        $this->render('create', array(
            'model' => $model,
            'actions' => $this->listActionsCanAccess,
        ));
        
    }

    public function actionDelete($id) {
        try {
            if(Yii::app()->request->isPostRequest) {
                // we only allow deletion via POST request
				if (!in_array($id, $this->cannotDelete))
				{
					if($model = $this->loadModel($id))
					{
                        if($model->delete())
						{
							//Yii::log("Delete record ".  print_r($model->attributes, true), 'info');
						}
					}

					// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
					if(!isset($_GET['ajax']))
						$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
				}
            } else {
                //Yii::log("Invalid request. Please do not repeat this request again.");
                //throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
            }
        } catch (Exception $e) {
            //Yii::log("Exception ".  print_r($e, true), 'error');
            //throw  new CHttpException($e);
        }
    }      
    
    public function actionIndex() 
    {
        try {
            $model=new TinRaoVat('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['TinRaoVat']))
                $model->attributes=$_GET['TinRaoVat'];

            $this->render('index',array(
                'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
        } catch (Exception $e) {
            //Yii::log("Exception ".  print_r($e, true), 'error');
            //throw  new CHttpException($e);
        }
    }

    public function actionUpdate($id) 
    {
        $model=$this->loadModel($id);
        $user = Users::model()->findByPk(Yii::app()->user->id);
        $model->edit_user_name = $user->full_name;
        $model->edit_user_id = Yii::app()->user->id;
        if(isset($_POST['TinRaoVat']))
        {
            
            $old_image1 = $model->image1;
        	$old_image2 = $model->image2;
            $model->attributes=$_POST['TinRaoVat'];
            $uploadImage1 = CUploadedFile::getInstance($model, 'image1');
            $uploadImage2 = CUploadedFile::getInstance($model, 'image2');

            if ($model->save())
			{ 		
                if($model->status==STATUS_ACTIVE)
                {
                    // $model->updated_date_status = date('Y-m-d H:i:s');
                    // $model->update( array('updated_date_status') );
                }else if($model->status==STATUS_INACTIVE)
                {
                    // $model->updated_date_status = date('Y-m-d H:i:s');
                    // $model->update( array('updated_date_status') );
                }


            	if( empty($uploadImage1) || $uploadImage1==NULL )
                {
                    $model->image1 = $old_image1;
                    $model->update( array('image1') );
                }else{
                        $model->saveImage('image1');
                        $model->deleteImages('image1', $old_image1);
                }

                if( empty($uploadImage2) || $uploadImage2==NULL )
                {
                    $model->image2 = $old_image2;
                    $model->update( array('image2') );
                }else{
                        $model->saveImage('image2');
                        $model->deleteImages('image2', $old_image2);
                }

				$this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been updated');
				$this->redirect(array('view', 'id'=> $model->id));
			}
			else
				$this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be updated for some reasons');
        }
        //$model->beforeRender();
        $this->render('update',array(
            'model' => $model,
            'actions' => $this->listActionsCanAccess,
            'title_name' => $model->title        ));
    }

    
    public function actionView($id) {
        // try {
            $model = $this->loadModel($id);
            $this->render('view', array(
                'model'=> $model,
                'actions' => $this->listActionsCanAccess,
                'title_name' => $model->title            ));
        // } catch (Exception $exc) {
        //     throw new CHttpException(404, 'The requested page does not exist.');
        // }
    }

	/*
	* Bulk delete
	* If you don't want to delete some specified record please configure it in global $cannotDelete variable
	*/
	public function actionDeleteAll()
	{
		$deleteItems = $_POST['tin-rao-vat-grid_c0'];
		$shouldDelete = array_diff($deleteItems, $this->cannotDelete);

		if (!empty($shouldDelete))
		{
			TinRaoVat::model()->deleteAll('id in (' . implode(',', $shouldDelete) . ')');
			$this->setNotifyMessage(NotificationType::Success, 'Your selected records have been deleted');
		}
		else
			$this->setNotifyMessage(NotificationType::Error, 'No records was deleted');

		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}
	
		
    public function loadModel($id){
		//need this define for inherit model case. Form will render parent model name in control if we don't have this line
		$initMode = new TinRaoVat();
        $model=$initMode->findByPk($id);
        if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
}