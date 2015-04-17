<?php

/**
 * This is the model class for table "{{_subscriber}}".
 *
 * The followings are the available columns in table '{{_subscriber}}':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property integer $status
 */
class Subscriber extends _BaseModel {
    public $oldObj;
    public $filename;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Subscriber the static model class
     */
    public function init() {
        Yii::app()->setting->setDbItem('mailchimpGroupingId', null);
        return parent::init();
    }
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{_subscriber}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('filename,subscriber_group_id', 'required', 'on'=>'import'),
            array('filename', 'file', 'on'=>'import',
                'allowEmpty'=>false,
                'types'=> 'xls,xlsx',
                'wrongType'=>'Only *.xls,*.xlsx are allowed.',
                'maxSize' => '10485760', // 10MB
                'tooLarge' => 'The file was larger than '.(10485760/1024).' KB. Please upload a smaller file.',
            ),
            array('email,name,subscriber_group_id', 'required','on'=>'create,update'),
            array('email', 'unique', 'message' => 'This email address has been subscriber'),
            array('status', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 100),
            array('email', 'length', 'max' => 200),
            array('email', 'email'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, email, status, subscriber_group_id, subscribed_date, unsubscribed_date', 'safe'),
        );
    }

    public function getAjaxAction() {
        return array('actionAjaxActivate', 'actionAjaxDeactivate');
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'subscriber_group' => array(self::BELONGS_TO, 'SubscriberGroup', 'subscriber_group_id'),
            'group' => array(self::HAS_MANY, 'GroupGroupSubscriber', 'subscriber_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'status' => 'Status',
            'subscriber_group_id' => 'Subscriber Group',
            'filename'=>'File Name',
			'subscribed_date'=>'Subscribed Date',
			'unsubscribed_date'=>'Unsubscribed Date',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        if ($this->subscriber_group_id != "") {
            $arr = array($this->subscriber_group_id);
            $tmp = array();
            if (is_array($arr)) {
                foreach ($arr as $key => $value) {
                    $tmp[] = " t.subscriber_group_id  LIKE '" . '%"' . $value .'"%' . "'  ";
                }
            }
            $condition = implode(' or ', $tmp);
            $criteria->condition = $condition;
        }

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.name', $this->name, true);
        $criteria->compare('t.email', trim($this->email), true);
        $criteria->compare('t.status', $this->status);


        $criteria->order = 'id DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'Pagination' => array(
                'PageSize' => 50, //edit your number items per page here
            ),
        ));
    }

    public function activate() {
        $this->status = 1;
		$this->subscribed_date = date('Y-m-d H:i:s');
        if ($this->update()) {
            //$this->mailchimp();
        }
    }

    public function deactivate() {
        $this->status = 0;
		$this->unsubscribed_date = date('Y-m-d H:i:s');
        if ($this->update()) {
            //$this->mailchimp();
        }
    }

    public function scopes() {
        return array(
            'active' => array(
                'condition' => 'status=1',
            )
        );
    }

    public function saveMuilGroupSubscriber(){
		$arrGroup = $this->subscriber_group_id;
		if(is_array($arrGroup) && count($arrGroup)>0 ){
			//delete old data
			GroupGroupSubscriber::model()->deleteAllByAttributes(array('subscriber_id'=>$this->id));
			//save data
			foreach($arrGroup as $group){
				$gruopSubscriber = new GroupGroupSubscriber();
				$gruopSubscriber->group_id = $group;
				$gruopSubscriber->subscriber_id = $this->id;
				$gruopSubscriber->save();
			}
		}
    }

    public function getGroupwithSubscriberID(){
		$arrGroup = GroupGroupSubscriber::model()->getBySubscribeId($this->id);
		$html ='';
		$data = CHtml::listData(SubscriberGroup::model()->findAllByAttributes(array("id"=>$arrGroup)),'id','name');
		if(is_array($data) && count($data)>0){
			$html = "- ".implode( '<br>- ', $data);
		}
		return $html;    
    }

	public function getGroupidwithSubscriberID(){
		$arrGroup = GroupGroupSubscriber::model()->getBySubscribeId($this->id);
		$data = CHtml::listData(SubscriberGroup::model()->findAllByAttributes(array("id"=>$arrGroup)),'id','id');
		return $data;    
    }


    protected function beforeSave() {
        /*
        if($this->isNewRecord)
            $this->addMailchimp();
        else
            $this->updateMailchimp($this->oldObj->email);
        */
        return parent::beforeSave();
    }
    
    public function beforeDelete() {
        //$this->delMailchimp();
        return parent::beforeDelete();
    }

    public function addMailchimp() {
        $merge_vars = array(
            'FNAME' => $this->name, 
            'LNAME'=>'', 
            'GROUPINGS'=>array(
                array(
                    'name' => Yii::app()->params['mailchimpGroupingTitle'], 
                    'groups' => SubscriberGroup::model()->findByPk($this->subscriber_group_id)->name,
                ),
            )
        );
        Yii::import('ext.MailChimp.lib.MCAPI', true);     
        $mailchimp = new MCAPI(Yii::app()->params['mailchimpApiKey']);
        $mailchimp->listSubscribe(Yii::app()->params['mailchimpListId'], $this->email, $merge_vars);
        return $mailchimp;
    }
    public function delMailchimp() {
        Yii::import('ext.MailChimp.lib.MCAPI', true);     
        $mailchimp = new MCAPI(Yii::app()->params['mailchimpApiKey']);
        return $mailchimp->listUnsubscribe(Yii::app()->params['mailchimpListId'], $this->email);
    }
    public function updateMailchimp($old_email) {
        $merge_vars = array(
            'FNAME' => $this->name, 
            'LNAME'=>'', 
            'GROUPINGS'=>array(
                array(
                    'name' => Yii::app()->params['mailchimpGroupingTitle'], 
                    'groups' => SubscriberGroup::model()->findByPk($this->subscriber_group_id)->name,
                ),
            )
        );
        Yii::import('ext.MailChimp.lib.MCAPI', true);     
        $mailchimp = new MCAPI(Yii::app()->params['mailchimpApiKey']);
        return $mailchimp->listUpdateMember(Yii::app()->params['mailchimpListId'], $old_email, 'html');
    } 
	
	
}