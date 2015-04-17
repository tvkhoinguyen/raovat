<?php
$this->breadcrumbs=array(
	$this->singlelTitle . ' Management',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});

$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('email-templates-grid', {
		data: $(this).serialize()
	});
	return false;
});

$('#clearsearch').click(function(){
	var id='search-form';
	var inputSelector='#'+id+' input, '+'#'+id+' select';
	$(inputSelector).each( function(i,o) {
		 $(o).val('');
	});
	var data=$.param($(inputSelector));
	$.fn.yiiGridView.update('email-templates-grid', {data: data});
	return false;
});

");
?>

<h1><?php echo $this->singlelTitle?> Management</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php 
echo $this->renderControlNav();?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="glyphicon glyphicon-th-list"></span> Listing</h3>
	</div>
	<div class="panel-body">
		<?php 
			$this->renderNotifyMessage(); 
			$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'email-templates-grid',
			'dataProvider'=>$model->search(),
			//'filter'=>$model,
			'pager'=>array(
				'header'         => '',
				'prevPageLabel'  => 'Prev',
				'firstPageLabel' => 'First',
				'lastPageLabel'  => 'Last',
				'nextPageLabel'  => 'Next',
			),
			'columns'=>array(
				array(
					'header' => 'S/N',
					'type' => 'raw',
					'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
					'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
					'htmlOptions' => array('style' => 'text-align:center;')
				),
				'email_subject',
				//'email_body',
				'parameter_description',
				array(
					'header' => 'Actions',
					'class'=>'CButtonColumn',
					'template'=> ControllerActionsName::createIndexButtonRoles($actions,array('view','update')),
					'buttons'=>array(
					),
				),
			),
		)); ?>
	</div>
</div>
