<?php
$this->breadcrumbs=array(
	$this->pluralTitle => array('index'),
	// 'Banner Management' => array('index'),
	// 'View ' . $this->singleTitle . ' : ' . $title_name,
	'View ' . $this->singleTitle ,
);

$this->menu = array(
    array('label'=>$this->pluralTitle, 'url'=>array('index'), 'icon' => $this->iconList),	
    array('label'=> 'Update '. $this->singleTitle, 'url'=>array('update', 'id'=>$model->id)),
	array('label' => 'Create ' . $this->singleTitle, 'url' => array('create')),
);   

?>
<!-- <h1>View <?php echo $this->singleTitle . ' : ' . $model->name; ?></h1> -->
<h1>View <?php echo $this->singleTitle; ?></h1>
<?php
//for notify message
$this->renderNotifyMessage(); 
//for list action button
echo $this->renderControlNav();
?><div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="glyphicon glyphicon-list-alt"></span> View <?php echo $this->singleTitle?></h3>
	</div>
	<div class="panel-body">
	<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
    			array(
					'name' => 'image',
					'type'=>'raw',
					'value' => $model->image != '' ? '<div class="thumbnail col-sm-8">' . CHtml::image(
									ImageHelper::getImageUrl($model, 'image', Banner::HOME_BANNER_SIZE2 ) ,
									'' , array(
									'style' => 'width :100%',
								)) . '</div>' : ''
				),
				array(
					'name' => 'content',
					'type' => 'raw',
				),
				'status:status',
				// array(
				// 	'name' => 'name',
				// 	// 'type' => 'html',
				// ),
				// array(
				// 	'name' => 'link',
				// 	'type' => 'raw',
				// ),
				
				// 'text1',
				// 'text2',
				// 'text3',
				'order_display',
				array(
					'name' => 'created_date',
					'type' => 'datetime',
				),
		),
	)); ?>
	<div class="well">
		<?php echo CHtml::htmlButton('<span class="' . $this->iconBack . '"></span> Back', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\''.  $this->baseControllerIndexUrl() . '\'')); ?>	</div>
	</div>
</div>