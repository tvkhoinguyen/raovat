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
 * @property integer $layout_id
 * @property string $user_id
 * @property string $post_type
 * @property string $title_tag
 * @property string $meta_keywords
 * @property string $meta_desc
 * @property integer $featured_image
 * @property integer $order
 * @property string $created
 * @property string $modified
 * @property string $slug
 *
 * The followings are the available model relations:
 * @property TagsPosts[] $tagsPosts
 */
class Posts extends CActiveRecord
{

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
			array('status, layout_id, featured_image, order', 'numerical', 'integerOnly' => true),
			array('title', 'length', 'max' => 200),
			array('user_id', 'length', 'max' => 11),
			array('post_type', 'length', 'max' => 20),
			array('slug', 'length', 'max' => 250),
			array('short_content, content, title_tag, meta_keywords, meta_desc, created, modified', 'safe'),
			array('title,content', 'required', 'on' => 'create, update'),
			array('title', 'unique', 'on' => 'create, update'),
			array('post_type', 'file', 'on' => 'create,update',
				'allowEmpty' => true,
				'types' => 'jpg,gif,png',
				'wrongType' => 'Only jpg,gif,png are allowed.',
				'maxSize' => 3 * 1024, // 3MB
				'tooLarge' => 'The file was larger than 3 MB. Please upload a smaller file.',
			),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, short_content, content, status, layout_id, user_id, post_type, title_tag, meta_keywords, meta_desc, featured_image, order, created, modified, slug', 'safe', 'on' => 'search'),
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
			'tagsPosts' => array(self::HAS_MANY, 'TagsPosts', 'post_id'),
			'CategoriesPosts' => array(self::HAS_MANY, 'CategoriesPosts', 'post_id'),
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
			'layout_id' => Yii::t('translation', 'Layout'),
			'user_id' => Yii::t('translation', 'User'),
			'post_type' => Yii::t('translation', 'Post Type'),
			'title_tag' => Yii::t('translation', 'Title Tag'),
			'meta_keywords' => Yii::t('translation', 'Meta Keywords'),
			'meta_desc' => Yii::t('translation', 'Meta Desc'),
			'featured_image' => Yii::t('translation', 'Featured Image'),
			'order' => Yii::t('translation', 'Order'),
			'created' => Yii::t('translation', 'Created'),
			'modified' => Yii::t('translation', 'Modified'),
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
		$criteria->compare('layout_id', $this->layout_id);
		$criteria->compare('user_id', $this->user_id, true);
		$criteria->compare('post_type', $this->post_type, true);
		$criteria->compare('title_tag', $this->title_tag, true);
		$criteria->compare('meta_keywords', $this->meta_keywords, true);
		$criteria->compare('meta_desc', $this->meta_desc, true);
		$criteria->compare('featured_image', $this->featured_image);
		$criteria->compare('order', $this->order);
		$criteria->compare('created', $this->created, true);
		$criteria->compare('modified', $this->modified, true);
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
		return Posts::model()->find($criteria);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Posts the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

}
