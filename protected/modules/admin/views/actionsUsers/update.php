<?php
$this->breadcrumbs=array(
	'Actions Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$menus = array(	
        array('label'=>'ActionsUsers Management', 'url'=>array('index')),
	array('label'=>'View ActionsUsers', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Create ActionsUsers', 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1>Update ActionsUsers <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>