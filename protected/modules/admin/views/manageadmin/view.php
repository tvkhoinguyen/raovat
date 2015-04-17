<?php
$this->breadcrumbs=array(
	$this->pluralTitle =>array('index'),
    $model->full_name,
);

$menus=array(
	array('label'=>$this->pluralTitle, 'url'=>array('index'), 'icon' => $this->iconList),
	array('label'=>'Create ' . $this->singlelTitle, 'url'=>array('create')),
	array('label'=>'Update ' . $this->singlelTitle, 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ' . $this->singlelTitle, 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View <?php echo $this->singlelTitle; ?>: <?php echo $model->full_name; ?></h1>
<?php
//for list action button
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
		'data'=>$model,
		'attributes'=>array(
			'username',
			'email',
			array(
				'name' => 'Full Name',
				'type'=>'raw',
				'value'=>$model->full_name
			),
			'phone',
		
			array(
				'name' => 'created_date',
				'type'=>'datetime',
			),
			array(
				'name' => 'last_logged_in',
				'type'=>'datetime',
			),


			//'ip_address',
			'status:status',
		),
	)); ?>
	<div class="well">
		<?php echo CHtml::htmlButton('<span class="' . $this->iconBack . '"></span> Back', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\''.  $this->baseControllerIndexUrl() . '\'')); ?>
	</div>
	</div>
</div>