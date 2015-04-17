<?php
$this->breadcrumbs=array(
	'Actions Roles'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$menus = array(	
        array('label'=>'ActionsRoles Management', 'url'=>array('index')),
	array('label'=>'View ActionsRoles', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Create ActionsRoles', 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1>Update ActionsRoles <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>