<?php
/**
 * This is the model class for table "{{_image_example}}".
 *
 * The followings are the available columns in table '{{_image_example}}':
 * @property string $id
 * @property string $name
 * @property string $image1
 * @property string $image2
 * @property string $image3
 * 
 * IN VIEW FILE call this to get image URL
 * echo $model->getImageUrl('image1', ImageExample::IMAGE1_WIDTH_1, ImageExample::IMAGE1_HEIGHT_1)
 */
class ImageExample extends MyActiveRecord
{
        const IMAGE1_WIDTH_1 = 226;
        const IMAGE1_HEIGHT_1 = 226;
        const IMAGE1_WIDTH_2 = 108;
        const IMAGE1_HEIGHT_2 = 108;
        
        const IMAGE2_WIDTH_1 = 226;
        const IMAGE2_HEIGHT_1 = 226;
        const IMAGE2_WIDTH_2 = 108;
        const IMAGE2_HEIGHT_2 = 108;
        
        const IMAGE3_WIDTH_1 = 226;
        const IMAGE3_HEIGHT_1 = 226;
        const IMAGE3_WIDTH_2 = 108;
        const IMAGE3_HEIGHT_2 = 108;
        
	//bb
        public $aImageSize = array(
            'image1' => array(
                            '226x226' => array('width' => 226, 'height' => 226),
                            '108x108' => array('width' => 108, 'height' => 108),
                        ),
            'image2' => array(
                            '226x226' => array('width' => 226, 'height' => 226),
                            '108x108' => array('width' => 108, 'height' => 108),
                        ),
            'image3' => NULL//if you need save image but no need to resize
        );
        
        public $aImagePath = array(
            'image1' => 'upload/imageExample/{id}',            
            'image2' => 'upload/imageExample/{id}',            
            'image3' => 'upload/imageExample/{id}',            
        );

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_image_example}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'length', 'max'=>255),
			array('image1, image2, image3', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, image1, image2, image3', 'safe', 'on'=>'search'),
                         array('image1, image2, image3', 'file',
                            'allowEmpty' => true,
                            'types' => 'jpg, png, gif',
                            'wrongType' => 'Only jpg, png, gif are allowed.',
                            'maxSize' => ActiveRecord::getMaxFileSize(), // 3MB
                            'tooLarge' => 'The file was larger than ' . (ActiveRecord::getMaxFileSize() / 1024) . ' KB. Please upload a smaller file.',
                        ),
		);
	}
        
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'image1' => 'Image1',
			'image2' => 'Image2',
		);
	}
	
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('t.id',$this->id,true);
		$criteria->compare('t.name',$this->name,true);
		$criteria->compare('t.image1',$this->image1,true);
		$criteria->compare('t.image2',$this->image2,true);
		$criteria->compare('t.image3',$this->image3,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
		));
	}

        
}