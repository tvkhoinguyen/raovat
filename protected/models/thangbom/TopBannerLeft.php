<?php

class TopBannerLeft extends _BaseModel {

	const WIDTH = 680;
	const HEIGHT = 120;
	const SIZE = '680x120';
	public $maxImageFileSize = 5242880; //3MB

	public $allowImageType = 'jpg,gif,png';
	public $uploadImageFolder = 'upload/topbannerleft'; //remember remove ending slash
	public $defineImageSize = array(
			'image' => array(
							array('alias' => '980x120', 'size' => '980x120'),
							array('alias' => '680x120', 'size' => '680x120'),
						), 
				);	
	public function tableName()
	{
		return '{{_static_banner}}';
	}

	public function rules()
	{
		return array(
			// array('image,status', 'required'),
			array('status, order_display', 'numerical', 'integerOnly'=>true),
			array('image, title, name_banner', 'length', 'max'=>255),
		 	array('image,status', 'required', 'on' => 'create, update'), 
		 
			array('image', 'file', 'on' => 'create,update',
				'allowEmpty' => true,
				'types' => $this->allowImageType,
				'wrongType' => 'Only ' . $this->allowImageType . ' are allowed.',
				'maxSize' => $this->maxImageFileSize, // 3MB
				'tooLarge' => 'The file was larger than' . ($this->maxImageFileSize/1024)/1024 . 'MB. Please upload a smaller file.',
			), 
			array('name_banner,link, id, image, title, status, content, created_date, order_display', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array();
	}
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('translation','ID'),
			'image' => Yii::t('translation','Image'),
			'title' => Yii::t('translation','Title'),
			'status' => Yii::t('translation','Status'),
			'content' => Yii::t('translation','Content'),
			'created_date' => Yii::t('translation','Created Date'),
			'order_display' => Yii::t('translation','Order Display'),
			'name_banner'=>Yii::t('translation','Name Banner'),
			'link'=>Yii::t('translation','Link'),
		);
	}

	
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('order_display',$this->order_display);
					
		 
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
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	
}
