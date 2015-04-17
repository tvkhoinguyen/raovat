<?php

/**
 * This is the model class for table "{{_static_block}}".
 *
 * The followings are the available columns in table '{{_static_block}}':
 * @property integer $id
 * @property string $title
 * @property string $content
 */
class SmartBlock extends _BasePost {

    public $uploadImageFolder = 'upload/cms'; //remember remove ending slash
    public $defineImageSize = array();
    public $pageType = 'block';

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function defaultScope() {
        return array(
            'condition' => "post_type='block'",
        );
    }

    public function getSlugById($id) {
        return SmartBlock::model()->findByPk((int) $id);
    }

    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('content', $this->content, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function getBlockContent($blockId) {
        $field = is_numeric($blockId) ? 'id' : 'block_id';
        $b = self::model()->findByAttributes(array($field => $blockId));
        $content = $b ? $b->content : '';
        $content = str_replace('{{BASE_URL}}', Yii::app()->request->getBaseUrl(true), $content);
        return $content;
    }

    public function nextOrderNumber() {
        return SmartBlock::model()->count() + 1;
    }
    
    public static function getSmartBlock($id) {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);
        $criteria->compare('status', STATUS_ACTIVE);
        return SmartBlock::model()->find($criteria);
    }

}
