<?php
// Add By Nguyen Dung
/**
 * This is the model class for table "{{_newsletter_tracking}}".
 *
 * The followings are the available columns in table '{{_newsletter_tracking}}':
 * @property integer $id
 * @property integer $newsletter_id
 * @property string $subscriber_email
 */
class NewsletterTracking extends _BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return NewsletterTracking the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_newsletter_tracking}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('id, newsletter_id, subscriber_email', 'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'newsletter_id' => 'Newsletter',
			'subscriber_email' => 'Subscriber Email',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.newsletter_id',$this->newsletter_id);
		$criteria->compare('t.subscriber_email',$this->subscriber_email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
		));
	}

    /*
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
	*/

	public function defaultScope()
	{
		return array(
			//'condition'=>'',
		);
	}
        
        // Add By Nguyen Dung
        public static function checkRecordExists($newsletter_id, $subscriber_email_id){
                $criteria=new CDbCriteria;
		$criteria->compare('t.newsletter_id',$newsletter_id);
		$criteria->compare('t.subscriber_email_id',$subscriber_email_id);
                return NewsletterTracking::model()->find($criteria);
        }
}