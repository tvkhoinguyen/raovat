<?php

/**
 * This is the model class for table "{{_state}}".
 *
 * The followings are the available columns in table '{{_state}}':
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property integer $status
 * @property integer $order_display
 * @property string $created_date
 * @property string $updated_date
 */
class State extends _BaseModel 
{
		
		/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_state}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// array('name, slug, status, order_display, created_date, updated_date', 'required'),
			array('name, status, order_display', 'required', 'on'=>'create,update' ),
			array('status, order_display', 'numerical', 'integerOnly'=>true),
			array('name, slug', 'length', 'max'=>200),
			array('id, name, slug, status, order_display, created_date, updated_date', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
	
																						);
	}

	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('translation','ID'),
			'name' => Yii::t('translation','Name'),
			'slug' => Yii::t('translation','Slug'),
			'status' => Yii::t('translation','Status'),
			'order_display' => Yii::t('translation','Order Display'),
			'created_date' => Yii::t('translation','Created Date'),
			'updated_date' => Yii::t('translation','Updated Date'),
		);
	}

	
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('order_display',$this->order_display);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);
				$sort = new CSort();

        $sort->attributes = array(
            'name' => array(
                'asc' => 't.id',
                'desc' => 't.id desc',
                'default' => 'asc',
            ),
        );
		$sort->defaultOrder = 't.id asc';
					
		 
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
	
	public static function getDetailBySlug($slug)
	{
		$criteria = new CDbCriteria;
        $criteria->compare('t.slug', $slug);
        return self::model()->find($criteria);
	}
	

	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function nextOrderNumber()
	{
		return self::model()->count() + 1;
	}
	public static function getListData()
	{
		$criteria = new CDbCriteria();
		$criteria->compare('status', STATUS_ACTIVE);
		$criteria->order ="order_display ASC";
		$models = self::model()->findAll($criteria);

        return  CHtml::listData($models,'id','name');
	}
	protected function beforeSave() 
	{
		if(empty($this->created_date))
		{
			$this->created_date = date('Y-m-d H:i:s');
		}
        $this->updated_date = date('Y-m-d H:i:s');
	    return parent::beforeSave();
	}
}
