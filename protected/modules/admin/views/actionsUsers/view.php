<?php
$this->breadcrumbs=array(
	'Actions Users'=>array('index'),
	$model->id,
);

$menus = array(
	array('label'=>'Create ActionsUsers', 'url'=>array('create')),
	array('label'=>'Update ActionsUsers', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ActionsUsers', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View ActionsUsers #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'action_id',
		'can_access',
	),
)); ?>
