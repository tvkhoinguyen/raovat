<?php
$this->breadcrumbs=array(
	'Manage Menu'=>array('index'),
	$model->menu_name=>array('view','id'=>$model->id),
	'Update',
);

$menus=array(
	array('label'=>'List Menu', 'url'=>array('index')),
	array('label'=>'Create Menu', 'url'=>array('create')),
	array('label'=>'View Menu', 'url'=>array('view', 'id'=>$model->id)),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Update Menu:  <?php echo $model->menu_name; ?></h1>
<?php echo $this->renderControlNav();?>
<?php echo $this->renderPartial('_form', array('model'=>$model, 'roles' => $roles, 'selectedRoles' => $selectedRoles)); ?>