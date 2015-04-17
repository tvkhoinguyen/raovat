<?php
$this->breadcrumbs=array(
	'Image Examples'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$menus = array(	
        array('label'=>'ImageExample Management', 'url'=>array('index')),
	array('label'=>'View ImageExample', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Create ImageExample', 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1>Update ImageExample <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>