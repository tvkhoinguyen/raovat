<?php
$this->breadcrumbs=array(
	$this->pluralTitle . ' Management' => array('index'),
	'Create ' . $this->singleTitle,
);

$this->menu = array(		
        array('label'=> $this->pluralTitle . ' Management', 'url'=>array('index')),
);

?>

<h1>Create <?php echo $this->singleTitle; ?></h1>

<?php
//for list action button
echo $this->renderControlNav();
?><?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
