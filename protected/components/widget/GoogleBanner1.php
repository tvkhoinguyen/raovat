<?php
class GoogleBanner1 extends CWidget
{
    public $list_hot;
    public function run()
    {    
        // $list_hot = $this->list_hot;
        $this->render( 'google_banner1' ,array(
            // 'list_hot'=>$list_hot,
        ));
    }
}