<?php

class ThoiSu extends _BaseModel 
{
    const SIZE1 = '353x258'; const SIZE1_WIDTH = '353'; const SIZE1_HEIGHT = '258';
    const SIZE2 = '156x110'; const SIZE2_WIDTH = '156'; const SIZE2_HEIGHT = '110';
    const SIZE3 = '146x96';  const SIZE3_WIDTH = '146'; const SIZE3_HEIGHT = '96';
    public $maxImageFileSize = 3145728; //3MB
    public $allowImageType = 'jpg,gif,png';
	public $uploadImageFolder = 'upload/thoisu'; //remember remove ending slash
    public $defineImageSize = array(
        'image' => array(
            array('alias' => '353x258', 'size' => '353x258'),
            array('alias' => '156x110', 'size' => '156x110'),
            array('alias' => '146x96', 'size' => '146x96'),
            )
    );
    public $tmp_category;
    public $tmp_sub_category;
	    
	public function tableName()
	{
		return '{{_tb_tin}}';
	}

	public function rules()
	{
		return array(
			array('category_parent_id, category_sub_id, user_id, order_display, status, view, is_home, is_default', 'numerical', 'integerOnly'=>true),
			array('title, image, slug', 'length', 'max'=>200),
			array('get_from', 'length', 'max'=>100),
			array('short_content', 'length', 'max'=>160),
			array('created_date, is_bai_hot', 'safe'),
			array('id, title, short_content, content, image, get_from, category_parent_id, category_sub_id, user_id, order_display, status, view, slug, is_home, is_default, created_date, updated_date', 'safe', 'on'=>'search'),
			array('is_bai_hot,tmp_sub_category,tmp_category,id, title, short_content, content, image, get_from, category_parent_id, category_sub_id, user_id, order_display, status, view, slug, is_home, is_default, created_date, updated_date', 'safe'),

			//
			//
			array('image', 'file', 'on' => 'create,update',
				'allowEmpty' => true,
				'types' => $this->allowImageType,
				'wrongType' => 'Only ' . $this->allowImageType . ' are allowed.',
				'maxSize' => $this->maxImageFileSize, // 3MB
				'tooLarge' => 'The file was larger than' . ($this->maxImageFileSize/1024)/1024 . 'MB. Please upload a smaller file.',
			),
			array('image, title, short_content, content, image, category_parent_id, order_display, status, created_date', 'required', 'on'=>'create'),
			array('is_marquee, is_hot, is_default,is_bai_hot', 'safe'),
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
			'title' => Yii::t('translation','Title'),
			'short_content' => Yii::t('translation','Short Content'),
			'content' => Yii::t('translation','Content'),
			'image' => Yii::t('translation','Image'),
			'get_from' => Yii::t('translation','Get From'),
			'category_parent_id' => Yii::t('translation','Category Parent'),
			'category_sub_id' => Yii::t('translation','Category Sub'),
			'user_id' => Yii::t('translation','User'),
			'order_display' => Yii::t('translation','Order Display'),
			'status' => Yii::t('translation','Status'),
			'view' => Yii::t('translation','View'),
			'slug' => Yii::t('translation','Slug'),
			
			
			'created_date' => Yii::t('translation','Created Date'),
			'updated_date' => Yii::t('translation','Last Update'),
			'tmp_category'=>'Parent Category',
			'tmp_sub_category'=>'Sub Category',

			'is_marquee'=>'Slide Chạy Mỗi Chuyên Mục',
			'is_hot'=>'Nổi Bật Mỗi Chuyên Mục',
			'is_home' => Yii::t('translation','Nằm Home Mỗi Chuyên Mục'),
			'is_default' => Yii::t('translation','Nằm Ở Trang Chủ'),
			'is_bai_hot' => Yii::t('translation','Bài Hot Nằm Ở Trang Chủ'),
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('short_content',$this->short_content,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('get_from',$this->get_from,true);
		// $criteria->compare('category_parent_id',$this->category_parent_id);
		// $criteria->compare('category_sub_id',$this->category_sub_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('order_display',$this->order_display);
		$criteria->compare('status',$this->status);
		$criteria->compare('view',$this->view);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('is_home',$this->is_home);
		$criteria->compare('is_default',$this->is_default);
		$criteria->compare('is_bai_hot',$this->is_bai_hot);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		if(!isset($_GET['ajax']))
		{
			$criteria->order = 'created_date DESC, id DESC';
		}

		if(!empty($this->tmp_category))
		{
			$criteria->compare('category_parent_id',$this->tmp_category);
		}

		if(!empty($this->tmp_sub_category))
		{
			$criteria->compare('category_sub_id',$this->tmp_sub_category);
		}

		// if(!empty($this->tmp_category))
		// {
		// 	$arr[] = $this->tmp_category;
		// 	$criteria1=new CDbCriteria;
		// 	$criteria1->compare('t.status',STATUS_ACTIVE);
		// 	$criteria1->compare('t.parent_id', $this->tmp_category);
		// 	$criteria1->order ="name ASC";
		// 	$models = CategoryTin::model()->findAll($criteria1);
		// 	if(!empty($models))
		// 	{
		// 		foreach ($models as $one) 
		// 		{
		// 			if(!empty($one)) $arr[] = $one->id;
		// 		}
		// 	}
		// 	$criteria->addInCondition('category_sub_id', $arr);
		// }
					
		 
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
	public function behaviors() {
        return array('sluggable' => array(
                'class' => 'application.extensions.mintao-yii-behavior-sluggable.SluggableBehavior',
                'columns' => array('title'),
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
	

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function nextOrderNumber()
	{
		return self::model()->count() + 1;
	}

	public function getCategoryNameDetail()
	{
		$html ='';
		if(!empty($this->category_sub_id) && !empty($this->category_parent_id) )
		{
			$sub = CategoryTin::model()->findByPk($this->category_sub_id);
			$parent = CategoryTin::model()->findByPk($this->category_parent_id);
			if(!empty($sub) && !empty($parent))
			{
				return $parent->name;
				$html.='<a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('p_slug'=>$parent->slug, 'c_slug'=>'' )).'">'.$parent->name.'</a>';
				$html.='<span class="glyphicon glyphicon-fast-forward"> > </span>';
				$html.='<a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('p_slug'=>$parent->slug, 'c_slug'=>$sub->slug )).'">'.$sub->name.'</a>';
				// <span class="main-cat-title">Tin tức</span>
			}
		}else if(!empty($this->category_parent_id))
		{
			// $sub = CategoryTin::model()->findByPk($this->category_sub_id);
			$parent = CategoryTin::model()->findByPk($this->category_parent_id);
			if( !empty($parent) )
			{
				return $parent->name;
				$html.='<a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('p_slug'=>$parent->slug, 'c_slug'=>'' )).'">'.$parent->name.'</a>';
				// $html.='<span class="glyphicon glyphicon-fast-forward"></span>';
				// $html.='<a href="">'.$sub->name.'</a>';
				// <span class="main-cat-title">Tin tức</span>
			}
		}
		// return $html;
		return '';
	}
	public function getCategoryName()
	{
		$html ='';
		if(!empty($this->category_sub_id) && !empty($this->category_parent_id) )
		{
			$sub = CategoryTin::model()->findByPk($this->category_sub_id);
			$parent = CategoryTin::model()->findByPk($this->category_parent_id);
			if(!empty($sub) && !empty($parent))
			{
				$html.='<span class="main-cat-title">';
				$html.='<a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('p_slug'=>$parent->slug, 'c_slug'=>'' )).'">'.$parent->name.'</a>';
				$html.='<span class="glyphicon glyphicon-fast-forward"> > </span>';
				$html.='<a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('p_slug'=>$parent->slug, 'c_slug'=>$sub->slug )).'">'.$sub->name.'</a>';
				$html.='</span>';
				// <span class="main-cat-title">Tin tức</span>
			}
		}else if(!empty($this->category_parent_id))
		{
			// $sub = CategoryTin::model()->findByPk($this->category_sub_id);
			$parent = CategoryTin::model()->findByPk($this->category_parent_id);
			if( !empty($parent) )
			{
				$html.='<span class="main-cat-title">';
				$html.='<a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('p_slug'=>$parent->slug, 'c_slug'=>'' )).'">'.$parent->name.'</a>';
				// $html.='<span class="glyphicon glyphicon-fast-forward"></span>';
				// $html.='<a href="">'.$sub->name.'</a>';
				$html.='</span>';
				// <span class="main-cat-title">Tin tức</span>
			}
		}
		return $html;
	}

	public static function getHomeMarquee($id)
	{
		$criteria = new CDbCriteria();
		$criteria->compare('t.status',STATUS_ACTIVE);
		$criteria->compare('t.category_parent_id', $id);
		$criteria->compare('t.is_marquee',STATUS_ACTIVE);

		$criteria->limit = 5;
		$criteria->order ="order_display DESC, id DESC";
		return ThoiSu::model()->findAll($criteria);
	}

	public static function getHomeMarqueeBox($id, $number=9)
	{
		$criteria = new CDbCriteria();
		$criteria->compare('t.status',STATUS_ACTIVE);
		$criteria->compare('t.category_parent_id', $id);
		// $criteria->compare('t.is_marquee',STATUS_ACTIVE);
		$criteria->compare('t.is_marquee',STATUS_ACTIVE);
		// $criteria->compare('t.is_default', STATUS_ACTIVE);
		$criteria->addCondition('t.is_hot=1 OR t.is_home=1');

		$criteria->limit = $number;
		$criteria->order ="order_display DESC, id DESC";
		return ThoiSu::model()->findAll($criteria);
	}

	public static function getMoiCapNhap()
	{
		$criteria = new CDbCriteria();
		$criteria->compare('t.status',STATUS_ACTIVE);
		// $criteria->compare('t.category_parent_id', $id);
		// $criteria->compare('t.is_marquee',STATUS_ACTIVE);
		// $criteria->compare('t.is_hot',STATUS_ACTIVE);
		$criteria->addCondition('t.is_hot=1 OR t.is_home=1');
		$criteria->limit = 8;
		$criteria->order ="created_date DESC, id DESC";
		return ThoiSu::model()->findAll($criteria);
	}

	public static function getOneHomeDefaultHot()
	{
		$criteria = new CDbCriteria();
		$criteria->compare('t.status',STATUS_ACTIVE);
		// $criteria->compare('t.category_parent_id', $id);
		// $criteria->compare('t.is_marquee',STATUS_ACTIVE);
		// $criteria->compare('t.is_home',STATUS_ACTIVE);
		// $criteria->compare('t.is_default',STATUS_ACTIVE);
		$criteria->compare('t.is_bai_hot',STATUS_ACTIVE);

		$criteria->order ="order_display DESC, created_date DESC, id DESC";
		$models = ThoiSu::model()->findAll($criteria);
		if(!empty($models) )
		{
			if(!empty($models[0])) return $models[0];
			else return NULL;
		}else return NULL;
	} 

	public static function getLimitTin($limit, $id)
	{
		$criteria = new CDbCriteria();
		$criteria->compare('t.status',STATUS_ACTIVE);
		$criteria->compare('t.category_parent_id', $id);
		// $criteria->compare('t.is_marquee',STATUS_ACTIVE);
		$criteria->compare('t.is_home',STATUS_ACTIVE);
		// $criteria->compare('t.is_default',STATUS_ACTIVE);
		// $criteria->compare('t.is_hot',STATUS_ACTIVE);
		$criteria->limit = $limit;
		$criteria->order ="order_display DESC, id DESC";
		return ThoiSu::model()->findAll($criteria);
	}

	public static function getLimitHotTin($limit, $id, $arr_not_in = array())
	{
		$criteria = new CDbCriteria();
		$criteria->compare('t.status',STATUS_ACTIVE);
		$criteria->compare('t.category_parent_id', $id);
		// $criteria->compare('t.is_marquee',STATUS_ACTIVE);
		// $criteria->compare('t.is_home',STATUS_ACTIVE);
		// $criteria->compare('t.is_default',STATUS_ACTIVE);
		$criteria->compare('t.is_hot',STATUS_ACTIVE);
		if(!empty($arr_not_in))
		{
			$str_arr = implode(',', $arr_not_in);
			// echo '<pre>';
			// print_r($str_arr);
			// echo '</pre>';
			// die;
			$criteria->addCondition( 't.id not in ('.$str_arr.' )' );
		}

		$criteria->limit = $limit;
		$criteria->order ="order_display DESC, id DESC";
		return ThoiSu::model()->findAll($criteria);
	}









	//Detail tin
	public static function tinLienQuan($model, $limit)
	{
		$criteria = new CDbCriteria();
		$criteria->compare('t.status',STATUS_ACTIVE);
		$criteria->compare('t.category_parent_id',$model->category_parent_id);
		$criteria->limit = $limit;
		$criteria->order ="order_display DESC, created_date DESC";
		return ThoiSu::model()->findAll($criteria);
	}

	public static function tinCuHon($model, $limit)
	{
		$criteria = new CDbCriteria();
		$criteria->compare('t.status',STATUS_ACTIVE);
		// $criteria->compare('t.category_parent_id',$model->category_parent_id);
		$criteria->limit = $limit;
		$criteria->order ="created_date DESC";
		return ThoiSu::model()->findAll($criteria);
	}

	public static function tinNoiBat($model, $limit)
	{
		$criteria = new CDbCriteria();
		$criteria->compare('t.status',STATUS_ACTIVE);
		$criteria->compare('t.is_hot',STATUS_ACTIVE);
		// $criteria->compare('t.category_parent_id',$model->category_parent_id);
		$criteria->limit = $limit;
		$criteria->order ="created_date DESC";
		return ThoiSu::model()->findAll($criteria);
	}

	public static function tinTieuDiemTuanQua($model, $limit)
	{
		$criteria = new CDbCriteria();
		$criteria->compare('t.status',STATUS_ACTIVE);
		// $criteria->compare('t.category_parent_id',$model->category_parent_id);
		$criteria->limit = $limit;
		$criteria->order ="order_display DESC, view DESC, created_date DESC";
		return ThoiSu::model()->findAll($criteria);
	}

	//List Tin
	public static function listtinTieuDiemTuanQua( $limit)
	{
		$criteria = new CDbCriteria();
		$criteria->compare('t.status',STATUS_ACTIVE);
		// $criteria->compare('t.category_parent_id',$model->category_parent_id);
		$criteria->limit = $limit;
		$criteria->order ="view DESC, order_display DESC, created_date DESC";
		return ThoiSu::model()->findAll($criteria);
	}


	public static function listtinNoiBat( $limit)
	{
		$criteria = new CDbCriteria();
		$criteria->compare('t.status',STATUS_ACTIVE);
		$criteria->compare('t.is_hot',STATUS_ACTIVE);
		// $criteria->compare('t.category_parent_id',$model->category_parent_id);
		$criteria->limit = $limit;
		$criteria->order ="order_display DESC, created_date DESC";
		return ThoiSu::model()->findAll($criteria);
	}
	public static function listtinLienQuan($parent, $limit)
	{
		$criteria = new CDbCriteria();
		$criteria->compare('t.status',STATUS_ACTIVE);
		$criteria->compare('t.category_parent_id',$parent->id);
		$criteria->limit = $limit;
		$criteria->order ="order_display DESC, created_date DESC";
		return ThoiSu::model()->findAll($criteria);
	}

	

	
}
