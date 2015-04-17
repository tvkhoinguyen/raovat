<?php
/**
 * VerzDesignCMS
 * 
 * LICENSE
 *
 * @copyright	Copyright (c) 2012 Verz Design (http://www.verzdesign.com)
 * @version 	$Id: Roles.php 2012-06-01 09:09:18 nguyendung $
 * @since		1.0.0
 */

/**
 * This is the model class for table "{{roles}}".
 *
 * The followings are the available columns in table '{{roles}}':
 * @property integer $id
 * @property string $role_name
 * @property string $role_short_name
 * @property integer $application_id
 */
class Roles extends _BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Roles the static model class
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
		return '{{_roles}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('role_name, role_short_name, application_id', 'required'),
			array('application_id', 'numerical', 'integerOnly'=>true),
			array('role_name, role_short_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, role_name, role_short_name, application_id', 'safe', 'on'=>'search'),
			array('id, role_name, role_short_name, application_id,status', 'safe',),
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
			'application' => array(self::BELONGS_TO, 'Applications', 'application_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'role_name' => 'Role Name',
			'role_short_name' => 'Role Short Name',
			'application_id' => 'Application',
			'status' => 'Status',                    
		);
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
			$_items[$model->id]=$model->role_name;
		return $_items;
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
		$criteria->compare('role_name',$this->role_name,true);
		$criteria->compare('role_short_name',$this->role_short_name,true);
		$criteria->compare('application_id',$this->application_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getRoles()
	{
		return $this->findAll();
	}
	
	public function adminDelete(){
		
		// 1 delete foreign table Roles
		RolesMenus::model()->deleteAllByAttributes(array('role_id'=>$this->id));

		// 2 delete foreign table Menus
		Users::model()->deleteAllByAttributes(array('role_id'=>$this->id));

		// 4 delete table Applications
		$this->delete();
		
	}
	
	public function userDelete(){
            $this->status = 0;
            $this->update();		
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
    
        public static function getAppicationIdByRoleId($role_id){        
        $model = Roles::model()->findByPk($role_id);
        if($model)
            return $model->application_id;
        return 0;
    }

        
        
}