<?php

/**
 * This is the model class for table "{{_banner_ads}}".
 *
 * The followings are the available columns in table '{{_banner_ads}}':
 * @property integer $id
 * @property integer $cate_holder_id
 * @property integer $place_holder_id
 * @property string $image
 * @property string $link
 * @property integer $published
 * @property string $created_date
 * @property string $expired_date
 * @property integer $order
 */
class Ads extends _BaseModel {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return BannerAds the static model class
     */
    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
	return '{{_ads}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('place_holder, link, status, order_display, expired_date', 'required'),
            array('status, order_display', 'numerical', 'integerOnly' => true),
            array('expired_date, place_holder', 'safe'),
            array('image', 'required', 'on'=>'create'),
            array('image', 'file', 'on' => 'create',
                'allowEmpty' => true,
                'types' => 'jpg,gif,png,jpeg',
                'wrongType' => 'Only jpg,gif,png,jpeg are allowed.',
                'maxSize' => Yii::app()->params['maxUploadedFile'],
                'tooLarge' => 'The file was larger than ' . (Yii::app()->params['maxUploadedFile'] / 1024 / 1024) . ' MB. Please upload a smaller file.',
            ),
            array('image', 'file', 'on' => 'update',
                'allowEmpty' => true,
                'types' => 'jpg,gif,png,jpeg',
                'wrongType' => 'Only jpg,gif,png,jpeg are allowed.',
                'maxSize' => Yii::app()->params['maxUploadedFile'],
                'tooLarge' => 'The file was larger than ' . (Yii::app()->params['maxUploadedFile'] / 1024 / 1024) . ' MB. Please upload a smaller file.',
            ),
            array(
                'image', 'match',
                'pattern' => '/^[^\\/?*:&;{}\\\\]+\\.[^\\/?*:;{}\\\\]{3,4}$/',
                'message' => 'Image files name cannot include special characters: &%$#',
            ),
            array('link', 'url'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, place_holder, image, link, status, created_date, expired_date, order_display', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'place_holder' => 'Place Holder',
            'image' => 'Image',
            'link' => 'Link',
            'status' => 'Status',
            'created_date' => 'Created Date',
            'expired_date' => 'Expired Date',
            'order_display' => 'Order',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
	// Warning: Please modify the following code to remove attributes that
	// should not be searched.

	$criteria = new CDbCriteria;

	$criteria->compare('t.id', $this->id);
	$criteria->compare('t.place_holder', $this->place_holder);
	$criteria->compare('t.image', $this->image, true);
	$criteria->compare('t.link', $this->link, true);
	$criteria->compare('t.status', $this->status);
	$criteria->compare('t.created_date', $this->created_date, true);
	$criteria->compare('t.expired_date', $this->expired_date, true);
	$criteria->compare('t.order_display', $this->order_display);
	$criteria->order = 't.place_holder, t.order_display';

	return new CActiveDataProvider($this, array(
		    'criteria' => $criteria,
		    'pagination' => array(
			'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
		    ),
		));
    }

    public function activate() {
	$this->status = 1;
	$this->update();
    }

    public function deactivate() {
	$this->status = 0;
	$this->update();
    }

    public function minOrder($place_holder) {
	$minOrder = Yii::app()->db->createCommand()
		->select('MIN(order_display) as minOrder')
		->from(self::tableName())
		->where('place_holder ="' . $place_holder.'"')
		->queryScalar();
	return $minOrder;
    }

    public function maxOrder($place_holder) {
	$minOrder = Yii::app()->db->createCommand()
		->select('MAX(order_display) as maxOrder')
		->from(self::tableName())
		->where('place_holder ="' . $place_holder.'"')
		->queryScalar();
	return $minOrder;
    }

    public static function getPlaceHolder($emptyOption = false) {
        if ($emptyOption)
            return array("" => "", "Clinic" => "Clinic", "Blog - Right Side" => "Blog - Right Side", "Search Results of Clinic" => "Search Results of Clinic");
        else
            return array("Clinic" => "Clinic", "Blog - Right Side" => "Blog - Right Side", "Search Results of Clinic" => "Search Results of Clinic");
    }

    public function defaultScope() {
        return array(
            //'condition'=>'',
        );
    }

    public static function getAdsByPlaceHolder($place_holder){
        if($place_holder == "Homepage" || $place_holder == "Blog - Top")
            return self::model()->find('place_holder ="' . $place_holder.'" AND status ='.STATUS_ACTIVE.' AND DATE(expired_date) >= DATE(NOW())');
        else
            return self::model()->findAll(array('condition'=>'place_holder ="' . $place_holder.'" AND status ='.STATUS_ACTIVE.' AND DATE(expired_date) >= DATE(NOW())', 'order'=>'order_display ASC'));
    }

}