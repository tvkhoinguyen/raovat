<?php
$this->breadcrumbs=array(
	$this->singlelTitle . ' Management'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>$this->singlelTitle . ' Management', 'url'=>array('index')),
);

?>

<h1>Create <?php echo $this->singlelTitle;?></h1>
<?php echo $this->renderControlNav();?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>