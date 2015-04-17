<?php

class CategoryVideo extends _BaseModel {
		
		/**
	 * @return string the associated database table name
	 */
	public static function getNameCategoryVideo($id)
	{
		if(!empty($id))
		{
			$model = CategoryVideo::model()->findByPk($id);
			if(!empty($model))
				return $model->name;
			else
				return '';
		}
		else
			return '';
	}

	public static function getListData()
	{
		$criteria = new CDbCriteria();
		$criteria->compare('t.status',STATUS_ACTIVE);
		$criteria->order ="order_display DESC, id DESC";
		$models = self::model()->findAll($criteria);
		return CHtml::listData($models, 'id', 'name');
	}

	public function tableName()
	{
		return '{{_tb_category_video}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// array('name, status, slug, created_date, updated_date, order_display', 'required'),
			array('name, status, order_display', 'required', 'on'=>'create'),
			array('status, order_display', 'numerical', 'integerOnly'=>true),
			array('name, slug', 'length', 'max'=>100),
		 array('name,status,order_display', 'required', 'on' => 'create, update'), 
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, status, slug, created_date, updated_date, order_display', 'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
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
			'name' => Yii::t('translation','Name'),
			'status' => Yii::t('translation','Status'),
			'slug' => Yii::t('translation','Slug'),
			'created_date' => Yii::t('translation','Created Date'),
			'updated_date' => Yii::t('translation','Updated Date'),
			'order_display' => Yii::t('translation','Order Display'),
		);
	}

	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('order_display',$this->order_display);
		$criteria->order= 'id DESC';
		// 		$sort = new CSort();

  //       $sort->attributes = array(
  //           'name' => array(
  //               'asc' => 't.name',
  //               'desc' => 't.name desc',
  //               'default' => 'asc',
  //           ),
  //       );
		// $sort->defaultOrder = 't.name asc';
					
		 
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                'pageSize'=> Yii::app()->params['defaultPageSize'],
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
	public function behaviors() {
        return array('sluggable' => array(
                'class' => 'application.extensions.mintao-yii-behavior-sluggable.SluggableBehavior',
                'columns' => array('name'),
                'unique' => true,
                'update' => true,
            ),);
    }
	
	public function getDetailBySlug($slug)
	{
		$criteria = new CDbCriteria;
        $criteria->compare('t.slug', $slug);
        return CategoryVideo::model()->find($criteria);
	}
	

	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function nextOrderNumber()
	{
		return self::model()->count() + 1;
	}
}
