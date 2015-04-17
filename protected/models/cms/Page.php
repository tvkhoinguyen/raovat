<?php

class Page extends _BasePost {

    public $uploadImageFolder = 'upload/cms'; //remember remove ending slash
    public $defineImageSize = array(
        'featured_image' => array(
            array('alias' => 'thumb1', 'size' => '204x94')
        ),
    );
    public $pageType = 'page';

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function rules() {
        $retRules = parent::rules();
        // $retRules[] = array('featured_image', 'required', 'on' => 'create,update');
        return $retRules;
    }

    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'parent' => array(self::BELONGS_TO, 'Page', 'parent_id', 'order' => 'display_order ASC,  title ASC'),
            'childs' => array(self::HAS_MANY, 'Page', 'parent_id', 'order' => 'display_order ASC,  title ASC'),
        );
    }

    public function defaultScope() {
        return array(
            'condition' => "post_type='" . $this->pageType . "'",
        );
    }

    public function getSlugById($id) {
        return Page::model()->findByPk((int) $id);
    }

    public static function searchPageBacked() {
        $dataProvider = new CArrayDataProvider(Page::model()->getPageTree(false, 0), array(
            'id' => 'page',
            'pagination' => array(
                'pageSize' => 50,
            ),
        ));
        return $dataProvider;
    }

    public function getPageTree($publishedOnly = false, $parent = 0, $limitLevel = 0, $notIncluded = 0) {
        $criteria = new CDbCriteria ();
        $criteria->select = 't.title,t.status,t.created_date,t.id,t.parent_id,t.display_order, t.*';
        $criteria->compare('parent_id', $parent);

        // avoid cicle relationship
        if ($notIncluded != 0)
            $criteria->addCondition('id <> ' . $notIncluded);

        if ($publishedOnly == true)
            $criteria->compare('status', 1);

        $criteria->order = " display_order ASC, title ASC";
        $items = array();
        $pages = Page::model()->findAll($criteria);
        $level = 0;
        foreach ($pages as $child) {
            //var_dump($child->attributes);
            self::getListed($child, $level, $items, $publishedOnly, $limitLevel, $notIncluded);
        }
        return $items;
    }

    public function getListed($child, $level, &$return, $publishedOnly, $limitLevel, $notIncluded = 0) {
        $child->level = $level;
        $return[] = $child;
        $childItem = $child->childs;
        if (count($childItem) > 0) {
            foreach ($childItem as $item) {
                if ($notIncluded != 0 && $notIncluded == $item->id)
                    continue;

                if ($publishedOnly == true) {
                    if ($item->status == 1) {
                        if ($limitLevel > 0 && $level >= $limitLevel) {
                            return;
                        }
                        $level++;
                        self::getListed($item, $level, $return, $publishedOnly, $limitLevel);
                        $level--;
                    }
                } else {
                    if ($limitLevel > 0 && $level >= $limitLevel) {
                        return;
                    }
                    $level++;
                    self::getListed($item, $level, $return, $publishedOnly, $limitLevel);
                    $level--;
                }
            }
        }
    }

    public function getBreakscrum($currentPageID, &$return = array(), $publishedOnly = true) {
        $criteria = new CDbCriteria ();
        $criteria->select = 'title, slug, id, parent_id';
        $criteria->compare('id', $currentPageID);
        if ($publishedOnly == true)
            $criteria->compare('status', 1);
        $curPage = Page::model()->find($criteria);

        $return[] = $curPage->attributes;
        if ($curPage) {
            if ($curPage->parentPage) {
                $this->getBreakscrum($curPage->parentPage->id, $return, $publishedOnly);
            } else
                return;
        }
    }

    public function getRoot($currentPageID, &$return, $publishedOnly = true) {
        $criteria = new CDbCriteria ();
        $criteria->compare('id', $currentPageID);
        if ($publishedOnly == true)
            $criteria->compare('status', 1);
        $curPage = Page::model()->find($criteria);

        if ($curPage) {
            $return = $curPage;
            if (count($curPage->parentPage) > 0 && $curPage->parent_id != 0) {
                $this->getRoot($curPage->parentPage->id, $return, $publishedOnly);
            } else {
                return;
            }
        }
    }

    public function buildLevelTreeCharacter($level) {
        $ret = '';
        for ($i = 0; $i < $level; $i++)
            $ret .= "—";
        return $ret . " ";
    }

    public function buildPagesDropdown($excluded = 0) {
        $listPages = $this->getPageTree(false, 0, 2, $excluded);
        //$listPages = array (1 => 'a', 2 => 'b');
        $data = array('' => '-- Root --');
        foreach ($listPages as $item) {
            $tree = "";
            if ($item->level > 0) {
                $tree = "";
                for ($i = 0; $i < $item->level; $i++)
                    $tree .= "—";
            }

            $data[$item->id] = $tree . $item->title;
        }
        return $data;
    }

    public function buildPageTreeData() {
        $listPages = $this->getPageTree(false, 0, 2, $excluded);
        //$listPages = array (1 => 'a', 2 => 'b');
        $data = array('' => '-- Root --');
        foreach ($listPages as $item) {
            $tree = "";
            if ($item->level > 0) {
                $tree = "";
                for ($i = 0; $i < $item->level; $i++)
                    $tree .= "—";
            }

            $data[$item->id] = $tree . $item->title;
        }
        return $data;
    }

    public function nextOrderNumber() {
        return Page::model()->count() + 1;
    }

}
