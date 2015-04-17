<?php

/**
 * This is the model class for table "{{_categories}}".
 *
 * The followings are the available columns in table '{{_categories}}':
 * @property integer $id
 * @property string $category_name
 * @property integer $display_order
 * @property integer $status
 * @property integer $parent_id
 */
class _BaseCategory extends _BaseModel {
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Categories the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{_categories}}';
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array (
			array ('category_name, status, type', 'required' ), 
			array ('display_order, status, parent_id', 'numerical', 'integerOnly' => true ), 
			array ('category_name', 'length', 'max' => 255 ), // The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array ('id, category_name, category_slug, type, display_order, status, parent_id, title_tag, meta_keyword, meta_description', 'safe', 'on' => 'search' ) );
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
			return array();
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array (
			'id' => 'ID', 
			'category_name' => 'Category Name', 
			'display_order' => 'Display Order', 
			'status' => 'Status', 
			'parent_id' => 'Parent' );
	}
	
	public function buildLevelTreeCharacter($level) {
        $ret = '';
        for ($i = 0; $i < $level; $i++)
            $ret .= "—";
        return $ret . " ";
    }
	
	public function behaviors() {
        return array('sluggable' => array(
                'class' => 'application.extensions.mintao-yii-behavior-sluggable.SluggableBehavior',
                'columns' => array('category_name'),
                'unique' => true,
                'update' => true,
            ),);
    }
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria = new CDbCriteria ();
		$criteria->compare ( 'id', $this->id );
		$criteria->compare ( 'category_name', $this->category_name, true );
		$criteria->compare ( 'display_order', $this->display_order );
		$criteria->compare ( 'status', $this->status );
		$criteria->compare ( 'parent_id', $this->parent_id );
		
		return new CActiveDataProvider ( $this, array ('criteria' => $criteria ) );
	}
	
	public function searchFE() {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria = new CDbCriteria ();
		$criteria->compare ( 'id', $this->id );
		$criteria->compare ( 'category_name', $this->category_name, true );
		$criteria->compare ( 'display_order', $this->display_order );
		$criteria->compare ( 'status', $this->status );
		$criteria->compare ( 'parent_id', $this->parent_id );
		//$criteria->order = " category_name ASC";
		return new CActiveDataProvider ( $this, array ('criteria' => $criteria, 'pagination' => false) );
	}
	
	public function getCatBySlug($slug)
	{
	    $criteria = new CDbCriteria ();
	    $criteria->compare ( 'category_slug', $slug);
	    return self::model ()->find($criteria);
	}
	
	public function categoryDropdown()
	{
		$listCategories = $this->getCategoryTree();
		$data = array();
		foreach ($listCategories as $item)
		{
			$tree = "";
			if ($item->level > 0) 
			{
				$tree = "";
				for ($i = 0 ; $i < $item->level; $i++ )
					$tree .= "---";
			}
			 
			$data [$item->category_slug]= $tree . $item->category_name;
		}
		return $data;
	}
	
	public function categoryDropdownBackend()
	{
		$listCategories = $this->getCategoryTree();
		
		$data = array();
		foreach ($listCategories as $item)
		{
			$tree = "";
			if ($item->level > 0) 
			{
				$tree = "";
				for ($i = 0 ; $i < $item->level; $i++ )
					$tree .= "---";
			}
			 
			$data [$item->id]= $tree . $item->category_name;
		}
		return $data;
	}

	
	
	

	public function nextOrderNumber()
	{
		return self::model()->count() + 1;
	}
}