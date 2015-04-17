<?php echo "<?php\n"; ?>
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
	$.fn.yiiGridView.update('<?php echo $this->class2id($this->model_name); ?>-grid', {
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
	$.fn.yiiGridView.update('<?php echo($this->class2id($this->model_name));?>-grid', {data: data});
	return false;
});

$('.deleteall-button').click(function(){
        var atLeastOneIsChecked = $('input[name=\"<?php echo($this->class2id($this->model_name));?>-grid_c0[]\"]:checked').length > 0;
        if (!atLeastOneIsChecked)
        {
                alert('Please select at least one record to delete');
        }
        else if (window.confirm('Are you sure you want to delete the selected records?'))
        {
                document.getElementById('<?php echo($this->class2id($this->model_name));?>-grid-bulk').action='" . Yii::app()->createAbsoluteUrl('admin/' . Yii::app()->controller->id  . '/deleteall') . "';
                document.getElementById('<?php echo($this->class2id($this->model_name));?>-grid-bulk').submit();
        }
});

");

Yii::app()->clientScript->registerScript('ajaxupdate', "
    $('#<?php echo $this->class2id($this->model_name); ?>-grid a.ajaxupdate').live('click', function() {
        $.fn.yiiGridView.update('<?php echo $this->class2id($this->model_name); ?>-grid', {
            type: 'POST',
            url: $(this).attr('href'),
            success: function() {
                $.fn.yiiGridView.update('<?php echo $this->class2id($this->model_name); ?>-grid');
            }
        });
        return false;
    });
");
<?php echo "?>\n"; ?>
<h1><?php echo "<?php echo \$this->pluralTitle; ?>"; ?></h1>
<?php echo "<?php echo CHtml::link(Yii::t('translation','Advanced Search'),'#',array('class'=>'search-button')); ?>\n"; ?>
<?php echo "<div class='search-form' style='display:none'>\n"; ?>
<?php echo "<?php \$this->renderPartial('_search',array(
	'model'=>\$model,
)); ?>"; ?>
<?php echo "</div>\n"; ?>

<?php echo "<?php echo \$this->renderControlNav();?>";?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="<?php echo "<?php echo \$this->iconList; ?>" ;?>"></span> Listing</h3>
	</div>
	<div class="panel-body">
		<?php echo "<?php"; ?> 
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
				<?php
		if (isset($this->type_option['index']))
		{
		foreach ($this->type_option['index'] as $key_index => $val_index) 
		{  

			$link_img = 'CHtml::image(Yii::app()->request->baseUrl."/upload/listings/".$data->id."/187x140/".$data->image, "image", array("class"=>"b_img", "height" => "100px"))';
			if ($val_index == 'string') {
				echo "\t\t\t\t'".$key_index."',\n";
			} elseif ($val_index == 'date') {
		echo "\t\t\t\tarray(
					//'header' => 'customHeader',
					'name' => '{$key_index}',
					'type' => 'date',
					'htmlOptions' => array('style' => 'text-align:center;'),
				),\n";
			} elseif ($val_index == 'datetime') {
		echo "\t\t\t\tarray(
					//'header' => 'customHeader',
					'name' => '{$key_index}',
					'type' => 'datetime',
					'htmlOptions' => array('style' => 'text-align:center;'),
				),\n";
			} elseif ($val_index == 'html') {
		echo "\t\t\t\tarray(
					//'header' => 'customHeader',
					'name' => '{$key_index}',
					'type' => 'html',
					'htmlOptions' => array('style' => 'text-align:center;'),
				),\n";
			} elseif ($val_index == 'number') {
		echo "\t\t\t\tarray(
					//'header' => 'customHeader',
					'name' => '{$key_index}',
					'htmlOptions' => array('style' => 'text-align:right;'),
				),\n";                    
			} elseif ($val_index == 'image') {
		echo "\t\t\t\tarray(
					//'header' => 'customHeader',
					'name'=>'{$key_index}',
					'type'=>'html',
					'value' => '{$link_img}',
					'htmlOptions' => array('style' => 'text-align:center;'),
				),\n";
			} elseif ($val_index == 'status') {
		echo "\t\t\t\tarray(
					//'header' => 'customHeader',
					'name'=>'{$key_index}',
					'type'=>'status',
					'value'=>'array(".'"id"'."=>\$data->id,".'"status"'."=>\$data->status)',
					'htmlOptions' => array('style' => 'text-align:center;')
			   ),\n";
			} elseif (isset($key_index) && $key_index == 'extend_attributes') {
				foreach ($this->type_option['index']['extend_attributes'] as $ke => $ex) {
					if ($ex["relation_type"] == 'string') {
				echo "\tarray(
							//'header' => 'customHeader',
							'name' => '{$ex["attr_name"]}',
							'value' => '\$data->{$ex["relation_name"]}->{$ex["attr_name"]}',
							'htmlOptions' => array('style' => 'text-align:center;'),
						),\n";
					} elseif ($ex["relation_type"] == 'number') {
				echo "array(
							//'header' => 'customHeader',
							'name' => '{$ex["attr_name"]}',
							'value' => '\$data->{$ex["relation_name"]}->{$ex["attr_name"]}',
							'htmlOptions' => array('style' => 'text-align:right;')    
						),\n";
					}
				}
			}elseif (isset($this->type_option['index']['action']) && count($val_index) > 0 && $key_index == 'action') {
				$item_action = '';
				foreach ($this->type_option['index']['action'] as $ka => $val_a) {
					$item_action .= $val_a;
				}
		echo "\t\t\t\tarray(
					'header' => 'Actions',
					'class'=>'CButtonColumn',
					'template'=> '{$item_action}',
					/*'buttons' => array(
							'delete' => array('visible' => '!in_array(\$data->id, array(' . implode(',', \$this->cannotDelete) . '))'),
							'update' => array('visible' => 'strpos(\"' . \$actions . '\", \"update\") !== false'),
							'view' => array('visible' => 'strpos(\"' . \$actions . '\", \"view\") !== false')
							), */
				),\n";
			}
		}
		}
				?>
			));
			$form=$this->beginWidget('CActiveForm', array(
			'id'=>'<?php echo $this->class2id($this->model_name); ?>-grid-bulk',
			'enableAjaxValidation'=>false,
			'htmlOptions'=>array('enctype' => 'multipart/form-data')));

			$this->renderNotifyMessage(); 
			$this->renderDeleteAllButton(); 
			
			$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'<?php echo $this->class2id($this->model_name); ?>-grid',
				//KNguyen fix holder.js not load after gridview update
				//By: add new jquery gridview and content in Folder:  customassets/gridview
				//And custom update function
				//'baseScriptUrl'=>Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'customassets'.DIRECTORY_SEPARATOR.'gridview',
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
