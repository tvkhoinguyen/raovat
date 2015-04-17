<?php
$this->breadcrumbs=array(
	$this->pluralTitle,
);
$this->menu=array(
	array('label'=>'Create ' . $this->singleTitle, 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('banner-grid', {
                url : $(this).attr('action'),
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
	$.fn.yiiGridView.update('banner-grid', {data: data});
	return false;
});

$('.deleteall-button').click(function(){
        var atLeastOneIsChecked = $('input[name=\"banner-grid_c0[]\"]:checked').length > 0;
        if (!atLeastOneIsChecked)
        {
                alert('Please select at least one record to delete');
        }
        else if (window.confirm('Are you sure you want to delete the selected records?'))
        {
                document.getElementById('banner-grid-bulk').action='" . Yii::app()->createAbsoluteUrl('admin/' . Yii::app()->controller->id  . '/deleteall') . "';
                document.getElementById('banner-grid-bulk').submit();
        }
});

");

Yii::app()->clientScript->registerScript('ajaxupdate', "
    $('#banner-grid a.ajaxupdate').live('click', function() {
        $.fn.yiiGridView.update('banner-grid', {
            type: 'POST',
            url: $(this).attr('href'),
            success: function() {
                $.fn.yiiGridView.update('banner-grid');
            }
        });
        return false;
    });
");
?>
<h1><?php echo $this->pluralTitle; ?></h1>
<?php echo CHtml::link(Yii::t('translation','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class='search-form' style='display:none'>
<?php 
	$this->renderPartial('_search',array(
		'model'=>$model,
	)); 
?>
</div>

<?php echo $this->renderControlNav();?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="<?php echo $this->iconList; ?>"></span> Listing</h3>
	</div>
	<div class="panel-body">
		<?php 
			$allowAction = in_array("delete", $this->listActionsCanAccess)?'CCheckBoxColumn':'';
			$columnArray = array();
			if (in_array("Delete", $this->listActionsCanAccess))
			{
				$columnArray[] = array(
									'value'=>'$data->id',
									'class'=> "CCheckBoxColumn",
									'headerHtmlOptions' => array('width' => '10px','style' => 'text-align:center;'),
									'htmlOptions' => array('width' => '10px','style' => 'text-align:center;'),
								);
			}
			$columnArray = array_merge($columnArray, array(
				array(
					'header' => 'S/N',
					'type' => 'raw',
					'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
					'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
					'htmlOptions' => array('style' => 'text-align:center;')
					),
				array(
					'header' => '<a class="sort-link">Image</a>',
					'type' => 'raw',
					'value' => 'isset($data)
				                ?
				                    CHtml::image(ImageHelper::getImageUrl($data, "image", Banner::HOME_BANNER_SIZE2 ) )
				                :"";',
					'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
					'htmlOptions' => array('style' => 'text-align:center;')
					),
				
				
				array(
					'name'=>'content',
					'type'=>'raw',
					'headerHtmlOptions' => array('style' => 'text-align:center;'),
					'htmlOptions' => array('style' => 'text-align:left;')
				   ),
				array(
					'header' => "Status",
					'name'=>'status',
					'type'=>'status',
					'value'=>'array("id"=>$data->id,"status"=>$data->status)',
					'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
					'htmlOptions' => array('style' => 'text-align:center;')
				   ),
				array(
					'name'=>'order_display',
					'type'=>'raw',
					'value'=>'$data->order_display',
					'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
					'htmlOptions' => array('style' => 'text-align:center;')
				   ),
				array(
							'header' => 'Actions',
							'class'=>'CButtonColumn',
							'template'=> '{view}{update}{delete}',
						),
				));

			$form=$this->beginWidget('CActiveForm', array(
			'id'=>'banner-grid-bulk',
			'enableAjaxValidation'=>false,
			'htmlOptions'=>array('enctype' => 'multipart/form-data')));

			$this->renderNotifyMessage(); 
			$this->renderDeleteAllButton(); 
			
			$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'banner-grid',
				//KNguyen fix holder.js not load after gridview update
				//By: add new jquery gridview and content in Folder:  customassets/gridview
				//And custom update function
				'baseScriptUrl'=>Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'customassets'.DIRECTORY_SEPARATOR.'gridview',
				'dataProvider'=>$model->search(),
				'pager'=>array(
							'header'         => '',
							'prevPageLabel'  => 'Prev',
							'firstPageLabel' => 'First',
							'lastPageLabel'  => 'Last',
							'nextPageLabel'  => 'Next',
						),
				'selectableRows'=>2,
				'columns'=>$columnArray,
		)); 
		$this->endWidget();
		?>
