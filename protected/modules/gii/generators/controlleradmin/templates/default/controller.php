<?php
/**
 * This is the template for generating a controller class file.
 * The following variables are available in this template:
 * - $this: the ControllerCode object
 */

$hasImage = false;
$imageFieldName = array();
if (isset($this->type_option['form']))
{
	foreach ($this->type_option['form'] as $key => $val) {
		if ($val == 'file')
		{
			$hasImage = true;
			$imageFieldName[] = $key;
		}
	}
}
?>
<?php echo "<?php\n"; ?>

class <?php echo $this->controllerClass; ?> extends <?php echo $this->baseClass."\n"; ?>
{
    public $pluralTitle = '<?php echo $this->model_name; ?>';
    public $singleTitle = '<?php echo $this->model_name; ?>';
    public $cannotDelete = array();
<?php 
    foreach($this->getActionIDs() as $action): 
        if ($action == '_form' || $action == '_search')
            continue;
?>
<?php if ($action == 'index') { ?>
    public function actionIndex() {
        try {
            $model=new <?php echo $this->model_name; ?>('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['<?php echo $this->model_name; ?>']))
                $model->attributes=$_GET['<?php echo $this->model_name; ?>'];

            $this->render('index',array(
                'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
        } catch (Exception $e) {
            //Yii::log("Exception ".  print_r($e, true), 'error');
            //throw  new CHttpException($e);
        }
    }
<?php } elseif ($action == 'create') { ?>
    public function actionCreate(){
        try {
            $model = new <?php echo $this->model_name; ?>('create');
            if (isset($_POST['<?php echo $this->model_name; ?>'])) {
                $model->attributes = $_POST['<?php echo $this->model_name; ?>'];
                if($model->save())
				{ <?php
					if ($hasImage)
					{
						foreach ($imageFieldName as $imageItem){
						?>
	<?php echo "\n\t\t\t\t\t"; ?>$model->saveImage('<?php echo $imageItem; ?>');
						<?php } } ?>
	<?php echo "\n\t\t\t\t\t"; ?>$this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been created');
                    $this->redirect(array('view', 'id'=> $model->id));
				}
				else
					$this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be created for some reasons');
            }
            $this->render('create', array(
                'model' => $model,
                'actions' => $this->listActionsCanAccess,
            ));
        }catch (exception $e) {
            //Yii::log("Exception " . print_r($e, true), 'error');
            //throw new CHttpException($e);
        }
    }
<?php } elseif ($action == 'update') { ?>
    public function actionUpdate($id) {
        $model=$this->loadModel($id);
        if(isset($_POST['<?php echo $this->model_name; ?>']))
        {
        	foreach ($model->defineImageSize as $key => $value) {
        	    $imageField=$key; break;
        	}
        	$old_image = $model->$imageField;
        	$uploadImage = CUploadedFile::getInstance($model, $imageField);
            $model->attributes=$_POST['<?php echo $this->model_name; ?>'];
            if ($model->save())
			{ <?php
			if ($hasImage)
			{ ?>
			<?php echo "\n\t\t\t\t"; ?>if( empty($uploadImage) || $uploadImage==NULL )
				{
				    $model->image = $old_image;
				    $model->update( array($imageField) );
				}else{
				    $model->saveImage($imageField);
				    $model->deleteImages($imageField, $old_image);
				}
			<?php
				foreach ($imageFieldName as $imageItem){
				?>
					<?php echo "\n\t\t\t\t"; ?>//$model->saveImage('<?php echo $imageItem; ?>');
				<?php }
			} ?>
				<?php echo "\n\t\t\t\t"; ?>$this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been updated');
				$this->redirect(array('view', 'id'=> $model->id));
			}
			else
				$this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be updated for some reasons');
        }
        //$model->beforeRender();
        $this->render('update',array(
            'model' => $model,
            'actions' => $this->listActionsCanAccess,
            'title_name' => $model-><?php echo $title_name; ?>
        ));
    }
<?php } elseif ($action == 'view') { ?>    
    public function actionView($id) {
        try {
            $model = $this->loadModel($id);
            $this->render('view', array(
                'model'=> $model,
                'actions' => $this->listActionsCanAccess,
                'title_name' => $model-><?php echo $title_name; ?>
            ));
        } catch (Exception $exc) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }
<?php } elseif ($action == 'delete') { ?>
    public function actionDelete($id) {
        try {
            if(Yii::app()->request->isPostRequest) {
                // we only allow deletion via POST request
				if (!in_array($id, $this->cannotDelete))
				{
					if($model = $this->loadModel($id))
					{
					<?php 
					if ($hasImage)
					{ ?>
						<?php echo "\n\t\t\t\t\t\t";?>foreach ($model->defineImageSize as $key => $value) 
						{
						    $imageField=$key; break;
						}
						$old_image = $model->$imageField;
						if(!empty($old_image)) $model->deleteImages($imageField, $old_image);
						<?php
						echo "//call delete image first\n";
						echo "\t\t\t\t\t\t"."//". "\$model->removeImage(array('" . implode("', '", $imageFieldName) . "'), true);\n";
					}
					?>
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
    <?php } else { ?>
    public function action<?php echo ucfirst($action); ?>()
    {
            $this->render('<?php echo $action; ?>');
    }
        <?php } ?>

<?php endforeach; ?>
	/*
	* Bulk delete
	* If you don't want to delete some specified record please configure it in global $cannotDelete variable
	*/
	public function actionDeleteAll()
	{
		$deleteItems = $_POST['<?php echo $this->class2id($this->model_name); ?>-grid_c0'];
		$shouldDelete = array_diff($deleteItems, $this->cannotDelete);

		if (!empty($shouldDelete))
		{
			<?php 
			if ($hasImage)
			{
				echo "\$deleteImages = Page::model()->findAll('id in (' . implode(',', \$shouldDelete) . ')');";
				echo "if (!empty(\$deleteImages))";
				echo "{";
				echo "	foreach(\$deleteImages as \$item)";
					echo "{";
						echo "\$item->removeImage(array('" . implode("', '", $imageFieldName) . "'), true);";
					echo "}";
				echo "}";
			}
			?>
			<?php echo $this->model_name; ?>::model()->deleteAll('id in (' . implode(',', $shouldDelete) . ')');
			$this->setNotifyMessage(NotificationType::Success, 'Your selected records have been deleted');
		}
		else
			$this->setNotifyMessage(NotificationType::Error, 'No records was deleted');

		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}
	
	<?php 
		
		if ($hasImage):
	?>
	/*
	* Remove upload image 
	* Only files are deleted not folder. Run in ajax mode. Can modify in custom.js admin theme
	*/
	public function actionRemoveImage($fieldName, $id)
	{
		try
		{
			$model = $this->loadModel((int)$id);
			$model->removeImage(array($fieldName));
			echo 'thumbnail-' . $id;
		}
		catch (Exception $exc)
		{
			echo '';
		}
	}
	<?php endif;?>
	
    public function loadModel($id){
		//need this define for inherit model case. Form will render parent model name in control if we don't have this line
		$initMode = new <?php echo $this->model_name; ?>();
        $model=$initMode->findByPk($id);
        if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
}