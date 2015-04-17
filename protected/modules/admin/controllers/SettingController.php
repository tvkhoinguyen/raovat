<?php

class SettingController extends AdminController
{    
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Setting'])) {
            $model->attributes = $_POST['Setting'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionIndex()
    {
        $this->pageTitle = 'Setting';
        $this->layout ='column1';
        $model = new SettingForm;
        $model->scenario = "updateSettings";
        $setting = Yii::app()->setting;
		$listAttributes = SettingForm::getAllAttributes();
        if (isset($_POST['SettingForm'])) {
            $model->attributes = $_POST['SettingForm'];
            if ($model->validate()) {
                if ($listAttributes && array($listAttributes)) {
                    foreach($listAttributes as $attr) {
                        $setting->setDbItem($attr, $model->$attr);
                    }
                }

                Yii::app()->user->setFlash('setting', 'Setting has been updated.');
                $this->redirect(array('index'));
            }
        } else {
            if ($listAttributes && array($listAttributes)) {
                foreach($listAttributes as $attr) {
                    $temp = $setting->getItem($attr);
                    if (!empty($temp)) {
                        $model->$attr = $setting->getItem($attr);
                    }
                }
            }
        }
        $this->render('index', array('model' => $model, ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Setting::model()->findByPk($id);
        if ($model === null)
        {
            Yii::log('The requested page does not exist.');
            throw new CHttpException(404,'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'setting-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    public function actionSendTestMail() {
        $this->layout = 'ajax';
        $meta = array();
        if (isset($_POST['email'])) {
            $data = array(
                'subject'=> 'Send test email successfully',
                'params'=>array(
                    'message'=> 'This is a test email',
                ),
                'view'=>'message',
                'to'=> $_POST['email'],
                'from'=>Yii::app()->params['autoEmail'],
            );
            if (CmsEmail::mail($data)) {
                $meta['code'] = 200;
                $meta['mess'] = __('Send test mail successfully!');
            } else {
                $meta['code'] = 500;
                $meta['mess'] = __('Send test mail error!');
            }
        }
        echo json_encode($meta);
    }
}
