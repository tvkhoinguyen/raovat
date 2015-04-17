<?php
class News extends _BasePost 
{
	public $uploadImageFolder = 'upload/cms'; //remember remove ending slash
	public $defineImageSize = array(
                    'featured_image' => array(
                        array('alias' => 'thumb1', 'size' => '200x150')
                    ), 
        );	
	public $categoryId;
	public $post_type_option = array(
            'news' => 'News',
            'event' => 'Event',
        );
	public static function model($className=__CLASS__)
        {
            return parent::model($className);
        }
        
        public function rules()
	{
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('short_content, title, content, post_type', 'required', 'on' => 'News, UpdateNews'),
                array('slug, status', 'safe')
            );
        }
	
        public static function getListActive($type) {
            $criteria=new CDbCriteria;
            $criteria->compare('t.post_type', $type);
            $criteria->compare('t.status', STATUS_ACTIVE);
            return new CActiveDataProvider('News', array(
                'criteria' => $criteria,
                'pagination' => array(
                    'pageSize' => ITEM_PAGING,
                ),
                'sort' => array(
                    'defaultOrder' => 't.id DESC'
                )
            ));
        }
        
        public function search() {
            $criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('short_content', $this->short_content, true);
		$criteria->compare('content', $this->content, true);
		$criteria->compare('status', $this->status);		
		$criteria->compare('post_type', array('news', 'event'));
		$criteria->compare('title_tag', $this->title_tag, true);
		$criteria->compare('meta_keywords', $this->meta_keywords, true);
		$criteria->compare('meta_desc', $this->meta_desc, true);
		$criteria->compare('featured_image', $this->featured_image, true);
		$criteria->compare('display_order', $this->display_order);
		$criteria->compare('created_date', $this->created_date, true);
		$criteria->compare('modified_date', $this->modified_date, true);
		$criteria->compare('slug', $this->slug, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageSize' => Yii::app()->params['defaultPageSize'],
			),
                        'sort' => array(
                            'defaultOrder' => 't.id DESC'
                        )
		));
        }

        public function getSlugById($id)
	{
		return News::model()->findByPk((int)$id);
	}
	
	public static function findBySlug($slug) {
            $criteria=new CDbCriteria;
            $criteria->compare('t.slug', $slug);
            return self::model()->find($criteria);
        }


    public function nextOrderNumber()
	{
		return News::model()->count() + 1;
	}


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
        // $criteria->condition = ' t.post_type = "news" OR t.post_type = "event"  ';
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
}

