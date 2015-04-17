<?php if($mBanner): ?>
    <?php 
    foreach ($mBanner as $Banner) { 
            if($Banner->link != null):?>
        <a href="<?php echo $Banner->link; ?>" target='_blank'>
        <img src="<?php echo Yii::app()->baseUrl.'/upload/admin/advertise/'.$Banner->large_image  ?>" >
        </a>
        <?php else:?>

            <img src="<?php echo Yii::app()->baseUrl.'/upload/admin/advertise/'.$Banner->large_image  ?>" >

        <?php endif; 
        }
        ?>
<?php endif; ?>