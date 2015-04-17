<?php

class MemberModule extends CWebModule {

    public $defaultController = 'site';

    public function init() {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'member.models.*',
            'member.components.*',
        ));

        $this->setComponents(array(
            // 'user' => array(
            //     'class' => 'WebUser',
            //     // 'loginUrl' => Yii::app()->createAbsoluteUrl('site/index'),
            //     // 'loginUrl' => Yii::app()->createUrl('member/site/login/'),
            //     'loginUrl' => array('site/index'),
            // ),
            'user' => array(
                // enable cookie-based authentication
                'allowAutoLogin' => true,
                'class' => 'WebUser',
                // 'loginUrl' => array('/admin/site/login'),
                'loginUrl' => array('site/index'),
            ),
        ));
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            Yii::app()->errorHandler->errorAction = 'member/site/error';

            // set pageTitle
            $act = explode('_', strtolower($action->id));
            $controller->pageTitle = '' . implode(' ', $act);

            $route = $controller->id . '/' . $action->id;
            // echo $route;
            $publicPages = array(
//                'profile/getnexttraining',
//                'profile/paymentgetnexttraining',
//                'profile/sub_tournament',
//                'profile/sub_leagues',
//                'tournament/join',
//                'tournament/payment',
//                'tournament/reject',
//                'tournament/notifiedpaypal',
//                'tournament/successpaypal',
//                'tournament/failpaypal',
//                'league/join',
//                'league/reject',
//                'league/payment',
//                'league/notifiedpaypal',
//                'league/successpaypal',
//                'league/failpaypal',
//                'users/profile',
//                'users/account_doctor',
//                'users/edit_profile',
//                'users/doctor_profile',
//                'users/DoctorShowAppointment',
//                'users/DoctorChangeAppointmentStatus',
//                'users/DoctorAddAppointment',
//                'site/cancel_appointment',
//                'site/error',
//                'site/forgot_password',
//                'site/change_password',
//		  'site/register_confirm_code',
//                'site/captcha'
            );
            if (in_array(trim($route), $publicPages))
                return true;
                    
            if (!isset(Yii::app()->user->id))
                Yii::app()->user->loginRequired();

            if (isset(Yii::app()->user->id)) {
                $mUser = Users::model()->findByPk(Yii::app()->user->id);
                if (is_null($mUser) || $mUser->status == STATUS_INACTIVE) 
                {
                    Yii::app()->user->logout();
                    Yii::app()->controller->redirect(Yii::app()->createAbsoluteUrl('site/index'));
                }
            }
//            if (in_array($route, $publicPages))
//                if (!isset(Yii::app()->user->id))
//                    Yii::app()->user->loginRequired();
            //die;
            /* if (!Yii::app()->user->isMember && !in_array($route, $publicPages)){
              //Yii::app()->getModule('member')->user->loginRequired();

              }
              else */
            return true;
        }
        else
            return false;
    }

}
