<?php

class AboutBlock extends _BaseModel 
{
	const SIZE = '480x200'; //use show BE
	const SIZE1 = '960x480'; const SIZE1_WIDTH = 960; const SIZE1_HEIGHT = 480; 
	// const SIZE2 = '310x555'; const SIZE2_WIDTH = 310; const SIZE2_HEIGHT = 555; 
	// const SIZE3 = '635x270'; const SIZE3_WIDTH = 635; const SIZE3_HEIGHT = 270; 

	public $maxImageFileSize = 3145728; //3MB
	public $allowImageType = 'jpg,gif,png';
	public $uploadImageFolder = 'upload/aboutblock'; //remember remove ending slash
	public $defineImageSize = array(
			'image' => array(
						array('alias' => '480x200', 'size' => '480x200'),
						array('alias' => '960x480', 'size' => '960x480'),
						// array('alias' => '310x555', 'size' => '310x555'),
						// array('alias' => '635x270', 'size' => '635x270'),
					), 
				);	

	public function tableName()
	{
		return '{{_home_block}}';
	}

	public function rules()
	{
		return array(
			array('image, name,  content, type', 'required', 'on'=>'create, update'),
			array('image, name, link, title', 'length', 'max'=>255),
		 
					array('image', 'file', 'on' => 'create,update',
						'allowEmpty' => true,
						'types' => $this->allowImageType,
						'wrongType' => 'Only ' . $this->allowImageType . ' are allowed.',
						'maxSize' => $this->maxImageFileSize, // 3MB
						'tooLarge' => 'The file was larger than' . ($this->maxImageFileSize/1024)/1024 . 'MB. Please upload a smaller file.',
					), 
			array('id, image, name, link, title, content', 'safe', 'on'=>'search'),
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
			// 'status' => Yii::t('translation','Status'),
			// 'order_display' => Yii::t('translation','Order Display'),
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->condition = 'type = "aboutus" ';
		$criteria->compare('id',$this->id);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
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
