<?php
class RaoVatHotWidget extends CWidget
{
    public $list_hot;
    public function run()
    {    
        $list_hot = $this->list_hot;
        $this->render( 'widget_rao_vat_hot' ,array(
            'list_hot'=>$list_hot,
        ));
    }
}