<?php
if(!empty($data))
{
	if(!empty($data->rState))
		echo '<li><a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$data->slug)).'">'.$data->title.'</a><span class="adsmanager_cat">('.$data->rState->name.')</span></li>';
}
?>
<!-- <span class="adsmanager_cat">(&nbsp;'.$data->rState->name.' &nbsp;)</span> -->