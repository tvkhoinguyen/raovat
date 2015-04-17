<?php

class Tin extends _BaseModel 
{
    const HOME_BANNER_WIDTH = 960;
    const HOME_BANNER_HEIGHT = 280;
    const HOME_BANNER_SIZE1 = '960x280';
    const HOME_BANNER_SIZE2 = '480x140';
    public $maxImageFileSize = 3145728; //3MB
	public $uploadImageFolder = 'upload/homebanner'; //remember remove ending slash
    public $defineImageSize = array(
        'image' => array(
            array('alias' => '960x280', 'size' => '960x280'),
            array('alias' => '480x140', 'size' => '480x140')
            )
    );
	    
	public function tableName()
	{
		return '{{_tb_tin}}';
	}

	public function rules()
	{
		return array(
			array('title, short_content, content, image, get_from, category_parent_id, category_sub_id, user_id, order_display, status, view, slug, is_home, is_default, updated_date', 'required'),
			array('category_parent_id, category_sub_id, user_id, order_display, status, view, is_home, is_default', 'numerical', 'integerOnly'=>true),
			array('title, image, slug', 'length', 'max'=>200),
			array('get_from', 'length', 'max'=>100),
			array('created_date', 'safe'),
			array('id, title, short_content, content, image, get_from, category_parent_id, category_sub_id, user_id, order_display, status, view, slug, is_home, is_default, created_date, updated_date', 'safe', 'on'=>'search'),
		);
	}
	public function relations()
	{
		return array();
	}

	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('translation','ID'),
			'title' => Yii::t('translation','Title'),
			'short_content' => Yii::t('translation','Short Content'),
			'content' => Yii::t('translation','Content'),
			'image' => Yii::t('translation','Image'),
			'get_from' => Yii::t('translation','Get From'),
			'category_parent_id' => Yii::t('translation','Category Parent'),
			'category_sub_id' => Yii::t('translation','Category Sub'),
			'user_id' => Yii::t('translation','User'),
			'order_display' => Yii::t('translation','Order Display'),
			'status' => Yii::t('translation','Status'),
			'view' => Yii::t('translation','View'),
			'slug' => Yii::t('translation','Slug'),
			'is_home' => Yii::t('translation','Is Home'),
			'is_default' => Yii::t('translation','Is Default'),
			'created_date' => Yii::t('translation','Created Date'),
			'updated_date' => Yii::t('translation','Updated Date'),
		);
	}

	public function search()
	{

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('short_content',$this->short_content,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('get_from',$this->get_from,true);
		$criteria->compare('category_parent_id',$this->category_parent_id);
		$criteria->compare('category_sub_id',$this->category_sub_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('order_display',$this->order_display);
		$criteria->compare('status',$this->status);
		$criteria->compare('view',$this->view);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('is_home',$this->is_home);
		$criteria->compare('is_default',$this->is_default);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);
					
		 
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
