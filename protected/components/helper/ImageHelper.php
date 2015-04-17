<?php

/**
 * 
 * Class using for handle image. Required: EPhpThumb extension
 * @author bb
 * @example Using createThumbs function
 *
 */
class ImageHelper
{

  public $folder = 'upload';
  public $file = '';
  public $thumbs = array();
  public $createFullImage = true; //true if you need to create full size image after resize
  public $aRGB = array(255, 255, 255); //full image background

  /**
   * Create thumb images to specific folders from exist image 
   * @example 

    $ImageHelper = new ImageHelper();
    $ImageHelper->folder = 'upload/admin/artist';
    $ImageHelper->file = 'photo.jpg';
    $ImageHelper->thumbs =array('thumb1' => array('width'=>'1336','height'=>'768'),
    'thumb2' =>  array('width'=>'800','height'=>'600'));
    $ImageHelper->createThumbs();
    Bảng Mã Màu CSS: https://sites.google.com/site/wwwcaotongvn/css
   *  http://www.rapidtables.com/web/color/RGB_Color.htm 
   * @author bb
   */

  public function createThumbs()
  {
    if (count($this->thumbs) > 0)
    {
      $pathFile = Yii::getPathOfAlias('webroot') . '/' . $this->folder . '/' . $this->file;
      if (!file_exists($pathFile) || empty($this->file))
        return false;

      self::createDirectoryByPath($this->folder);
      foreach ($this->thumbs as $folderThumb => $size)
      {
        $this->createSingleDirectoryByPath($this->folder . '/' . $folderThumb);

        $thumb = new EPhpThumb();
        $thumb->init();
        $thumb->create($pathFile)
          ->resize($size['width'], $size['height'])
          ->save(Yii::getPathOfAlias('webroot') . '/' . $this->folder . '/' . $folderThumb . '/' . $this->file);

        self::createNoImage($size['width'], $size['height']);
        //create full image
        if ($this->createFullImage)
        {
          $source_folder = $this->folder . '/' . $folderThumb;
          self::createFullImage($source_folder, $this->file, $size['width'], $size['height'], NULL, $this->aRGB);
        }
      }
    }
  }

  /**
   * @param int $width 
   * @param int $height
   * @return boolean
   * @copyright (c) 2013, bb
   */
  public static function createNoImage($width, $height, $aBackgroundRGB = array(255, 255, 255), $aTextRGB = array(0, 0, 0))
  {
    self::createDirectoryByPath('upload/noimage');
    $noimagePath = 'upload/noimage/' . $width . 'x' . $height . '.jpg';
    if (!file_exists(Yii::getPathOfAlias("webroot") . '/' . $noimagePath))
    {
      if (!file_exists(Yii::getPathOfAlias("webroot") . '/upload/noimage/ARLRDBD.TTF'))
      {
        echo "Need font file " . Yii::getPathOfAlias("webroot") . '/upload/noimage/ARLRDBD.TTF';
        exit;
      }
      $bg_image = @imagecreatetruecolor($width, $height);
      $bg_color = imagecolorallocate($bg_image, $aBackgroundRGB[0], $aBackgroundRGB[1], $aBackgroundRGB[2]);
      $textColor = imagecolorallocate($bg_image, $aTextRGB[0], $aTextRGB[1], $aTextRGB[2]);
      $grey = imagecolorallocate($bg_image, 128, 128, 128);
      imagefilledrectangle($bg_image, 0, 0, $width, $height, $bg_color);

      $text = "NO IMAGE";
      $font_file = Yii::getPathOfAlias("webroot") . '/upload/noimage/ARLRDBD.TTF';
      $font_size = 6; // Font size is in pixels.
      // Retrieve bounding box:
      $area = imagettfbbox($font_size, 0, $font_file, $text);

      $textwidth = $area[2] - $area[0] + 2;
      $textheight = $area[1] - $area[7] + 2;

      while ($width / $textwidth > 1.5)
      {
        $font_size++;
        // Retrieve bounding box:
        $area = imagettfbbox($font_size, 0, $font_file, $text);

        $textwidth = $area[2] - $area[0] + 2;
        $textheight = $area[1] - $area[7] + 2;
      }

      // Add some shadow to the text
      imagettftext($bg_image, $font_size, 0, ($width - $textwidth) / 2, ($height - $textheight) / 2 + $textheight / 2, $grey, $font_file, $text);

      // Add the text
      imagettftext($bg_image, $font_size, 0, ($width - $textwidth) / 2, ($height - $textheight) / 2 + $textheight / 2, $textColor, $font_file, $text);

      imagejpeg($bg_image, Yii::getPathOfAlias('webroot') . '/' . $noimagePath, 100);

      // Destroy memory handlers
      imagedestroy($bg_image);
      return true;
    }
    return false;
  }

  /**
   * @todo delete image file
   * @param type $source: "upload/admin/artist/photo.jpg"
   * @author bb
   */
  public static function deleteFile($source)
  {
    if (file_exists(Yii::getPathOfAlias("webroot") . '/' . $source))
      @unlink(Yii::getPathOfAlias("webroot") . '/' . $source);
  }

  /**
   * 
   * @todo RESIZE & CROP
   * @param type $fileName
   * @example 
   * $ImageHelper = new ImageHelper();
    $ImageHelper->folder = 'upload/admin/artist';
    $ImageHelper->file = 'photo.jpg';
    $ImageHelper->thumbs =array('width'=>'1336','height'=>'768');
    $ImageHelper->resizeAndCrop('fileNameOfDestinationImage');
   * @author bb
   */
  public function resizeAndCrop($fileName)
  {
    $thumb = new EPhpThumb();
    $thumb->init();
    $thumb->create(Yii::getPathOfAlias('webroot') . '/' . $this->folder . '/' . $this->file)
      ->adaptiveResize($this->thumbs['width'], $this->thumbs['height'])
      ->save(Yii::getPathOfAlias('webroot') . '/' . $this->folder . '/' . $fileName);
  }

  /**
   * Useful in case of full image for SLIDING EFFECT in jquery
   * @param string $source_folder 'upload/source';
   * @param string $source_filename 'source.jpg';
   * @param string $destination_folder 'upload/source/full'. If NULL => file "source.jpg" will be override
   * @return string|boolean
   * bb
   */
  public static function createFullImage($source_folder, $source_filename, $final_width, $final_height, $destination_folder = NULL, $aRGB = array(255, 255, 255))
  {
    $watermark_file = Yii::getPathOfAlias('webroot') . '/' . $source_folder . '/' . $source_filename;
    if ($destination_folder == NULL)
      $destination_folder = $source_folder;

    self::createDirectoryByPath($destination_folder);

    $finalExtension = 'jpg';
//            $bg_image_link = Yii::getPathOfAlias('webroot') . 'upload/test/bg.jpg';
    if (!file_exists($watermark_file))
      return FALSE;

    list($source_width, $source_height, $source_type) = getimagesize($watermark_file);

    if ($source_type === NULL)
    {
      return false;
    }

    switch ($source_type)
    {
      case "1":
        $watermark = imagecreatefromgif($watermark_file);
        $finalExtension = 'gif';
        break;
      case "2":
        $watermark = imagecreatefromjpeg($watermark_file);
        $finalExtension = 'jpg';
        break;
      case "3":
        $watermark = imagecreatefrompng($watermark_file);
        $finalExtension = 'png';
        break;
      default:
        return false;
    }

    $bg_image = @imagecreatetruecolor($final_width, $final_height);
    $bg_color = imagecolorallocate($bg_image, $aRGB[0], $aRGB[1], $aRGB[2]);
//            $white = imagecolorallocate($bg_image, 255, 255, 255);
//            $black = @imagecolorallocate($bg_image, 0, 0, 0);

    imagefilledrectangle($bg_image, 0, 0, $final_width, $final_height, $bg_color);

    $imageWidth = imageSX($bg_image);
    $imageHeight = imageSY($bg_image);
    $watermarkWidth = $source_width;
    $watermarkHeight = $source_height;

    $coordinate_X = ( $imageWidth - $watermarkWidth) / 2;
    $coordinate_Y = ( $imageHeight - $watermarkHeight) / 2;

    // Merge the watermark onto base image
    imagecopymerge(
      $bg_image, $watermark, $coordinate_X, $coordinate_Y, 0, 0, $watermarkWidth, $watermarkHeight, 100
    );

    // Save to new location as jpg file
    $filename = pathinfo($watermark_file, PATHINFO_FILENAME);
    $final_name = $filename . '.' . $finalExtension;

    imagejpeg($bg_image, Yii::getPathOfAlias('webroot') . '/' . $destination_folder . '/' . $final_name, 100);

    // Destroy memory handlers
    imagedestroy($bg_image);
    imagedestroy($watermark);

    // Return new file name
    return $final_name;
  }

  /**
   * 
   * @todo Create single directory. 
   *          Create directory from the last path.
   *          You have to make sure that the parent directorry already exists
   * @param string $path: 'upload/admin/artist/thumb'
   * @author bb
   * 
   */
  public function createSingleDirectoryByPath($path)
  {
    $path = Yii::getPathOfAlias('webroot') . '/' . $path;
    if (!is_dir($path))
      mkdir($path);
  }

  /**
   * 
   * @todo create directory from path
   * @param type $path: 'upload/admin/artist'
   * @author bb
   */
  public static function createDirectoryByPath($path)
  {
    $aFolder = explode('/', $path);
    if (is_array($aFolder))
    {
      self::removeEmptyItemFromArray($aFolder);
      $root = Yii::getPathOfAlias('webroot');
      $currentPath = $root;
      foreach ($aFolder as $key => $folder)
      {
        $currentPath = $currentPath . '/' . $folder;
        if (!is_dir($currentPath))
        {
          mkdir($currentPath);
          chmod($currentPath, 0755);
        }
      }
    }
  }

  //bb
  public static function removeEmptyItemFromArray(&$arr)
  {
    foreach ($arr as $key => $value)
      if (is_null($value))
      {
        unset($arr[$key]);
      }
  }

  /**
   * 
   * @param string $model : model contain image field 
   * @param string $fieldName : image file name  (string)
   * @param string $imageSizeAlias  alias name of image size
   * function will return default imgage 200x200 if give wrong alias name
   * You must include holder.js to themes js folder 
   */
  // public static function getImageUrl($model, $fieldName, $imageSizeAlias)
  // {
  //   //has image in database
  //   $defaultSize = '200X200';

  //   $baseNoneImage = Yii::app()->theme->baseUrl . '/js/holder.js/';
  //   if(empty($model)) return $baseNoneImage . $imageSizeAlias;
  //   if ($model && $model->$fieldName != "")
  //   {
  //     if (array_key_exists($fieldName, $model->defineImageSize) && is_array($model->defineImageSize[$fieldName]))
  //     {
  //       foreach ($model->defineImageSize[$fieldName] as $item)
  //       {
  //         if($item['alias'] == $imageSizeAlias)
  //         {
  //           $image  = $model->uploadImageFolder . '/' . $model->id . '/' . $item['alias'] . '/' . $model->$fieldName;
  //           $rootImage = $model->uploadImageFolder . '/' . $model->id . '/' . $model->$fieldName;
  //           if (!file_exists($image) && file_exists($rootImage)) 
  //               $model->resizeImage($fieldName);
            
  //           if (file_exists($image))
  //             return Yii::app()->createAbsoluteUrl($image);
  //           else
  //             return $baseNoneImage . $item['size'];
  //         }
  //       }
  //     }
  //   }
  //   else //don't have image in database
  //   {
  //     if (array_key_exists($fieldName, $model->defineImageSize) && is_array($model->defineImageSize[$fieldName]))
  //     {
  //       foreach ($model->defineImageSize[$fieldName] as $item)
  //       {
  //         if($item['alias'] == $imageSizeAlias)
  //           return $baseNoneImage . $item['size'];
          
  //       }
  //     }
  //   }
  //   if(!empty($imageSizeAlias))
  //   // return $baseNoneImage . $defaultSize;
  //     return $baseNoneImage . $imageSizeAlias;
  //   else
  //     return $baseNoneImage . $defaultSize;
  // }

  public static function getImageUrl($model, $fieldName, $imageSizeAlias)
  {
     
    $defaultSize = '200X200';
    $baseNoneImage = Yii::app()->theme->baseUrl . '/js/holder.js/';
    // $baseNoneImage = Yii::app()->theme->baseUrl . '/js/holder.js/';
    if ( !empty($model) && !empty($model->$fieldName) )
    {
      if (array_key_exists($fieldName, $model->defineImageSize) && is_array($model->defineImageSize[$fieldName]))
      {
        foreach ($model->defineImageSize[$fieldName] as $item)
        {
          if($item['alias'] == $imageSizeAlias)
          {
            $image  = $model->uploadImageFolder . '/' . $model->id . '/' . $item['alias'] . '/' . $model->$fieldName;
            $rootImage = $model->uploadImageFolder . '/' . $model->id . '/' . $model->$fieldName;
            if (!file_exists($image) && file_exists($rootImage)) 
              $model->resizeImage($fieldName);
            
            if (file_exists($image))
              return Yii::app()->createAbsoluteUrl($image);
            else
              return $baseNoneImage . $item['size'];
          }
        }
      }
    }
    else //don't have image in database
    {
      if (array_key_exists($fieldName, $model->defineImageSize) && is_array($model->defineImageSize[$fieldName]))
      {
        foreach ($model->defineImageSize[$fieldName] as $item)
        {
          if($item['alias'] == $imageSizeAlias)
            return $baseNoneImage . $item['size'];
          
        }
      }
    }
    
    return $baseNoneImage . $defaultSize;
  }
  
    public static function getDefaultImage($product_id, $width = '', $height = '') {
        $default_color = GocProductColor::getDefaultColor($product_id);        
        $image = GocProductImages::getDefaultImage($default_color->id);
        $check_file ='';
        if (!empty($image)) {
            if ($width != '' && $height!= '') {
                $src = Yii::app()->baseUrl.'/upload/products/'.$product_id.'/'.$image->product_color->color_id.'/'.$width.'x'.$height.'/'.$image->image;
                $check_file = Yii::getPathOfAlias("webroot").'/upload/products/'.$product_id.'/'.$image->product_color->color_id.'/'.$width.'x'.$height.'/'.$image->image;
            } elseif ($width == '' && $height == '') {
                $src = Yii::app()->baseUrl.'/upload/products/'.$product_id.'/'.$image->product_color->color_id.'/'.$image->image;
                $check_file = Yii::getPathOfAlias("webroot").'/upload/products/'.$product_id.'/'.$image->product_color->color_id.'/'.$image->image;
            } else {
                $src = Yii::app()->baseUrl.'/upload/noimage/'.$width.'x'.$height.'.jpg';
            }
        } else {
            $src = Yii::app()->baseUrl.'/upload/noimage/'.$width.'x'.$height.'.jpg';
        }
        if (file_exists( $check_file )) {
          return $src;
        }else{
          return Yii::app()->baseUrl.'/upload/noimage/'.$width.'x'.$height.'.jpg';
        }
    }
    
    public static function getProductImage($product_id, $color_id, $image, $width = null, $height = null) {
        if ($width != null && $height != null) {
            if (file_exists(Yii::getPathOfAlias("webroot").'/upload/products/'.$product_id."/".$color_id.'/'.$width.'x'.$height.'/'.$image)) {
                $src = Yii::app()->baseUrl.'/upload/products/'.$product_id.'/'.$color_id.'/'.$width.'x'.$height.'/'.$image;
            } else {
                $src = Yii::app()->baseUrl.'/upload/noimage/'.$width.'x'.$height.'.jpg';
            }
        } else {
            if (file_exists(Yii::getPathOfAlias("webroot").'/upload/products/'.$product_id."/".$color_id.'/'.$image)) {
                $src = Yii::app()->baseUrl.'/upload/products/'.$product_id.'/'.$color_id.'/'.$image;
            } else {
                $src = Yii::app()->baseUrl.'/upload/noimage/600x680.jpg';
            }
        }
        return $src;
    }

}
