<?php
if(!empty($data))
{
	echo '<li>
           		<a href="'.echo Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$data->slug)).'">'.$data->title.'</a>&nbsp;
           		<span class="adsmanager_cat">(&nbsp;'.$data->rState->name.' &nbsp;)</span>
         	</li>';
}
?>