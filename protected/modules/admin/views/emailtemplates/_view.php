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
	<b><?php echo CHtml::encode($data->getAttributeLabel('email_subject')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->email_subject), array('view', 'id'=>$data->id)); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('parameter_description')); ?>:</b>
	<?php echo CHtml::encode($data->parameter_description); ?>
	<br />
</div>