<?php
$this->breadcrumbs = array(
	$this->pluralTitle => array('index'),
	$model->first_name . " " . $model->last_name => array('view', 'id' => $model->id),
	'Update ' . $this->singlelTitle,
);

$this->menu = array(
	array('label' => $this->pluralTitle, 'url' => array('index'), 'icon' => $this->iconList),
	array('label' => 'View ' . $this->singlelTitle, 'url' => array('view', 'id' => $model->id)),
	array('label' => 'Create ' . $this->singlelTitle, 'url' => array('create')),
);
?>

<h1>Update <?php echo $this->singlelTitle; ?> [<?php echo $model->first_name . " " . $model->last_name; ?>]</h1>
<?php
//for list action button
echo $this->renderControlNav();
?>
<?php echo $this->renderPartial('_form', array('model' => $model)); ?>