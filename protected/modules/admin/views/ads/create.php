<?php
$this->breadcrumbs=array(
    'Ads Management'=>array('index'),
    'Create',
);

$menus=array(
    array('label'=>'Ads Management', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Create Ads</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>