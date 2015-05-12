<?php
class TinRaoVat extends _BaseModel 
{
	public $verifyCode;
	public $s_state_id;
	public $s_job_id;
	public static $loai_tin = array(
		TIN_3_NGAY =>'Tin 3 ngày',
		TIN_7_NGAY =>'Tin 7 ngày',
		TIN_14_NGAY =>'Tin 14 ngày',
		TIN_1_THANG =>'Tin 1 tháng',
		TIN_2_THANG =>'Tin 2 tháng',
		TIN_3_THANG =>'Tin 3 tháng',
		// TIN_4_THANG =>'Tin 4 tháng',
		// TIN_5_THANG =>'Tin 5 tháng',
		TIN_6_THANG =>'Tin 6 tháng',
		TIN_1_NAM =>'Tin 1 năm',
		);
	public $maxImageFileSize = 3145728; //3MB
	public $allowImageType = 'jpg,gif,png';
	public $uploadImageFolder = 'upload/tin_rao_vat'; //remember remove ending slash
	public $defineImageSize = array(
			'image1' => array(
				array('alias' => RAOVAT_SIZE, 'size' => RAOVAT_SIZE),
				// array('alias' => 'SIZE_IN_LOCAL_CONFIG', 'size' => 'SIZE_IN_LOCAL_CONFIG'),
			), 
			'image2' => array(
				// array('alias' => '100x100', 'size' => '100x100'),
				array('alias' => RAOVAT_SIZE, 'size' => RAOVAT_SIZE),
				// array('alias' => 'SIZE_IN_LOCAL_CONFIG', 'size' => 'SIZE_IN_LOCAL_CONFIG'),
			), 
	);	

	public function tableName()
	{
		return '{{_tin_rao_vat}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			// array('title, short_content, content, status, image1, image2, order_display, is_hot, is_new, phone, mobile, state_id, city, created_date, updated_date, slug, job_id, updated_date_status, view, loai_tin, post_user_id, edit_user_id, post_user_name, edit_user_name', 'required'),
			// array('title, short_content, content, status, image1, image2, order_display, is_hot, is_new, phone, mobile, state_id, city, created_date, updated_date, slug, job_id, updated_date_status, view, loai_tin, post_user_id, edit_user_id, post_user_name, edit_user_name', 'required', 'on'=>'dang_tin'),
			array('email, address, title, content, status, order_display, phone, state_id, job_id, created_date, updated_date, view, loai_tin, post_user_name', 'required', 'on'=>'dang_tin'),

			//create BE
			array('post_user_name,post_user_id, title, short_content, content, status, order_display, phone, state_id, job_id, created_date, updated_date, view, loai_tin', 'required', 'on'=>'create_be'),


			array('status, order_display, is_hot, is_new, state_id, job_id, view, loai_tin, post_user_id, edit_user_id', 'numerical', 'integerOnly'=>true),
			array('title, image1, image2, city', 'length', 'max'=>200),
			array('phone, mobile, post_user_name, edit_user_name', 'length', 'max'=>200),
			array('slug', 'length', 'max'=>300),
			array('email', 'email', 'message' => 'Please enter a valid email.'),
			array('id, title, short_content, content, status, image1, image2, order_display, is_hot, is_new, phone, mobile, state_id, city, created_date, updated_date, slug, job_id, updated_date_status, view, loai_tin, post_user_id, edit_user_id, post_user_name, edit_user_name', 'safe', 'on'=>'search'),
			array('address,email,id, title, short_content, content, status, image1, image2, order_display, is_hot, is_new, phone, mobile, state_id, city, created_date, updated_date, slug, job_id, updated_date_status, view, loai_tin, post_user_id, edit_user_id, post_user_name, edit_user_name', 'safe'),


			array('verifyCode','captcha','allowEmpty'=>!CCaptcha::checkRequirements(), 'on'=>'dang_tin' ),
			array('image1,image2', 'file', 'on' => 'create,update',
				'allowEmpty' => true,
				'types' => $this->allowImageType,
				'wrongType' => 'Only ' . $this->allowImageType . ' are allowed.',
				'maxSize' => $this->maxImageFileSize, // 3MB
				'tooLarge' => 'The file was larger than' . ($this->maxImageFileSize/1024)/1024 . 'MB. Please upload a smaller file.',
			),
			array('image1', 'file', 'on' => 'create',
				'allowEmpty' => true,
				'types' => $this->allowImageType,
				'wrongType' => 'Only ' . $this->allowImageType . ' are allowed.',
				'maxSize' => $this->maxImageFileSize, // 3MB
				'tooLarge' => 'The file was larger than' . ($this->maxImageFileSize/1024)/1024 . 'MB. Please upload a smaller file.',
			),
		);
	}

	public function relations()
	{
		return array(
			// 'rTemplateId' => array(self::BELONGS_TO, 'QuotationPlusTemplate', 'template_id'),
            // 'rLevel2' => array(self::HAS_MANY, 'QuotationPlusTemplateLevel2', 'level_1_id'),
            'rState' => array(self::BELONGS_TO, 'State', 'state_id'),
            'rJob' => array(self::BELONGS_TO, 'Job', 'job_id'),
																						);
	}

	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('translation','ID'),
			'title' => Yii::t('translation','Title - Tiêu đề'),
			'short_content' => Yii::t('translation','Short Content'),
			'content' => Yii::t('translation','Content - Nội dung'),
			'status' => Yii::t('translation','Status'),
			'image1' => Yii::t('translation','Image1'),
			'image2' => Yii::t('translation','Image2'),
			'order_display' => Yii::t('translation','Order Display'),
			'is_hot' => Yii::t('translation','Is Hot'),
			'is_new' => Yii::t('translation','Is New'),
			'phone' => Yii::t('translation','Phone'),
			'mobile' => Yii::t('translation','Mobile'),
			'state_id' => Yii::t('translation','State - Tiểu bang'),
			'city' => Yii::t('translation','City - Thành phố'),
			'created_date' => Yii::t('translation','Created Date'),
			'updated_date' => Yii::t('translation','Updated Date'),
			'slug' => Yii::t('translation','Slug'),
			'job_id' => Yii::t('translation','Job - Chuyên mục'),
			'updated_date_status' => Yii::t('translation','Updated Date Status'),
			'view' => Yii::t('translation','View'),
			'loai_tin' => Yii::t('translation','Type - Loại Tin'),
			'post_user_id' => Yii::t('translation','Post User'),
			'edit_user_id' => Yii::t('translation','Edit User'),
			'post_user_name' => Yii::t('translation','Name - Người đăng'),
			'edit_user_name' => Yii::t('translation','Edit By'),
			'address' => Yii::t('translation','Address - Địa chỉ'),
			'verifyCode' => Yii::t('translation','Captcha'),
			'email' => Yii::t('translation','Email'),
		);
	}

	
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('short_content',$this->short_content,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('image1',$this->image1,true);
		$criteria->compare('image2',$this->image2,true);
		$criteria->compare('order_display',$this->order_display);
		$criteria->compare('is_hot',$this->is_hot);
		$criteria->compare('is_new',$this->is_new);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('state_id',$this->state_id);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('job_id',$this->job_id);
		$criteria->compare('updated_date_status',$this->updated_date_status,true);
		$criteria->compare('view',$this->view);
		$criteria->compare('loai_tin',$this->loai_tin);
		$criteria->compare('post_user_id',$this->post_user_id);
		$criteria->compare('edit_user_id',$this->edit_user_id);
		$criteria->compare('post_user_name',$this->post_user_name,true);
		$criteria->compare('edit_user_name',$this->edit_user_name,true);
					
		 
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                'pageSize'=> Yii::app()->params['defaultPageSize'],
            ),
		));
	}

	public function searchIndexInActive()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('short_content',$this->short_content,true);
		$criteria->compare('content',$this->content,true);
		// $criteria->compare('status',$this->status);
		// $criteria->compare('image1',$this->image1,true);
		// $criteria->compare('image2',$this->image2,true);
		// $criteria->compare('order_display',$this->order_display);
		$criteria->compare('is_hot',$this->is_hot);
		$criteria->compare('is_new',$this->is_new);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('state_id',$this->state_id);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('job_id',$this->job_id);
		$criteria->compare('updated_date_status',$this->updated_date_status,true);
		$criteria->compare('view',$this->view);
		$criteria->compare('loai_tin',$this->loai_tin);
		$criteria->compare('post_user_id',$this->post_user_id);
		$criteria->compare('edit_user_id',$this->edit_user_id);
		$criteria->compare('post_user_name',$this->post_user_name,true);
		$criteria->compare('edit_user_name',$this->edit_user_name,true);
		
		$criteria->addCondition("status=".STATUS_NEW);
		if(!isset($_GET['ajax']))
			$criteria->order = "ID DESC";
		 
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                'pageSize'=> Yii::app()->params['defaultPageSize'],
            ),
		));
	}

	public function searchIndexHidden()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('short_content',$this->short_content,true);
		$criteria->compare('content',$this->content,true);
		// $criteria->compare('status',$this->status);
		// $criteria->compare('image1',$this->image1,true);
		// $criteria->compare('image2',$this->image2,true);
		// $criteria->compare('order_display',$this->order_display);
		$criteria->compare('is_hot',$this->is_hot);
		$criteria->compare('is_new',$this->is_new);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('state_id',$this->state_id);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('job_id',$this->job_id);
		$criteria->compare('updated_date_status',$this->updated_date_status,true);
		$criteria->compare('view',$this->view);
		$criteria->compare('loai_tin',$this->loai_tin);
		$criteria->compare('post_user_id',$this->post_user_id);
		$criteria->compare('edit_user_id',$this->edit_user_id);
		$criteria->compare('post_user_name',$this->post_user_name,true);
		$criteria->compare('edit_user_name',$this->edit_user_name,true);
		
		$criteria->addCondition("status=".STATUS_INACTIVE);
		if(!isset($_GET['ajax']))
			$criteria->order = "ID DESC";
		 
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                'pageSize'=> Yii::app()->params['defaultPageSize'],
            ),
		));
	}


	public function searchIndexType($type)
	{

		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('short_content',$this->short_content,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('image1',$this->image1,true);
		$criteria->compare('image2',$this->image2,true);
		$criteria->compare('order_display',$this->order_display);
		$criteria->compare('is_hot',$this->is_hot);
		$criteria->compare('is_new',$this->is_new);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('state_id',$this->state_id);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('job_id',$this->job_id);
		$criteria->compare('updated_date_status',$this->updated_date_status,true);
		$criteria->compare('view',$this->view);
		$criteria->compare('loai_tin',$this->loai_tin);
		$criteria->compare('post_user_id',$this->post_user_id);
		$criteria->compare('edit_user_id',$this->edit_user_id);
		$criteria->compare('post_user_name',$this->post_user_name,true);
		$criteria->compare('edit_user_name',$this->edit_user_name,true);
		
		switch ($type) 
		{
			case TIN_3_NGAY:
				$criteria->addCondition(" loai_tin=".TIN_3_NGAY." AND status=".STATUS_ACTIVE);
				break;
			case TIN_7_NGAY:
				$criteria->addCondition(" loai_tin=".TIN_7_NGAY." AND status=".STATUS_ACTIVE);
				break;
			case TIN_14_NGAY:
				$criteria->addCondition(" loai_tin=".TIN_14_NGAY." AND status=".STATUS_ACTIVE);
				break;
			case TIN_1_THANG:
				$criteria->addCondition(" loai_tin=".TIN_1_THANG." AND status=".STATUS_ACTIVE);
				break;
			case TIN_2_THANG:
				$criteria->addCondition(" loai_tin=".TIN_2_THANG." AND status=".STATUS_ACTIVE);
				break;
			case TIN_3_THANG:
				$criteria->addCondition(" loai_tin=".TIN_3_THANG." AND status=".STATUS_ACTIVE);
				break;
			case TIN_4_THANG:
				$criteria->addCondition(" loai_tin=".TIN_4_THANG." AND status=".STATUS_ACTIVE);
				break;
			case TIN_5_THANG:
				$criteria->addCondition(" loai_tin=".TIN_5_THANG." AND status=".STATUS_ACTIVE);
				break;
			case TIN_6_THANG:
				$criteria->addCondition(" loai_tin=".TIN_6_THANG." AND status=".STATUS_ACTIVE);
				break;
			case TIN_1_NAM:
				$criteria->addCondition(" loai_tin=".TIN_1_NAM." AND status=".STATUS_ACTIVE);
				break;
		}

		if(!isset($_GET['ajax']))
			$criteria->order = "ID DESC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                'pageSize'=> Yii::app()->params['defaultPageSize'],
            ),
		));
	}

	public function searchListHotTrongTuan($id='')
	{
		$criteria=new CDbCriteria;

		// $criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('short_content',$this->short_content,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('image1',$this->image1,true);
		$criteria->compare('image2',$this->image2,true);
		$criteria->compare('order_display',$this->order_display);
		$criteria->compare('is_hot',$this->is_hot);
		$criteria->compare('is_new',$this->is_new);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('state_id',$this->state_id);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('job_id',$this->job_id);
		$criteria->compare('updated_date_status',$this->updated_date_status,true);
		$criteria->compare('view',$this->view);
		$criteria->compare('loai_tin',$this->loai_tin);
		$criteria->compare('post_user_id',$this->post_user_id);
		$criteria->compare('edit_user_id',$this->edit_user_id);
		$criteria->compare('post_user_name',$this->post_user_name,true);
		$criteria->compare('edit_user_name',$this->edit_user_name,true);
		
		if(!empty($id))
			$criteria->addCondition( 't.id <> '.$id );

		$criteria->addCondition('t.status = '.STATUS_ACTIVE);	
		// $criteria->addCondition('t.status = '.STATUS_ACTIVE);	
		$criteria->order = ' updated_date DESC, order_display DESC ';
		 
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                'pageSize'=> Yii::app()->params['defaultPageSize'],
            ),
		));
	}

	public function searchListDetailCungChuyenMuc($id='', $job_id='')
	{	
				$criteria=new CDbCriteria;

				// $criteria->compare('id',$this->id);
				$criteria->compare('title',$this->title,true);
				$criteria->compare('short_content',$this->short_content,true);
				$criteria->compare('content',$this->content,true);
				$criteria->compare('status',$this->status);
				$criteria->compare('image1',$this->image1,true);
				$criteria->compare('image2',$this->image2,true);
				$criteria->compare('order_display',$this->order_display);
				$criteria->compare('is_hot',$this->is_hot);
				$criteria->compare('is_new',$this->is_new);
				$criteria->compare('phone',$this->phone,true);
				$criteria->compare('mobile',$this->mobile,true);
				$criteria->compare('state_id',$this->state_id);
				$criteria->compare('city',$this->city,true);
				$criteria->compare('created_date',$this->created_date,true);
				$criteria->compare('updated_date',$this->updated_date,true);
				$criteria->compare('slug',$this->slug,true);
				$criteria->compare('job_id',$this->job_id);
				$criteria->compare('updated_date_status',$this->updated_date_status,true);
				$criteria->compare('view',$this->view);
				$criteria->compare('loai_tin',$this->loai_tin);
				$criteria->compare('post_user_id',$this->post_user_id);
				$criteria->compare('edit_user_id',$this->edit_user_id);
				$criteria->compare('post_user_name',$this->post_user_name,true);
				$criteria->compare('edit_user_name',$this->edit_user_name,true);
				
				if(!empty($job_id))
					$criteria->addCondition( 't.job_id = '.$job_id );

				if(!empty($id))
					$criteria->addCondition( 't.id <> '.$id );

				$criteria->addCondition('t.status = '.STATUS_ACTIVE);	
				// $criteria->addCondition('t.status = '.STATUS_ACTIVE);	
				$criteria->order = ' updated_date DESC, order_display DESC ';
				 
				return new CActiveDataProvider($this, array(
					'criteria'=>$criteria,
					'pagination'=>array(
		                // 'pageSize'=> Yii::app()->params['defaultPageSize'],
		                'pageSize'=> 8,
		            ),
				));
	}


	public function searchListTin($get_tin='')
	{
		$criteria=new CDbCriteria;

		if(!empty($get_tin))
		{
			if(!empty($get_tin['s_state_id']))
				$criteria->addCondition( 't.state_id='.$get_tin['s_state_id'] );

			if(!empty($get_tin['s_job_id']))
				$criteria->addCondition( 't.job_id='.$get_tin['s_job_id'] );

			if(!empty($get_tin['title']))
				$criteria->compare('title',$get_tin['title'],true);
		}
		// $criteria->compare('id',$this->id);
		// $criteria->compare('title',$this->title,true);
		// $criteria->compare('short_content',$this->short_content,true);
		// $criteria->compare('content',$this->content,true);
		// $criteria->compare('status',$this->status);
		// $criteria->compare('image1',$this->image1,true);
		// $criteria->compare('image2',$this->image2,true);
		// $criteria->compare('order_display',$this->order_display);
		// $criteria->compare('is_hot',$this->is_hot);
		// $criteria->compare('is_new',$this->is_new);
		// $criteria->compare('phone',$this->phone,true);
		// $criteria->compare('mobile',$this->mobile,true);
		// $criteria->compare('state_id',$this->state_id);
		// $criteria->compare('city',$this->city,true);
		// $criteria->compare('created_date',$this->created_date,true);
		// $criteria->compare('updated_date',$this->updated_date,true);
		// $criteria->compare('slug',$this->slug,true);
		// $criteria->compare('job_id',$this->job_id);
		// $criteria->compare('updated_date_status',$this->updated_date_status,true);
		// $criteria->compare('view',$this->view);
		// $criteria->compare('loai_tin',$this->loai_tin);
		// $criteria->compare('post_user_id',$this->post_user_id);
		// $criteria->compare('edit_user_id',$this->edit_user_id);
		// $criteria->compare('post_user_name',$this->post_user_name,true);
		// $criteria->compare('edit_user_name',$this->edit_user_name,true);

		$criteria->addCondition('t.status = '.STATUS_ACTIVE);	
		// $criteria->addCondition('t.is_hot = '.TYPE_YES);	
		// $criteria->addCondition(' ( t.loai_tin='.TIN_7_NGAY. ' OR t.loai_tin='.TIN_30_NGAY.' ) ');	
		$criteria->order = ' updated_date DESC, order_display DESC ';
		 
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                'pageSize'=> Yii::app()->params['defaultPageSize'],
                // 'pageSize'=>Yii::app()->params['pagesize_raovat_hot'],
            ),
		));
	}

	public function searchListHotIndex()
	{
		$criteria=new CDbCriteria;

		// $criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('short_content',$this->short_content,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('image1',$this->image1,true);
		$criteria->compare('image2',$this->image2,true);
		$criteria->compare('order_display',$this->order_display);
		// $criteria->compare('is_hot',$this->is_hot);
		// $criteria->compare('is_new',$this->is_new);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('state_id',$this->state_id);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('job_id',$this->job_id);
		$criteria->compare('updated_date_status',$this->updated_date_status,true);
		$criteria->compare('view',$this->view);
		// $criteria->compare('loai_tin',$this->loai_tin);
		$criteria->compare('post_user_id',$this->post_user_id);
		$criteria->compare('edit_user_id',$this->edit_user_id);
		$criteria->compare('post_user_name',$this->post_user_name,true);
		$criteria->compare('edit_user_name',$this->edit_user_name,true);

		$criteria->addCondition('t.status = '.STATUS_ACTIVE);	
		$criteria->addCondition('t.is_hot = '.TYPE_YES);	
		// $criteria->addCondition('t.is_hot = '.TYPE_YES);	
		$criteria->addCondition(' ( t.loai_tin <> '.TIN_3_NGAY .') ');	
		$criteria->order = ' order_display DESC, updated_date DESC ';
		 
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                // 'pageSize'=> Yii::app()->params['defaultPageSize'],
                'pageSize'=>Yii::app()->params['pagesize_raovat_hot'],
            ),
		));
	}

	public function searchListKhacIndex($arr_duplicate=null)
	{
		$criteria=new CDbCriteria;

		// $criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('short_content',$this->short_content,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('image1',$this->image1,true);
		$criteria->compare('image2',$this->image2,true);
		$criteria->compare('order_display',$this->order_display);
		// $criteria->compare('is_hot',$this->is_hot);
		// $criteria->compare('is_new',$this->is_new);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('state_id',$this->state_id);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('job_id',$this->job_id);
		$criteria->compare('updated_date_status',$this->updated_date_status,true);
		$criteria->compare('view',$this->view);
		$criteria->compare('loai_tin',$this->loai_tin);
		$criteria->compare('post_user_id',$this->post_user_id);
		$criteria->compare('edit_user_id',$this->edit_user_id);
		$criteria->compare('post_user_name',$this->post_user_name,true);
		$criteria->compare('edit_user_name',$this->edit_user_name,true);

		$criteria->addCondition('t.status = '.STATUS_ACTIVE);
		if(!empty($arr_duplicate))
			$criteria->addNotInCondition('id', $arr_duplicate);	
		// $criteria->addCondition('t.is_hot = '.TYPE_YES);	
		$criteria->order = ' updated_date DESC, order_display DESC ';
		 
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                'pageSize'=> Yii::app()->params['pagesize_raovat_khac'],
                // 'pageSize'=>Yii::app()->setting->getItem('pagesize_raovat_khac'),
            ),
		));
	}
	

	
	public function activate()
    {
        $this->status = STATUS_ACTIVE;
        $this->update();
    }



    public function deactivate()
    {
        $this->status = STATUS_INACTIVE;
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
	
	public static function getDetailBySlug($slug)
	{
		$criteria = new CDbCriteria;
        $criteria->compare('t.slug', $slug);
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

	public static function getListData()
	{
		$criteria = new CDbCriteria();
		$criteria->compare('status', STATUS_ACTIVE);
		$criteria->order ="order_display ASC";
		$models = self::model()->findAll($criteria);

        return CHtml::listData($models,'id','name');
	}

	protected function beforeSave() 
	{
		if(empty($this->created_date))
		{
			$this->created_date = date('Y-m-d H:i:s');
		}
        $this->updated_date = date('Y-m-d H:i:s');
        if(empty($this->view)) $this->view = 1;
        if(empty($this->order_display)) $this->order_display = 1;
        if(empty($this->is_hot)) $this->is_hot = TYPE_NO;
        // if(empty($this->is_hot)) $this->view = TYPE_NO;

        if(empty($this->updated_date_status))
		{
			$this->updated_date_status = date('Y-m-d H:i:s');
		}
		// if(!Yii::app()->user->id)
		// {
		// 	$this->post_user_id = '';
		// 	$this->edit_user_id = '';
		// }

	    return parent::beforeSave();
	}

	protected function beforeDelete() 
	{
		$this->deleteImages('image1', $this->image1);
		$this->deleteImages('image2', $this->image2);
        return parent::beforeDelete();
    }
    protected function beforeValidate() 
	{
		if(empty($this->created_date))
		{
			$this->created_date = date('Y-m-d H:i:s');
		}
        $this->updated_date = date('Y-m-d H:i:s');
        if(empty($this->view)) $this->view = 1;
        if(empty($this->order_display)) $this->order_display = 1;
        if(empty($this->is_hot)) $this->is_hot = TYPE_NO;
        // if(empty($this->is_hot)) $this->view = TYPE_NO;

        if(empty($this->updated_date_status))
		{
			$this->updated_date_status = date('Y-m-d H:i:s');
		}
		// if(!Yii::app()->user->id)
		// {
		// 	$this->post_user_id = '';
		// 	$this->edit_user_id = '';
		// }
        return parent::beforeValidate();
    }


    // check Hidden Tin Sau 3 ngày, 7 ngày, 30 ngày
    public function checkHiddenTin()
    {
    	$now_time = strtotime( date('Y-m-d 23:59:59') );
    	// $now_time = time();
    	if(!empty($this->updated_date_status))
    		$updated_date_status_time = strtotime( $this->updated_date_status );
    	else
    		$updated_date_status_time='';

    	if($this->loai_tin == TIN_3_NGAY)
    	{
    		$elapsed = 3*24*60*60;
    	}
    	else if($this->loai_tin == TIN_7_NGAY)
    	{
    		$elapsed = 7*24*60*60;
    	}
    	else if($this->loai_tin == TIN_14_NGAY)
    	{
    		$elapsed = 14*24*60*60;
    	}
    	else if($this->loai_tin == TIN_1_THANG)
    	{
    		$elapsed = 30*24*60*60;
    	}
    	else if($this->loai_tin == TIN_2_THANG)
    	{
    		$elapsed = 2*30*24*60*60;
    	}
    	else if($this->loai_tin == TIN_3_THANG)
    	{
    		$elapsed = 3*30*24*60*60;
    	}
    	else if($this->loai_tin == TIN_4_THANG)
    	{
    		$elapsed = 4*30*24*60*60;
    	}
    	else if($this->loai_tin == TIN_5_THANG)
    	{
    		$elapsed = 5*30*24*60*60;
    	}
    	else if($this->loai_tin == TIN_6_THANG)
    	{
    		$elapsed = 6*30*24*60*60;
    	}
    	else if($this->loai_tin == TIN_1_NAM)
    	{
    		$elapsed = 12*30*24*60*60;
    	}
    	else{
    		$elapsed = '';
    	}


    	// if( (($now_time-$updated_date_status_time) > $elapsed) && !empty($elapsed) && !empty($updated_date_status_time) )
    	if(    ( $updated_date_status_time + $elapsed ) < $now_time   && !empty($elapsed) && !empty($updated_date_status_time) )
    	{
    		if($this->status==STATUS_ACTIVE)
    		{
    			$this->status = STATUS_INACTIVE;
    			$this->update( array('status'));
    		}
    	}
    }

    /*Check xóa tin sau 2 tháng
	Điều kiện: tin đang Inactive + !empty($updated_date_status_time)
    */
    public function checkXoaTin()
    {
    	if($this->status==STATUS_INACTIVE && !empty($this->updated_date_status))
    	{
    		$today = strtotime( date('Y-m-d 23:59:59') ); //OR time();
			// $twoMonthsLater = strtotime("+2 months", $today);

			$temp_update_date = strtotime($this->updated_date_status);
			$two_month_after_temp = strtotime("+2 months", $temp_update_date);

			if( $today > $two_month_after_temp )
			{
				$this->deleteRecordAndImageOne();
			}

    		// $two_month_time = 60*24*60*60;
    		// $updated_date_status_time = strtotime( $this->updated_date_status );
    		// $now_time = strtotime( date('Y-m-d 23:59:59') );
    		// if( ($now_time-$updated_date_status_time) > $two_month_time )
    		// {
    		// 	$this->deleteRecordAndImageOne();
    		// }
    	}

    }


    public function deleteRecordAndImageOne()
    {
    	if(!empty($this))
    	{
		    if (!empty($this->image1) )
		    {
		        $source = $this->uploadImageFolder.'/' . $this->id . '/' . $this->image1;
		        if (file_exists($source))
		            unlink($source);
		        $this->deleteImages('image1', $this->image1);
		    }
		    if (!empty($this->image2) )
		    {
		        $source = $this->uploadImageFolder.'/' . $this->id . '/' . $this->image2;
		        if (file_exists($source))
		            unlink($source);
		        $this->deleteImages('image2', $this->image2);
		    }

		    if ($this->delete()) 
            {
            }
    	}
    }

    public static function randomBackgroundColor()
    {
    	$arr_color = array(
    		'1' =>'#FAF834',
    		'2' =>'#EBFAB2',
    		'3' =>'#F79696',
    		'4' =>'#A0FC6B',
    		'5' =>'#FDD863',

    		'6' =>'#67F079',
    		'7' =>'#FAB0EB',
    		'8' =>'#F6FCA4',
    		'9' =>'#63FDF9',
    	);
    	$index = rand(1,9);
    	return $arr_color[$index];
    }

    public static function cronJobCheckHiddenDelete()
    {
    	Yii::app()->setting->setDbItem('last_working2', date('Y-m-d H:i:s'));

    	$models = TinRaoVat::model()->findAll();
    	foreach ($models as $one) 
    	{
    		if(empty($one)) continue;
    		$one->checkHiddenTin();
    		$one->checkXoaTin();
    	}
    }
}
