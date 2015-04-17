<?php
class _BaseModel extends CActiveRecord
{
	public $optionYesNo = array('0' => 'No', '1' => 'Yes');
	public $optionActive = array('1' => 'Active', '0' => 'Inactive');
	public $optionShowHidden = array('1' => 'Shown', '0' => 'Hidden');
	public $optionAnHien = array('1' => 'Hiện', '0' => 'Ẩn');
	public $optionPublish = array('1' => 'Publish', '0' => 'Un-Publish');
	public $optionGender = array('1' => 'Male', '0' => 'Female');
	
	//for image upload 
	public $maxImageFileSize = 3145728; //3MB
	public $uploadImageFolder = 'upload/cms'; //remember remove ending slash
	public $defineImageSize = array();
	public $allowImageType = 'jpg, png, gif';
	
	//for file upload
	public $maxUploadFileSize = 3145728;
	public $uploadFileFolder = 'upload/files'; //remember remove ending slash\n";
	public $uploadFileFields = array();
	public $allowUploadType = 'doc,docx,xls,xlsx,pdf';
	
	
	
	public function saveImage($fieldName)
	{
		$this->$fieldName = CUploadedFile::getInstance($this, $fieldName);
		$oldImge = $this->oldInformation();
		
		if (is_null($this->$fieldName) || !is_object($this->$fieldName))
		{
			if (!empty($oldImge->$fieldName))
			{
				$this->$fieldName = $oldImge->$fieldName;
				$this->update(array($fieldName));
			}
			return false;
		}
		
		if (!empty($this->$fieldName))
			$this->deleteImages($fieldName, $oldImge->$fieldName);
		
		$ext = strtolower($this->$fieldName->getExtensionName());
		$fileName = time() . '_' . $this->id . '_' . $this->$fieldName->getName();
		$imageHelper = new ImageHelper();
		$imageHelper->createDirectoryByPath($this->uploadImageFolder . "/" . $this->id);
		$this->$fieldName->saveAs($this->uploadImageFolder . '/' . $this->id . '/' . $fileName);
		$this->$fieldName = $fileName;
		$this->update(array($fieldName));

		if (array_key_exists($fieldName, $this->defineImageSize) && is_array($this->defineImageSize[$fieldName]))
		{
			$this->resizeImage($fieldName, $this->uploadImageFolder . '/' . $this->id . '/');
		}
	}
	/*
	 * For upload file 
	 */
	public function saveFile($fieldName)
	{
		$this->$fieldName = CUploadedFile::getInstance($this, $fieldName);
		$oldFile = $this->oldInformation();
		
		if (is_null($this->$fieldName) || !is_object($this->$fieldName))
		{
			if (!empty($oldFile->$fieldName))
			{
				$this->$fieldName = $oldFile->$fieldName;
				$this->update(array($fieldName));
			}
			return false;
		}
		if (!empty($this->$fieldName))
			$this->deleteFiles($fieldName, $oldFile->$fieldName);
		
		if (is_object($this->$fieldName))
		{
			$imageHelper = new ImageHelper();
			$imageHelper->createDirectoryByPath($this->uploadFileFolder . "/" . $this->id);
            $this->$fieldName->saveAs($this->uploadFileFolder . '/' . $this->id . '/' . $this->$fieldName->getName());
			$this->$fieldName = $this->$fieldName->getName() ;
			$this->update(array($fieldName));
		}
	}

	//bb
	public function resizeImage($fieldName)
	{
		$sizeRefactory = array();
		foreach ($this->defineImageSize[$fieldName] as $item)
		{
			$sizeExplode = explode('x', $item['size']);
			$sizeRefactory[$item['alias']] = array('width' => $sizeExplode[0], 'height' => $sizeExplode[1]);
		}
		$ImageHelper = new ImageHelper();
		$ImageHelper->folder = $this->uploadImageFolder . '/' . $this->id ;
		$ImageHelper->file = $this->$fieldName;
		$ImageHelper->thumbs = $sizeRefactory;
		$ImageHelper->aRGB = array(255, 255, 255);
        $ImageHelper->createFullImage = true;
		$ImageHelper->createThumbs();
	}
	
	public function deleteFiles($fieldName, $oldFile)
	{
		if (!empty($oldFile))
			ImageHelper::deleteFile($this->uploadFileFolder . '/' . $this->id . '/' . $oldFile);
	}

	//bb
	public function deleteImages($fieldName, $oldImage)
	{
		if (!empty($oldImage))
		{
			ImageHelper::deleteFile($this->uploadImageFolder . '/' . $this->id . '/' . $oldImage);
			if (array_key_exists($fieldName, $this->defineImageSize) && is_array($this->defineImageSize[$fieldName]))
			{
				$imageSize = $this->defineImageSize[$fieldName];
				foreach ($imageSize as $item)
				{
					ImageHelper::deleteFile($this->uploadImageFolder . '/' . $this->id . '/' . $item['alias'] . '/' . $oldImage);
				}
			}
		}
	}
	
	public function removeImage($fieldName = array(), $deleteFolder = false)
	{
		$updateField = array();
		if (!empty($fieldName) && is_array($fieldName))
		{
			foreach($fieldName as $fieldItem)
			{
				ImageHelper::deleteFile($this->uploadImageFolder . '/' . $this->id . '/' . $this->$fieldItem);
				if (array_key_exists($fieldItem, $this->defineImageSize) && is_array($this->defineImageSize[$fieldItem]))
				{
					$imageSize = $this->defineImageSize[$fieldItem];
					foreach ($imageSize as $item)
					{
						ImageHelper::deleteFile($this->uploadImageFolder . '/' . $this->id . '/' . $item['alias'] . '/' . $this->$fieldItem);
						$imgDir = $this->uploadImageFolder . '/' . $this->id . '/' . $item['alias'];
						if ($deleteFolder == true && file_exists($imgDir) && $this->is_dir_empty($imgDir))
							rmdir ($this->uploadImageFolder . '/' . $this->id . '/' . $item['alias'] );
					}
					$this->$fieldItem = '';
					$updateField[] = $fieldItem;
				}
			}
			if ($this->is_dir_empty($this->uploadImageFolder . '/' . $this->id) && $deleteFolder == true && file_exists($this->uploadImageFolder . '/' . $this->id))
				rmdir ($this->uploadImageFolder . '/' . $this->id);
			$this->update($updateField);
		}
	}
	
	
	public function removeFile($fieldName = array(), $deleteFolder = false)
	{
		$updateField = array();
		if (!empty($fieldName) && is_array($fieldName))
		{
			foreach($fieldName as $fieldItem)
			{
				ImageHelper::deleteFile($this->uploadFileFolder . '/' . $this->id . '/' . $this->$fieldItem);
				$this->$fieldItem = '';
				$updateField[] = $fieldItem;
			}
			if ($deleteFolder == true && file_exists($this->uploadFileFolder . '/' . $this->id))
				rmdir ($this->uploadFileFolder . '/' . $this->id);
			$this->update($updateField);
		}
	}
	
	private function is_dir_empty($dir) {
		if (!is_readable($dir)) return NULL; 
		return (count(scandir($dir)) == 2);
	}
	
	public function oldInformation()
	{
		$beforeSaveObj = array();
		if (!$this->isNewRecord)
		{
			$model = call_user_func(array(get_class($this), 'model'));
			$beforeSaveObj = $model->findByPk($this->id);
		}

		return $beforeSaveObj;
	}
	
	protected function beforeValidate()
	{
		$imageField = $this->defineImageSize;
		if (is_array($imageField) && !empty($imageField))
		{
			foreach($imageField as $fieldName=>$Size)
			{
				$this->$fieldName = CUploadedFile::getInstance($this, $fieldName);
				if (!is_object($this->$fieldName))
				{
					$oldImge = $this->oldInformation();
					if (!empty($oldImge->$fieldName) && $oldImge && $oldImge->$fieldName !== '')
						$this->$fieldName = $oldImge->$fieldName;
				}
			}
		}
		
		$fileFields = $this->uploadFileFields;
		
		if (is_array($fileFields) && !empty($fileFields))
		{
			foreach($fileFields as $item)
			{
				$this->$item = CUploadedFile::getInstance($this, $item);
				if (!is_object($this->$item))
				{
					$oldFile = $this->oldInformation();
					if (!empty($oldFile->$item))
						$this->$item = $oldImge->$item;
				}
			}
		}
		return parent::beforeValidate();
	}
	
	public function tablePrefix()
	{
		return $tablePrefix = Yii::app()->db->tablePrefix;
	}

	/*public function getImageUrl($fieldName, $imageSizeAlias)
	{
            //has image in database
            if ($this->$fieldName != "")
            {
                if (array_key_exists($fieldName, $this->defineImageSize) && is_array($this->defineImageSize[$fieldName]))
                {
                    foreach ($this->defineImageSize[$fieldName] as $item)
                    {
                        if($item['alias'] == $imageSizeAlias)
                        {
                                $location = $this->uploadImageFolder . '/' . $this->id . '/' . $item['alias'] . '/' . $this->$fieldName;
                                if (file_exists($location)) 
                                        return Yii::app()->createAbsoluteUrl($this->uploadImageFolder . '/' . $this->id . '/' . $item['alias'] . '/' . $this->$fieldName);
                                else
                                {
                                        //resize image on fly
                                        $this->resizeImage($fieldName);
                                        if (!file_exists($location)) 
                                            return $this->getDefaultImageUrl($fieldName, $imageSizeAlias);
                                        return Yii::app()->createAbsoluteUrl($location);
                                }
                        }
                       
                    }
                    return Yii::app()->theme->baseUrl . '/admin/js/holder.js/200X200';
                }
            }
            else //don't have image in database
            {
                return $this->getDefaultImageUrl($fieldName, $imageSizeAlias);
            }
	}*/
	public function getImageUrl($fieldName, $imageSizeAlias = null)
	{
		if ($this->$fieldName != "")
		{
			if (array_key_exists($fieldName, $this->defineImageSize) && is_array($this->defineImageSize[$fieldName]))
			{
				foreach ($this->defineImageSize[$fieldName] as $item)
				{
					if($imageSizeAlias == null) {
						$location = $this->uploadImageFolder . '/' . $this->id . '/' . $this->$fieldName;
						return Yii::app()->createAbsoluteUrl($this->uploadImageFolder . '/' . $this->id . '/'. $this->$fieldName);
					}
					if($item['alias'] == $imageSizeAlias) 
					{
						$location = $this->uploadImageFolder . '/' . $this->id . '/' . $item['alias'] . '/' . $this->$fieldName;
						if (file_exists($location)) 
								return Yii::app()->createAbsoluteUrl($this->uploadImageFolder . '/' . $this->id . '/' . $item['alias'] . '/' . $this->$fieldName);
						else
						{
								//resize image on fly
								$this->resizeImage($fieldName);
								if (!file_exists($location)) 
									return $this->getDefaultImageUrl($fieldName, $imageSizeAlias);
								return Yii::app()->createAbsoluteUrl($location);
						}
					} 
				}
				return Yii::app()->theme->baseUrl . '/admin/js/holder.js/200X200';
			}
		}
		else //don't have image in database
		{
			return $this->getDefaultImageUrl($fieldName, $imageSizeAlias);
		}
	}

	public function getDefaultImageUrl($fieldName, $imageSizeAlias)//noiamge
	{
	    if (array_key_exists($fieldName, $this->defineImageSize) && is_array($this->defineImageSize[$fieldName]))
	    {
	        foreach ($this->defineImageSize[$fieldName] as $item)
	        {
	            if($item['alias'] == $imageSizeAlias)
	            {
	                if(isset($item['default']) && $item['default'] != '')
	                {
	                    return Yii::app()->createAbsoluteUrl($item['default']);
	                }
	                else
	                    return Yii::app()->theme->baseUrl . '/admin/js/holder.js/' . $item['size'];
	            }
	        }
	        return Yii::app()->theme->baseUrl . '/admin/js/holder.js/200X200';
	    }
	}

	/*public function getImageUrl($fieldName, $imageSizeAlias = null) {
		if ($imageSizeAlias == null) {
			$image = $this->uploadImageFolder . '/' . $this->id . '/' . $this->$fieldName;
			if (file_exists($image) && $this->$fieldName != '')
				return Yii::app()->createAbsoluteUrl($image);
			else
				return Yii::app()->theme->baseUrl . '/admin/js/holder.js/200X200';
		}
		//has image in database
		if ($this->$fieldName != "") {
			if (array_key_exists($fieldName, $this->defineImageSize) && is_array($this->defineImageSize[$fieldName])) {
				foreach ($this->defineImageSize[$fieldName] as $item) {
					if ($item['alias'] == $imageSizeAlias) {
						$thumb = $this->uploadImageFolder . '/' . $this->id . '/' . $item['alias'] . '/' . $this->$fieldName;
						$image = $this->uploadImageFolder . '/' . $this->id . '/' . $this->$fieldName;

						if (!file_exists($thumb) && file_exists($image))
							$this->resizeImage($fieldName);

						if (file_exists($thumb))
							return Yii::app()->createAbsoluteUrl($thumb);
						else
							return $this->getDefaultImageUrl($fieldName, $imageSizeAlias);
					}
				}
				return $this->getDefaultImageUrl($fieldName, $imageSizeAlias);
			}
		}
		else { //don't have image in database
			return $this->getDefaultImageUrl($fieldName, $imageSizeAlias);
		}
	}*/
        
    public function getCurrentUrlWithoutParam()
    {
            $uriWithoutParam = $_SERVER['REQUEST_URI'];
            if (strpos($uriWithoutParam, '?') !== false)
                    $uriWithoutParam = substr($uriWithoutParam, 0, strpos($uriWithoutParam, '?'));
            return 'http://' . $_SERVER['SERVER_NAME'] . $uriWithoutParam;
    }     
	
	
	
	public function escapeInput($value)
	{
		$value = str_replace('"', '""', $value);
		$value = str_replace("'", "''", $value);
		return $value;
	}
     public function getParamArray()
    {
        $param = array();
        foreach ($this->attributes as $fieldName=>$value)
        {
            $param['{'.strtoupper($fieldName).'}'] = $value;
        }
        return $param;
    }

    /**
     * DTOAN
     * using get dropdownlist
     * $arrWher : parram ex : array('id'=>10,'status'=>1)
     */

    public  function getDropdownlistWithTable($arrWhere=array(), $key='id', $value='id',$order=null) {
        if($order !=''){
        	$model = $this->findAllByAttributes($arrWhere,array('order'=>$order));
        }else{
        	$model = $this->findAllByAttributes($arrWhere);
        }

        if ($model) {
            return CHtml::listData($model, $key, $value);
        }
        return array();
    }
    /**
     * DTOAN
     * get info record
     * $arrWher : parram
     * ex : array('id'=>10,'status'=>1)
     */

    public function getInfoRecordWithTable($arrWhere=array(), $field_name = NULL) {
        $model = $this->findByAttributes($arrWhere);
        if ($model) {
            if (empty($field_name)) return $model;
            else return $model->$field_name;
        }
        return null;
    }


	// public function saveFileUpload($model, $fileuploaded, $field_name, $filename, $destination )
    // {
    //     $model->$fileuploaded = CUploadedFile::getInstance($model, $fileuploaded);
    //     if (!empty($model->$fileuploaded)) 
    //     {
    //         $ext_banner = $model->$fileuploaded->getExtensionName();
    //         $model->$field_name = $filename .'.'. $ext_banner;
    //         $ImageHelper = new ImageHelper();
    //         $ImageHelper->createDirectoryByPath( $destination );
    //         $model->$fileuploaded->saveAs(Yii::getPathOfAlias("webroot") . $destination . $model->$field_name);
    //     }
    // }






}
?>
