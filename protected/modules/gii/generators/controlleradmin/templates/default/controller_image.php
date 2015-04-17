<?php
/**
 * This is the template for generating a controller class file.
 * The following variables are available in this template:
 * - $this: the ControllerImage object
 */
?>
<?php echo "<?php\n"; ?>
class <?php echo $this->controllerClass; ?> extends <?php echo $this->baseClass."\n"; ?>{
    public static $title_pages = '<?php echo $this->model_name; ?>s';
    public static $title_page = '<?php echo $this->model_name; ?>';
    
<?php 
    foreach($this->getActionIDs() as $action): 
        if ($action == '_form' || $action == '_search')
            continue;
?>
<?php if ($action == 'index') { ?>
    public function actionIndex() {
        $model = new <?php echo $this->model_name; ?>('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['<?php echo $this->model_name; ?>']))
                $model->attributes=$_GET['<?php echo $this->model_name; ?>'];

        $this->render('index',array(
                'model'=>$model, 'actions' => $this->listActionsCanAccess,
        ));
    }
<?php } elseif ($action == 'create') { ?>    
    public function actionCreate() {
        $model = new <?php echo $this->model_name; ?>('create');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['<?php echo $this->model_name; ?>'])) {
            $model->attributes = $_POST['<?php echo $this->model_name; ?>'];
            $model->imageFile = CUploadedFile::getInstance($model, 'imageFile');
            $model->scenario = 'create';

            if ($model->validate()) {
                $timestamp = time();
                if (!is_null($model->imageFile)) {
                    $ext = $model->imageFile->getExtensionName();
                    $model->large_image = $timestamp . '.' . $ext;
                }
                if ($model->save()) {
                    if (!is_null($model->imageFile)) {
                        $model->large_image = <?php echo $this->model_name; ?>::saveImage($model);
                        <?php echo $this->model_name; ?>::resizeImage($model);
                        $model->update(array('large_image'));
                    }
                    $this->redirect(array('view', 'id' => $model->id));
                }
            }
        }

        $this->render('create', array(
            'model' => $model, 'actions' => $this->listActionsCanAccess,
        ));
    }
<?php } elseif ($action == 'update') { ?>     
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->scenario = 'update';
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $old_image = $model->large_image;
        if (isset($_POST['<?php echo $this->model_name; ?>'])) {
            $model->attributes = $_POST['<?php echo $this->model_name; ?>'];

            $isEmptyFileInput = empty($_FILES["<?php echo $this->model_name; ?>"]["name"]["imageFile"]);
            if (!$isEmptyFileInput) { //has file input
                $model->imageFile = CUploadedFile::getInstance($model, 'imageFile');
            }

            if ($model->validate()) {
                if (!is_null($model->imageFile)) {
                    $model->large_image = <?php echo $this->model_name; ?>::saveImage($model);
                    <?php echo $this->model_name; ?>::resizeImage($model);
                    $model->update(array('large_image'));
                }
                if ($model->update()) {
                    $this->redirect(array('view', 'id' => $model->id));
                }
            }
        }
        $this->render('update', array(
            'model' => $model, 'actions' => $this->listActionsCanAccess, 'title_name' => $model-><?php echo $title_name; ?>
        ));
    }
<?php } elseif ($action == 'delete') { ?>     
    public function actionDelete($id) {
        if(Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            if($model = $this->loadModel($id))
            {
                if($model->delete())
                    Yii::log("Delete record ".  print_r($model->attributes, true), 'info');
            }

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                   $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        } else {
            //Yii::log('Invalid request. Please do not repeat this request again.');
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
    }
<?php } elseif ($action == 'view') { ?>    
    public function actionView($id) {
        try{
            $model = $this->loadModel($id);
            $this->render('view',array(
                'model'=> $model,
                'actions' => $this->listActionsCanAccess,
                'title_name' => $model-><?php echo $title_name; ?>
            ));
        }
        catch (Exception $e)
        {
            //Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));
        }
    }
<?php } ?>   
<?php endforeach; ?>
    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        try {
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'prec-partners-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        } catch (Exception $e) {
            //Yii::log("Exception " . print_r($e, true), 'error');
            throw new CHttpException("Exception " . print_r($e, true));
        }
    }
    
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        try {
            $model = <?php echo $this->model_name; ?>::model()->findByPk($id);
            if($model===null) {
                //Yii::log("The requested page does not exist.");
                throw new CHttpException(404,'The requested page does not exist.');
            }
            return $model;
        } catch (Exception $e) {
            //Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));
        }
    }
}
