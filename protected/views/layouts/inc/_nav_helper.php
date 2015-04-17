<div class="hidden-xs hidden-sm">
  <div class="container">
    <div class="navbar navbar-default yamm">
      <div id="navbar-collapse-grid" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <!-- Grid 12 Menu -->
            <li class="dropdown"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/index'); ?>"><span>Home</span></a></li>
            <?php 
            $criteria = new CDbCriteria();
            $criteria->compare('t.status',STATUS_ACTIVE);
            // $criteria->compare('t.status',STATUS_ACTIVE);
            // $criteria->limit = ;
            $criteria->order ="order_display DESC";
            $models = Job::model()->findAll($criteria);
            foreach ($models as $one) 
            {
              echo '<li class="dropdown"><a href="'.Yii::app()->createAbsoluteUrl('site/listTin',array('j_slug'=>$one->slug)  ).'"><span>'.$one->name.'</span></a></li>';
            }

            ?>
            <li class="dropdown"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/contactUs'); ?>"><span>Liên hệ</span></a></li>

          </ul>
      </div>
    </div>
  </div>
</div>