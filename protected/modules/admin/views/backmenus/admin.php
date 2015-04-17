<?php
$this->breadcrumbs=array(
	'Manage Menu',
);

$menus=array(
	array('label'=>'Create Menu', 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('menus-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Menu</h1>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div> 
<!--search-form--> 
<?php echo $this->renderControlNav();?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'menus-grid',
	'dataProvider'=>$model->searchMenuTree(),
	//'filter'=>$model,
	'columns'=>array(
		//'id',
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
		
        array(
            'header' => 'Menu Name',
            'name' => "menu_name",
            'type' => 'html',
            'value' => '$data->level > 0 ? $data->buildLevelTreeCharacter($data->level) . $data->menu_name . "</span>": $data->menu_name'
        ),
		array(
            'header' => 'Menu Link',
			'name' => 'menu_link'
		),
        array(
			'header' => 'Displayed Order',
            'name'=>'display_order',
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),
		array(
			'header' => 'Visibled',
				'name'=>'show_in_menu',
				'value'=> '(!empty($data->show_in_menu) && $data->show_in_menu==1) ? "Yes" : "No"',
							'filter'=>array('1'=>'Yes','0'=>'No'),
				'htmlOptions' => array('style' => 'text-align:center;')
			),
		array(
			'class'=>'CButtonColumn',
            'template'=> ControllerActionsName::createIndexButtonRoles($actions),
		),
	),
)); ?>
