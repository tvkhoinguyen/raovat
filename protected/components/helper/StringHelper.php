<?php
/**
 * bb
 * Class for handle string
 */
class StringHelper
{
    public static function getMenuFooterHtml($id, $name='', $number=0)
    {
        $html = '';
        $one = CategoryTin::model()->findByPk($id); 
        if(!empty($one))
        {
            $html .= '<ul class="ulBlockMenu">
                        <li class="liFirst">
                           <h2>
                              <a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('p_slug'=>$one->slug, 'c_slug'=>'')).'">'.$one->name.'</a>
                           </h2>
                        </li>';
            $criteria = new CDbCriteria();
            $criteria->compare('t.status',STATUS_ACTIVE);
            $criteria->addCondition('t.parent_id = '.$one->id);
            // $criteria->order ="id DESC";
            $models = CategoryTin::model()->findAll($criteria);
            if(!empty($models))
            {
                $i=0;
                foreach ($models as $tmp) 
                {
                    if(empty($tmp)) continue;
                    $i++;
                    $html.='<li class="liFollow">
                               <h2><a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('p_slug'=>$one->slug, 'c_slug'=>$tmp->slug)).'">'.$tmp->name.'</a></h2>
                            </li>';
                }
                if($i<$number)
                {
                    for($x=$i; $x<$number; $x++)
                        $html.='<li class="liFollow">
                               <h2><a href=""></a></h2>
                            </li>';
                }
            }
            $html .= '</ul>';
        }
        return $html;
    }

    public static function xml_to_array($root) {
        $result = array();

        if ($root->hasAttributes()) {
            $attrs = $root->attributes;
            foreach ($attrs as $attr) {
                $result['@attributes'][$attr->name] = $attr->value;
            }
        }

        if ($root->hasChildNodes()) {
            $children = $root->childNodes;
            if ($children->length == 1) {
                $child = $children->item(0);
                if ($child->nodeType == XML_TEXT_NODE) {
                    $result['_value'] = $child->nodeValue;
                    return count($result) == 1
                        ? $result['_value']
                        : $result;
                }
            }
            $groups = array();
            foreach ($children as $child) {
                if (!isset($result[$child->nodeName])) {
                    $result[$child->nodeName] = xml_to_array($child);
                } else {
                    if (!isset($groups[$child->nodeName])) {
                        $result[$child->nodeName] = array($result[$child->nodeName]);
                        $groups[$child->nodeName] = 1;
                    }
                    $result[$child->nodeName][] = xml_to_array($child);
                }
            }
        }

        return $result;
    }
    public static function  parseXml($data) 
    {
      $xml_parser = xml_parser_create();
      xml_parse_into_struct($xml_parser, $data, $vals, $index);
      xml_parser_free($xml_parser);
      $params = array();

      echo '<pre>';
      print_r($vals);
      echo '</pre>';

      foreach ($vals as $xml_elem) {
       if ($xml_elem['type'] == 'complete' && $xml_elem['level'] == '1') {
        $params[$xml_elem['tag']] = $xml_elem['value'];
       }
      }
      return $params;
     }

    public static function arrToString($arr)
    {
        if(!empty($arr))
        {
            
        }
    }
    public static function getMenuHtml($id)
    {
        $html = '';
        $one = CategoryTin::model()->findByPk($id); 
        if(!empty($one))
        {
            $html .= '<li><a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('p_slug'=>$one->slug, 'c_slug'=>'')).'">'.$one->name.'</a>';
            $criteria = new CDbCriteria();
            $criteria->compare('t.status',STATUS_ACTIVE);
            $criteria->addCondition('t.parent_id = '.$one->id);
            // $criteria->order ="id DESC";
            $models = CategoryTin::model()->findAll($criteria);
            if(!empty($models))
            {
                $html .= '<ul>';
                foreach ($models as $tmp) 
                {
                    if(empty($tmp)) continue;
                    $html .= '<li><a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('p_slug'=>$one->slug, 'c_slug'=>$tmp->slug)).'">'.$tmp->name.'</a></li>';
                }
                if($id==2)
                {
                    // $html .= '<li><a href="'.Yii::app()->createAbsoluteUrl('site/getListTin', array('type'=>'vnexpress')).'">Từ VnExpress</a></li>';
                    $html .= '<li><a href="'.Yii::app()->createAbsoluteUrl('site/getListTin', array('type'=>'bbc')).'">Từ BBC</a></li>';
                    $html .= '<li><a href="'.Yii::app()->createAbsoluteUrl('site/getListTin', array('type'=>'rfi')).'">Từ RFI</a></li>';
                    // $html .= '<li><a href="'.Yii::app()->createAbsoluteUrl('site/getListTin', array('type'=>'vov')).'">Từ VOV</a></li>';
                }
                $html .= '</ul>';
            }
            $html .= '</li>';
        }


        return $html;
    }
    /**
     * bb
   * TEMP
   * need to code more
   */

    /**
     * trims text to a space then adds ellipses if desired
     * @param string $str text to trim
     * @param int $length in characters to trim to
     * @param bool $ellipses if ellipses (...) are to be added
     * @param bool $strip_html if html tags are to be stripped
     * @return string
     */
    public static function createShort($str, $length, $ellipses = true, $strip_html = true)
    {
        //strip tags, if desired
        if ($strip_html) {
            $str = strip_tags($str);
        }

        if(strlen($str) <= $length) return $str;

        $shortStr = trim(substr($str, 0 , $length - 3));

        //add ellipses (...)
        if ($ellipses) {
            $shortStr = trim($shortStr).'...';
        }

        return $shortStr;
    }
    
    public static function createShortEnd($str, $length)
    {
        if(strlen($str) <= $length) return $str;

        $shortStr = substr($str, -$length , $length);        
        return '..'.$shortStr;
    }
    
    /*
     * bb
     * get segment of url by position
     * example:
     * http://code.local/hansproperty/category/commercial
     * 1-> hansproperty
     */
    
    public static function getSegmentOfUrl($position)
    {
        $aSegment = explode('/', str_replace(Yii::app()->baseUrl, '', Yii::app()->request->requestUri));
        if(isset($aSegment[$position]))
            return $aSegment[$position];
        return '';
    }
    
    /**
     * 
     * @param int $id id in table
     * @param char $char
     * @param int $length length of generated string
     * @param string $prefix prefix add to first of generated string
     * @return string
     * 
     * @example  
     *          Input   : genId(789, '0', 6)
     *          Output  : 000789
     * 
     *          Input   : genId(789, '0', 8, 'S-')
     *          Output  : S-000789
     * 
     * 
     * @author bb  <quocbao1087@gmail.com>
     * @copyright (c) 26/6/2013, bb Verz Design
     */
    public static function genId($id, $char = '0', $length = 8, $prefix = '')
    {
        $result = $id;
        $idLength = strlen($id);
        if($idLength < $length)
        {
            $result = $prefix.self::genNumberOfCharacters($char, $length - $idLength).$id;           
        }
        return $result;
    }
    
    /**
     * Add random string before given id
     * 99 -> LKCUA99
     * 
     * @param int $id
     * @param int $length
     * @param string $type: all, alphabet, uppercase, lowercase, number
     * @return string random string end with $id
     * @copyright (c) 9/6/2013, bb 
     * @author bb  <quocbao1087@gmail.com>
     */
    public static function genRandomWithId($id, $length = 8, $type = 'uppercase')
    {
        $result = $id;
        $strLength = strlen($id);
        if($strLength < $length)
            $result = self::getRandomString($length - $strLength, $type).$result;
        return $result;
    }
    
    public function genNumberOfCharacters($char, $length)
    {
        $result = '';
        for($i = 0;  $i< $length; $i ++)
        {
            $result .= $char;
        }
        return $result;
    }
    /*
     * bb
     */
    //additional function, 
    public static function genPhoneFormat($str) //from 0902244581 to 090-224-xxxx
    {
        $aNumbers = str_split($str);
        
        $result = '';
        $index = 0;
        for($i = count($aNumbers) - 1 ; $i >= 0; $i--)
        {
           $index++;
            
           if($index <= 4)
           {
                $result = 'x'.$result; 
                if($index == 4)
                    $result = '-'.$result;
                           
           }else
           {
               $result = $aNumbers[$i].$result;
               if($index == 7)
                  $result = '-'.$result; 
           }
        }
        return $result;
    }
    
    /**
     * 
     * @param int $length
     * @param string $type: all, alphabet, uppercase, lowercase, number
     * @return string random
     * @copyright (c) 9/6/2013, bb
     * @author bb  <quocbao1087@gmail.com>
     */
    public static function getRandomString($length = 8, $type = 'all') 
    {
        if($type == 'all')
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        elseif($type == 'alphabet')
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        elseif($type == 'uppercase')
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        elseif($type == 'lowercase')
            $characters = 'abcdefghijklmnopqrstuvwxyz';
        elseif($type == 'number')
            $characters = '0123456789';
        elseif($type == 'uppercase_number')
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        
        $string = '';

        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
        return $string;
    }
	
	/**
     * 
     * @param string $sString
     * @param int $iLength
     * @param boolean $bReturnArray
     * @return string OR array
     * @copyright (c) 9/10/2013, bb
     */
    public static function limitStringLength($sString, $iLength = 500, $bReturnArray = false)
    {
        $aResult = array('sContent'=>$sString,
                        'bShowMore'=>false
            );
        $sString = strip_tags($sString);
        if (strlen($sString) > $iLength) 
        {
            // truncate string
            $stringCut = substr($sString, 0, $iLength);

            // make sure it ends in a word so assassinate doesn't become ass...
            $sString = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
            $aResult['sContent'] = $sString;
            $aResult['bShowMore'] = true;
        }
        if($bReturnArray)
            return $aResult;
        return $sString;
    }

    // validate a string before insert to database
    public static function toRegularString($string)
    {
        if (!is_string($string))
            return null;
        return mysql_real_escape_string($string);
    }

    public static function replaceInputValue($strInput)
    {
        $result = '';
        if(empty($strInput)){
            $result = '';
            return $result;
        } else
        {
            $badWords = array("/delete/", "/update/","/union/","/insert/","/drop/","/http/","/--/");
            $result = preg_replace($badWords, "", $strInput);
            $result = addslashes($result);
            $result = preg_replace('/\s\s+/', ' ', trim($result));  //Strip off multiple spaces between the sentence, making it like "Hello Ms Van"
            $result = preg_replace('%(#|;|{}=(//)).*%','',$result);
            $result = preg_replace('%/\*(?:(?!\*/).)*\*/%s','',$result); // google for negative lookahead
            $result = preg_replace('/^[\-]+/','',$result); // Strip off the starting hyphens
            $result = preg_replace('/[\-]+$/','',$result); // // Strip off the ending hyphens
            $result = strtolower($result);

            return $result;
        }
    }

    /*
    * to make slug (url string)
    */
    public static function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        // trim
        $text = trim($text, '-');
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // lowercase
        $text = strtolower($text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        if (empty($text))
        {
            return 'n-a';
        }
        return $text;
    }

}
