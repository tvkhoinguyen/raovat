<?php
/**
 * VerzDesignCMS
 * 
 * LICENSE
 *
 * @copyright	Copyright (c) 2012 Verz Design (http://www.verzdesign.com)
 * @version 	$Id: create.php 2012-06-01 09:09:18 nguyendung $
 * @since		1.0.0
 */
?>
<?php
$this->breadcrumbs=array(
	'Roles'=>array('index'),
	'Create',
);

$menus=array(
	array('label'=>'Manage Roles', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>


<h1>Create Roles</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>