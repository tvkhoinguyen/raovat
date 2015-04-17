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
	'Applications'=>array('index'),
	$model->application_name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Applications', 'url'=>array('index')),
	array('label'=>'Create Applications', 'url'=>array('create')),
	array('label'=>'View Applications', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Applications', 'url'=>array('admin')),
);
?>

<h1>Update Applications: <?php echo $model->application_name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>