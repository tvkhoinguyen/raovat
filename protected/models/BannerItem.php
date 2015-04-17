<?php

/**
 * This is the model class for table "{{_banners}}".
 *
 * The followings are the available columns in table '{{_banners}}':
 * @property integer $id
 * @property string $name
 * @property string $banner_title
 * @property string $banner_description
 * @property string $thumb_image
 * @property string $large_image
 * @property string $link
 * @property integer $place_holder_id
 * @property integer $status
 * @property integer $order_display
 * @property string $created_date
 */
class BannerItem extends _BaseModel
{

	public $maxImageFileSize = 3145728; //3MB
	public $allowImageType = 'jpg,gif,png';
	public $uploadImageFolder = 'upload/banners'; //remember remove ending slash
	public $defineImageSize = array('large_image' => array(array('alias' => 'thumb1', 'size' => '920x320')));
	public $pageType = 'page';

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_banneritems}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, banner_title, banner_description, large_image, order_display', 'required'),
			array('place_holder_id, status, order_display', 'numerical', 'integerOnly' => true),
			array('name', 'length', 'max' => 250),
			array('thumb_image, large_image, link', 'length', 'max' => 255),
			array('name,banner_title,banner_description,link', 'required', 'on' => 'create, update'),
			array('id', 'unique', 'on' => 'create, update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, banner_title, banner_description, thumb_image, large_image, link, place_holder_id, status, order_display, created_date', 'safe', 'on' => 'search'),
			array('large_image', 'file', 'on' => 'create,update',
				'allowEmpty' => true,
				'types' => $this->allowImageType,
				'wrongType' => 'Only jpg,gif,png are allowed.',
				'maxSize' => $this->maxImageFileSize, // 3MB
				'tooLarge' => 'The file was larger than' . ($this->maxImageFileSize / 1024) / 1024 . 'MB. Please upload a smaller file.',
			),
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
			'id' => Yii::t('translation', 'ID'),
			'name' => Yii::t('translation', 'Name'),
			'banner_title' => Yii::t('translation', 'Banner Title'),
			'banner_description' => Yii::t('translation', 'Banner Description'),
			'thumb_image' => Yii::t('translation', 'Thumb Image'),
			'large_image' => Yii::t('translation', 'Large Image'),
			'link' => Yii::t('translation', 'Link'),
			'place_holder_id' => Yii::t('translation', 'Place Holder'),
			'status' => Yii::t('translation', 'Status'),
			'order_display' => Yii::t('translation', 'Order Display'),
			'created_date' => Yii::t('translation', 'Created Date'),
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

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('banner_title', $this->banner_title, true);
		$criteria->compare('banner_description', $this->banner_description, true);
		$criteria->compare('thumb_image', $this->thumb_image, true);
		$criteria->compare('large_image', $this->large_image, true);
		$criteria->compare('link', $this->link, true);
		$criteria->compare('place_holder_id', $this->place_holder_id);
		$criteria->compare('status', $this->status);
		$criteria->compare('order_display', $this->order_display);
		$criteria->compare('created_date', $this->created_date, true);
		$sort = new CSort();

		$sort->attributes = array(
			'name' => array(
				'asc' => 't.banner_title',
				'desc' => 't.banner_title desc',
				'default' => 'asc',
			),
		);
		$sort->defaultOrder = 't.banner_title asc';


		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageSize' => Yii::app()->params['defaultPageSize'],
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

	public function behaviors()
	{
		return array('sluggable' => array(
				'class' => 'application.extensions.mintao-yii-behavior-sluggable.SluggableBehavior',
				'columns' => array('banner_title'),
				'unique' => true,
				'update' => true,
			),);
	}

	public function getDetailBySlug($slug)
	{
		$criteria = new CDbCriteria;
		$criteria->compare('t.slug', $slug);
		return Banner::model()->find($criteria);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Banner the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function nextOrderNumber()
	{
		return Banner::model()->count() + 1;
	}

	protected function beforeSave()
	{
		if (parent::beforeSave())
		{
			if ($this->isNewRecord)
				$this->created_date = date('Y-m-d H:i:s');
			$model->role_id = ROLE_MEMBER;
		}
		return true;
	}

}
