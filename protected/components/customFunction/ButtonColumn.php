<?php
/**
 * ButtonColumn class file.
 * Extends {@link CButtonColumn}
 * 
 * Allows additional evaluation of ID in options.
 * 
 * @version $Id$
 * Article: http://www.yiiframework.com/wiki/372/cbuttoncolumn-use-special-variable-data-for-the-id-in-the-options-of-a-button/
 * ************ HOW TO USE ********
 * array(  'class'=>'ButtonColumn',
    'template'=>'{myButton}',
    'evaluateID'=>true,
    'buttons'=>array(
        'myButton'=>array(
            'label'=>'My Button',
            'url'=>'Yii::app()->createUrl("site/doStuff", array("id"=>$data->id))',
            'options'=>array(
                'id'=>'\'button_for_id_\'.$data->id',
            ),
        ),
    ),
),
 * 
 */
class ButtonColumn extends CButtonColumn
{
    /**
     * @var boolean whether the ID in the button options should be evaluated.
     */
    public $evaluateID = false;
 
    /**
     * Renders the button cell content.
     * This method renders the view, update and delete buttons in the data cell.
     * Overrides the method 'renderDataCellContent()' of the class CButtonColumn
     * @param integer $row the row number (zero-based)
     * @param mixed $data the data associated with the row
     */
    public function renderDataCellContent($row, $data)
    {
        $tr=array();
        ob_start();
        
        foreach($this->buttons as $id=>$button)
        {
            if($this->evaluateID and isset($button['options']['id'])) 
            {
                $button['options']['id'] = $this->evaluateExpression($button['options']['id'], array('row'=>$row,'data'=>$data));
            }
 
            $this->renderButton($id,$button,$row,$data);
            $tr['{'.$id.'}']=ob_get_contents();
            ob_clean();
        }
        ob_end_clean();
        echo strtr($this->template,$tr);
    }
}

?>