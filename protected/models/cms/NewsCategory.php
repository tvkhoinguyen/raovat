<?php
class NewsCategory extends _BaseCategory 
{
	public $categoryType = 'news';
	
	public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
	
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
			return array(
		      'getparent' => array(self::BELONGS_TO, 'NewsCategory', 'parent_id'),
		      'childs' => array(self::HAS_MANY, 'NewsCategory', 'parent_id',  'order'=>'category_name ASC'),
		   );
	}
	
	public function defaultScope()
    {
        return array(
            'condition'=>"type='" . $this->categoryType . "'",
        );
    }
	
	public function getCategoryTree()
	{
		$criteria = new CDbCriteria ();
		$criteria->compare ('parent_id', 0);
		$criteria->compare ('status', 1);  
		$criteria->order = " category_name ASC";
		$items = array();
		$categories = self::model ()->findAll($criteria);
		$level = 0;
		foreach($categories as $child) {
		    //var_dump($child->attributes);
		    $this->getListed($child, $level, $items);
		}   
		return $items; 
    }

	
	public function getListed($child, $level, &$return) {
	    $child->level = $level;
	    $return[] = $child;
	    $childItem = $child->childs;
	    if(count($childItem) > 0) 
	    {
		    foreach($childItem as $item) {
		    	if ($item->status == 1)
		    	{
			    	$level++;
			        $this->getListed($item, $level, $return);
			        $level--;
		    	}
		    }
	    }   
	}
	
	
	
}