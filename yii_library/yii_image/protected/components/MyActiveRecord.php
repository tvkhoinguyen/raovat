<?php
class MyActiveRecord extends CActiveRecord{
    
    public $aAttributesBeforeSave = array();//first time load model
    public $aImagesToSave = array();
    public $aImageSize = array();
    public $aImagePath = array();
    
        /**
        * IN VIEW FILE call this to get image URL
        * echo $model->getImageUrl('image1', ImageExample::IMAGE1_WIDTH_1, ImageExample::IMAGE1_HEIGHT_1)
        * @param type $fieldName
        * @param type $path 'upload/imageExample/123456789'
        * @return string
        * @copyright (c) 2014, bb
        */
        public function saveImage($fieldName, $path)
        {
           if(array_key_exists($fieldName, $this->aAttributesBeforeSave))
                $oldImage = $this->aAttributesBeforeSave[$fieldName];
           if (is_null($this->$fieldName))
           {   
               if(!empty($oldImage))
               {
                    $this->$fieldName = $oldImage;
                    $this->update(array($fieldName));
               }
               return false;
           }
           if(!empty($oldImage))
                $this->deleteImage($fieldName,$path, $oldImage);
           $ext = $this->$fieldName->getExtensionName();
           $fileName = time() . '_' .$this->id.'_'. $fieldName . '.' . $ext;
           $imageHelper = new ImageHelper();
           $imageHelper->createDirectoryByPath($path);
           $this->$fieldName->saveAs($path. '/' . $fileName);
           $this->$fieldName = $fileName;
           $this->update(array($fieldName));
           
           if(array_key_exists($fieldName, $this->aImageSize) && is_array($this->aImageSize[$fieldName]))
           {
               $this->resizeImage($fieldName, $path);
           }
       }

        //bb
        public function resizeImage($fieldName, $path)
        {
            $ImageHelper = new ImageHelper();
            $ImageHelper->folder = $path;
            $ImageHelper->file = $this->$fieldName;
            $ImageHelper->thumbs = $this->aImageSize[$fieldName];
            $ImageHelper->createThumbs();
        }

        //bb - delete Old image
        public function deleteImage($fieldName, $path, $oldImage)
        {
            if (!empty($oldImage)) {
                ImageHelper::deleteFile($path. '/' . $oldImage);
                if(array_key_exists($fieldName, $this->aImageSize) && is_array($this->aImageSize[$fieldName]))
                {
                    $aSize = $this->aImageSize[$fieldName];
                    foreach ($aSize as $key => $value) {
                        ImageHelper::deleteFile($path.'/' . $key . '/' . $oldImage);
                    }
                }
            }
        }
        
        //bb
        public function deleteCurrentImage($fieldName)
        {
            $path = $this->getPathByFieldName($fieldName); 
            ImageHelper::deleteFile($path. '/' . $this->$fieldName);
            if(array_key_exists($fieldName, $this->aImageSize) && is_array($this->aImageSize[$fieldName]))
            {
                $aSize = $this->aImageSize[$fieldName];
                foreach ($aSize as $key => $value) {
                    ImageHelper::deleteFile($path.'/' . $key . '/' . $this->$fieldName);
                }
            }
            $this->$fieldName = '';
            $this->update(array($fieldName));
        }
        
        //bb
        public function getImageUrl($fieldName, $width = NULL, $height = NULL)
        {
             if($width && $height)
                $thumbFolder = $width.'x'.$height.'/';
            else
                $thumbFolder = '';
            $path1 = $this->getPathByFieldName($fieldName); 
//            $path = 'upload/imageExample/'.$this->id.'/'.$thumbFolder.$this->$fieldName;
            $path = $path1.'/'.$thumbFolder.$this->$fieldName;
            return ImageHelper::getImageUrl($path, $width, $height);//get noimage if not availabe
        }        
        
        //bb
        protected function beforeSave()
        {
            if(!$this->isNewRecord)
            {
                if(count($this->aAttributesBeforeSave) == 0)
                {
                    $model = call_user_func(array(get_class($this) , 'model'));
                    $mBeforeSave = $model->findByPk($this->id);
                    $this->aAttributesBeforeSave = $mBeforeSave->attributes;
                }
            }
            return parent::beforeSave();
        }
        
        //bb
        protected function beforeDelete()
        {
            foreach($this->aImageSize as $fieldName=>$aSize)
            {
                $path = $this->getPathByFieldName($fieldName);  
                $this->deleteImage($fieldName, $path, $this->$fieldName);  
            }
            return parent::beforeDelete();
        }
        
        //bb
        public function getPathByFieldName($fieldName)
        {
            $path = $this->aImagePath[$fieldName];
            preg_match_all('/\{([A-Za-z0-9 ]+?)\}/', $path, $aParams);
            foreach($aParams[1] as $param)
            {
                $path = str_replace('{'.$param.'}', $this->$param, $path);
            }     
            return $path;
        }
        //bb
        public function saveImages()
        {
            foreach($this->aImageSize as $fieldName=>$aSize)
            {
                $this->$fieldName = CUploadedFile::getInstance($this, $fieldName); 
                $path = $this->getPathByFieldName($fieldName);          
                $this->saveImage($fieldName, $path);                
            }
        }        
        
        //CONTINUE :) - when update new size of image
        public function resizeToNewSize()
        {
            //delelte all size folder and resize
        }
        
}

