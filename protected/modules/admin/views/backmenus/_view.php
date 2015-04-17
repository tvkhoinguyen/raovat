<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('menu_name')); ?>:</b>
	<?php //echo CHtml::encode($data->menu_name); ?>
	<?php echo CHtml::link(CHtml::encode($data->menu_name), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('menu_link')); ?>:</b>
	<?php echo CHtml::encode($data->menu_link); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('display_order')); ?>:</b>
	<?php echo CHtml::encode($data->display_order); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('show_in_menu')); ?>:</b>
	<?php echo CHtml::encode((!empty($data->show_in_menu) && $data->show_in_menu==1) ? "Yes" : "No"); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('place_holder_id')); ?>:</b>
	<?php echo CHtml::encode($data->place_holder->position); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('application_id')); ?>:</b>
	<?php echo CHtml::encode($data->application->application_name); ?>
	<br />
      
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('parent_id')); ?>:</b>
	<?php echo CHtml::encode($data->parent_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('group_id')); ?>:</b>
	<?php echo CHtml::encode($data->group_id); ?>
	<br />

	*/ ?>

</div>