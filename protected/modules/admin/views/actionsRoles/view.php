<?php
$this->breadcrumbs=array(
	'Actions Roles'=>array('index'),
	$model->id,
);

$menus = array(
	array('label'=>'Create ActionsRoles', 'url'=>array('create')),
	array('label'=>'Update ActionsRoles', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ActionsRoles', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View ActionsRoles #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'roles_id',
		'action_id',
		'can_access',
	),
)); ?>
