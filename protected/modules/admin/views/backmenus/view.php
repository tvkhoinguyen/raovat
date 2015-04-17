<?php
$this->breadcrumbs=array(
	'Manage Menu'=>array('index'),
	$model->menu_name,
);

$menus=array(
	array('label'=>'List Menu', 'url'=>array('index')),
	array('label'=>'Create Menu', 'url'=>array('create')),
	array('label'=>'Update Menu', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Menu', 'url'=>'delete', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View Menu: <?php echo $model->menu_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'menu_name',
		'menu_link',
		'display_order',
		array(
			'name'=>'show_in_menu',
			'value'=>(!empty($model->show_in_menu) && $model->show_in_menu==1) ? 'Yes' : 'No',
		),
		array(
            'name'=>'application',
            'value'=>$model->application->application_name,
        ),
        array(
            'name'=>'roles',
            'type'=>'raw',
            'value'=>$sRoles,
        ),
	array(
            'name'=>'parent',
            'value'=>(!is_null(Menus::model()->findByPk($model->parent_id))?Menus::model()->findByPk($model->parent_id)->menu_name:''),
        ),
	),
)); ?>
