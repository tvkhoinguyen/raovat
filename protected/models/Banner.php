<?php

class Banner extends _BaseModel
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
		return '{{_banners}}';
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

	public function rules()
	{
		return array(
            array('status, order_display', 'required', 'on' => 'create,update'),
			array('content', 'required', 'on' => 'create,update'),
			array('image', 'required', 'on' => 'create', 'message' => 'Select file upload.'),
			array('status', 'numerical', 'integerOnly' => true),
			array('image', 'length', 'max' => 255),
            array('id, status, created_date', 'safe', 'on' => 'search'),
			array('content', 'safe'),
			array('image', 'file',
                'allowEmpty' => true,
                'types' => 'jpg,gif,png',
                'wrongType' => 'Only jpg,gif,png are allowed.',
                'maxSize' => $this->maxImageFileSize, // 3MB
                'tooLarge' => 'The file was larger than ' . ($this->maxImageFileSize / 1024) . ' KB. Please upload a smaller file.',
            ),
            array(
                'image', 'match',
                'pattern' => '/^[^\\/?*:&;{}\\\\]+\\.[^\\/?*:;{}\\\\]{3}$/',
                'message' => 'Image files name cannot include special characters: &%$#',
            ),
		);
	}

	public function relations()
	{
		return array(
		);
	}

	public function attributeLabels() {
        return array(
            'id' => Yii::t('translation', 'ID'),
            // 'name' => Yii::t('translation', 'Title'),
            'text1' => Yii::t('translation', 'Title 1'),
            'text2' => Yii::t('translation', 'Title 2'),
            // 'text3' => Yii::t('translation', 'Title 3'),
            // 'link' => Yii::t('translation', 'Link'),
            'image' => Yii::t('translation', 'Image'),
            'status' => Yii::t('translation', 'Status'),
            'order_display' => Yii::t('translation', 'Order Display'),
            // 'type' => Yii::t('translation', 'Type'),
            'created_date' => Yii::t('translation', 'Created Date'),
        );
    }

	
	public function search($search=NULL) 
	{
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('order_display', $this->order_display, true);
        $criteria->compare('created_date', $this->created_date, true);
        if( $search!=NULL )
        {
            $criteria->order = "id DESC";
        }
        // $criteria->order = "id DESC";
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->params['defaultPageSize'],
            ),
        ));
    }

	public static function model($className = __CLASS__) {
        return parent::model($className);
    }

	public function nextOrderNumber()
	{
		return self::model()->count() + 1;
	}
	public function activate() 
    {
        $this->status = 1;
        $this->update();
    }

    public function deactivate() {
        $this->status = 0;
        $this->update();
    }
    public static function findActiveBanner() {
        $model = self::model()->findAll(array('condition' => 'status = '.STATUS_ACTIVE ));
        return $model;
    }

    public static function findHomeActiveBanner() {
        $criteria = new CDbCriteria();
        $criteria->compare('t.status',STATUS_ACTIVE);
        // $criteria->limit = 6 ;
        $criteria->order ="order_display ASC, id DESC";
        return self::model()->findAll($criteria);
    }

}
