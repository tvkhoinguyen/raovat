<?php

class HomeBlock extends _BaseModel 
{
	// const SIZE = '200x200'; //use show BE
	const SIZE1 = '298x205'; const SIZE1_WIDTH = 298; const SIZE1_HEIGHT = 205; 
	// const SIZE2 = '187x200'; const SIZE2_WIDTH = 187; const SIZE2_HEIGHT = 200; 

	public $maxImageFileSize = 3145728; //3MB
	public $allowImageType = 'jpg,gif,png';
	public $uploadImageFolder = 'upload/ads_banner'; //remember remove ending slash
	public $defineImageSize = array(
			'image' => array(
						// array('alias' => '200x200', 'size' => '200x200'),
						array('alias' => '298x205', 'size' => '298x205'),
						// array('alias' => '187x200', 'size' => '187x200'),
					), 
				);	
	

	public function tableName()
	{
		return '{{_home_block}}';
	}

	public static function getAdsBanner($type="adsbanner")
	{	
		$criteria = new CDbCriteria();
		$criteria->compare('t.status',STATUS_ACTIVE);
		$criteria->compare('t.type', $type);
		// $criteria->limit = ;
		$criteria->order ="id DESC";
		return self::model()->findAll($criteria);
	}

	public function rules()
	{
		return array(
			array('image', 'required', 'on'=>'create'),
			array('link', 'url', 'defaultScheme' => 'http'),
			array('image, name, link, title, content', 'length', 'max'=>255),
		 
					array('image', 'file', 'on' => 'create,update',
						'allowEmpty' => true,
						'types' => $this->allowImageType,
						'wrongType' => 'Only ' . $this->allowImageType . ' are allowed.',
						'maxSize' => $this->maxImageFileSize, // 3MB
						'tooLarge' => 'The file was larger than' . ($this->maxImageFileSize/1024)/1024 . 'MB. Please upload a smaller file.',
					), 
			array('id,order_display, image, name, link, title, content', 'safe', 'on'=>'search'),
			array('id,order_display, image, name, link, title, content', 'safe'),
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
			'image' => Yii::t('translation','Image'),
			'name' => Yii::t('translation','Name'),
			'link' => Yii::t('translation','Link'),
			'title' => Yii::t('translation','Title'),
			'content' => Yii::t('translation','Content'),
			'type' => Yii::t('translation','Type'),
			'order_display' => Yii::t('translation','Order Display'),
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->condition = 'type = "adsbanner" ';
		$criteria->compare('id',$this->id);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('order_display',$this->order_display,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                'pageSize'=> Yii::app()->params['defaultPageSize'],
            ),
		));
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
