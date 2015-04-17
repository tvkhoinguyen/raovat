<?php
class ShowMenu
{
    /**
     * return menu ul li.
     */
	public $str="";	
	public function haschild($id,$arrobj)
	{
		foreach($arrobj as $obj)
			if($obj->parent_id == $id) return 1;			
		return 0;
	}
	public function findchild($id,$arrobj,$selected_id='',$userRoleMenuId=array())
	{
		foreach($arrobj as $obj)
		{
			$temp_id 		= $obj->id;
			$temp_parent_id = $obj->parent_id;
			if($temp_parent_id==$id)
			{
                                $name       = $obj->name;
                                //show menus not a parent
                                if(!$this->haschild($temp_id,$arrobj)==1)
                                {
                                    if($obj->type == 'page')
                                    {
                                        if($obj->required_login == 1)
                                        {
                                            if(!empty(Yii::app()->user->id))
                                                $this->str.="<li><a href='".Yii::app()->createAbsoluteUrl("/page/" . $obj->page->slug)."'>$obj->name</a></li>";
                                            else
                                                $this->str.="<li><a href='".Yii::app()->createAbsoluteUrl("site/login", array('returnUrl'=>"/page/" . $obj->page->slug))."'>$obj->name</a></li>";
                                        }
                                        else
                                            $this->str.="<li><a href='".Yii::app()->createAbsoluteUrl("/page/" . $obj->page->slug)."'>$obj->name</a></li>";
                                    }
                                    elseif($obj->type == 'url')
                                    {
                                        if($obj->required_login == 1)
                                        {
                                            if(!empty(Yii::app()->user->id))
                                                $this->str.="<li><a href='".Yii::app()->createAbsoluteUrl($obj->link)."'>$obj->name</a></li>";
                                            else
                                                $this->str.="<li><a href='".Yii::app()->createAbsoluteUrl("site/login", array('returnUrl'=>$obj->link))."'>$obj->name</a></li>";
                                        }
                                        else
                                            $this->str.="<li><a href='".Yii::app()->createAbsoluteUrl($obj->link)."'>$obj->name</a></li>";
                                    }
                                }
                                
                                //show menus is a parent                                             
                                if($this->haschild($temp_id,$arrobj)==1)
                                {
                                    if($obj->type == 'page')
                                    {
                                        if($obj->required_login == 1)
                                        {
                                            if(!empty(Yii::app()->user->id))
                                                $this->str.="<li><a href='".Yii::app()->createAbsoluteUrl("/page/" . $obj->page->slug)."'>$obj->name</a><ul>";
                                            else
                                                $this->str.="<li><a href='".Yii::app()->createAbsoluteUrl("site/login", array('returnUrl'=>"/page/" . $obj->page->slug))."'>$obj->name</a><ul>";
                                        }
                                        else
                                            $this->str.="<li><a href='".Yii::app()->createAbsoluteUrl("/page/" . $obj->page->slug)."'>$obj->name</a><ul>";                                        
                                    }
                                    elseif($obj->type == 'url')
                                    {
                                        if($obj->required_login == 1)
                                        {
                                            if(!empty(Yii::app()->user->id))
                                                $this->str.="<li><a href='".Yii::app()->createAbsoluteUrl($obj->link)."'>$obj->name</a><ul>";
                                            else
                                                $this->str.="<li><a href='".Yii::app()->createAbsoluteUrl("site/login", array('returnUrl'=>$obj->link))."'>$obj->name</a><ul>";
                                        }
                                        else
                                            $this->str.="<li><a href='".Yii::app()->createAbsoluteUrl($obj->link)."'>$obj->name</a><ul>";
                                    }
                                    $this->findchild($temp_id,$arrobj,$selected_id,$userRoleMenuId);
                                    $this->str.="</ul></li>";
                                }			
			}
		}
	}
	public function showMenu($place_holder_id = 0)
	{
        $value = '';
        $menus = FeMenus::model()->findAll(array(
            'condition'=>'status="1" AND place_holder_id=:place_holder_id',
            'params'=>array(':place_holder_id'=>$place_holder_id),
            'order'=>'`order` asc',
        ));
        $this->str="<ul id='navmenu'>";
        $this->str.="<li><a href='".Yii::app()->createAbsoluteUrl('/')."'>Home</a></li>";
        if($menus!= NULL)
        {
            $this->findchild(0,$menus,$value);
        }
        $this->str.="</ul>";
        return $this->str;
	}	        
}