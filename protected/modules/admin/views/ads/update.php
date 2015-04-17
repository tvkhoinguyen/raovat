<?php
$this->breadcrumbs=array(
	'Ads Management'=>array('index'),
	'Update',
);

$menus=array(
    array('label'=>'Create Ads', 'url'=>array('create')),
    array('label'=>'View Ads', 'url'=>array('view', 'id'=>$model->id)),
    array('label'=>'Ads Management', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Update Ads</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>