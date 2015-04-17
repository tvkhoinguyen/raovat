<?php
$this->breadcrumbs=array(
	'Update',
);

$menus = array(	
        array('label'=>'Role Privileges', 'url'=>array('group')),
        array('label'=>'User Privileges', 'url'=>array('user')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1>Update Controllers <?php echo $model->controller_name; ?></h1>
<?php echo $this->renderControlNav();?>
<?php echo $this->renderPartial('_form2', array('model'=>$model,)); ?>