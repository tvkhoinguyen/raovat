<?php

class EnquiryTypesController extends AdminController
{
    public $pluralTitle = 'Enquiry Type Management';
    public $singleTitle = 'Enquiry Type';
    public $cannotDetele = array();
    public function actionCreate(){
        try {
            $model = new SpEnquiryTypes('create');
            if (isset($_POST['SpEnquiryTypes'])) {
                $model->attributes = $_POST['SpEnquiryTypes'];
                if($model->save()){
                    $this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been created');
                    $this->redirect(array('index'));
		}
		else
                    $this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be created for some reasons');
            }
            $this->render('create', array(
                'model' => $model,
                'actions' => $this->listActionsCanAccess,
            ));
        }catch (exception $e) {
            Yii::log("Exception " . print_r($e, true), 'error');
            throw new CHttpException($e);
        }
    }

    public function actionDelete($id) {
        try {
            if(Yii::app()->request->isPostRequest) {
                // we only allow deletion via POST request
                if (!in_array($id, $this->cannotDetele))
                {
                        if($model = $this->loadModel($id)){
                                                                                if($model->delete())
                                        Yii::log("Delete record ".  print_r($model->attributes, true), 'info');
                        }

                        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                        if(!isset($_GET['ajax']))
                                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
                }
            } else {
                Yii::log("Invalid request. Please do not repeat this request again.");
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
            }
        } catch (Exception $e) {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException($e);
        }
    }      
    
    public function actionIndex() {
        try {
            $model=new SpEnquiryTypes('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['SpEnquiryTypes']))
                $model->attributes=$_GET['SpEnquiryTypes'];

            $this->render('index',array(
                'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
        } catch (Exception $e) {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException($e);
        }
    }

    public function actionUpdate($id) {
        $model=$this->loadModel($id);
        if(isset($_POST['SpEnquiryTypes']))
        {
            $model->attributes=$_POST['SpEnquiryTypes'];
            if ($model->save()) {
		$this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been updated');
		$this->redirect(array('index'));
            } else
		$this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be updated for some reasons');
        }
        //$model->beforeRender();
        $this->render('update',array(
            'model' => $model,
            'actions' => $this->listActionsCanAccess,
            'title_name' => $model->name        
        ));
    }

	/*
	* Bulk delete
	* If you don't want to delete some specified record please configure it in global $cannotDetele variable
	*/
	public function actionDeleteAll()
	{
		$deleteItems = $_POST['sp-enquiry-types-grid_c0'];
		$shouldDelete = array_diff($deleteItems, $this->cannotDetele);

		if (!empty($shouldDelete))
		{
			SpEnquiryTypes::model()->deleteAll('id in (' . implode(',', $shouldDelete) . ')');
			$this->setNotifyMessage(NotificationType::Success, 'Your selected records have been deleted');
		}
		else
			$this->setNotifyMessage(NotificationType::Error, 'No records was deleted');

		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}
	
		
    public function loadModel($id){
        //need this define for inherit model case. Form will render parent model name in control if we don't have this line
        $initMode = new SpEnquiryTypes();
        $model=$initMode->findByPk($id);
        if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
}