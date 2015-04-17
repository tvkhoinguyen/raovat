<?php
$this->breadcrumbs=array(
	'Banner Ads Management',
);

$this->menu=array(
	array('label'=>'Create Banner Ads', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('banner-ads-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#banner-ads-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('banner-ads-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('banner-ads-grid');
        }
    });
    return false;
});
");
?>

<h1>Banner Ads Management</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'banner-ads-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
        array(
            'name'=>'place_holder',
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),
        array(
            'name'=>'image',
            'type' => 'html',
            'htmlOptions' => array('style' => 'text-align:center;'),
            'value'=> '!empty($data->image) ? CHtml::image(Yii::app()->baseUrl."/upload/bannerads/".$data->place_holder."/thumbs/".$data->image, "blum & frost"):"";'
        ),
		'link',
        array(
            'header'=>'Status',
            'type'=>'status',
            'htmlOptions' => array('style' => 'text-align:center;'),
            'value'=>'array("status"=>$data->status,"id"=>$data->id)',
        ),
//		'created_date',
//		'expired_date',
        array(
            'header'=>'Order',
            'class'=>'CButtonColumn',
            'buttons'=>array(
                'up'=>array(
                    'visible'=>'$data->order_display != Ads::minOrder($data->place_holder)',
                    'label'=>'Up',
                    'imageUrl'=>Yii::app()->theme->baseUrl . '/admin/images/up.gif',
                    'url'=>'Yii::app()->createUrl("admin/bannerads/up",array("id"=>$data->id,"place_holder"=>$data->place_holder))',
                    'options'=>array(
                        "class"=>"ajaxupdate",
                    ),
                    /*'ajax'=>'
                      array(
                        "url"=>Yii::app()->createUrl("banner/reposition"),
                        "data"=>array("id"=>$data->id,"direction"=>"up",),
                        "update"=>"#banner-grid"
                      )',*/
                ),
                'down'=>array(
                    'visible'=>'$data->order_display != Ads::maxOrder($data->place_holder)',
                    'label'=>'Down',
                    'imageUrl'=>Yii::app()->theme->baseUrl . '/admin/images/down.gif',
                    'url'=>'Yii::app()->createUrl("admin/bannerads/down",array("id"=>$data->id,"place_holder"=>$data->place_holder))',
                    'options'=>array(
                        "class"=>"ajaxupdate",
                    ),
                ),
            ),
            'template'=> '{up} {down}',
        ),
		array(
			'class'=>'CButtonColumn',
            'buttons'=>array(
                'delete'=>array(
                    'visible'=>'$data->id != 1 && $data->id != 7',
                ),

            )
		),
	),
)); ?>
