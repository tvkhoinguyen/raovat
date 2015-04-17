<?php
$this->breadcrumbs=array(
	'Controllers'=>array('index'),
	$model->id,
);

$menus=array(
	array('label'=>'Group Privileges', 'url'=>array('group')),
        array('label'=>'User Privileges', 'url'=>array('user')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View Controllers #<?php echo $model->controller_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(		
		'controller_name',
		'module_name',
		'actions',
	),
)); ?>
