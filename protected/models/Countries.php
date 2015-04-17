<?php

/**
 * This is the model class for table "{{_area_code}}".
 *
 * The followings are the available columns in table '{{_area_code}}':
 * @property string $id
 * @property string $area_name
 * @property string $area_code
 * @property string $region_id
 */
class Countries extends _BaseModel {
		
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
			array('area_name', 'length', 'max'=>100),
			array('area_code', 'length', 'max'=>10),
			array('region_id', 'length', 'max'=>11),
                        array('area_name', 'required', 'on' => 'create, update'), 
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, area_name, area_code, region_id', 'safe', 'on'=>'search'),
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
			'id' => Yii::t('translation','ID'),
			'area_name' => Yii::t('translation','Name'),
			'area_code' => Yii::t('translation','Country Code'),
			'region_id' => Yii::t('translation','Region'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('area_name',$this->area_name,true);
		$criteria->compare('area_code',$this->area_code,true);
        $criteria->order = 'area_name ASC';
					
		 
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                'pageSize'=> Yii::app()->params['defaultPageSize'],
            ),
		));
	}

	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Countries the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function nextOrderNumber()
	{
		return Countries::model()->count() + 1;
	}


    public static function getDropdownlistWithTableName() {
        $model = Countries::model()->findAll(array('order' => 'area_name ASC'));
        if ($model) {
            return CHtml::listData($model, 'id', 'area_name');
        }
        return array();
    }
    public function getCountryNameByCode($country_code) {
        $data = Countries::model()->findByAttributes(array('area_code' =>$country_code));
        $country_name = '';
        if($data) {
            $country_name = $data->area_name;
        }
        return $country_name;
    }
    public function getCountryNameById($country_id) {
        $data = Countries::model()->findByPk($country_id);
        $country_name = '';
        if($data) {
            $country_name = $data->area_name;
        }
        return $country_name;
    }
	public function getCountryCodeById($country_id) {
        $data = Countries::model()->findByPk($country_id);
        $country_code = '';
        if($data) {
            $country_code = $data->area_code_a2;
        }
        return $country_code;
    }
}
