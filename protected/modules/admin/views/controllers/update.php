<?php
$this->breadcrumbs=array(
	'Controllers'=>array('index'),
	'Update',
);

$this->menu = array(	
	array('label' => $this->pluralTitle, 'url' => array('index'), 'icon' => $this->iconList),
	array('label' => 'View ' . $this->singleTitle, 'url' => array('view', 'id' => $model->id)),	
	array('label' => 'Create ' . $this->singleTitle, 'url' => array('create')),
);

?>

<h1>Update Controllers <?php echo $model->controller_name; ?></h1>
<?php echo $this->renderControlNav();?>
<?php echo $this->renderPartial('_form2', array('model'=>$model,)); ?>