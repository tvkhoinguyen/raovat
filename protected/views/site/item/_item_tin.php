<div style="float:left">
      <a href="<?php echo Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$data->slug)); ?>" >
      		<img src="<?php echo ImageHelper::getImageUrl($data, "image", ThoiSu::SIZE2); ?>" />
      </a>
      <a href="<?php echo Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$data->slug)); ?>">
      		<?php echo $data->title; ?>
      </a>
      <div style="padding-right: 15px;">
      		<?php echo $data->short_content; ?> 
                  <a href="<?php echo Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$data->slug)); ?>"> &nbsp;&nbsp;<i>xem thêm</i>&nbsp;&nbsp;</a>
      </div>
      <br/><br/>
</div>
