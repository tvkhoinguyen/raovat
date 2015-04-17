<?php

class SiteController extends MemberController
{
	// public $layout = '/layouts/sidemenu';
    public function actionMyProfile()
    {
        $this->pageTitle = 'Account Infomation - '.Yii::app()->setting->getItem('defaultPageTitle');
        if(!Yii::app()->user->id)
        	$this->redirect( Yii::app()->createAbsoluteUrl('site/index') );

		$model = Users::model()->getInforUser(Yii::app()->user->id);
		$check_change_pass = false;

		if(isset($_POST['Users']) )
        {
        	$check_change_pass = true;
        	$model->scenario = 'changeMyPassword';
			$model->attributes=$_POST['Users'];
			if($model->validate())
			{
				$model->password_hash = md5($model->newPassword);
				$model->temp_password = $model->newPassword;
				if($model->update(array('password_hash', 'temp_password'))) 
                {
					SendEmail::changePassMailToUser($model);
					Yii::app()->user->setFlash('successChangeMyPassword', "Your profile and password has been successfully changed.");
					$this->refresh();
				}
			}
        }
		
        $this->render('myProfile', array('model'=>$model, 'check_change_pass'=>$check_change_pass ));
    }

    public function actionProfileInfo()
    {
        if(!Yii::app()->user->id)
            $this->redirect( Yii::app()->createAbsoluteUrl('site/index') );
        $this->pageTitle = 'Profile Infomation - '.Yii::app()->setting->getItem('defaultPageTitle');
		$model = Users::model()->getInforUser(Yii::app()->user->id);
		$model->scenario = 'profileUpdate';
		$check_subscribe = false;
		$rs = Subscriber::model()->findAll(array('condition'=>'email="'.$model->email.'"'));
		if(count($rs)>0) {
			foreach($rs as $subscriber) {
				if($subscriber->status == 1) {
					$check_subscribe = true;
				} 
			}
		}
		if(isset($_POST['Users'])) {
			$model->attributes=$_POST['Users'];
			$model->full_name = $model->first_name.' '.$model->last_name;
            $model->address2 = $_POST['Users']['address2'];
			if($model->save()){
				if(isset($_POST['subscribe'])) {
					if(count($rs)>0) {
						foreach($rs as $subscriber) {
							$subscriber->status = 1;
							$subscriber->subscribed_date = date('Y-m-d H:i:s');
							$subscriber->update(array('status','subscribed_date'));
							if(!GroupGroupSubscriber::model()->checkExist($subscriber->id, SUBSCRIBER_GROUP_MEMBER)) {
								GroupGroupSubscriber::model()->saveGroup($subscriber->id, SUBSCRIBER_GROUP_MEMBER);
							} 
						}
					} else {
						$subscriber = new Subscriber();
						$subscriber->status = 1;
						$subscriber->name = $model->first_name.' '.$model->last_name;
						$subscriber->email = $model->email;
						$subscriber->subscribed_date = date('Y-m-d H:i:s');
						if($subscriber->save()) {
							GroupGroupSubscriber::model()->saveGroup($subscriber->id, SUBSCRIBER_GROUP_MEMBER);
						}
					}
				} else {
					if(count($rs)>0) {
						foreach($rs as $subscriber) {
							if(GroupGroupSubscriber::model()->checkExist($subscriber->id, SUBSCRIBER_GROUP_MEMBER)) {
								$subscriber->status = 0;
								$subscriber->unsubscribed_date = date('Y-m-d H:i:s');
								$subscriber->update(array('status','unsubscribed_date'));
								//GroupGroupSubscriber::model()->removeGroup($subscriber->id, SUBSCRIBER_GROUP_MEMBER);
							} 
						}
					}
				}
				Yii::app()->user->setFlash('success', "Your profile has been successfully changed.");
				$this->refresh();
			}
        }
        $this->render('profileInfo', array('model'=>$model, 'check_subscribe'=>$check_subscribe) );
    }

    public function actionMyOrder()
    {
        if(!Yii::app()->user->id)
            $this->redirect( Yii::app()->createAbsoluteUrl('site/index') );

        $this->pageTitle = 'My Order - '.Yii::app()->setting->getItem('defaultPageTitle');

        $orders = new SpOrders();
        $orders->unsetAttributes(); // clear any default values
        if (isset($_GET['SpOrders'])) 
        {
            $orders->attributes = $_GET['SpOrders'];
        }
        $orders->user_id = Yii::app()->user->id;

        $this->render('myOrder', array(
            'model' => $orders
        ) );
    }

    

    public function accessRules() {
        return array();
    }

    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page'=>array(
                'class'=>'CViewAction',
            ),
        );
    }

	public function actionIndex()
	{
        $this->render('index');
	}
 
    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }
    public function actionViewOrder($order_id) 
    {
        if(!Yii::app()->user->id)
            $this->redirect( Yii::app()->createAbsoluteUrl('site/index') );

        $this->pageTitle = 'View Order - '.Yii::app()->setting->getItem('defaultPageTitle');
        $order_id = base64_decode($order_id);
        $order = SpOrders::model()->findByPk($order_id);
        // $total = GocOrders::getListTotalCart($order->id);
        if($order) {
            $this->render('orderDetail', array(
                'order' => $order,
                // 'total' => $total
            ));
        } else {
            Yii::log("Invalid request. Please do not repeat this request again.");
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }
    public function actionDownloadInvoice()
    {
        if(!Yii::app()->user->id)
            $this->redirect( Yii::app()->createAbsoluteUrl('site/index') );

        if(isset($_GET['order_id']))
        {
            $order_id = base64_decode($_GET['order_id']);
            $this->layout = '//layouts/ajax';

            $order = SpOrders::model()->findByPk($order_id);
            $html2pdf = Yii::app()->pdf->HTML2PDF('P','A4','en');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            if(!empty($order) ) 
            {
                $html = '';
                $email =  EmailTemplates::model()->findByPk(18);
                if(!empty($email)) 
                    $html = $email->email_body;

                $items = SpOrders::getItemsInTableInvoice($order);
                $billing_address = json_decode($order->billing_address);
                // $aBody = array(
                //     '{DATE}' => Yii::app()->format->date($order->created_date),
                //     '{INVOICE_NO}' => $order->order_no,
                //     '{ITEMS}' => $items,
                //     '{BILLING_ADDRESS}' => $billing_address->address1,
                //     '{REGN_NUMBER}' => Yii::app()->params['regnNumber'];
                // );
                $html = str_replace("{DATE}",Yii::app()->format->date($order->created_date),$html);
                $html = str_replace("{CUSTOMER_NAME}", $order->user_name, $html);
                $html = str_replace("{INVOICE_NO}",$order->order_no,$html);
                $html = str_replace("{ITEMS}", $items, $html);
                $address = 'Address1: '.$billing_address->address1;
                if(!empty($billing_address->address2))
                    $address .= ' - '.'Address2: '.$billing_address->address2;
                $html = str_replace("{BILLING_ADDRESS}", $address , $html);
                $html = str_replace("{REGN_NUMBER}", Yii::app()->params['regnNumber'] , $html);

                $html2pdf->WriteHTML($html);
                /*$html2pdf->WriteHTML(
                    $this->renderPartial('print_invoice', 
                        array(
                            'order' => $order,
                            // 'total' => $total,
                            // 'header' => $header,
                            // 'footer' => $footer,
                            // 'billing_info' => $billing_info,
                            // 'shipping_info' => $shipping_info,
                        ), true)
                );*/

                $html2pdf->Output('Invoice_' . $order->order_no.date('Y-m-d'). '.pdf', 'D');
            } else {
                Yii::log("Invalid request. Please do not repeat this request again.");
                throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
            }
        }
    }
}
