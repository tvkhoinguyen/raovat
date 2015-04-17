<?php

class ServiceBlock extends _BaseModel 
{
	const SIZE = '150x275'; //use show BE
	const SIZE1 = '300x550'; const SIZE1_WIDTH = 300; const SIZE1_HEIGHT = 550; 

	public $maxImageFileSize = 3145728; //3MB
	public $allowImageType = 'jpg,gif,png';
	public $uploadImageFolder = 'upload/serviceblock'; //remember remove ending slash
	public $defineImageSize = array(
			'image' => array(
						array('alias' => '150x275', 'size' => '150x275'),
						array('alias' => '300x550', 'size' => '300x550'),
					), 
				);	

	public function tableName()
	{
		return '{{_home_block}}';
	}

	public function rules()
	{
		return array(
			array('image, status, name, content, price', 'required', 'on'=>'create'),
			array('image, name, link, title', 'length', 'max'=>255),
		 
					array('image', 'file', 'on' => 'create,update',
						'allowEmpty' => true,
						'types' => $this->allowImageType,
						'wrongType' => 'Only ' . $this->allowImageType . ' are allowed.',
						'maxSize' => $this->maxImageFileSize, // 3MB
						'tooLarge' => 'The file was larger than' . ($this->maxImageFileSize/1024)/1024 . 'MB. Please upload a smaller file.',
					), 
			array('id,status, image, name, link, title, content', 'safe', 'on'=>'search'),
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
			'price' => Yii::t('translation','Price'),
			'status' => Yii::t('translation','Status'),
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->condition = 'type = "service" ';
		$criteria->compare('id',$this->id);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('status',$this->status);
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
	
	public function nextOrderNumber()
	{
		return self::model()->count() + 1;
	}

	public static function getServices()
	{
		$criteria = new CDbCriteria();
		$criteria->condition = ' type="service" AND status ='.STATUS_ACTIVE;
		// $criteria->compare('t.xxx',$xxx);
		// $criteria->limit = ;
		$criteria->order ="order_display ASC, id DESC";
		return self::model()->findAll($criteria);
	}
}
