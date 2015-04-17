<?php

class MailchimpController extends AdminController
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
            array('allow',
                'actions' => array('index'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('create', 'view','delete','update','synchronize'),
                'users' => array('@'),
            ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	
        //import all subcriber to mailchimp
        public function actionSynchronize()
        {
            set_time_limit(7200);
            $idNameGroup=array();
            $criteria=new CDbCriteria;
//            $criteria->compare('t.status',1);
            $mSubG = SubscriberGroup::model()->findAll($criteria);
            if(count($mSubG)>0)
                foreach($mSubG as $i)
                    $idNameGroup[$i->id] = $i->name;
            
            $criteria=new CDbCriteria;
            $mSubscriber = Subscriber::model()->findAll($criteria);
            $test=array();
            if(count($mSubscriber)>0)
            {
                Yii::import('ext.MailChimp.MailChimp', true); 
                foreach($mSubscriber as $item)
                {
                    $mailChimp = new MailChimp();
//                    $mailChimp->removeSubscriber('verzdev2@gmail.com');
//                    die;
                    $sGroupName = Yii::app()->params['mailchimp_title_groups'];
                    $sGroup = strtolower($idNameGroup[$item->subscriber_group_id]);
                    $merge_vars = array(
                            //'FNAME'=>$item->first_name, 'LNAME'=>  $item->last_name, 
                            'GROUPINGS'=>array(
                                array('name'=>$sGroupName, 'groups'=>$sGroup),
                            )
                        );
                    if($item->status == 1)
                    {
                        $test[]= $mailChimp->addSubscriber($item->email, $merge_vars);
                    }
                    else
                    {
                        $mailChimp->removeSubscriber($item->email);
                    }
                }
                
            }
            
            Yii::app()->user->setFlash('mailchimp', "Synchronize Mailling list successfully!");
            $this->redirect ( Yii::app()->createAbsoluteUrl("admin/setting/mailchimp"));
        }
}
