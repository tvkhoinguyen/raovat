<?php
$this->breadcrumbs=array(
	'Actions Roles'=>array('index'),
	'Create',
);

$menus = array(		
        array('label'=>'ActionsRoles Management', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Create ActionsRoles</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>