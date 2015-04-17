<?php

class ShowMenuFE {

    /** XUAN TINH custom gen menu FE date 20/11/2014
     *  return menu ul li.
     */
    public $str = "";
    public $strLeft = "";
    public $strFooterLeft ="";

    public function getCurrentUrlWithoutParam() {
        $uriWithoutParam = $_SERVER['REQUEST_URI'];
        if (strpos($uriWithoutParam, '?') != false)
            $uriWithoutParam = substr($uriWithoutParam, 0, strpos($uriWithoutParam, '?'));
        $res= 'http://' . $_SERVER['SERVER_NAME'] . $uriWithoutParam;
        if(substr($res,-1)=='/')
            return substr($res, 0, strlen($res)-1);
        else
            return $res;
    }
    
    public function findChild($parent, $level, $menuId) {
        $criteria=new CDbCriteria;
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->compare('t.menu_id', $menuId);
        $criteria->compare('t.parent_id', $parent);
        $criteria->order = 't.order ASC';
        $result = Menuitem::model()->findAll($criteria);
        if (count($result) > 0) {
            if ($parent == 0) {
                // $this->str .= "<ul id='menu' class='clearfix'>";
                $this->str .= "<ul>";
            } else {
                $this->str .= "<ul>";
            }
            foreach ($result as $item) {
                $id = $item->id;
                $name = $item->name;
                $link = $item->link;
                $clasActive = "";
                $linkCheck = $this->getCurrentUrlWithoutParam();

                $checkLinkActive = $this->checkIsLinkChild($id, $linkCheck, $menuId);
                if ($checkLinkActive) {
                    $clasActive = "class='active'";
                }
                // $this->str .= "<li " . $clasActive . "><a href='" . $link . "'>" . $name . "</a>";
                $this->str .= "<li><a ".$clasActive." href='" . $link . "'>" . $name . "</a>";
                // $this->findChild($id, $level + 1, $menuId);
                $this->str .= "</li>";
            }
            $this->str .= "</ul>";
        } 
    }
    
    public function checkIsLinkChild($id, $link, $menuId) {
        $c = new CDbCriteria;
        $c->condition = "(t.id = " . $id . " OR t.parent_id = " . $id . ") ";
        $c->compare('t.link', $link);
        $c->compare('t.menu_id', $menuId);
        $c->compare('t.status', STATUS_ACTIVE);
        $c->order = 't.order ASC';
        $model = Menuitem::model()->find($c);
        if ($model) {
            return true;
        } 
        return false;
    }

    public function findChildLeftMenu($parent, $level, $menuId) {
        $criteria = new CDbCriteria;
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->compare('t.menu_id', $menuId);
        $criteria->compare('t.parent_id', $parent);
        $criteria->order = 't.order ASC';
        $result = Menuitem::model()->findAll($criteria);
        if (count($result) > 0) {
            if ($parent == 0) {
                $this->strLeft .= "<ul class='nav-list'>";
            } else {
                $this->strLeft .= "<ul>";
            }
            foreach ($result as $item) {
                $id = $item->id;
                $name = $item->name;
                $link = $item->link;
                $clasActive = "";
                if ($this->getCurrentUrlWithoutParam() == $link) {
                    $clasActive = "class='active'";
                }
                $this->strLeft .= "<li " . $clasActive . "><a href='" . $link . "'>" . $name . "</a>";
                $this->findChildLeftMenu($id, $level + 1, $menuId);
                $this->strLeft .= "</li>";
            }
            $this->strLeft .= "</ul>";
        }
    }

    public function showMainLeftMenuFE() {
        $this->showMenu(0, 1, MENU_LEFT);
        return $this->strLeft;
    }

    public function showMainMenuFE() {
        $this->findChild(0, 1, MENU_MAIN);
        return $this->str;
    }









    //KNguyen
    // showFooterLeftMenuFE menu footer left (column 1)
    public function showFooterLeftMenuFE() 
    {
        // $this->findChild_FooterLeft(0, 1, MENU_LEFT);
        $parent = 0;
        $level = 1;
        $menuId = MENU_LEFT; //1
        $criteria=new CDbCriteria;
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->compare('t.menu_id', $menuId);
        $criteria->compare('t.parent_id', $parent);
        $criteria->order = 't.order ASC';
        $result = Menuitem::model()->findAll($criteria);
        // <li><a href="index.html" class="active">Home</a></li>
        // <li><a href="#">About Us </a></li>
        if (count($result) > 0) 
        {
            if ($parent == 0) {
                $this->strFooterLeft .= '<ul class="menufooter">';
            } else {
                $this->strFooterLeft .= "<ul>";
            }

            foreach ($result as $item) 
            {
                $id = $item->id;
                $name = $item->name;
                $link = $item->link;
                $clasActive = "";
                $linkCheck = $this->getCurrentUrlWithoutParam();
                $checkLinkActive = $this->checkIsLinkChild($id, $linkCheck, $menuId);
                if ($checkLinkActive) 
                {
                    $clasActive = "class='active'";
                }
                $this->strFooterLeft .= "<li><a ".$clasActive." href='" . $link . "'>" . $name . "</a>";
                // $this->findChild($id, $level + 1, $menuId);
                $this->strFooterLeft .= "</li>";
            }
            $this->strFooterLeft .= "</ul>";
        }
        return $this->strFooterLeft;
    }


    //KNguyen
    // showFooterLeftMenuFE menu footer left (column 1)
    public function showFooterRightMenuFE() 
    {
        // $this->findChild_FooterLeft(0, 1, MENU_LEFT);
        $parent = 0;
        $level = 1;
        $menuId = MENU_RIGHT; //2
        $strFooterRight='';

        $criteria=new CDbCriteria;
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->compare('t.menu_id', $menuId);
        $criteria->compare('t.parent_id', $parent);
        $criteria->order = 't.order ASC';
        $result = Menuitem::model()->findAll($criteria);
        // <li><a href="index.html" class="active">Home</a></li>
        // <li><a href="#">About Us </a></li>
        if (count($result) > 0) 
        {
            if ($parent == 0) {
                $strFooterRight .= '<ul class="menufooter">';
            } else {
                $strFooterRight .= "<ul>";
            }

            foreach ($result as $item) 
            {
                $id = $item->id;
                $name = $item->name;
                $link = $item->link;
                // $clasActive = "";
                // $linkCheck = $this->getCurrentUrlWithoutParam();
                // $checkLinkActive = $this->checkIsLinkChild($id, $linkCheck, $menuId);
                // if ($checkLinkActive) 
                // {
                //     $clasActive = "class='active'";
                // }
                // $strFooterRight .= "<li><a ".$clasActive." href='" . $link . "'>" . $name . "</a>";
                $strFooterRight .= "<li><a href='" . $link . "'>" . $name . "</a>";
                // $this->findChild($id, $level + 1, $menuId);
                $strFooterRight .= "</li>";
            }
            $strFooterRight .= "</ul>";
        }
        return $strFooterRight;
    }
}
