 <li id="menu-<?php echo $item->id?>" class="dd-item" data-id="<?php echo $item->id?>">
    <span class="close-menu hidden-symbol close-menu-<?php echo $item->id?>">+</span>
	<span class="glyphicon glyphicon-remove-circle pull-right remove-menu" id="removemenu-<?php echo $item->id?>" title="Remove menu"></span>
    <div class="dd-handle"><?php echo $item->name?> </div>
    <div class="data-menu-<?php echo $item->id?> data-wrap" style="display: none; clear: both">
		<div class="col-sm-5">
			<div class="form-group form-group-sm">
				<?php echo CHtml::activeLabel($item,"[$item->id]name", array('class' => 'col-sm-2 control-label')) ?>
				<div class="col-sm-10">
					<?php echo CHtml::activeTextField($item,"[$item->id]name", array('class' => 'form-control')); ?>
					<?php echo CHtml::error($item,"[$item->id]name"); ?>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group form-group-sm" id="div-link-<?php echo $item->id;?>">
				<?php echo CHtml::activeLabel($item,"[$item->id]link", array('class' => 'col-sm-2 control-label')) ?>
				<div class="col-sm-10">
				<?php echo CHtml::activeTextField($item,"[$item->id]link", array('class' => 'form-control')); ?>
				<?php echo CHtml::error($item,"[$item->id]link"); ?>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group form-group-sm">
				<?php echo CHtml::activeLabel($item,"[$item->id]status", array('class' => 'col-sm-3 control-label')) ?>
				<div class="col-sm-9">
				<?php echo CHtml::activeDropDownList($item,"[$item->id]status", array(STATUS_ACTIVE => 'Active', STATUS_INACTIVE => 'Inactive'), array('class' => 'form-control')); ?>
				<?php echo CHtml::error($item,"[$item->id]status"); ?>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group form-group-sm">
				<?php echo CHtml::activeLabel($item,"[$item->id]target", array('class' => 'col-sm-3 control-label')) ?>
				<div class="col-sm-9">
				<?php echo CHtml::activeDropDownList($item,"[$item->id]target", array('_self' => '_self', '_blank' => '_blank'), array('class' => 'form-control')); ?>
				<?php echo CHtml::error($item,"[$item->id]target"); ?>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group form-group-sm">
				<?php echo CHtml::activeLabel($item,"[$item->id]page_id", array('class' => 'col-sm-3 control-label')) ?>
				<div class="col-sm-9">
				<?php echo CHtml::activeDropDownList($item,"[$item->id]page_id", Page::model()->buildPagesDropdown(), array('class' => 'form-control')); ?>
				<?php echo CHtml::error($item,"[$item->id]page_id"); ?>
				</div>
			</div>
		</div>
		<div class="clr"></div>
    </div>
    <?php $childs = $item->getChilds(); ?>
    <?php if(!empty($childs)): ?>
       <ol class="dd-list">
           <?php $this->renderChilds($item->id, $item->menu_id) ?>
       </ol>
    <?php endif ?>
    <script type="text/javascript">
        if($('#Menuitem_<?php echo $item->id;?>_page_id').val() == '')
            $('#div-link-<?php echo $item->id;?>').show();
        else $('#div-link-<?php echo $item->id;?>').hide();
            
        $('#Menuitem_<?php echo $item->id;?>_page_id').on('change', function(){
            if($(this).val() == '')
                $('#div-link-<?php echo $item->id;?>').show();
            else $('#div-link-<?php echo $item->id;?>').hide();
        });
		
    </script>
 </li>