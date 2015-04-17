<?php

class Utils
{

    /**
     * Get a sub-set of an array by keys
     * @param array $array original array
     * @param array $keys sub-set keys
     */
    public static function subArrayByKeys($array, $keys)
    {
        $tmpArray = array();
        if (is_array($array) && is_array($keys)) {
            foreach ($keys as $key)
                $tmpArray[$key] = $array[$key];
        }
        return $tmpArray;
    }

    /**
     * Ajax validation for a specific form
     */
    public static function ajaxValidation($model, $formId = '')
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === $formId) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Get path to a specific upload folder
     * @param string $subPath
     */
    public static function uploadPath($subPath = null)
    {
        $path = Yii::getPathOfAlias('webroot') . '/upload/';
        return empty($subPath) ? $path : ($path . $subPath);
    }

    /**
     * Get path to a specific upload folder
     * @param string $subPath
     */
    public static function uploadHashPath($userId = null, $subPath = null)
    {
        $path = Yii::getPathOfAlias('webroot') . '/upload/';
        if (!is_null($userId))
            $path .= $userId . '/';
        return empty($subPath) ? $path : ($path . $subPath);
    }

    /**
     * Get tmp upload path
     */
    public static function uploadTmpPath($subPath = null)
    {
        return self::uploadPath('tmp/' . $subPath);
    }

    /**
     * Get upload url
     */
    public static function uploadUrl($subPath = null)
    {
        $url = Yii::app()->request->baseUrl . '/upload/';
        return empty($subPath) ? $url : ($url . $subPath);
    }

    /**
     * Get upload url
     */
    public static function uploadHashUrl($userId = null, $subPath = null)
    {
        $url = Yii::app()->request->baseUrl . '/upload/';
        if (!is_null($userId))
            $url .= $userId . '/';
        return empty($subPath) ? $url : ($url . $subPath);
    }

    /**
     * Get tmp upload url
     */
    public static function uploadTmpUrl($subPath = null)
    {
        return self::uploadUrl('tmp/' . $subPath);
    }

    /**
     * createThumb function
     * @param type $path
     * @param type $fileName
     * @param type $size
     * @param type $bgColor
     */
    public static function createThumb($path, $fileName, $size, $bgColor = 'ffffff')
    {
        $desPath = $path . '/' . $size;
        @mkdir($desPath, 0777, true);

        if (!class_exists('phpThumb', false)) {
            Yii::import("application.extensions.phpThumb.*");
            require_once("phpthumb.class.php");
        }

        $size           = explode('x', $size);
        $realPath = realpath($path . '/' . $fileName);
        
        $thumbGenerator = new phpThumb();
        $thumbGenerator->setSourceFilename($realPath);
        $thumbGenerator->setParameter('w', $size[0]);
        $thumbGenerator->setParameter('h', $size[1]);
        $thumbGenerator->setParameter('bg', $bgColor);
        $thumbGenerator->setParameter('far', 'C');

        if ($thumbGenerator->GenerateThumbnail()) {
            $thumbGenerator->RenderToFile($desPath . '/' . $fileName);
        } else {
//            dump($thumbGenerator);
        }
    }

    /**
     * Clear all uploaded files in sessions
     */
    public static function resetUploadFiles()
    {
        Yii::app()->user->setState('uploadFiles', NULL);
        if( Yii::app()->user->hasState('uploadFiles')  )
            Yii::app()->user->setState('uploadFiles', NULL);
        if( Yii::app()->session['uploadFiles'] )
            Yii::app()->session['uploadFiles']= NULL;
    }

    /**
     * Create thumb files with sizes configured in params.php
     */
    public static function createThumbFiles($source, $path, $thumb, $autoPath = true)
    {
        if ($autoPath)
            $path = Utils::uploadPath($path);

        if (!is_dir($path)) {
            @mkdir($path, 0777, true);
        }

        $sizes = Yii::app()->params['thumb'][$thumb];
        if (!empty($sizes)) {
            foreach ($sizes as $size) {
                Utils::createThumb($path, $source, $size);
            }
        }
    }
    
    public static function createThumbFilesProduct($source, $path, $thumb, $autoPath = true)
    {
        if ($autoPath)
            $path = Utils::uploadPath($path);

        if (!is_dir($path)) {
            @mkdir($path, 0777, true);
        }

        $sizes = $thumb;
        if (!empty($sizes)) {
            foreach ($sizes as $size) {
                Utils::createThumb($path, $source, $size);
            }
        }
    }

    /**
     * Delete original file and its thumb files
     */
    public static function deleteFiles($source, $path, $thumb = false)
    {
        $path = self::uploadPath($path);
        @unlink($path . '/' . $source);
        if (!empty($thumb)) {
            $sizes = Yii::app()->params['thumb'][$thumb];
            if (!empty($sizes)) {
                foreach ($sizes as $size) {
                    @unlink($path . '/' . $size . '/' . $source);
                }
            }
        }
    }

    /**
     * @desc remove folder
     * @param type $dir
     */
    public static function removeDir($dir, $rmRoot = true)
    {
        foreach (glob($dir . '/*') as $file) {
            if (is_dir($file))
                self::removeDir($file);
            else
                unlink($file);
        }
        if ($rmRoot)
            rmdir($dir);
    }

    /**
     *
     * Create a folder if it not exist
     * @param string $path
     */
    public static function mkdir($path)
    {
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
            chmod($path, 0777);
        }
    }
    
    /**
     *
     * Dump for test
     * @param string or array
     */
    public static function dump()
    {
        $args = func_get_args();
        foreach ($args as $k => $arg) {
            echo '<fieldset class="debug">';
            echo '<legend>' . ($k+1) . '</legend>';
            CVarDumper::dump($arg, 10, true);
            echo '</fieldset>';
        }
    }
    
    /**
     * @Author: Xuan Tinh Sep 23, 2014
     * Return string attribute product
     * @param object $attr  of attribute 
     * @param string $nameAttrCate  of table attribute
     */
    public static function genHtmlAttr($attr, $nameAttrCate)
    {
        $arrName = array();
        $arrVal = array();
        $hasGroup = false;
        $countItem = 0;
        foreach ($attr as $item) {
            if ($item->group_name != "") {
                $arrName[$item->group_name][] = $item->attribute->name;
                $arrVal[$item->group_name][] = $item->value;;
                $hasGroup = true;
            } else {
                $arrName[] = $item->attribute->name;
                $arrVal[] = $item->value;
            }
            $countItem++;
            
        }
        $html = "";
        $html .= "<table class='tbl-history tbl-detail'>";
            $html .= " <thead>";
                $html .= "<tr><th class='th-title' colspan='" . $countItem . "'>" . $nameAttrCate . "</td></tr>";
                $html .= " <tr>";
                    foreach ($arrName as $key => $val) {
                        if (is_array($val)) {
                            $html .= "<th colspan='" . count($val). "'>" . $key . "</th>";
                        } else {
                            if ($hasGroup) {
                                $html .= "<th rowspan='2'>" . $val . "</th>";
                            } else {
                                $html .= "<th>" . $val . "</th>";
                            }
                            
                        }
                    }
                $html .= "</tr>";
                if ($hasGroup) {
                    $html .= " <tr>";
                    foreach ($arrName as $key => $val) {
                        if (is_array($val)) {
                            foreach ($val as $name) {
                                $html .= "<th>" . $name . "</th>";
                            }
                        }
                    }
                    $html .= "</tr>";
                }
            $html .= " </thead>";
            $html .= "<tbody>";
                $html .= "<tr>";
                    foreach ($arrVal as $key => $val) {
                        if (is_array($val)) {
                            foreach ($val as $itemVal) {
                                $html .= "<td>" . $itemVal . "</td>";
                            }
                        } else {
                            $html .= "<td>" . $val . "</td>";
                        }
                        
                    }
                $html .= "</tr>";
            $html .= "</tbody>";
        $html .= "</table>";
        return $html;
    }
    
    /**
     * @Author: Xuan Tinh Sep 23, 2014
     * Return string attribute product
     * @param object $attr  of attribute 
     * @param string $nameAttrCate  of table attribute
     */
    public static function genEogSkuCode($product_item_id) {
        $string = StringHelper::getRandomString(6, 'numberUppercase');
        return 'EOG' . $string . $product_item_id;
    }
    
    /**
     * @Author: Xuan Tinh Sep 27, 2014
     * Return string slides product
     * @param interger $product_id 
     * @param string slides product
     */
    public static function genSlidesProductAdmin($product_id)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('product_id', $product_id);
        $criteria->order = "is_featured DESC";
        $proImg = ProductImage::model()->findAll($criteria);
        $html = '';
        if ($proImg) {
            $html .= '<div id="slider" class="flexslider">';
                $html .= '<ul class="slides">';
                $i = 1;
                foreach ($proImg as $val) {
                    $classActive = '';
                    if ($val->is_featured) {
                        $classActive = 'class="flex-active-slide"';
                    }
                    $imgUrl = Utils::uploadUrl('pds/' . $product_id . '/230x160/' . $val->image);
                    $html .=  '<li ' . $classActive . '><a href="#"><img width="220px" src="' . $imgUrl . '" alt=""/></a></li>';
                }
                $html .= '</ul>';
            $html .= '</div>';
            $html .= '<div id="carousel" class="flexslider">';
                $html .= '<ul class="slides">';
                foreach ($proImg as $val) {
                    $classActive = '';
                    if ($val->is_featured) {
                        $classActive = 'class="flex-active-slide"';
                    }
                    $imgUrl = Utils::uploadUrl('pds/' . $product_id . '/50x50/' . $val->image);
                    $html .=  '<li ' . $classActive . '><a href="#"><span class="hovethumb"></span><img src="' . $imgUrl . '" alt=""></a></li>';
                }
                $html .= '</ul>';
            $html .= '</div>';
        } else {
            $product = Product::model()->findById($product_id);
            if ($product && $product->category) {
                if ($product->category->image_thumb != "") {
                    $imgUrl = Utils::uploadUrl('category/' . $product->category->id . '/190x95/' . $product->category->image_thumb);
                    $html .=  '<img src="' . $imgUrl . '" alt=""/>';
                } else {
                    $html .= '<img src="' . Yii::app()->theme->baseUrl . '/img/img_230x160.png' . '" />';
                }
            } else {
                $html .= '<img src="' . Yii::app()->theme->baseUrl . '/img/img_230x160.png' . '" />';
            }
        }
        return $html;
    }
    
    /**
     * @Huu Thoa 15/10/2014
     * get image for slider popup
     * param: product_id
     */
    public static function getImageSliderProAdmin($product_id) {
        $product = Product::model()->findByPk($product_id);

        $photo_set = new PhotoSet();
        $image = ImageHelper::getImageUrl($photo_set, 'featureImage', 'thumb1');

        if($product) {
            $product_attr = EogProductItemAttribute::model()->findAllByAttributes(array('product_item_id' => $product->id));
            $attrIdArr = array();

            foreach($product_attr as $attr) {
                $attrIdArr[$attr->value] =  $attr->value;
            }

            $criteria = new CDbCriteria;
            $criteria->compare('category_id', $product->category_id);
            $criteria->addInCondition('attr_value', $attrIdArr);
            $category_attr_photo_set = EogCateAdminAttrPhoto::model()->find($criteria);

            if($category_attr_photo_set) { // check category attribute photo set exist
                $photo_set = PhotoSetDetail::findByPhotoSetId($category_attr_photo_set->photo_set_id);                
            }  else { // default category photo set
                $photo_set = PhotoSetDetail::findByPhotoSetId($product->category->photo_set_id);
            }
        }
        $html = '';
        $html .= '<div id="slider" class="flexslider">';
        $html .= '<ul class="slides">';
            foreach ($photo_set as $key => $val) {
                $classActive = '';
                if ($key == 0) {
                    $classActive = 'class="flex-active-slide"';
                }
                if (file_exists(Yii::getPathOfAlias("webroot").'/upload/photoset/'.$val->photo_set_id.'/230x160/'.$val->source)) {
                    $image = Utils::uploadUrl('photoset/'.$val->photo_set_id.'/230x160/'.$val->source);
                } else {
                    $image = Yii::app()->createAbsoluteUrl('upload/noimage/230x160.jpg');
                }
                $html .=  '<li ' . $classActive.'><a href="#"><img width="220px" src="' . $image . '" alt=""/></a></li>';
            }
        $html .= '</ul>';
        $html .= '</div>';
        $html .= '<div id="carousel" class="flexslider">';
        $html .= '<ul class="slides">';
            foreach ($photo_set as $key => $val) {   
                $classActive = '';
                if ($key == 0) {
                    $classActive = 'class="flex-active-slide"';
                }
                if (file_exists(Yii::getPathOfAlias("webroot").'/upload/photoset/'.$val->photo_set_id.'/50x50/'.$val->source)) {
                    $image = Utils::uploadUrl('photoset/'.$val->photo_set_id.'/50x50/'.$val->source);
                } else {
                    $image = Yii::app()->createAbsoluteUrl('upload/noimage/50x50.jpg');
                }
                $html .=  '<li ' . $classActive . '><a href="#"><span class="hovethumb"></span><img src="' . $image . '" alt=""></a></li>';
            }
        $html .= '</ul>';
        $html .= '</div>';
        return $html;
    }
    
    public static function getIpAddress()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (array_map('trim', explode(',', $_SERVER[$key])) as $ip) {
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
                return $_SERVER['REMOTE_ADDR'];
            }
        }
    }
    
    public static function getImageCate($model)
    {
        $html = "";
        if ($model->category) {
            $rootImage = "upload/category/" . $model->category_id . "/" . $model->category->image_thumb;
            if ($model->category->image_thumb != "" && file_exists($rootImage)) {
                $src = Yii::app()->createAbsoluteUrl($rootImage);
                $html .=  '<img width="230px" src="' . $src . '" alt=""/>';
            } else {
                $html .= '<img src="' . Yii::app()->theme->baseUrl . '/img/img_230x160.png' . '" />';
            }
        } else {
            $html .= '<img src="' . Yii::app()->theme->baseUrl . '/img/img_230x160.png' . '" />';
        }
        return $html;
    }
    
    public static function getImageSlider($product_item_id) {
        $product_item = ProductItems::model()->findByPk($product_item_id);
        $photo_set = new PhotoSet();
        $image = ImageHelper::getImageUrl($photo_set, 'featureImage', 'thumb1');
        
        $html = "";
        if($product_item) {
            $item_photo_set =  EogItemPhotoSet::model()->findByAttributes(array('product_item_id' => $product_item->id));
            $product_item_attr = EogProductItemAttribute::model()->findAllByAttributes(array('product_item_id' => $product_item->id));
            $attrIdArr = array();
            foreach($product_item_attr as $attr) {
                $attrIdArr[$attr->value] =  $attr->value;
            }
            $criteria = new CDbCriteria;
            $criteria->compare('category_id', $product_item->category_id);
            $criteria->addInCondition('attr_value', $attrIdArr);
            $category_attr_photo_set =  EogCateItemAttrPhoto::model()->find($criteria);

            if($item_photo_set) {// check eog photo set exist
                $photo_set = PhotoSetDetail::findByPhotoSetId($item_photo_set->photo_set_id);
            } else if($category_attr_photo_set) { // check category attribute photo set exist
                $photo_set =  PhotoSetDetail::findByPhotoSetId($category_attr_photo_set->photo_set_id);
            }  else { // default category photo set
                $photo_set = PhotoSetDetail::findByPhotoSetId($product_item->category->photo_set_id);
            }
        }

        
        $html .= '<div id="slider" class="flexslider">';
        $html .= '<ul class="slides">';
            foreach ($photo_set as $key => $val) {
                $classActive = '';
                if ($key == 0) {
                    $classActive = 'class="flex-active-slide"';
                }
                if (file_exists(Yii::getPathOfAlias("webroot").'/upload/photoset/'.$val->photo_set_id.'/230x160/'.$val->source)) {
                    $image = Utils::uploadUrl('photoset/'.$val->photo_set_id.'/230x160/'.$val->source);
                } else {
                    $image = Yii::app()->createAbsoluteUrl('upload/noimage/230x160.jpg');
                }
                $html .=  '<li ' . $classActive.'><a href="#"><img width="220px" src="' . $image . '" alt=""/></a></li>';
            }
        $html .= '</ul>';
        $html .= '</div>';
        $html .= '<div id="carousel" class="flexslider">';
        $html .= '<ul class="slides">';
            foreach ($photo_set as $key => $val) {   
                $classActive = '';
                if ($key == 0) {
                    $classActive = 'class="flex-active-slide"';
                }
                if (file_exists(Yii::getPathOfAlias("webroot").'/upload/photoset/'.$val->photo_set_id.'/50x50/'.$val->source)) {
                    $image = Utils::uploadUrl('photoset/'.$val->photo_set_id.'/50x50/'.$val->source);
                } else {
                    $image = Yii::app()->createAbsoluteUrl('upload/noimage/50x50.jpg');
                }
                $html .=  '<li ' . $classActive . '><a href="#"><span class="hovethumb"></span><img src="' . $image . '" alt=""></a></li>';
            }
        $html .= '</ul>';
        $html .= '</div>';
        return $html;
    }

}
