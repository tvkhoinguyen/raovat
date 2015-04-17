<?php

/**
 * This is the model class for table "{{_area_code}}".
 *
 * The followings are the available columns in table '{{_area_code}}':
 * @property integer $id
 * @property string $area_name
 * @property string $area_code
 */
class AreaCode extends _BaseModel
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AreaCode the static model class
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
		return '{{_area_code}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('area_name', 'required'),
			array('area_name', 'length', 'max' => 100),
			array('area_code', 'length', 'max' => 10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, area_name, area_code', 'safe', 'on' => 'search'),
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
			'area_name' => 'Name',
			'area_code' => 'Code',
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
		$criteria->compare('id', '<>' . OTHER_NATIONALITY);
		$criteria->compare('area_name', $this->area_name, true);
		$criteria->compare('area_code', $this->area_code, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	public static function loadItems($emptyOption = false)
	{
		$_items = array();
		if ($emptyOption)
			$_items[""] = "Not applicable";
		$models = self::model()->findAll(array(
			'order' => 'area_name',
		));
		foreach ($models as $model)
			$_items[$model->area_code] = $model->area_name;
		return $_items;
	}

	public static function sltAreaCode($name, $value, $emptyOption = false)
	{
		$str = "<select name='$name' id='$name' style='width:240px;' onchange='fnUserPhoneChange(this);'>";
		if ($emptyOption)
			$str .= "<option value='' >Not applicable</option>";
		$models = self::model()->findAll(array(
			'order' => 'area_name',
		));
		foreach ($models as $model)
		{
			$selected = "";
			if ($model->id == $value)
				$selected = "selected='selected'";
			$str.="<option value='" . $model->id . "' $selected>" . $model->area_name . '(+' . $model->area_code . ')' . "</option>";
		}
		$str.="</select>";
		return $str;
	}

	public static function sltAreaCodeBackEnd($name, $value, $emptyOption = false)
	{
		$str = "<select name='$name' id='$name' style='width:250px;' >";
		if ($emptyOption)
			$str .= "<option value='' >Not applicable</option>";
		$models = self::model()->findAll(array(
			'order' => 'area_name',
		));
		if (empty($value))
		{
			$value = 229;
		}
		foreach ($models as $model)
		{
			$selected = "";
			if ($model->id == $value)
				$selected = "selected='selected'";
			$str.="<option value='" . $model->id . "' $selected>" . $model->area_name . '(+' . $model->area_code . ')' . "</option>";
		}
		$str.="</select>";
		return $str;
	}

	//bb
	public static function getAreaCode()
	{
		$models = self::model()->findAll(array(
			'order' => 'area_name',
		));
		$result = array();
		foreach ($models as $model)
		{
			$result[$model->id] = $model->area_name . ' (+' . $model->area_code . ')';
		}
		return $result;
	}

	public static function loadArrArea()
	{
		$models = self::model()->findAll(array(
			'order' => 'area_name',
		));
		return CHtml::listData($models, 'id', 'area_name');
	}

	public static function getAreaCodeSpecific($areaCodeId)
	{
		$model = self::model()->findByPk($areaCodeId);
		return isset($model) ? $model->area_name . ' (+' . $model->area_code . ')' : '';
	}

}
