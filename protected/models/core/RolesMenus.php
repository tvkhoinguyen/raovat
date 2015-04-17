<?php

/**
 * This is the model class for table "{{_roles_menus}}".
 *
 * The followings are the available columns in table '{{_roles_menus}}':
 * @property string $id
 * @property string $role_id
 * @property string $menu_id
 */
class RolesMenus extends _BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RolesMenus the static model class
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
		return '{{_roles_menus}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('role_id', 'required','on'=>'addRoles'),
			array('role_id, menu_id', 'length', 'max'=>20),
            array('role_id, menu_id', 'uniquePair', 'on'=>'addRoles'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, role_id, menu_id', 'safe', 'on'=>'search'),
			array('id, role_id, menu_id,actions', 'safe'),
		);
	}

    public function uniquePair($attribute,$params){
        if(!$this->hasErrors())
        {
            $rolesMenus = RolesMenus::model()->find('t.menu_id ='.$this->menu_id.' AND t.role_id = '.$this->role_id);
            if(!empty($rolesMenus))
                $this->addError('role_id','Role has been exist');
        }
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'role' => array(self::BELONGS_TO, 'Roles', 'role_id'),
                    'menu' => array(self::BELONGS_TO, 'Menus', 'menu_id'),
		);
	}

        public static function getActionName($id){
            $model = Menus::model()->findByPk((int)$id);
            $roles = $model->rolesMenus;
            $sRoles = '';
            if(count($roles)>0){
                for($i=0; $i< count($roles); $i++)
                {
                    $sRoles .= $roles[$i]->role->role_name.' ('.$roles[$i]->actions.')<br/> ';
                }
                $sRoles = substr($sRoles, 0, -2);
            }
            return $sRoles;
        }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'role_id' => 'Role',
			'menu_id' => 'Menu',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('menu_id',$this->menu_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}