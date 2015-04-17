<?php 
if(!empty($data))
{ ?>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="ad-square ad-regular" style="background-color: <?php echo TinRaoVat::randomBackgroundColor(); ?>">
          <h3 style="margin-left:20px;"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$data->slug)); ?>"><?php echo $data->title; ?></a></h3>
            <span class="timestamp"><?php echo Yii::app()->format->date($data->updated_date);  ?></span>

              <p align="justify">
                <?php echo $data->short_content; ?>[...]            
              </p>
              
              <h3 class="phone-listing"><?php echo $data->phone; ?></h3>
              <h4 class="location"><i class="glyphicon glyphicon-map-marker"></i>
                    <a href=""><?php echo $data->rState->name; ?></a> 
                    <?php 
                    if(!empty($data->city))
                        echo ' &gt; <a href="">'.$data->city.'</a>';
                    ?>
                </h4>
              <span class="xem-tiep">
                  <a href="<?php echo Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$data->slug)); ?>">Xem thêm <i class="glyphicon glyphicon-arrow-right"></i></a>
              </span>
        </div>
    </div>
<?php
}
?>
