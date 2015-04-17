<style type="text/css">
	.errorMessage
	{
		color: red !important;
	}
</style>
<?php
$this->breadcrumbs=array(
	'Best Purchased Product Report',
);
$this->menu=array(
	// array('label'=>'Create ' . $this->singleTitle, 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "

/*$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('report-best-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});*/

$('#clearsearch').click(function(){
	var id='search-form';
	var inputSelector='#'+id+' input, '+'#'+id+' select';
	$(inputSelector).each( function(i,o) {
		 $(o).val('');
	});
	var data=$.param($(inputSelector));
	$.fn.yiiGridView.update('report-best-grid', {data: data});
	return false;
});

$('.deleteall-button').click(function(){
        var atLeastOneIsChecked = $('input[name=\"report-best-grid_c0[]\"]:checked').length > 0;
        if (!atLeastOneIsChecked)
        {
                alert('Please select at least one record to delete');
        }
        else if (window.confirm('Are you sure you want to delete the selected records?'))
        {
                document.getElementById('report-best-grid-bulk').action='" . Yii::app()->createAbsoluteUrl('admin/' . Yii::app()->controller->id  . '/deleteall') . "';
                document.getElementById('report-best-grid-bulk').submit();
        }
});

");

Yii::app()->clientScript->registerScript('ajaxupdate', "
    $('#report-best-grid a.ajaxupdate').live('click', function() {
        $.fn.yiiGridView.update('report-best-grid', {
            type: 'POST',
            url: $(this).attr('href'),
            success: function() {
                $.fn.yiiGridView.update('report-best-grid');
            }
        });
        return false;
    });
");
?>
<h1><?php echo 'Best Purchased Product Report'; ?></h1>
<?php echo CHtml::link(Yii::t('translation','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class='search-form' style='display:block;'>
<?php $this->renderPartial('_search_bestPurchasedReport',array(
	'model'=>$model,
)); ?></div>

<div class="navbar-right nguyencustom">
    <div class="btn-group btn-group-sm">
    	
    	<a class="btn btn-default" href="<?php echo Yii::app()->createAbsoluteUrl('admin/report/Export', array('type'=>'bestPurchasedReport' , 'filename'=>'Report_Best_Purchased_Product_Report_'.date('d-m-Y')) ); ?>">Export</a>
	</div> 
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
								);
			}
			$columnArray = 
			// array_merge($columnArray, 
			array(
				array(
					'header' => 'S/N',
					'type' => 'raw',
					'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
					'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
					'htmlOptions' => array('style' => 'text-align:center;')
				),
				
				array(
	                'header' => 'Seller Name',
	                'type'=>'GetSellerNameFromOrderDetail',
	                'value'=>' $data["id"] ',
        			'htmlOptions' => array('style' => 'text-align:center;'),
		         ),
							// 'product_item_id' ,
							// 'product_item_sku' ,
				array(
		                'header' => 'SKU',
		                'value'=>' isset($data) ? $data["product_item_sku"] : "" ',
		                'htmlOptions' => array('style' => 'text-align:center;')
		         ),
				array(
		                'header' => 'EOG SKU',
		                'type'=>'EOG_SKU',
		                'value'=>'$data["product_item_id"]',
		                // 'value'=>'  !empty( ProductItems::model()->findByPk($data["product_item_id"])    ) 
		                // 			? ProductItems::model()->findByPk($data["product_item_id"])->eog_sku 
		                // 			: ""
		                // 		 ',
                		 'htmlOptions' => array('style' => 'text-align:center;'),
		         ),
				// 'quantity' ,
				// 'price' ,
				// 'criteria_total_quantity',
				array(
		                'header' => 'Total Quantity',
		                'value'=>'isset($data) ? $data["criteria_total_quantity"] : "" ',
		                'htmlOptions' => array('style' => 'text-align:center;')
		         ),
				array(
		                'header' => 'Total Amount',
		                'value'=>'isset($data) ? Yii::app()->format->price($data["criteria_total_amount"]) : "" ',
		                'htmlOptions' => array('style' => 'text-align:center;')
		         ),
				
				/*array(
					'header' => 'Actions',
					'class'=>'CButtonColumn',
					'template'=> '{view}',
					'buttons' => array(
							// 'delete' => array('visible' => '!in_array($data->id, array(' . implode(',', $this->cannotDelete) . '))'),
							// 'update' => array('visible' => 'strpos("' . $actions . '", "update") !== false'),
							// 'view' => array('visible' => 'strpos("' . $actions . '", "view") !== false')
							'view' => array(
									// 'visible' => 'strpos("' . $actions . '", "view") !== false'
									'url'=>' Yii::app()->createAbsoluteUrl("admin/report/viewBestPurchasedReport", array("id"=>  $data["id"])) ',                                         
								)	
						),
				),*/
			// )
			);
			$form=$this->beginWidget('CActiveForm', array(
			'id'=>'report-best-grid-bulk',
			'enableAjaxValidation'=>false,
			'htmlOptions'=>array('enctype' => 'multipart/form-data')));

			$this->renderNotifyMessage(); 
			// $this->renderDeleteAllButton(); 
			
			$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'report-best-grid',
				//KNguyen fix holder.js not load after gridview update
				//By: add new jquery gridview and content in Folder:  customassets/gridview
				//And custom update function
				'baseScriptUrl'=>Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'customassets'.DIRECTORY_SEPARATOR.'gridview',
				'dataProvider'=>$model->searchBestPurchasedReport(),
				// 'filter'=>$model,
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
