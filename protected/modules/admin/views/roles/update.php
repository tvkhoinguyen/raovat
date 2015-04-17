<?php
/**
 * VerzDesignCMS
 * 
 * LICENSE
 *
 * @copyright	Copyright (c) 2012 Verz Design (http://www.verzdesign.com)
 * @version 	$Id: update.php 2012-06-01 09:09:18 nguyendung $
 * @since		1.0.0
 */
?>
<?php
$this->breadcrumbs=array(
	'Roles'=>array('index'),
	//$model->role_name=>array('view','id'=>$model->id),
	'Update',
);

$menus=array(
	array('label'=>'Manage Roles', 'url'=>array('index')),
	array('label'=>'Create Roles', 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1>Update Roles: <?php echo $model->role_name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>