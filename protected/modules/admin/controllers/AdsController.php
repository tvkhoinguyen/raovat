<?php

class AdsController extends AdminController
{

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
            'actions' => $this->listActionsCanAccess,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Ads('create');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Ads']))
		{
			$model->attributes=$_POST['Ads'];
            $model->image= CUploadedFile::getInstance($model,'image');
            if(!empty($_POST['Ads']['expired_date'])){
                $expired_date =str_replace('/','-',$_POST['Ads']['expired_date']);
                $model->expired_date = date('Y-m-d',strtotime($expired_date));
            }

            $place_holder = $_POST['Ads']['place_holder'];
            $maxOrder = Ads::maxOrder($place_holder);
            $model->order_display = $maxOrder + 1;

            if($place_holder == "Homepage"){
                $widthAds = ADS_HOME_WIDTH;
                $heightAds = ADS_HOME_HEIGHT;
                $widthAdsThumbs = ADS_HOME_THUMBS_WIDTH;
                $heightAdsThumbs = ADS_HOME_THUMBS_HEIGHT;
            }elseif($place_holder == "Blog - Top"){
                $widthAds = ADS_BLOG_TOP_WIDTH;
                $heightAds = ADS_BLOG_TOP_HEIGHT;
                $widthAdsThumbs = ADS_BLOG_TOP_THUMBS_WIDTH;
                $heightAdsThumbs = ADS_BLOG_TOP_THUMBS_HEIGHT;
            }else{
                $widthAds = ADS_INSIDE_PAGE_WIDTH;
                $heightAds = ADS_INSIDE_PAGE_HEIGHT;
                $widthAdsThumbs = ADS_INSIDE_PAGE_THUMBS_WIDTH;
                $heightAdsThumbs = ADS_INSIDE_PAGE_THUMBS_HEIGHT;
            }

            $fileUpload=CUploadedFile::getInstance($model,'image');

            if($model->validate()){
                if($fileUpload !== null)
                {
                    $ext = $fileUpload->getExtensionName();
                    $timestamp = time();
                    $newName = $timestamp.'.'.$ext;
                    //Yii::log($newName, 'error');
                    $ImageProcessing = new ImageHelper();
                    $ImageProcessing->folder = '/upload/bannerads/'.$place_holder;
                    $ImageProcessing->createDirectoryByPath($ImageProcessing->folder);
                    if($fileUpload->saveAs(YII_UPLOAD_DIR.'/bannerads/'.$place_holder.'/'.$newName)){
                        $model->image = $newName;
                        $ImageProcessing->file = $model->image;
                        $ImageProcessing->thumbs = array(
                            'main' => array('width'=>$widthAds,'height'=>$heightAds),
                            'thumbs' => array('width'=>$widthAdsThumbs,'height'=>$heightAdsThumbs),
                        );
                        $ImageProcessing->createThumbs();


                    }
                }
                if($model->save())
                    $this->redirect(array('view','id'=>$model->id));

            }

		}
        if(!empty($model->expired_date))
            $model->expired_date = $_POST['Ads']['expired_date'];
		$this->render('create',array(
			'model'=>$model,
            'actions' => $this->listActionsCanAccess,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
        $old_thumb_image_name = $model->image;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Ads']))
		{
			$model->attributes=$_POST['Ads'];
            if(!empty($_POST['Ads']['expired_date'])){
                $expired_date =str_replace('/','-',$_POST['Ads']['expired_date']);
                $model->expired_date = date('Y-m-d',strtotime($expired_date));
            }
            $place_holder = $model->place_holder;
            if($place_holder == "Homepage"){
                $widthAds = ADS_HOME_WIDTH;
                $heightAds = ADS_HOME_HEIGHT;
                $widthAdsThumbs = ADS_HOME_THUMBS_WIDTH;
                $heightAdsThumbs = ADS_HOME_THUMBS_HEIGHT;
            }elseif($place_holder == "Blog - Top"){
                $widthAds = ADS_BLOG_TOP_WIDTH;
                $heightAds = ADS_BLOG_TOP_HEIGHT;
                $widthAdsThumbs = ADS_BLOG_TOP_THUMBS_WIDTH;
                $heightAdsThumbs = ADS_BLOG_TOP_THUMBS_HEIGHT;
            }else{
                $widthAds = ADS_INSIDE_PAGE_WIDTH;
                $heightAds = ADS_INSIDE_PAGE_HEIGHT;
                $widthAdsThumbs = ADS_INSIDE_PAGE_THUMBS_WIDTH;
                $heightAdsThumbs = ADS_INSIDE_PAGE_THUMBS_HEIGHT;
            }

            $fileUpload=CUploadedFile::getInstance($model,'image');

            if($fileUpload !== null)
            {
                $ext = $fileUpload->getExtensionName();
                $timestamp = time();
                $newName = $timestamp.'.'.$ext;
                Yii::log($newName, 'error');
                $ImageProcessing = new ImageHelper();
                $ImageProcessing->folder = '/upload/bannerads/'.$place_holder;
                $ImageProcessing->createDirectoryByPath($ImageProcessing->folder);
                if($fileUpload->saveAs(YII_UPLOAD_DIR.'/bannerads/'.$place_holder.'/'.$newName)){
                    $model->image = $newName;
                    $ImageProcessing->file = $model->image;
                    $ImageProcessing->thumbs = array(
                        'main' => array('width'=>$widthAds,'height'=>$heightAds),
                        'thumbs' => array('width'=>$widthAdsThumbs,'height'=>$heightAdsThumbs),
                    );
                    $ImageProcessing->createThumbs();
                }
            }else{
                $model->image = $old_thumb_image_name;
            }

			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

        if(!empty($model->expired_date))
            $model->expired_date = date('d/m/Y',strtotime($model->expired_date));

		$this->render('update',array(
			'model'=>$model,
            'actions' => $this->listActionsCanAccess,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request

			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new Ads('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Ads']))
			$model->attributes=$_GET['Ads'];

		$this->render('index',array(
			'model'=>$model,
            'actions' => $this->listActionsCanAccess,
		));
	}

    public function actionUp($id,$place_holder) {

        if(Yii::app()->request->isPostRequest)
        {
            //decrease order
            $model= $this->loadModel($id);
            $whereCondition = 'place_holder ="'.$place_holder.'"';
            $record_prev = MyFunctionCustom::getNextOrPrevId($id, "prev","Ads",$whereCondition);
            if(!empty($record_prev)){
                Ads::model()->updateAll(array('order_display'=>$model->order_display),'order_display = '.$record_prev->order_display.' AND place_holder ="'.$place_holder.'"');
                $model->order_display = $record_prev->order_display;
                $model->update();
                //
                Yii::app()->end();
            }
            else{
                Yii::log('Invalid request. Please do not repeat this request again.');
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
            }

        }
        else {
            Yii::log('Invalid request. Please do not repeat this request again.');
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }

    }

    public function actionDown($id,$place_holder) {
        if(Yii::app()->request->isPostRequest)
        {
            $model= $this->loadModel($id);
            $whereCondition = 'place_holder ="'.$place_holder.'"';
            $record_next = MyFunctionCustom::getNextOrPrevId($id, "next","Ads",$whereCondition);
            if(!empty($record_next)){
                Ads::model()->updateAll(array('order_display'=>$model->order_display),'order_display = '.$record_next->order_display.' AND place_holder ="'.$place_holder.'"');
                $model->order_display = $record_next->order_display;
                $model->update();
                //
                Yii::app()->end();
            }
            else{
                Yii::log('Invalid request. Please do not repeat this request again.');
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
            }
        }
        else {
            Yii::log('Invalid request. Please do not repeat this request again.');
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }

    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Ads::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='banner-ads-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
