<?php
$this->breadcrumbs=array(
	'Newsletter Management'=>array('index'),
	$model->subject=>array('view','id'=>$model->id),
	'Update Newsletter',
);

$menus=array(
	array('label'=>'Newsletter Management', 'url'=>array('index')),
	array('label'=>'Create Newsletter', 'url'=>array('create')),
	array('label'=>'View Newsletter', 'url'=>array('view', 'id'=>$model->id)),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Update Newsletter  [<?php echo $model->subject; ?>]</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>