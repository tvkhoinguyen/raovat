<?php
/**
 * VerzDesignCMS
 * 
 * LICENSE
 *
 * @copyright	Copyright (c) 2012 Verz Design (http://www.verzdesign.com)
 * @version 	$Id: _view.php 2012-06-01 09:09:18 nguyendung $
 * @since		1.0.0
 */
?>
<div class="view">
	<b><?php echo CHtml::encode($data->getAttributeLabel('application_name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->application_name), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('application_short_name')); ?>:</b>
	<?php echo CHtml::encode($data->application_short_name); ?>
	<br />


</div>