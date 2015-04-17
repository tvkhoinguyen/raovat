<?php
$this->breadcrumbs=array(
	'Actions Users'=>array('index'),
	'Create',
);

$menus = array(		
        array('label'=>'ActionsUsers Management', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Create ActionsUsers</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>