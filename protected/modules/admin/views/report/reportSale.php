<style type="text/css">
	.errorMessage
	{
		color: red !important;
	}
</style>

<?php
$this->breadcrumbs=array(
	$this->pluralTitle,
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});

$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('orders-grid', {
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
	$.fn.yiiGridView.update('orders-grid', {data: data});
	return false;
});

$('.deleteall-button').click(function(){
        var atLeastOneIsChecked = $('input[name=\"orders-grid_c0[]\"]:checked').length > 0;
        if (!atLeastOneIsChecked)
        {
                alert('Please select at least one record to delete');
        }
        else if (window.confirm('Are you sure you want to delete the selected records?'))
        {
                document.getElementById('orders-grid-bulk').action='" . Yii::app()->createAbsoluteUrl('admin/' . Yii::app()->controller->id  . '/deleteall') . "';
                document.getElementById('orders-grid-bulk').submit();
        }
});

");

Yii::app()->clientScript->registerScript('ajaxupdate', "
    $('#orders-grid a.ajaxupdate').live('click', function() {
        $.fn.yiiGridView.update('orders-grid', {
            type: 'POST',
            url: $(this).attr('href'),
            success: function() {
                $.fn.yiiGridView.update('orders-grid');
            }
        });
        return false;
    });
");
?>
<h1><?php echo $this->pluralTitle; ?></h1>
<?php echo CHtml::link(Yii::t('translation','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class='search-form' style=''>
<?php $this->renderPartial('_search_reportSale',array(
	'model'=>$model,
)); ?></div>

<div class="navbar-right nguyencustom">
    <div class="btn-group btn-group-sm">
    	<!-- <input style="padding:5px; cursor: not-allowed;" type="text" id="choose_month" value="" class="my-datepicker-control-month-year" readonly="readonly" /> -->
    	<a class="export btn btn-default" target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('admin/report/Export', array('type'=>'sale' , 'filename'=>'Report_Sale_'.date('d-m-Y')) ); ?>">Export</a>
	</div> 
</div>


<?php echo $this->renderControlNav(); ?>
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
					'header'=>'Order Date',
					'name' => 'created_date',
					'type' => 'date',
					'htmlOptions' => array('style' => 'text-align:center;')
				),
								// 'no_id',
				array(
					'header'=>'Order No',
					'name' => 'order_no',
					'htmlOptions' => array('style' => 'text-align:left;')
				),
				array(
					'header'=>'Client Name',
					'name' => 'user_name',
					'type' => 'raw',
					'htmlOptions' => array('style' => 'text-align:left;')
				),
				//Sub Total ($)	Delivery Fee ($)	GST ($)	Total ($)	Order Status

				array(
					'header'=>'Sub Total ($)',
					'name' => 'sub_total',
					// 'type' => 'price ',
					// 'value' => ' GocOrders::getListProductName($data->id)',
					'htmlOptions' => array('style' => 'text-align:right;')
				),
				array(
					'header'=>'Delivery Fee ($)',
					'name' => 'shipping_fee',
					// 'type' => 'price ',
					// 'value' => ' GocOrders::getListProductName($data->id)',
					'htmlOptions' => array('style' => 'text-align:right;')
				),
				array(
					'header'=>'GST ($)',
					'name' => 'gst',
					// 'type' => 'price ',
					// 'value' => ' GocOrders::getListProductName($data->id)',
					'htmlOptions' => array('style' => 'text-align:right;')
				),
				array(
					'header'=>'Total ($)',
					'name' => 'total',
					// 'type' => 'price ',
					// 'value' => ' GocOrders::getListProductName($data->id)',
					'htmlOptions' => array('style' => 'text-align:right;')
				),
				array(
					'header'=>'Order Status',
					'name' => 'status',
					'type'=>'raw',
					'value'=>'SpOrders::getStatusOrder($data)',
					// 'value'=> 'GocOrders::getStatusReportBE_Nguyen($data->status)',
					'headerHtmlOptions' => array('style' => 'text-align:center;'),
					'htmlOptions' => array('style' => 'text-align:center;')
				),
				// array(
				// 	'header' => 'Actions',
				// 	'class'=>'CButtonColumn',
				// 	'template'=> '{view}{update}{delete}',
				// 	// 'template'=> '{view}',
				// 	// 'buttons' => array(
				// 	// 		'delete' => array('visible' => '!in_array($data->id, array(' . implode(',', $this->cannotDetele) . '))'),
				// 	// 		'update' => array('visible' => 'strpos("' . $actions . '", "update") !== false'),
				// 	// 		'view' => array('visible' => 'strpos("' . $actions . '", "view") !== false')
				// 	// 		),
				// ),
			// )
			);
			$form=$this->beginWidget('CActiveForm', array(
			'id'=>'orders-grid-bulk',
			'enableAjaxValidation'=>false,
			'htmlOptions'=>array('enctype' => 'multipart/form-data')));

			$this->renderNotifyMessage(); 
			// $this->renderDeleteAllButton(); 
			
			$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'orders-grid',
				//KNguyen fix holder.js not load after gridview update
				//By: add new jquery gridview and content in Folder:  customassets/gridview
				//And custom update function
				// 'baseScriptUrl'=>Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'customassets'.DIRECTORY_SEPARATOR.'gridview',
				'dataProvider'=>$model->searchReportSale(),
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
		<script type="text/javascript">
		    /*function checkExport(object)
		    {
		    	var month_year = $('#choose_month').val();
		    	if(month_year.length > 0)
		    	{
		    		var url = jQuery(object).attr('href');
		    		alert(url);
		    	}else
		    	{
		    		alert('Choose month to export !');
		    	}
		    	return false;
		    }*/

		    $(document).ready(function()
		    {
		    	$( "a.export" ).click(function( event ) {
		    	    event.preventDefault();
		    	    var object = jQuery(this);
		    	    var url = jQuery(object).attr('href');
		    	    window.location.href = url;

		    	    
		    	  	/*var month_year = $('#choose_month').val();
					if(month_year.length > 0)
					{
						var object = jQuery(this);
						var url = jQuery(object).attr('href');
						url = url + '?time='+month_year;
						window.location.href = url;
					}else
					{
						alert('Choose month to export !');
					}*/
		    	});


		       /*$('#choose_month').datepicker( {
		            changeMonth: true,
		            changeYear: true,
		            showButtonPanel: true,
		            dateFormat: 'mm/yy',
		            showOn : 'button',
		            buttonImage: "<?php echo Yii::app()->theme->baseUrl.'/admin/images/icon_calendar_r.gif'; ?>",
		            buttonImageOnly:true,
		            onClose: function(dateText, inst) { 
		                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
		                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
		                $(this).datepicker('setDate', new Date(year, month, 1));
		            }
		           
		        });

		       $("#choose_month").focus(function () {
			        $(".ui-datepicker-calendar").hide();
			        $("#ui-datepicker-div").position({
			            my: "center top",
			            at: "center bottom",
			            of: $(this)
			        });    
			    });*/

			});
		</script>

