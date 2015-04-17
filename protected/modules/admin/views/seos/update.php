<?php
$this->breadcrumbs = array(
	$this->pluralTitle . ' Management' => array('index'),
	'Update ' . $this->singleTitle,
);

$this->menu = array(	
	array('label' => $this->pluralTitle . ' Management', 'url' => array('index')),
	array('label' => 'View ' . $this->singleTitle, 'url' => array('view', 'id' => $model->id)),	
	array('label' => 'Create ' . $this->singleTitle, 'url' => array('create')),
);
?>

<h1>Update <?php echo $this->singleTitle . ': ' . $title_name; ?></h1>

<?php
//for list action button
echo $this->renderControlNav();
?><?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
