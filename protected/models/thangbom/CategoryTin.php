<?php

class CategoryTin extends _BaseModel 
{
	public function tableName()
	{
		return '{{_tb_category_tin}}';
	}

	public function rules()
	{
		return array(
			// array('name, status, slug, created_date, updated_date, order_display', 'required'),
			array('name, status, slug, created_date, updated_date, order_display', 'required', 'on'=>'xxx'),
			array('status, order_display, parent_id', 'numerical', 'integerOnly'=>true),
			array('name, slug', 'length', 'max'=>100),
			array('id, name, status, slug, created_date, updated_date, order_display, parent_id', 'safe', 'on'=>'search'),
			array('name, status, created_date, order_display', 'required', 'on'=>'createParent, updateParent'),
			array('name, status, created_date, order_display', 'required', 'on'=>'createSub, updateSub'),
		);
	}

	public function relations()
	{
		return array();
	}

	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('translation','ID'),
			'name' => Yii::t('translation','Name'),
			'status' => Yii::t('translation','Status'),
			'slug' => Yii::t('translation','Slug'),
			'created_date' => Yii::t('translation','Created Date'),
			'updated_date' => Yii::t('translation','Updated Date'),
			'order_display' => Yii::t('translation','Order Display'),
			'parent_id' => Yii::t('translation','Parent Category'),
		);
	}

	
	public function search($p_id)
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('order_display',$this->order_display);
		$criteria->compare('parent_id', $p_id);
					
		 
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                'pageSize'=> Yii::app()->params['defaultPageSize'],
            ),
		));
	}

	public function searchParent()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('order_display',$this->order_display);
		$criteria->compare('parent_id', 0);
					
		 
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                'pageSize'=> Yii::app()->params['defaultPageSize'],
            ),
		));
	}

	
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

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function nextOrderNumber()
	{
		return self::model()->count() + 1;
	}
	public function behaviors() {
        return array('sluggable' => array(
                'class' => 'application.extensions.mintao-yii-behavior-sluggable.SluggableBehavior',
                'columns' => array('name'),
                'unique' => true,
                'update' => true,
            ),);
    }
	
	public function getDetailBySlug($slug)
	{
		$criteria = new CDbCriteria;
        $criteria->compare('t.slug', $slug);
        $criteria->compare('t.status', STATUS_ACTIVE);
        return self::model()->find($criteria);
	}


	public static function getListData($all = "")
	{
		$criteria = new CDbCriteria();
		$criteria->compare('t.status',1);
		$criteria->addCondition('status = '.STATUS_ACTIVE);

		if(!empty($all) && $all=="all")
		{
		}
		else if(!empty($all) && $all=="submenu")
		{
			$criteria->addCondition( 't.parent_id <> 0' );
		}else
		{
			$criteria->compare('t.parent_id', 0);
		}
		
		$criteria->order ="order_display DESC, id DESC";
		$models = self::model()->findAll($criteria);
		return CHtml::listData($models, 'id', 'name');
	}


	public static function getSubListData($id_parent)
	{
		$criteria = new CDbCriteria();
		// $criteria->compare('t.status',STATUS_ACTIVE);
		$criteria->addCondition('status = '.STATUS_ACTIVE);
		$criteria->compare('t.parent_id', $id_parent);
		$criteria->order ="order_display DESC, id DESC";
		$models = self::model()->findAll($criteria);
		return CHtml::listData($models, 'id', 'name');
	}
}
