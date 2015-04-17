<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="<?php echo $model->isNewRecord ? $this->iconCreate : $this->iconEdit; ?>"></span> <?php echo $model->isNewRecord ? 'Create' : 'Update'; ?> <?php echo $this->singleTitle ?></h3>
	</div>
	<div class="panel-body">
		
		

		
		<div class="form">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id' => 'menu-form',
			'enableAjaxValidation'=>false,
			'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
		)); ?>
			
			<div class='form-group form-group-sm'>
			<?php echo $form->labelEx($model,'title', array('class' => 'col-sm-1 control-label')); ?>
				<div class="col-sm-3">
				<?php echo $form->textField($model,'title', array('class' => 'form-control', 'maxlength' => 255)); ?>
				<?php echo $form->error($model,'title'); ?>
				</div>
			</div>
			
			
		<?php if(!$model->isNewRecord):?>
			<div class="col-sm-12 panel panel-default" style="padding-left: -20px; padding-right: -20px">
			<div class="panel-body"  style="padding-left: -20px; padding-right: -20px">
				<div class="col-sm-4" >
					<h5>Pages List</h5>
					<div class="pagelist">
						<ul id="cmspage">
							<?php 
							foreach ($pageTree as $key => $page)
							{
								if ($key != '')
									echo '<li id="cmspage' . $key . '"><input type="checkbox" name="cmspage[]" value="' . $key . '"> ' . $page . '</li>';
							}
							?>
						</ul>
					</div>
					<button type="button" class="btn btn-default btn-sm" onclick="addMorePage()">Add Pages Menu</button>
					<button type="button" class="btn btn-default btn-sm" onclick="addMore()">Add Custom Menu</button>
					
				</div>

				<input id="LevelMenuJson" name="LevelMenuJson" type="hidden"/>
				<div class="col-sm-7">
					<h5 class="pull-left">Menu Structure</h5>
					<div class="clearfix"></div>
					<div class="dd">
						<ol class="dd-list" id="mainlist">
							<?php 
								$this->renderChilds(0, $menuId) ?>
						</ol>
					</div>
				</div>
			</div>
		</div>	
		
			<script type="text/javascript">
				var max_data_id = 0;
				$(document).ready(function(){
					
					loadItem();
					genValue_Level_Menu_Json();
					//don't know reason but call this 2 times can fix encode bug
					//Ex: value="[{"id":506},{"id":507},{"id":508},{"id":509},{"id":510},{"id":518}]" >
					// $('#LevelMenuJson').val(JSON.stringify($('.dd').nestable('serialize')));
					$('.col-sm-7 .dd').on('change', function() {
						// $('#LevelMenuJson').val(JSON.stringify($('.dd').nestable('serialize')));
						genValue_Level_Menu_Json();
						loadItem();
					});
					
					
				});
				function loadItem(){
					
					$('.col-sm-7 .dd li').each(function(){
						var prefix = $(this).attr('data-id').substring(0,4);
						var data_id = parseInt($(this).attr('data-id'));
						if(prefix == 'new-')
							data_id = parseInt($(this).attr('data-id').substring(4, $(this).attr('data-id').length));
						if(max_data_id < data_id)
							max_data_id = data_id;
					});
				}

				function genValue_Level_Menu_Json()
				{
					var text = '[';
					$('.col-sm-7 .dd li').each(function()
					{
						var data_id = parseInt($(this).attr('data-id'));
						text = text + '{"id":'+ data_id + '}';
					});
					text = text + ']';
					while(text.search('}{')!=-1){
						text = text.replace('}{', '},{');
					}
					console.log(text);
					$('#LevelMenuJson').val(text);
				}
				
				function addMore()
				{
					max_data_id = max_data_id + 1;
					$.post( "<?php echo Yii::app()->createAbsoluteUrl('admin/frontmenus/rendernewitem', array('menuId' => $menuId));?>", { newId: max_data_id})
						.done(function( data ) {
							$('.col-sm-7 .dd #mainlist').append(data);
						});
				}
				
				function addMorePage()
				{
					max_data_id = max_data_id + 1;
					var pageChecked = [];
					$('#cmspage input:checked').each(function() {
						pageChecked.push($(this).val());
					});
					
					if (pageChecked.length == 0)
					{
						alert('Please select pages you want to add to menu');
						return;
					}
					
					$.ajax({
						url: '<?php echo Yii::app()->createAbsoluteUrl('admin/frontmenus/Rendernewpageitem', array('menuId' => $menuId));?>',
						data: { newId: max_data_id, 'selectedpage[]': pageChecked},
						type: 'POST',
					}).done(function(data){
						$('.col-sm-7 .dd #mainlist').append(data);
						// $('#LevelMenuJson').val(JSON.stringify($('.dd').nestable('serialize')));
						genValue_Level_Menu_Json();
						loadItem();
					});
					
				}
				
				$('.remove-menu').click(function(event){
					var id = this.id;
					event.preventDefault();
					var r = confirm("Do you want to remove this menu? \nNoted: All submenus of this menu will be removed to");
					if (r == true) {
						$(this).parent().remove();
						// $('#LevelMenuJson').val(JSON.stringify($('.dd').nestable('serialize')));
						genValue_Level_Menu_Json();
					} 
					
				});
			</script>
			<?php endif;?>
			<div class="clr"></div>
			<div class="well">
				<?php echo CHtml::htmlButton($model->isNewRecord ? '<span class="' . $this->iconCreate . '"></span> Create' : '<span class="' . $this->iconSave . '"></span> Save', array('class' => 'btn btn-primary', 'type' => 'submit')); ?> &nbsp;  
				<?php echo CHtml::htmlButton('<span class="' . $this->iconCancel . '"></span> Cancel', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\'' . $this->baseControllerIndexUrl() . '\'')); ?>
			</div>
		<?php $this->endWidget(); ?>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
    if($('#FeMenus_type').val() == 'page')
    {
        $('#page_id').show();
        $('#link').hide();
    }
    else
    {
        $('#page_id').hide();
        $('#link').show();
    }
});
$("#FeMenus_type").change(function() {
    if($('#FeMenus_type').val() == 'page')
    {
        $('#page_id').show();
        $('#link').hide();
    }
    else
    {
        $('#page_id').hide();
        $('#link').show();
    }
});
</script>