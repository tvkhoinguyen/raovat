<?php
$this->breadcrumbs=array(
	'Image Examples'=>array('index'),
	$model->name,
);

$menus = array(
	array('label'=>'Create ImageExample', 'url'=>array('create')),
	array('label'=>'Update ImageExample', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ImageExample', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View Image Example #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'image1',
		'image2',
		'image3',
	),
)); ?>