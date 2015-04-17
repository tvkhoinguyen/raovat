<?php

/**
 * This is the model class for table "{{_subscriber_group}}".
 *
 * The followings are the available columns in table '{{_subscriber_group}}':
 * @property integer $id
 * @property string $name
 * @property integer $status
 */
class SubscriberGroup extends _BaseModel
{
    public $oldObj;
    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SubscriberGroup the static model class
	 */
    public function init() {
        Yii::app()->setting->setDbItem('mailchimpGroupingId', null);
        return parent::init();
    }
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_subscriber_group}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                    array('name', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>150),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'subscriber_group' => array(self::HAS_MANY, 'Subscriber', 'subscriber_group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.name',$this->name,true);
		$criteria->compare('t.status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
		));
	}

    
    public function activate()
    {
        $this->status = 1;
        $this->update();
    }

    public function deactivate()
    {
        $this->status = 0;
        $this->update();
    }
	

	public function defaultScope()
	{
		return array(
			//'condition'=>'',
		);
	}
    protected function beforeSave() {
        if($this->isNewRecord)
            $this->addMailchimp();
        else
            $this->updateMailchimp($this->oldObj->name);
        
        return parent::beforeSave();
    }
    protected function beforeDelete() {
        $subscribers = Subscriber::model()->findAll("subscriber_group_id = $this->id");
        if(!empty($subscribers))
            foreach ($subscribers as $subscriber) {
                $subscriber->delete();
            }
        $this->delMailchimp();
        return parent::beforeDelete();
    }
    public static function loadItems($emptyOption=false)
	{
		$_items = array();
		if($emptyOption)
			$_items[""]="Select";	
		$models=self::model()->findAll(array(
                        'condition'=>'status=1',
			'order'=>'name',
		));
		foreach($models as $model)
			$_items[$model->id]=$model->name;
		return $_items;
	}
    public function addMailchimp() {
        Yii::import('ext.MailChimp.lib.MCAPI', true);     
        $mailchimp = new MCAPI(Yii::app()->params['mailchimpApiKey']);
        return $mailchimp->listInterestGroupAdd(Yii::app()->params['mailchimpListId'], $this->name, Yii::app()->params['mailchimpGroupingId']);
    }
    public function delMailchimp() {
        Yii::import('ext.MailChimp.lib.MCAPI', true);     
        $mailchimp = new MCAPI(Yii::app()->params['mailchimpApiKey']);
        return $mailchimp->listInterestGroupDel(Yii::app()->params['mailchimpListId'], $this->name, Yii::app()->params['mailchimpGroupingId']);
    } 
    public function updateMailchimp($old_name) {
        Yii::import('ext.MailChimp.lib.MCAPI', true);     
        $mailchimp = new MCAPI(Yii::app()->params['mailchimpApiKey']);
        return $mailchimp->listInterestGroupUpdate(Yii::app()->params['mailchimpListId'], $old_name, $this->name, Yii::app()->params['mailchimpGroupingId']);
    } 

    public function totalSubScriber(){
    	if(isset($this->subscriber_group)){
    		$criteria=new CDbCriteria;
    		$criteria->with = array('group');
			$criteria->compare('group.group_id',$this->id);
    		$total =  Subscriber::model()->count($criteria);
    		return $total;
    	}
    	return 0;
    }
        
}