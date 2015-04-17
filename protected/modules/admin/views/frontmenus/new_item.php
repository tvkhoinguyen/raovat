 
<li id="menu-<?php echo $id?>" class="dd-item" data-id="<?php echo $id?>">
    <span class="close-menu showing-symbol close-menu-<?php echo $id?>">+</span>
    <div class="dd-handle"><?php echo $item->name != ''? $item->name : 'New menu item'?></div>
    <div class="data-menu-<?php echo $id?> data-wrap" style="display: none; clear: both">
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
				<?php echo CHtml::activeDropDownList($item,"[$item->id]status", array(STATUS_ACTIVE => 'Acitve', STATUS_INACTIVE => 'Inactive'), array('class' => 'form-control')); ?>
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
    <script type="text/javascript">
        $('#menu-<?php echo $id?>').ready(function(){
            if($('#Menuitem_<?php echo $id;?>_page_id').val() == '')
                $('#div-link-<?php echo $id;?>').show();
            else $('#div-link-<?php echo $id;?>').hide();
            
            $('#Menuitem_<?php echo $id;?>_page_id').on('change', function(){
                if($(this).val() == '')
                    $('#div-link-<?php echo $id;?>').show();
                else $('#div-link-<?php echo $id;?>').hide();
            });
        });
    </script>
 </li>
 