<?php

class MyActiveRecord extends CActiveRecord
{

	public $aAttributesBeforeSave = array(); //first time load model
	public $aImageSize = array();

	/**
	 * 
	 * @param type $fieldName
	 * @param type $path 'upload/imageExample/123456789'
	 * @param type $oldImage old image filename to delete after resize
	 * @return string
	 * @copyright (c) 2014, bb
	 */
	

	//bb
	public function getImageUrl($fieldName, $width, $height)
	{
		//you must code in each extend class
	}

	//bb
	protected function beforeValidate()
	{
		foreach ($this->aImageSize as $fieldName => $aSize)
		{
			$this->$fieldName = CUploadedFile::getInstance($this, $fieldName);
		}
		return parent::beforeValidate();
	}

	//bb
	protected function beforeSave()
	{
		if (!$this->isNewRecord)
		{
			if (count($this->aAttributesBeforeSave) == 0)
			{
				$model = call_user_func(array(get_class($this), 'model'));
				$mBeforeSave = $model->findByPk($this->id);
				$this->aAttributesBeforeSave = $mBeforeSave->attributes;
			}
		}
		return parent::beforeSave();
	}

	public static function getCurrentUrlWithoutParam()
	{
		$uriWithoutParam = $_SERVER['REQUEST_URI'];
		if (strpos($uriWithoutParam, '?') != false)
			$uriWithoutParam = substr($uriWithoutParam, 0, strpos($uriWithoutParam, '?'));
		return 'http://' . $_SERVER['SERVER_NAME'] . $uriWithoutParam;
	}

	public static function getGenders($hasEmpty = true)
	{
		if ($hasEmpty)
			$data = array('' => '', 'MALE' => 'Male', 'FEMALE' => 'Female');
		else
			$data = array('MALE' => 'Male', 'FEMALE' => 'Female');
		return $data;
	}

}
