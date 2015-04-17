<?php

/**
 * This is the model class for table "{{_menuitem}}".
 *
 * The followings are the available columns in table '{{_menuitem}}':
 * @property string $id
 * @property string $name
 * @property string $link
 * @property integer $order
 * @property integer $status
 * @property string $parent_id
 * @property string $menu_id
 * @property string $page_id
 * @property string $target
 * @property string $icon
 * @property string $created
 * @property string $modified


 */
class Menuitem extends _BaseModel {

    public $delete = false;
    public static $data = NULL;
    public $menuDataId = null;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Menuitem the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{_menuitem}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('order, status', 'numerical', 'integerOnly' => true),
            array('name, link', 'length', 'max' => 255),
            array('parent_id, menu_id, page_id', 'length', 'max' => 11),
            array('target', 'length', 'max' => 20),
            array('icon', 'length', 'max' => 50),
            array('modified, link, status, order, parent_id, menu_id, page_id, menuDataId, target', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, link, order, status, parent_id, menu_id, page_id, target, icon, created, modified, menuDataId', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'menu_fk' => array(self::BELONGS_TO, 'Menu', 'menu_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'link' => 'Link',
            'order' => 'Order',
            'status' => 'Status',
            'parent_id' => 'Parent',
            'menu_id' => 'Menu',
            'page_id' => 'Page',
            'target' => 'Target',
            'icon' => 'Icon',
            'created' => 'Created',
            'modified' => 'Modified',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
        $criteria = new CDbCriteria;
        $criteria->compare('t.id', $this->id, true);
        $criteria->compare('t.name', $this->name, true);
        $criteria->compare('t.link', $this->link, true);
        $criteria->compare('t.order', $this->order);
        $criteria->compare('t.status', $this->status);
        $criteria->compare('t.parent_id', $this->parent_id, true);
        $criteria->compare('t.menu_id', $this->menu_id, true);
        $criteria->compare('t.page_id', $this->page_id, true);
        $criteria->compare('t.target', $this->target, true);
        $criteria->compare('t.icon', $this->icon, true);
        $criteria->compare('t.created', $this->created, true);
        $criteria->compare('t.modified', $this->modified, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
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

    public function defaultScope() {
        return array(
                //'condition'=>'',
        );
    }

    protected function beforeSave() {
        if ($this->page_id != 0) {
            $page = Page::model()->findByPk((int) $this->page_id);
            if ($page)
                $this->link = Yii::app()->createAbsoluteUrl('cms/index', array('slug' => $page->slug));
        }
        return parent::beforeSave();
    }

    public static function findByMenu($menu) {
        $criteria = new CDbCriteria;
        $criteria->compare('t.menu_id', $menu);
        $criteria->order = 't.order ASC';
        return self::model()->findAll($criteria);
    }

    public static function findActiveByMenu($menu) {
        $criteria = new CDbCriteria;
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->compare('t.menu_id', $menu);
        $criteria->order = 't.order ASC';
        return self::model()->findAll($criteria);
    }

    public static function findByParent($parent) {
        return self::model()->findAll('parent_id = ' . $parent);
    }

    public static function getData() {
        if (self::$data == NULL) {
            self::$data = self::model()->findAll();
            return self::$data;
        }
        return self::$data;
    }

    public function getParentIdFromHierachy($hierachy, $models) {
        $parentDataId = self::getParentDataIdFromDataId($this->menuDataId, $hierachy);
        return self::getModelIdFromDataId($parentDataId, $models);
    }

    public static function getParentDataIdFromDataId($dataId, $hierachy, $parent = 0) {
        $return = array();
        foreach ($hierachy as $item) {
            if ($item['id'] == $dataId) {
                return $parent;
            } else if (!empty($item['children'])) {
                $return[] = self::getParentDataIdFromDataId($dataId, $item['children'], $item['id']);
            }
        }
        foreach ($return as $value)
            if (!empty($value))
                return $value;
    }

    public static function getModelIdFromDataId($dataId, $models) {
        foreach ($models as $model) {
            if ((string) $model->menuDataId == (string) $dataId)
                return $model->id;
        }
        return 0;
    }

    public function getChilds() {
        $res = Menuitem::model()->findAllByAttributes(array(
            'parent_id' => $this->id,
        ));

        return $res;
    }

    public static function findByPM($parent, $menu) {
        $criteria = new CDbCriteria;
        $criteria->compare('t.menu_id', $menu);
        $criteria->compare('t.parent_id', $parent);
        $criteria->order = 't.order ASC';
        return self::model()->findAll($criteria);
    }

    public static function showMenus($menu = MENU_MAIN, $parent = 0) {
        $criteria = new CDbCriteria;
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->compare('t.menu_id', $menu);
        $criteria->compare('t.parent_id', $parent);
        $criteria->order = 't.order ASC';
        return self::model()->findAll($criteria);
    }

    public static function buildMenuData($menu, $parent, $pageId) {
        $data = self::getData();
        $models = array();
        foreach ($data as $_data) {
            if ($_data->menu_id == $menu && $_data->parent_id == $parent && $_data->status == STATUS_ACTIVE) {
                $models[] = $_data;
            }
        }

        if (empty($models))
            return array();

        $data_menu_arr = array();
        foreach ($models as $model) {
            $data_menu_arr[] = array(
                'title' => $model->name,
                'link' => $model->link,
                'class' => $model->page_id == $pageId && $model->page_id != EXTERNAL_PAGE ? 'active' : '',
                'target' => $model->target,
                'child' => self::buildMenuData($menu, $model->id, $pageId),
            );
        }
        return $data_menu_arr;
    }

    public static function viewMenuStructure($menu, $parent, $level = 0, &$data_menu_arr) {
        $data = self::getData();

        $models = array();
        foreach ($data as $_data) {
            if ($_data->menu_id == $menu && $_data->parent_id == $parent && $_data->status == STATUS_ACTIVE) {
                $models[] = $_data;
            }
        }

        if (empty($models))
            return array();


        foreach ($models as $model) {
            $data_menu_arr[] = array(
                'title' => $model->name,
                'level' => $level
            );
            $level++;
            self::viewMenuStructure($menu, $model->id, $level, $data_menu_arr);
            $level--;
        }
        return $data_menu_arr;
    }

    //bb- 31/7/2014
    public static function checkActiveLink($link) {
        $uri = str_replace(Yii::app()->baseUrl, '', Yii::app()->request->requestUri);
        if ($uri == $link || $uri == '/' . $link) // short link to enable no need to change url when live site '/about-us' or 'login'
            echo 'class="active"';
        else {//full link with http://....
            $linkUri = strtr($link, array('http://' => '',
                'https://' => '',
                'https://www.' => '',
                $_SERVER['HTTP_HOST'] => '',
                    )
            );
            if (Yii::app()->request->requestUri == $linkUri)//   /BoH/about-us
                echo 'class="active"';
        }
    }

}
