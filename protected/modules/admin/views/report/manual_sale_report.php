<style type="text/css">
    .errorMessage
    {
        color: red !important;
    }
</style>
<?php 
$this->breadcrumbs = array(
	$this->pluralTitle,
);
$this->menu = array(
	array('label'=>'Create ' . $this->singleTitle, 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    
});

$('#clearsearch').click(function(){
    var id='search-form';
    var inputSelector='#'+id+' input, '+'#'+id+' select';
    $(inputSelector).each( function(i,o) {
         $(o).val('');
    });
    var data=$.param($(inputSelector));
    $.fn.yiiGridView.update('orders-grid', {data: data});
    return false;
});

$('.deleteall-button').click(function(){
        
});

");

Yii::app()->clientScript->registerScript('ajaxupdate', "
    $('#orders-grid a.ajaxupdate').live('click', function() {
        return false;
    });
");

?>

<h1><?php echo $this->pluralTitle; ?></h1>
<?php
$this->renderPartial('_form_search_manual',array(	'model' => $search, )); 
?>

<?php if ($search->type != "") { ?>
    <div class="navbar-right">
        <div class="btn-group btn-group-sm">
            <a href="<?php echo Yii::app()->createAbsoluteUrl('admin/report/exportManualSale', array('type' => $search->type, 'from' => DateHelper::toDbDateFormat($search->date_from), 'to' => DateHelper::toDbDateFormat($search->date_to))); ?>" class=" btn btn-default">
                Export 
            </a>
        </div>
    </div>
    <div class="clr"></div>
<?php } ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="<?php echo $this->iconList; ?>"></span> Listing</h3>
    </div>
    <div class="panel-body">
        <?php
        if ($search->type != "") {
            $columnArray = array();
            $columnArray = array_merge($columnArray, array(
                array(
                    'header' => 'S/N',
                    'type' => 'raw',
                    'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                    'headerHtmlOptions' => array('width' => '30px', 'style' => 'text-align:center;'),
                    'htmlOptions' => array('style' => 'text-align:center;')
                ),
                array(
                    'header' => 'Date',
                    'name' => 'dateReport',
                    'type' => 'dateManualReport',
                    'htmlOptions' => array('style' => 'text-align:center;')
                ),
                array(
                    'header' => 'Total Sale',
                    'type' => 'price',
                    'name' => 'totalSale',
                    'htmlOptions' => array('style' => 'text-align:center;')
                ),
                array(
                    'header' => 'Total Seller\'s Cost',
                    'type' => 'price',
                    'name' => 'totalSellerCost',
                    'htmlOptions' => array('style' => 'text-align:center;')
                ),
                array(
                    'header' => 'Total Markup',
                    'type' => 'price',
                    'name' => 'totalMarkup',
                    'htmlOptions' => array('style' => 'text-align:center;')
                ),
                array(
                    'header' => 'Total Shiping Charge',
                    'type' => 'price',
                    'name' => 'totalShip',
                    'htmlOptions' => array('style' => 'text-align:center;')
                ),

            ));
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'orders-grid-bulk',
                'enableAjaxValidation' => false,
                'htmlOptions' => array('enctype' => 'multipart/form-data')));

            $this->renderNotifyMessage();

            if(!empty($dataProvider))
            {
                $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'orders-grid',
                    'dataProvider' => $dataProvider,
                    'pager' => array(
                        'header' => '',
                        'prevPageLabel' => 'Prev',
                        'firstPageLabel' => 'First',
                        'lastPageLabel' => 'Last',
                        'nextPageLabel' => 'Next',
                    ),
                    'selectableRows' => 2,
                    'columns' => $columnArray,
                ));
                
            }/*else{
                $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'orders-grid',
                    'dataProvider' => new CArrayDataProvider( array() ),
                    'pager' => array(
                        'header' => '',
                        'prevPageLabel' => 'Prev',
                        'firstPageLabel' => 'First',
                        'lastPageLabel' => 'Last',
                        'nextPageLabel' => 'Next',
                    ),
                    'selectableRows' => 2,
                    'columns' => $columnArray,
                ));
                $this->endWidget();
            }*/

            $this->endWidget();
        }
        ?>
