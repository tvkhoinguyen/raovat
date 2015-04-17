<?php
$this->breadcrumbs=array(
	'Controllers',
);

$menus=array(
	array('label'=>'Role Privileges', 'url'=>array('group')),
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
<div class="form" style="padding-left: 0px;">
<div class="row">
        <?php 
        Yii::app()->session['type'] = 'ActionsUsers';
        ?>
        <label class="required" for="UsersActions_user_id">User name: <span class="required">*</span></label>
        <?php echo CHtml::textField('roles'); ?>
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
		'controller_name',
		'module_name',
                'actions',
		array(
			'class'=>'CButtonColumn',
                        'template'=> ControllerActionsName::createIndexButtonRoles($actions, array('update')),
		),
	),
)); ?>

<div id="re"></div>

<script type="text/javascript">
        
    $("input[name='roles']").keyup(rolesSession);

    function rolesSession(){
        var url = "<?php echo Yii::app()->createAbsoluteUrl('admin/getactions/rolessession');?>";
        var request = $.ajax({
            type: "post",
            url: url,
            data: { type: 'ActionsUsers', roles: $("input[name='roles']").val()}
          }).done(function(msg) {
            $("#re").html(msg);                
          });

          request.fail(function() {
            alert( "Request fail!");
          });            
    }
    
    $("a.update").click(checkEmptyName);
    function checkEmptyName(){
        var name = $("input[name='roles']").val();
        if(name == "")
        {
            alert("Username can not blank!");
            return false;
        }
    }
</script>