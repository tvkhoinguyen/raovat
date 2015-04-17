<?php
$this->breadcrumbs=array(
	'Controllers'=>array('index'),
	'Create',
);

$menus=array(
	array('label'=>'Contollers', 'url'=>array('index'), 'icon' => $this->iconList),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Create Controllers</h1>
<?php echo $this->renderControlNav();?>
<?php echo $this->renderPartial('_form2', array('model'=>$model)); ?>