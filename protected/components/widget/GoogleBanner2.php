<?php
class GoogleBanner2 extends CWidget
{
    public $list_khac;
    public function run()
    {        
        // $list_khac = $this->list_khac;

        $this->render( 'google_banner2' ,array(
            // 'list_khac'=>$list_khac
        ));
    }
}