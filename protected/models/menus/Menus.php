<?php

/**
 * This is the model class for table "{{_menus}}".
 *
 * The followings are the available columns in table '{{_menus}}':
 * @property integer $id
 * @property string $menu_name
 * @property string $menu_link
 * @property integer $display_order
 * @property integer $show_in_menu
 * @property integer $place_holder_id
 * @property integer $application_id
 * @property string $parent_id
 * @property integer $group_id
 */
class Menus extends _BaseModel
{

	public $roles;
	public $level = 0;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Menus the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_menus}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('menu_name, display_order, show_in_menu, application_id', 'required'),
			array('display_order, show_in_menu,  application_id', 'numerical', 'integerOnly' => true),
			array('menu_name, menu_link', 'length', 'max' => 255),
			array('parent_id', 'length', 'max' => 20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, menu_name, menu_link, display_order, show_in_menu,  application_id, parent_id, controller_name, module_name', 'safe', 'on' => 'search'),
			array('id, menu_name, menu_link, display_order, show_in_menu,  application_id, parent_id, controller_name, module_name', 'safe'),
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
			'rolesMenus' => array(self::HAS_MANY, 'RolesMenus', 'menu_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'menu_name' => 'Menu Name',
			'menu_link' => 'Menu Link',
			'module_name' => 'Module Name',
			'display_order' => 'Display Order',
			'show_in_menu' => 'Show In Menu',
			'application_id' => 'Application',
			'parent_id' => 'Parent',
			'roles' => 'Roles',
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

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('menu_name', $this->menu_name, true);
		$criteria->compare('menu_link', $this->menu_link, true);
		$criteria->compare('display_order', $this->display_order);
		$criteria->compare('show_in_menu', $this->show_in_menu);
		$criteria->compare('application_id', $this->application_id);
		$criteria->compare('parent_id', $this->parent_id, true);

		$criteria->order = 'display_order,parent_id ASC';

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'Pagination' => array(
				'PageSize' => 50, //edit your number items per page here
			),
		));
	}

	public function oMenu($parent_id, $menus, $value, $res = '', $sep = '')
	{

		//echo 'fix error not run......';die;
		foreach ($menus as $m)
		{
			$temp_id = $m->id;
			$temp_parent_id = $m->parent_id;
			if ($temp_parent_id == $parent_id)
			{
				if ($temp_id == $value)
				{
					$selected = 'selected="selected"';
					$style = " style='color:#AD0000;font-weight:bold;' ";
				}
				else
				{
					$selected = '';
					$style = '';
				}


				if ($m->parent_id == $parent_id)
				{
					$re = '<option value="' . $m->id . '" ' . $selected . $style . '>' . $sep . $m->menu_name . '</option>';
					$res .= Menus::model()->oMenu($m->id, $menus, $value, $re, $sep . "--> ");
				}
			}
		}
		return $res;
	}

	public static function getDropDownList($name, $id, $value = '', $hasEmpty = false)
	{

		$menus = Menus::model()->findAll();

		$strSelect = '<select name=' . $name . ' id=' . $id . '>';

		if ($hasEmpty)
			$strSelect .= '<option value="">--Root Menu--</option>';
		$strSelect .= Menus::model()->oMenu(0, $menus, $value);
		$strSelect .= '</select>';

		return $strSelect;
	}

	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	protected function beforeSave()
	{
		if (parent::beforeSave())
		{
			if ($this->isNewRecord)
			{
				
			}
			else
			{

				// Begin không cho update menu thụt cấp sâu vào trong, chỉ cho update lên cấp trên
				$old_record = Menus::model()->findByPk($this->id);
				$menus = Menus::model()->findAll();
				$idChild = Menus::model()->findAllChild($this->id, $menus);
				if (in_array($this->parent_id, $idChild))
				{
					$this->parent_id = $old_record->parent_id;
				}
				// End không cho update menu thụt cấp sâu vào trong, chỉ cho update lên cấp trên
			}
			return true;
		}
		else
			return false;
	}

	// Truyền vào 1 đối tượng menu
	// Trả về mảng đối tượng là tất cả các con của menu
	public function findAllChild($menu_id)
	{
		$queue = array($menu_id);
		$d = 0;
		$c = 0;
		while ($d <= $c)
		{
			$item_id = $queue[$d];
			$d++;
			$arr_child = self::findchildLevel1($item_id);
			//var_dump($arr_child);die;
			for ($i = 0; $i < count($arr_child); $i++)
			{
				$queue[] = $arr_child[$i]->id;
				;
				$c++;
			}
		}
		return $queue;
	}

	public function findchildLevel1($id)
	{
		if (!empty($id))
			return Menus::model()->findAll(array('condition' => 'parent_id=' . $id));
		return array();
	}

	/*
	  public function findAllChild($parent_id,$menus,$strId=''){

	  foreach($menus as $m){
	  if($m->parent_id!=0 && $m->parent_id == $parent_id){
	  $mId = $m->id;
	  $strId .= ','.Menus::model()->findAllChild($m->id,$menus,$mId);
	  }
	  }
	  return $strId;
	  }
	 */

	//Kvan
	public function getTree($publishedOnly = false, $parent = 0, $limitLevel = 0)
	{
		$criteria = new CDbCriteria;

		$criteria->compare('parent_id', $parent);
		$criteria->order = "display_order ASC";

		$items = array();
		$pages = self::model()->findAll($criteria);

		$level = 0;
		foreach ($pages as $child)
		{
			self::getListed($child, $level, $items, $publishedOnly, $limitLevel);
		}
		return $items;
	}

	//Kvan
	public static function getListed($child, $level, &$return, $publishedOnly, $limitLevel)
	{
		$child->level = $level;
		$return[] = $child;
		$childItem = self::findChild($child->id, $publishedOnly);

		if (count($childItem) > 0)
		{
			foreach ($childItem as $item)
			{
				if ($limitLevel > 0 && $level >= $limitLevel)
				{
					return;
				}
				$level++;
				self::getListed($item, $level, $return, $publishedOnly, $limitLevel);
				$level--;
			}
		}
	}

	//Kvan
	public static function findChild($id)
	{
		$criteria = new CDbCriteria;
		$criteria->compare('parent_id', $id);

		$criteria->order = 't.display_order asc';

		$model = self::model()->findAll($criteria);
		return $model;
	}

	//Kvan
	public static function searchMenuTree()
	{
		$dataProvider = new CArrayDataProvider(self::model()->getTree(true, 0), array(
			'id' => 'pages',
			'pagination' => array(
				'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
			),
		));
		return $dataProvider;
	}

	public function buildLevelTreeCharacter($level)
	{
		$ret = '';
		for ($i = 0; $i < $level; $i ++)
			$ret .= "———";
		return $ret . " ";
	}

}
