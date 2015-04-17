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
	'Applications'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Applications', 'url'=>array('index')),
	array('label'=>'Manage Applications', 'url'=>array('admin')),
);
?>

<h1>Create Applications</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>