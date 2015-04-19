<?php
$this->breadcrumbs=array(
	$this->pluralTitle,
);
$this->menu=array(
	array('label'=>'Create ' . $this->singleTitle, 'url'=>array('create', 'type'=>$type)),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tin-rao-vat-grid', {
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
	$.fn.yiiGridView.update('tin-rao-vat-grid', {data: data});
	return false;
});

$('.deleteall-button').click(function(){
        var atLeastOneIsChecked = $('input[name=\"tin-rao-vat-grid_c0[]\"]:checked').length > 0;
        if (!atLeastOneIsChecked)
        {
                alert('Please select at least one record to delete');
        }
        else if (window.confirm('Are you sure you want to delete the selected records?'))
        {
                document.getElementById('tin-rao-vat-grid-bulk').action='" . Yii::app()->createAbsoluteUrl('admin/' . Yii::app()->controller->id  . '/deleteall') . "';
                document.getElementById('tin-rao-vat-grid-bulk').submit();
        }
});

");

Yii::app()->clientScript->registerScript('ajaxupdate', "
    $('#tin-rao-vat-grid a.ajaxupdate').live('click', function() {
        $.fn.yiiGridView.update('tin-rao-vat-grid', {
            type: 'POST',
            url: $(this).attr('href'),
            success: function() {
                $.fn.yiiGridView.update('tin-rao-vat-grid');
            }
        });
        return false;
    });
");
?>
<h1><?php echo $this->pluralTitle; ?></h1>
<?php echo CHtml::link(Yii::t('translation','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class='search-form' style='display:none'>
<?php $this->renderPartial('_search',array(
	'model'=>$model,
	'type'=>$type,
)); ?></div>

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
					'header'=>'Post User Name',
					'name'=>'post_user_name',
				),
				// array(
				// 	'header'=>'Edit User Name',
				// 	'name'=>'edit_user_name',
				// ),
				'title',
				
				// 'image1',
				array(
					'name' => 'image1',
					'type' => 'raw',
					'value' => '( isset($data) && !empty($data->image1) )
				                ?
				                    CHtml::image(ImageHelper::getImageUrl($data, "image1", "'.RAOVAT_SIZE.'" ) )
				                :"";',
					'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
					'htmlOptions' => array('style' => 'text-align:center;')
					),
				array(
					'name' => 'image2',
					'type' => 'raw',
					'value' => '( isset($data) && !empty($data->image2) )
				                ?
				                    CHtml::image(ImageHelper::getImageUrl($data, "image2", "'.RAOVAT_SIZE.'" ) )
				                :"";',
					'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
					'htmlOptions' => array('style' => 'text-align:center;')
					),
				array(
					//'header' => 'customHeader',
					'name'=>'status',
					'type'=>'status',
					'value'=>'array("id"=>$data->id,"status"=>$data->status)',
					'htmlOptions' => array('style' => 'text-align:center;')
			   ),
				array(
					//'header' => 'customHeader',
					'name' => 'order_display',
					'htmlOptions' => array('style' => 'text-align:right;'),
				),
				array(
					//'header' => 'customHeader',
					'name' => 'is_hot',
					'type'=>'YesNo',
					'htmlOptions' => array('style' => 'text-align:right;'),
				),
				array(
					'name' => 'is_new',
					'type'=>'YesNo',
					'htmlOptions' => array('style' => 'text-align:right;'),
				),
				
				'phone',
				// 'mobile',
				array(
					//'header' => 'customHeader',
					'name' => 'state_id',
					'value'=>' !empty($data->rState) ? $data->rState->name : "" ',
					'htmlOptions' => array('style' => 'text-align:right;'),
				),
				array(
					//'header' => 'customHeader',
					'name' => 'job_id',
					'value'=>' !empty($data->rJob) ? $data->rJob->name : "" ',
					'htmlOptions' => array('style' => 'text-align:right;'),
				),
				'city',

				// array(
				// 	//'header' => 'Loại Tin',
				// 	'name' => 'loat_tin',
				// 	'type' => 'date',
				// 	'htmlOptions' => array('style' => 'text-align:center;'),
				// ),

				array(
					//'header' => 'customHeader',
					'name' => 'created_date',
					'type' => 'date',
					'htmlOptions' => array('style' => 'text-align:center;'),
				),
				array(
					//'header' => 'customHeader',
					'name' => 'updated_date',
					'type' => 'date',
					'htmlOptions' => array('style' => 'text-align:center;'),
				),
				array(
					'header' => 'Actions',
					'class'=>'CButtonColumn',
					'template'=> '{view}{update}{delete}',
					/*'buttons' => array(
							'delete' => array('visible' => '!in_array($data->id, array(' . implode(',', $this->cannotDelete) . '))'),
							'update' => array('visible' => 'strpos("' . $actions . '", "update") !== false'),
							'view' => array('visible' => 'strpos("' . $actions . '", "view") !== false')
							), */
				),
			));
			$form=$this->beginWidget('CActiveForm', array(
			'id'=>'tin-rao-vat-grid-bulk',
			'enableAjaxValidation'=>false,
			'htmlOptions'=>array('enctype' => 'multipart/form-data')));

			$this->renderNotifyMessage(); 
			$this->renderDeleteAllButton(); 
			
			$dataProvider='';
			switch ($type) 
			{
				case '3ngay':
					$dataProvider = $model->searchIndexType(TIN_3_NGAY);
					break;
				case '7ngay':
					// $criteria->addCondition(" loai_tin=".TIN_7_NGAY." AND status=".ACTIVE);
					$dataProvider = $model->searchIndexType(TIN_7_NGAY);
					break;
				case '14ngay':
					// $criteria->addCondition(" loai_tin=".TIN_14_NGAY." AND status=".ACTIVE);
					$dataProvider = $model->searchIndexType(TIN_14_NGAY);
					break;
				case '1thang':
					// $criteria->addCondition(" loai_tin=".TIN_1_THANG." AND status=".ACTIVE);
					$dataProvider = $model->searchIndexType(TIN_1_THANG);
					break;
				case '2thang':
					// $criteria->addCondition(" loai_tin=".TIN_1_THANG." AND status=".ACTIVE);
					$dataProvider = $model->searchIndexType(TIN_2_THANG);
					break;
				case '3thang':
					// $criteria->addCondition(" loai_tin=".TIN_1_THANG." AND status=".ACTIVE);
					$dataProvider = $model->searchIndexType(TIN_3_THANG);
					break;
				case '4thang':
					// $criteria->addCondition(" loai_tin=".TIN_1_THANG." AND status=".ACTIVE);
					$dataProvider = $model->searchIndexType(TIN_4_THANG);
					break;
				case '5thang':
					// $criteria->addCondition(" loai_tin=".TIN_1_THANG." AND status=".ACTIVE);
					$dataProvider = $model->searchIndexType(TIN_5_THANG);
					break;
				case '6thang':
					// $criteria->addCondition(" loai_tin=".TIN_1_THANG." AND status=".ACTIVE);
					$dataProvider = $model->searchIndexType(TIN_6_THANG);
					break;
				
				case '1nam':
					// $criteria->addCondition(" loai_tin=".TIN_1_NAM." AND status=".ACTIVE);
					$dataProvider = $model->searchIndexType(TIN_1_NAM);
					break;
			}

			$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'tin-rao-vat-grid',
				//KNguyen fix holder.js not load after gridview update
				//By: add new jquery gridview and content in Folder:  customassets/gridview
				//And custom update function
				//'baseScriptUrl'=>Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'customassets'.DIRECTORY_SEPARATOR.'gridview',
				'dataProvider'=>$dataProvider,
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
