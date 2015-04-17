<?php

class Video extends _BaseModel 
{
	const SIZE1_WIDTH = 120; const SIZE1_HEIGHT = 90; 
	const SIZE2_WIDTH = 128; const SIZE2_HEIGHT = 96; 
	const SIZE1 = '120x90';
	const SIZE2 = '128x96';

	// public $maxImageFileSize = 3145728; //3MB
	// public $allowImageType = 'jpg,gif,png';
	// public $uploadImageFolder = 'upload/video';
	// public $defineImageSize = array(
	// 'image' => array(
	// 				// array('alias' => '204x94', 'size' => '204x94'),
	// 				array('alias' => '120x90', 'size' => '120x90'),//Hot video
	// 				array('alias' => '128x96', 'size' => '128x96'),//Video list
	// 			), 
	// 	);	
	public function tableName()
	{
		return '{{_tb_video}}';
	}

	public function rules()
	{
		return array(
			// array('title, image, link, is_hot, slug, category_video_id, status, order_display, created_date, updated_date', 'required'),
			array('title, image, link, is_hot, slug, category_video_id, status, order_display, created_date', 'required', 'on'=>'xxxxx'),
			array('is_hot, category_video_id, status, order_display', 'numerical', 'integerOnly'=>true),
			array('title,  link, slug', 'length', 'max'=>200),
		 	array('title,link', 'required', 'on' => 'create, update'), 
		 
			// array('image', 'file', 'on' => 'create,update',
			// 	'allowEmpty' => true,
			// 	'types' => $this->allowImageType,
			// 	'wrongType' => 'Only ' . $this->allowImageType . ' are allowed.',
			// 	'maxSize' => $this->maxImageFileSize, // 3MB
			// 	'tooLarge' => 'The file was larger than' . ($this->maxImageFileSize/1024)/1024 . 'MB. Please upload a smaller file.',
			// ), 

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, image, link, is_hot, slug, category_video_id, status, order_display, created_date, updated_date', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
																						);
	}
	public function resizeImage($fieldName)
	{
	    $sizeRefactory = array();
	    foreach ($this->defineImageSize[$fieldName] as $item)
	    {
	        $sizeExplode = explode('x', $item['size']);
	        $sizeRefactory[$item['alias']] = array('width' => $sizeExplode[0], 'height' => $sizeExplode[1]);
	    }
	    $ImageHelper = new ImageHelper();
	    $ImageHelper->folder = $this->uploadImageFolder . '/' . $this->id ;
	    $ImageHelper->file = $this->$fieldName;
	    $ImageHelper->thumbs = $sizeRefactory;
	    $ImageHelper->aRGB = array(255, 255, 255);
	    $ImageHelper->createFullImage = true;
	    $ImageHelper->createThumbs();
	}

	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('translation','ID'),
			'title' => Yii::t('translation','Title'),
			'image' => Yii::t('translation','Image'),
			'link' => Yii::t('translation','Link'),
			'is_hot' => Yii::t('translation','Is Hot'),
			'slug' => Yii::t('translation','Slug'),
			'category_video_id' => Yii::t('translation','Category Video'),
			'status' => Yii::t('translation','Status'),
			'order_display' => Yii::t('translation','Order Display'),
			'created_date' => Yii::t('translation','Created Date'),
			'updated_date' => Yii::t('translation','Last Update'),
		);
	}

	
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('is_hot',$this->is_hot);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('category_video_id',$this->category_video_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('order_display',$this->order_display);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->order= 'id DESC';
				$sort = new CSort();

        $sort->attributes = array(
            'name' => array(
                'asc' => 't.title',
                'desc' => 't.title desc',
                'default' => 'asc',
            ),
        );
		$sort->defaultOrder = 't.title asc';
					
		 
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
	
	public function getDetailBySlug($slug)
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
}
