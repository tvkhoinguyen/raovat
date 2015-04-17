<?php

/**
 * This is the model class for table "{{_posts}}".
 *
 * The followings are the available columns in table '{{_posts}}':
 * @property integer $id
 * @property string $title
 * @property string $short_content
 * @property string $content
 * @property integer $status
 * @property string $posted_by
 * @property string $post_type
 * @property string $title_tag
 * @property string $meta_keywords
 * @property string $meta_desc
 * @property string $featured_image
 * @property integer $display_order
 * @property string $created_date
 * @property string $modified_date
 * @property string $slug
 */
class _BasePost extends _BaseModel
{
	public $maxImageFileSize = 3145728; //3MB
	public $allowImageType = 'jpg,gif,png';
	public $uploadImageFolder = '/upload/images'; //remember remove ending slash
	public $defineImageSize = array(
		'featured_image' => array('204x94'),
	);

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_posts}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status, display_order', 'numerical', 'integerOnly' => true),
			array('title, slug', 'length', 'max' => 400),
			array('posted_by', 'length', 'max' => 11),
			array('post_type', 'length', 'max' => 20),
			array('featured_image', 'length', 'max' => 300),
			array('short_content, content, title_tag, meta_keywords, meta_desc, created_date, modified_date', 'safe'),
			array('title,post_type,slug', 'required', 'on' => 'create, update'),
			array('featured_image', 'file', 'on' => 'create,update',
				'allowEmpty' => true,
				'types' => $this->allowImageType,
				'wrongType' => 'Only jpg,gif,png are allowed.',
				'maxSize' => $this->allowImageType, // 3MB
				'tooLarge' => 'The file was larger than' . ($this->allowImageType / 1024) / 1024 . 'MB. Please upload a smaller file.',
			),
			array(
				'featured_image', 'match',
				'pattern' => '/^[^\/?*:&;{}\\]+\.[^\/?*:;{}\\]{3}$/',
				'message' => 'Image files name cannot be included special characters: &%$#',
			),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, short_content, content, status, posted_by, post_type, title_tag, meta_keywords, meta_desc, featured_image, display_order, created_date, modified_date, slug', 'safe', 'on' => 'search'),
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
			'title' => Yii::t('translation', 'Title'),
			'short_content' => Yii::t('translation', 'Short Content'),
			'content' => Yii::t('translation', 'Content'),
			'status' => Yii::t('translation', 'Status'),
			'posted_by' => Yii::t('translation', 'Posted By'),
			'post_type' => Yii::t('translation', 'Post Type'),
			'title_tag' => Yii::t('translation', 'Title Tag'),
			'meta_keywords' => Yii::t('translation', 'Meta Keywords'),
			'meta_desc' => Yii::t('translation', 'Meta Desc'),
			'featured_image' => Yii::t('translation', 'Featured Image'),
			'display_order' => Yii::t('translation', 'Display Order'),
			'created_date' => Yii::t('translation', 'Created Date'),
			'modified_date' => Yii::t('translation', 'Modified Date'),
			'slug' => Yii::t('translation', 'Slug'),
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
		$criteria->compare('title', $this->title, true);
		$criteria->compare('short_content', $this->short_content, true);
		$criteria->compare('content', $this->content, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('posted_by', $this->posted_by, true);
		$criteria->compare('post_type', $this->post_type, true);
		$criteria->compare('title_tag', $this->title_tag, true);
		$criteria->compare('meta_keywords', $this->meta_keywords, true);
		$criteria->compare('meta_desc', $this->meta_desc, true);
		$criteria->compare('featured_image', $this->featured_image, true);
		$criteria->compare('display_order', $this->display_order);
		$criteria->compare('created_date', $this->created_date, true);
		$criteria->compare('modified_date', $this->modified_date, true);
		$criteria->compare('slug', $this->slug, true);
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
				'columns' => array('title'),
				'unique' => true,
				'update' => true,
			),);
	}

	public function getDetailBySlug($slug)
	{
		$criteria = new CDbCriteria;
		$criteria->compare('t.slug', $slug);
		return _BasePost::model()->find($criteria);
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return _BasePost the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

}
