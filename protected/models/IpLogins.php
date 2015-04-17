<?php

/**
 * This is the model class for table "{{_ip_logins}}".
 *
 * The followings are the available columns in table '{{_ip_logins}}':
 * @property integer $id
 * @property string $username
 * @property string $ip_address
 * @property integer $time_login
 */
class IpLogins extends _BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return IpLogins the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_ip_logins}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('time_login', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>50),
			array('ip_address', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, ip_address, time_login', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'ip_address' => 'Ip Address',
			'time_login' => 'Time Login',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('time_login',$this->time_login);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function deleteOldRecords()
        {
            $time_refresh = 60*Yii::app()->setting->getItem('time_refresh_login');
            
            $oldTimeBefore = (int)(time() - $time_refresh);            
            $this->deleteAll("time_login < $oldTimeBefore");
        }
        
        public  function limitLoginTimes($username, $ip)
        {
            $criteria = new CDbCriteria();
            $criteria->compare('username', $username, true);
            $criteria->compare('ip_address', $ip, true);
            $times = Yii::app()->setting->getItem('login_limit_times');
            $times = $times?$times:5;
            $count = $this->count($criteria);
            if($count >= $times)
            {
                return false;
            }
            return true;
        }
}