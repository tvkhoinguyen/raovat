<?php
$this->breadcrumbs = array(
	$this->pluralTitle => array('index'),
	'View ' . $this->singleTitle . ' : ' . $title_name,
);

$this->menu = array(
	array('label' => $this->pluralTitle . ' Management', 'url' => array('index'), 'icon' => $this->iconList),
	array('label' => 'Update ' . $this->singleTitle, 'url' => array('update', 'id' => $model->id)),
	array('label' => 'Create ' . $this->singleTitle, 'url' => array('create')),
);
?>
<h1>View <?php echo $this->singleTitle . ' : ' . $title_name; ?></h1>

<?php
//for list action button
$this->renderNotifyMessage();
echo $this->renderControlNav();
?><div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="glyphicon glyphicon-list-alt"></span> View <?php echo $this->singleTitle ?></h3>
	</div>
	<div class="panel-body">
		<?php
		$this->widget('zii.widgets.CDetailView', array(
			'data' => $model,
			'attributes' => array(
				'title',
//				array(
//					'name' => 'short_content',
//					'type' => 'html',
//				),
				array(
					'name' => 'content',
					'type' => 'html',
				),
				array(
					'name' => 'title_tag',
					'type' => 'html',
				),
				array(
					'name' => 'meta_keywords',
					'type' => 'html',
				),
				array(
					'name' => 'meta_desc',
					'type' => 'html',
				),
				array(
					'name' => 'featured_image',
					'type'=>'raw',
					'value' => $model->featured_image != '' ? '<div class="thumbnail col-sm-3">' . CHtml::image(
									Yii::app()->createAbsoluteUrl($model->uploadImageFolder . '/'.$model->id.'/'.$model->featured_image) ,
									'' , array(
									'style' => 'width :100%',
								)) . '</div>' : ''
				),
				'display_order',
				array(
					'name' => 'created_date',
					'type' => 'date',
				),
			),
		));
		?>
		<div class="well">
		<?php echo CHtml::htmlButton('<span class="' . $this->iconBack . '"></span> Back', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\''.  $this->baseControllerIndexUrl() . '\'')); ?>
		</div>
	</div>
</div>
