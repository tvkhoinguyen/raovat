<?php
/**
 * @author bb  <quocbao1087@gmail.com>
 * @copyright (c) 19/6/2013, bb Verz Design
 */
class Ads extends CWidget
{    
//    public $assets;
    public $place_holder_id;//place holder id
    public $width;
    public $height;
    public $status;
        
    public function init() {
            parent::init();
//            $this->assets =  Yii::app()->getAssetManager()->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.'assets');
    }

    public function run()
    {  
//                $mBanner = PrecAdvertise::model()->findAll('status='.$this->status.' AND show_banner = 1');
                $mBanner = PrecAdvertise::model()->findAll('status='.$this->status.' AND DATE(start_date) <= "'.date('Y-m-d').'" AND DATE(end_date) >= "'.date('Y-m-d').'"');
                $this->render('ads',array(
//                    'assets' =>$this->assets,
                    'mBanner' =>$mBanner,
                    'width'=>$this->width,
                    'height'=>$this->height,
                    ));
    }    
}








