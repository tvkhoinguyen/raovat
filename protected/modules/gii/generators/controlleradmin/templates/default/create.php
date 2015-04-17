<?php echo "<?php\n"; ?>
$this->breadcrumbs=array(
	<?php echo '$this->pluralTitle'; ?> => array('index'),
	'Create ' . <?php echo '$this->singleTitle'; ?>,
);

$this->menu = array(		
        array('label'=> <?php echo '$this->pluralTitle'; ?> , 'url'=>array('index'), 'icon' => $this->iconList),
);

?>

<h1>Create <?php echo '<?php echo $this->singleTitle; ?>'; ?></h1>
<?php echo "
<?php
//for notify message
\$this->renderNotifyMessage(); 
//for list action button
echo \$this->renderControlNav();
?>";?>
<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>

