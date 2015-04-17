<?php
$this->breadcrumbs = array(
	$this->pluralTitle => array('index'),
	'Create ' . $this->singlelTitle,
);

$this->menu = array(
	array('label' => $this->pluralTitle, 'url' => array('index'), 'icon' => $this->iconList),
);
?>

<h1>Create <?php echo $this->singlelTitle; ?></h1>
<?php
//for list action button
echo $this->renderControlNav();
?>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>