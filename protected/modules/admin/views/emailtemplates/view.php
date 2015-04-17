<?php
$this->breadcrumbs = array(
	$this->singlelTitle . ' Management' => array('index'),
	$model->email_subject,
);

$this->menu = array(
	array('label' => $this->singlelTitle . ' Management', 'url' => array('index')),
	array('label' => 'Update ' . $this->singlelTitle, 'url' => array('update', 'id' => $model->id)),
);

?>

<h1>View <?php echo $this->singlelTitle?>: <?php echo $model->email_subject; ?></h1>
<?php 
$this->renderNotifyMessage(); 
echo $this->renderControlNav();
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="glyphicon glyphicon-list-alt"></span> View <?php echo $this->singlelTitle?></h3>
	</div>
	<div class="panel-body">
		<?php
		$this->widget('zii.widgets.CDetailView', array(
			'data' => $model,
			'attributes' => array(
				'email_subject',
				'email_body:html',
				'parameter_description',
			),
		));
		?>
		<div class="well">
			<?php echo CHtml::htmlButton('<span class="glyphicon glyphicon-arrow-left"></span> Back', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\''.  $this->baseControllerIndexUrl() . '\'')); ?>
		</div>
	</div>
</div>