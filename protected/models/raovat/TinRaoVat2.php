<?php

class TinRaoVat extends _BaseModel 
{
	public $maxImageFileSize = 3145728; //3MB
	public $allowImageType = 'jpg,gif,png';
	public $uploadImageFolder = 'upload/tin_rao_vat'; //remember remove ending slash
	public $defineImageSize = array(
			'image1' => array(
				array('alias' => RAOVAT_SIZE, 'size' => RAOVAT_SIZE),
				// array('alias' => 'SIZE_IN_LOCAL_CONFIG', 'size' => 'SIZE_IN_LOCAL_CONFIG'),
			), 
			'image2' => array(
				// array('alias' => '100x100', 'size' => '100x100'),
				array('alias' => RAOVAT_SIZE, 'size' => RAOVAT_SIZE),
				// array('alias' => 'SIZE_IN_LOCAL_CONFIG', 'size' => 'SIZE_IN_LOCAL_CONFIG'),
			), 
	);	
	public function tableName()
	{
		return '{{_tin_rao_vat}}';
	}

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// array('title, short_content, content, status, image1, image2, order_display, is_hot, is_new, name, phone, mobile, state_id, city, created_date, updated_date', 'required'),
			array('title, short_content, content, status, order_display, is_hot, is_new, name,mobile, state_id', 'required','on'=>'create,update'),
			array('status, order_display, is_hot, is_new, state_id', 'numerical', 'integerOnly'=>true),
			array('title, image1, image2, city, slug', 'length', 'max'=>200),
			array('slug', 'length', 'max'=>300),
			array('name, phone, mobile', 'length', 'max'=>100),
		 
			array('image1,image2', 'file', 'on' => 'create,update',
				'allowEmpty' => true,
				'types' => $this->allowImageType,
				'wrongType' => 'Only ' . $this->allowImageType . ' are allowed.',
				'maxSize' => $this->maxImageFileSize, // 3MB
				'tooLarge' => 'The file was larger than' . ($this->maxImageFileSize/1024)/1024 . 'MB. Please upload a smaller file.',
			),
			array('image1', 'file', 'on' => 'create',
				'allowEmpty' => false,
				'types' => $this->allowImageType,
				'wrongType' => 'Only ' . $this->allowImageType . ' are allowed.',
				'maxSize' => $this->maxImageFileSize, // 3MB
				'tooLarge' => 'The file was larger than' . ($this->maxImageFileSize/1024)/1024 . 'MB. Please upload a smaller file.',
			), 
			array('id, title, short_content, content, status, image1, image2, order_display, is_hot, is_new, name, phone, mobile, state_id, city, created_date, updated_date', 'safe', 'on'=>'search'),
			array('id, job_id, slug, title, short_content, content, status, image1, image2, order_display, is_hot, is_new, name, phone, mobile, state_id, city, created_date, updated_date', 'safe'),
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
			'title' => Yii::t('translation','Title'),
			'short_content' => Yii::t('translation','Short Content'),
			'content' => Yii::t('translation','Content'),
			'status' => Yii::t('translation','Status'),
			'image1' => Yii::t('translation','Image1'),
			'image2' => Yii::t('translation','Image2'),
			'order_display' => Yii::t('translation','Order Display'),
			'is_hot' => Yii::t('translation','Is Hot'),
			'is_new' => Yii::t('translation','Is New'),
			'name' => Yii::t('translation','Tên Người Gửi'),
			'phone' => Yii::t('translation','Phone'),
			'mobile' => Yii::t('translation','Mobile'),
			'state_id' => Yii::t('translation','State'),
			'city' => Yii::t('translation','City'),
			'created_date' => Yii::t('translation','Created Date'),
			'updated_date' => Yii::t('translation','Updated Date'),
			'job_id' => Yii::t('translation','Job'),
		);
	}

	
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('short_content',$this->short_content,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('image1',$this->image1,true);
		$criteria->compare('image2',$this->image2,true);
		$criteria->compare('order_display',$this->order_display);
		$criteria->compare('is_hot',$this->is_hot);
		$criteria->compare('is_new',$this->is_new);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('state_id',$this->state_id);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		// $sort = new CSort();

  //       $sort->attributes = array(
  //           'name' => array(
  //               'asc' => 't.title',
  //               'desc' => 't.title desc',
  //               'default' => 'asc',
  //           ),
  //       );
		// $sort->defaultOrder = 't.title asc';
					
		 
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
                'columns' => array('title'),
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
	// public static function getListData()
	// {
	// 	$criteria = new CDbCriteria();
	// 	$criteria->compare('status', STATUS_ACTIVE);
	// 	$criteria->order ="order_display ASC";
	// 	$models = self::model()->findAll($criteria);

 //        return  array(''=>'---Chọn---') + CHtml::listData($models,'id','name');
	// }
	protected function beforeSave() 
	{
		if(empty($this->created_date))
		{
			$this->created_date = date('Y-m-d H:i:s');
		}
        $this->updated_date = date('Y-m-d H:i:s');
	    return parent::beforeSave();
	}

	public function setRaoVat_New()
	{
		$now_time = strtotime( date('Y-m-d H:i:s') );
		$one_time = strtotime( $this->created_date );
		if(  ($now_time - $one_time) > (60*60*24*7) )
		{
		    $this->is_new = TYPE_NO;
		}else{
			$this->is_new = TYPE_YES;
		}
		$this->update( array('is_new'));
	}
}
