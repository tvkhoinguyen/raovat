<?php
class RaoVatKhacWidget extends CWidget
{
    public $list_khac;
    public function run()
    {        
        $list_khac = $this->list_khac;

        $this->render( 'widget_rao_vat_khac' ,array(
            'list_khac'=>$list_khac
        ));
    }
}