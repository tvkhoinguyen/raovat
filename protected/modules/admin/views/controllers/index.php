<?php
$this->breadcrumbs=array(
	'Controllers',
);

$menus=array(
	array('label'=>'Create Controllers', 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('controllers-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#controllers-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('controllers-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('controllers-grid');
        }
    });
    return false;
});
");
?>

<h1>List Controllers</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php echo $this->renderControlNav();?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'controllers-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;width:10%;')
        ),		
		
		array(
			'name' => 'controller_name',
			'htmlOptions' => array('style' => 'width:40%;')
		),
		array(
			'name' => 'module_name',
			'htmlOptions' => array('style' => 'width:40%;')
		),
		array(
			'class'=>'CButtonColumn',
			//'template'=> ControllerActionsName::createIndexButtonRoles($actions),
			'htmlOptions' => array('style' => 'width:20%;')
		),
	),
)); ?>
