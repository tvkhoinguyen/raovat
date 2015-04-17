<?php
$this->breadcrumbs=array(
    'Newsletter Management'=>array('newsletter/'),
    'Create Newsletter'
);

$menus=array(
    array('label'=>'Newsletter Management', 'url'=>array('newsletter/')),    
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Create Newsletter</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>