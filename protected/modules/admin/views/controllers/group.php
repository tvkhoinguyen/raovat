<?php
$this->breadcrumbs=array(
	'Controllers',
);

$menus=array(
	array('label'=>'Group Privileges', 'url'=>array('group')),
        array('label'=>'User Privileges', 'url'=>array('user')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('controllers-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#controllers-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('controllers-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('controllers-grid');
        }
    });
    return false;
});
");
?>

<h1>List Controllers</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

</br>
<div class="form"  style="padding-left: 0px;">
<div class="row">        
        <label class="required" for="UsersActions_user_id">Role: <span class="required">*</span></label>
        <?php echo CHtml::dropDownList('roles', 1 , CHtml::listData(Roles::model()->findAll(), 'id', 'role_name')); ?>
        <?php //echo $form->error($model,'user_id'); ?>
</div>    
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'controllers-grid',
	'dataProvider'=>$model->search(),     
	//'filter'=>$model,
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$row+1',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
		array(
			'class'=>'CButtonColumn',
                        'template'=> ControllerActionsName::createIndexButtonRoles($actions, array('update')),
		),
	
		'controller_name',
		'module_name',
                'actions',
	),
)); ?>

<div id="re"></div>

<script type="text/javascript">
        
    $("select[name='roles']").change(rolesSession);    

    function rolesSession(){
        var url = "<?php echo Yii::app()->createAbsoluteUrl('admin/getactions/rolessession');?>";
        var request = $.ajax({
            type: "post",
            url: url,
            data: { type: 'ActionsRoles', roles: $("select[name='roles']").val()}
          }).done(function(msg) {
            $("#re").html(msg);                
          });

          request.fail(function() {
            alert( "Request fail!");
          });            
    }
</script>