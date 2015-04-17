<?php
$this->breadcrumbs=array(
	$this->pluralTitle => array('index'),
	'Create ' . $this->singleTitle,
);

$this->menu = array(		
        array('label'=> $this->pluralTitle, 'url'=>array('index'), 'icon' => $this->iconList),
);

?>

<h1>Create <?php echo $this->singleTitle; ?></h1>

<?php
//for notify message
$this->renderNotifyMessage();
//for list action button
echo $this->renderControlNav();
?><?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
