<?php
class SiteController extends FrontController
{

    public $attempts = MAX_TIME_TO_SHOW_CAPTCHA;
    public $counter;

    public function actionDangTin()
    {
        $this->pageTitle = 'Đăng Tin'.' - '.Yii::app()->setting->getItem('defaultPageTitle');
        if(Yii::app()->user->id)
            $user = Users::model()->findByPk(Yii::app()->user->id);
        else
            $user = NULL;

        $model =  new TinRaoVat('dang_tin');
        if(isset($_POST['TinRaoVat']))
        {
            $model->attributes = $_POST['TinRaoVat'];
            // array('address,email,id, title, short_content, content, status, image1, image2, order_display, is_hot, is_new, phone, mobile, state_id, city, created_date, updated_date, slug, job_id, updated_date_status, view, loai_tin, post_user_id, edit_user_id, post_user_name, edit_user_name', 'safe'),
            $model->short_content = StringHelper::limitStringLength( strip_tags($model->content),100 );

            /*khi post Tin lên thì status Inactive (chưa payment)
            Sau khi payment thành công thì update status Active
            Status này cũng có thể được update bởi Mod và Admin*/
            $model->status = STATUS_NEW;
            // updated_date_status,post_user_id, edit_user_id, post_user_name, edit_user_name
            if(!empty($user))
            {
                $model->post_user_id = Yii::app()->user->id;
                $model->post_user_name = $user->full_name;
            }

            if($model->validate())
            {
                if($model->save())
                {
                    $model->saveImage('image1');
                    $model->saveImage('image2');
                    $this->setMessageSuccess('Đăng tin thành công!');
                    SendEmail::mailAdminAfterDangTin($model);
                    $model = new TinRaoVat('dang_tin');
                    /*redirect qua trang thanh toán vd: paypal
                    Sau khi thanh toán xong thì update status Active*/
                }
            }
        }
        $this->render('raovat/dang_tin', array(
            'model' => $model,
        ));
    }

    /*Khi payment thanh toán thành công thì update lại status và updated_date_status*/
    public function actionAccessPayment() 
    {
        // $model = 
        // $model->status = STATUS_ACTIVE;
        // $model->updated_date_status = date('Y-m-d H:i:s');
        // $model->update( array('status', 'updated_date_status' ) );
    }

    public function actionIndex()
    {
        $this->pageTitle = Yii::app()->setting->getItem('defaultPageTitle');

        $a = new TinRaoVat;
        $b = new TinRaoVat;
        $list_hot = $a->searchListHotIndex();
        $list_khac = $b->searchListKhacIndex();
        // echo '<pre>';
        // print_r($list_hot);
        // echo '</pre>';

        // echo '<pre>';
        // print_r($list_khac);
        // echo '</pre>';
        // die;

        $this->render('index', array(
            'list_hot' => $list_hot ,
            'list_khac' => $list_khac ,
        ));
    }

    public function actionListTin()
    {
        $state=NULL;
        $job=NULL;
        $get_tin=NULL;
        if(isset($_GET['TinRaoVat']))
        {
            $get_tin = $_GET['TinRaoVat'];
            if(!empty($_GET['TinRaoVat']['s_state_id']))
                $state = State::model()->findByPk($_GET['TinRaoVat']['s_state_id']);

            if(!empty($_GET['TinRaoVat']['s_job_id']))
                $job = Job::model()->findByPk($_GET['TinRaoVat']['s_job_id']);
        }

        if(isset($_GET['j_slug']))
        {
            $job = Job::getDetailBySlug($_GET['j_slug']);
            if(!empty($job))
                $get_tin['s_job_id'] = $job->id;
        }



        $this->pageTitle = 'Tin Rao Vặt - '. Yii::app()->setting->getItem('defaultPageTitle');

        $a = new TinRaoVat();
        $list_raovat_dataProvider = $a->searchListTin($get_tin);

        $this->render('raovat/list_tin', array(
            'list_raovat_dataProvider' => $list_raovat_dataProvider,
            'state'=>$state,
            'job'=>$job,
        ));
    }

    public function actionTinDetail($slug)
    {
        $model = TinRaoVat::getDetailBySlug($slug);
            if(empty($model) || $model->status == STATUS_INACTIVE ) 
                throw new CHttpException(404, 'Sorry! The requested page does not exist.');

        $this->pageTitle = $model->title.' '. Yii::app()->setting->getItem('defaultPageTitle');

        $a = new TinRaoVat();
        $list_raovat_trong_tuan = $a->searchListHotTrongTuan($model->id);

        $this->render('raovat/rao_vat_detail', array(
            'model' => $model,
            'list_raovat_trong_tuan'=>$list_raovat_trong_tuan,
        ));
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('captcha','actions'),
                'users' => array('*'),
            ),
        );
    }
    
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
            ),
        );
        // return array(
        //     // captcha action renders the CAPTCHA image displayed on the contact page
        //     'captcha' => array(
        //         'class' => 'CCaptchaAction',
        //         'backColor' => 0xFFFFFF,
        //     ),
        //     // page action renders "static" pages stored under 'protected/views/site/pages'
        //     // They can be accessed via: index.php?r=site/page&view=FileName
        //     'page' => array(
        //         'class' => 'CViewAction',
        //     ),
        //     'ajax.'=>'application.components.widget.RegistorWidget',
        //     'ajaxlogin.'=>'application.components.widget.LoginWidget',
        //     'ajaxjoin.'=>'application.components.widget.JoinWidget',
        // );
    }
    
    private function captchaRequired() {
        return Yii::app()->session->itemAt('captchaRequired') >= $this->attempts;
    }
    
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    protected function performAjaxValidation($model)
    {
        try {
            if (isset($_POST['ajax'])) {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        } catch (Exception $e) {
            Yii::log("Exception " . print_r($e, true), 'error');
            throw  new CHttpException("Exception " . print_r($e, true));
        }
    }


    

    public function actionContactUs()
    {
        $this->pageTitle = 'Liên Hệ ' . ' - ' . Yii::app()->params['defaultPageTitle'];
        $model = new ContactForm('create');
        //auto fill
        // if (isset(Yii::app()->user->id)) {
        //     $mUser = Users::model()->findByPk(Yii::app()->user->id);
        //     if ($mUser) {
        //         $model->name = $mUser->full_name;
        //         $model->email = $mUser->email;
        //         $model->phone = $mUser->phone;
        //         $model->company = $mUser->company;
        //     }

        // }
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) 
            {
                $model->message = '<br>' . nl2br($model->message);
                
                if (!empty($model->email)) 
                {
                    // SendEmail::confirmContactMailToUser($model);
                }
                SendEmail::sendContactMailToAdmin($model);

                Yii::app()->user->setFlash('msg', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            } else {
                // Yii::log(print_r($model->getErrors(), true), 'error', 'SiteController.actionContact');
            }
        }

        $this->render('contact_us', array(
            'model' => $model,
        ));
    }

}