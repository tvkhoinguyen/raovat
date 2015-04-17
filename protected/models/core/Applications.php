<?php
/**
 * VerzDesignCMS
 * 
 * LICENSE
 *
 * @copyright	Copyright (c) 2012 Verz Design (http://www.verzdesign.com)
 * @version 	$Id: Applications.php 2012-06-01 09:09:18 nguyendung $
 * @since		1.0.0
 */

/**
 * This is the model class for table "{{applications}}".
 *
 * The followings are the available columns in table '{{applications}}':
 * @property integer $id
 * @property string $application_name
 * @property string $application_short_name
 */
class Applications extends _BaseModel
{
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Applications the static model class
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
		return '{{_applications}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('application_name, application_short_name', 'required'),
			array('application_name, application_short_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, application_name, application_short_name', 'safe', 'on'=>'search'),
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
			'role' => array(self::HAS_MANY, 'Roles', 'application_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'application_name' => 'Application Name',
			'application_short_name' => 'Application Short Name',
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
		$criteria->compare('application_name',$this->application_name,true);
		$criteria->compare('application_short_name',$this->application_short_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Loads the application items for the specified type from the database.
	 * @param boolean the item is empty
	 */
	public static function loadItems($emptyOption=false)
	{
		$_items = array();
		if($emptyOption)
			$_items[""]="";	
		$models=self::model()->findAll(array(
			'order'=>'id',
		));
		foreach($models as $model)
			$_items[$model->id]=$model->application_name;
		return $_items;
	}
	
	protected function beforeDelete(){
		$delete = true;
		// 1 check foreign table Roles
		$roles = Roles::model()->findByAttributes(array('application_id'=>$this->id));
		if(count($roles)>0)
			$delete = false;

		// 2 check foreign table Menus
		$menus = Menus::model()->findByAttributes(array('application_id'=>$this->id));
		if(count($menus)>0)
			$delete = false;

		// 3 check foreign table Menus
		$users = Users::model()->findByAttributes(array('application_id'=>$this->id));
		if(count($users)>0)
			$delete = false;
			
		return $delete;
	}
	
	public function adminDelete(){
		
		// 1 delete foreign table Roles
		Roles::model()->deleteAllByAttributes(array('application_id'=>$this->id));

		// 2 delete foreign table Menus
		Menus::model()->deleteAllByAttributes(array('application_id'=>$this->id));

		// 3 delete foreign table Menus
		Users::model()->deleteAllByAttributes(array('application_id'=>$this->id));
		
		// 4 delete table Applications
		if($this->delete())
                    Yii::log("Delete record id = ".$model->id);
		
	}
	
	public function userDelete(){
            $this->is_delete = 1;
            $this->update();		
	}	
	
}