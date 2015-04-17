<?php

class ShowAdminMenu {

    /**
     * return menu ul li.
     */
    public $str = "";

    public function haschild($id, $arrobj) {
	foreach ($arrobj as $obj)
	    if ($obj->parent_id == $id)
		return 1;
	return 0;
    }

    public function findchild($id, $arrobj, $selected_id = '', $userRoleMenuId = array()) 
    {
		foreach ($arrobj as $obj) 
		{
		    $temp_id = $obj->id;
		    $temp_parent_id = $obj->parent_id;
		    if ($temp_parent_id == $id) 
		    {
				$name = $obj->menu_name;
				if ( !$this->haschild($temp_id, $arrobj) == 1 )
				    if (in_array($temp_id, $userRoleMenuId))
				    //$this->str.="<li><a href='".$obj->menu_link."'>$obj->menu_name</a>";
					$this->str.="<li><a href='" . Yii::app()->createAbsoluteUrl($obj->menu_link) . "'>$obj->menu_name</a></li><li class=\"divider\"></li>";

				if ($this->haschild($temp_id, $arrobj) == 1) {
				    if (in_array($temp_id, $userRoleMenuId)) {
					$this->str.="<li class=\"dropdown\"><a href='#' class=\"dropdown-toggle\" data-toggle=\"dropdown\">" . $obj->menu_name . " <b class=\"caret\"></b></a><ul class=\"dropdown-menu\">";
					$this->findchild($temp_id, $arrobj, $selected_id, $userRoleMenuId);
					$this->str.="</ul></li>";
				    }
				}
				//$this->str.="</li>";				
		    }
		}
    }

    public function showMenu() {

	if (Yii::app()->session['LOGGED_USER'] != null) {
	    $userObj = new Users();
	    $userObj = Yii::app()->session['LOGGED_USER'];
	    $value = '';

	    $userRoleId = $userObj->role_id;
            

            $appicationId = Roles::getAppicationIdByRoleId($userRoleId);
                        
             if($appicationId!=BE){                                                        
                    Yii::app()->user->logout();
                    Yii::app()->controller->redirect(Yii::app()->createAbsoluteUrl('admin/site/login'));
             }
            
	    $userRoleMenu = RolesMenus::model()->findAll(array('condition' => 'role_id=' . $userRoleId));
	    $userRoleMenuId = array();
	    if ($userRoleMenu)
		foreach ($userRoleMenu as $u)
		    $userRoleMenuId[] = $u->menu_id;

	    $menus = Menus::model()->findAll(array('condition' => 'show_in_menu="1"', 'order' => 'display_order asc'));
	    $this->str = "<ul class='nav'>";
	    //$this->str.="<li>".CHtml::link('Home', array('/admin'))."</li>";		
	    $this->str.="<li class='nav_li'><a href='" . Yii::app()->createAbsoluteUrl('/admin') . "'>Home</a></li>";
	    
	    if ($menus != NULL) 
	    {
			$this->findchild(0, $menus, $value, $userRoleMenuId);
	    }

	    if ($userRoleId == ROLE_MANAGER || $userRoleId == ROLE_ADMIN):
       		//$this->str.="<li><a href='".Yii::app()->createAbsoluteUrl('/')."' target='_blank'>Visit Site</a></li>";
	    endif;

	    $this->str.="</ul>";
	    if (Yii::app()->user->id) 
	    {
			if (isset(Yii::app()->user->application_id) && Yii::app()->user->application_id == BE)
			{
			    if($userRoleId == ROLE_MANAGER || $userRoleId == ROLE_ADMIN)
			    	return $this->str;
			    else if($userRoleId == ROLE_MOD)
			    {
			    	//return menu for Mod Role
			    	return "<ul class='nav'>
			    			<li class='nav_li'><a href='" . Yii::app()->createAbsoluteUrl('/admin') . "'>Home</a></li>
			    			<li><a href='".Yii::app()->createAbsoluteUrl('admin/modAccess/index')."'>Tin Rao Vặt</a></li><li class='divider'></li>
			    			</ul>";
			    }else{
			    	return '';
			    }
			}
			else
			    return '';
	    }else
			return '';
	}
	return '';
    }

}