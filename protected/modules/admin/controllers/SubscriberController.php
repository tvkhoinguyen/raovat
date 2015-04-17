<?php

class SubscriberController extends AdminController
{
    public $pluralTitle = 'Subscriber';
    public $singleTitle = 'Subscriber';
    public $cannotDetele = array();
    public function actionCreate(){
        try {
            $model = new Subscriber('create');
            if (isset($_POST['Subscriber'])) {
                $model->attributes = $_POST['Subscriber'];
                if($model->validate()){
					$model->subscribed_date = date('Y-m-d H:i:s');
                    if($model->save())
                    {
                        $model->saveMuilGroupSubscriber();
                        $this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been created');
                        $this->redirect(array('view', 'id'=> $model->id));
                    }
                }else
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
						if($model->delete()){
                             //delete all data 
                            GroupGroupSubscriber::model()->deleteAllByAttributes(array('subscriber_id'=>$model->id));
							Yii::log("Delete record ".  print_r($model->attributes, true), 'info');
                        }
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
            $model=new Subscriber('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Subscriber']))
                $model->attributes=$_GET['Subscriber'];

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
        $model->scenario ='update';
		$model->subscriber_group_id = $model->getGroupidwithSubscriberID();
        if(isset($_POST['Subscriber']))
        {
            $model->attributes=$_POST['Subscriber'];
            if($model->validate()){
                if ($model->save())
                {
                    $model->saveMuilGroupSubscriber();
                    $this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been updated');
                    $this->redirect(array('view', 'id'=> $model->id));
                }
            }else
				$this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be updated for some reasons');
        }
        //$model->beforeRender();
        $this->render('update',array(
            'model' => $model,
            'actions' => $this->listActionsCanAccess,
            'title_name' => $model->name        ));
    }

    
    public function actionView($id) {
        try {
            $model = $this->loadModel($id);
            $this->render('view', array(
                'model'=> $model,
                'actions' => $this->listActionsCanAccess,
                'title_name' => $model->name            ));
        } catch (Exception $exc) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

	/*
	* Bulk delete
	* If you don't want to delete some specified record please configure it in global $cannotDetele variable
	*/
	public function actionDeleteAll()
	{
		$deleteItems = $_POST['subscriber-grid_c0'];
		$shouldDelete = array_diff($deleteItems, $this->cannotDetele);

		if (!empty($shouldDelete))
		{
			Subscriber::model()->deleteAll('id in (' . implode(',', $shouldDelete) . ')');
			$this->setNotifyMessage(NotificationType::Success, 'Your selected records have been deleted');
		}
		else
			$this->setNotifyMessage(NotificationType::Error, 'No records was deleted');

		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}
	
		
    public function loadModel($id){
		//need this define for inherit model case. Form will render parent model name in control if we don't have this line
		$initMode = new Subscriber();
        $model=$initMode->findByPk($id);
        $model->oldObj = clone $model;
        if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    public function actionImport() {
        $model = new Subscriber('import');
        if (isset($_POST['Subscriber'])) {
            
            $model->attributes = $_POST['Subscriber'];
            $model->filename = CUploadedFile::getInstance($model, 'filename');
            if ($model->validate()) {
                $model->filename->saveAs('upload/import/' . $model->filename->name);
                $documentFilename             = Yii::getPathOfAlias('webroot') . '/upload/import/' . $model->filename->name;
                $_SESSION['import_file_name'] = $documentFilename;
                $_SESSION['group_id'] = json_encode($model->subscriber_group_id);
                
                $this->redirect(Yii::app()->createAbsoluteUrl('/admin/subscriber/import'));
            }
        }
        
        $this->render('import', array(
            'model' => $model
        ));
    }


    // public function actionRemoveFile() {
        // if ($_SESSION['import_file_name']) {
            // unlink($_SESSION['import_file_name']);
            // unset($_SESSION['import_file_name']);
            // unset($_SESSION['group_id']);

            // $this->redirect(Yii::app()->createAbsoluteUrl("admin/Subscriber/import"));
        // }
    // }

    public function checkEmailimport($email){
        $email=strip_tags(trim($email)) ;
        if (!preg_match ( '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $email)){
             return 'Email is wrong';
        }else{
            //kiem tra email
            $findEmail = Subscriber::model()->findByAttributes(array('email' =>$email));
            if($findEmail){
                return 'Duplicate email';
            }
            return null;            
        }
    }

    public function actionImportAttribute() {
        
        $tableName     = Subscriber::model()->tableSchema->name;
        $categoryTable = GroupGroupSubscriber::model()->tableSchema->name;
        
        //get import file path from session
        $documentFilename = $_SESSION['import_file_name'];
        $category = $_SESSION['group_id'];

        //check if file exists
        if (file_exists($documentFilename) && $category !='') {
            $err_array = array();
            //read sheet product family with index 0
            $sheet1    = new ExcelReader($documentFilename, 0);

            unset($sheet1->data[1]);
            $htmlEroor = '';
            if (count($sheet1) > 0) {
                //building import query
                $sql             = "INSERT INTO " . $tableName . " (`name`, `email`, `status`, `subscriber_group_id`,`date_unsubscriber`) VALUES ";
                $sqlCategory     = "INSERT INTO " . $categoryTable . " (`subscriber_id`, `group_id`) VALUES ";
                $columInsert = array(); 
                $arrIdGroup = array();   
                foreach ($sheet1->data as $key => $item) {
                    if ( $item['A'] !='' && $item['B'] !='') { //Check null
                        $emailcheck = $this->checkEmailimport(strip_tags($item['B']));
                        if($emailcheck==''){
                            $name   = $item['A'];
                            $email  = $item['B'];
                            $status = STATUS_ACTIVE;
                            $subscriber_group_id = $category;
                            $date_unsubscriber = NULL;

                            $buidsql ='';
                            $buidsql .= "(";
                            $buidsql .= "'" .  $name . "',"; 
                            $buidsql .= "'" .  $email . "',"; 
                            $buidsql .= $status . ","; 
                            $buidsql .= "'" .  $subscriber_group_id . "',"; 
                            $buidsql .= "'" .  $date_unsubscriber . "'";    
                            $buidsql .= ");";
                            $columInsert[] = $buidsql;
                            Yii::app()->db->createCommand($sql.$buidsql)->query();
                            $last_id = Yii::app()->db->getLastInsertID();
                            $arrIdGroup[$last_id] = $last_id; 
                        }else{
                             $htmlEroor .= $emailcheck .' at line ' . $key . '</br>';
                        }
                    }
                }  
                if(count($arrIdGroup)>0){
                    $arrGroup = json_decode($category,true);
                    if(is_array($arrIdGroup) && count($arrIdGroup)>0){
                        $tmp = array();
                        foreach($arrIdGroup as $subscriber){
                            foreach( $arrGroup as $group_id){
                                $buidsql ='';
                                $buidsql .= "(";
                                $buidsql .= "'" . $subscriber . "',";    
                                $buidsql .= "'" . $group_id . "'"; 
                                $buidsql .= ")";  
                                $tmp[] = $buidsql;                              
                            }
                        }  
                        if(count($tmp)>0){
                            //insert tabel group category
                            $cateSql = implode(',', $tmp) .';';
                            Yii::app()->db->createCommand($sqlCategory .$cateSql)->query();
                        }
                    }
                }
            }else{
                $htmlEroor .= 'Data import error</br>';
            }
        }
        echo $htmlEroor;
    }


}