<?php
$this->breadcrumbs=array(
	'Image Examples'=>array('index'),
	'Create',
);

$menus = array(		
        array('label'=>'ImageExample Management', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Create ImageExample</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>