<?php
/**
 * VerzDesignCMS
 * 
 * LICENSE
 *
 * @copyright	Copyright (c) 2012 Verz Design (http://www.verzdesign.com)
 * @version 	$Id: admin.php 2012-06-01 09:09:18 nguyendung $
 * @since		1.0.0
 */
?>
<?php
$this->breadcrumbs=array(
	'Roles'=>array('index'),
	'Manage',
);

$menus=array(
	array('label'=>'Create Roles', 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('roles-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#roles-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('roles-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('roles-grid');
        }
    });
    return false;
});
");
?>

<h1>Manage Roles</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php
$visible = ControllerActionsName::checkVisibleButton($actions);
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'roles-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'role_name',
		'role_short_name',
		array(
                    'name'=>'application_id',
                    'htmlOptions' => array('style' => 'text-align:center;'),
                    'value'=> '!empty($data->application_id) ? $data->application->application_name : ""',
                    'filter'=>Applications::loadItems(),
                ),
		array(
                    'name'=>'status',
                    'type' => 'Status',
                    'value'=>'array("status"=>$data->status,"id"=>$data->id)',
                    //'value'=> 'CmsFormatter::$viewStatusFormat[$data->status]',
                    'htmlOptions' => array('style' => 'text-align:center;'),
                    'visible'=>$visible,
		),  
		array(
			'class'=>'CButtonColumn',
                        'template'=> ControllerActionsName::createIndexButtonRoles($actions),
		),
	),
)); ?>
