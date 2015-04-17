<?php $this->beginContent('//layouts/site'); ?>
<?php 
$Tcontroller = Yii::app()->controller->id;
$Taction = Yii::app()->controller->action->id;
?>
<div class="main clearfix">
    <div class="row">
        <div class="col-xs-3">
              <div class="title-1 clearfix">
                  <h3>My profile</h3>
              </div>
              <ul class="nav-list clearfix">
              <?php 
              if($Tcontroller=='site' && $Taction=='myOrder')
              { ?>
                  <li id="account"><a href="<?php echo Yii::app()->createAbsoluteUrl('member/site/myProfile'); ?>">account information</a></li>
                  <li id="profile"><a href="<?php echo Yii::app()->createAbsoluteUrl('member/site/profileInfo'); ?>">profile information</a></li>
                  <li class="active" id="orders"><a href="<?php echo Yii::app()->createAbsoluteUrl('member/site/myOrder'); ?>">my order</a></li>
              <?php
              }else if($Tcontroller=='site' && $Taction=='profileInfo'){ ?>
                  <li id="account"><a href="<?php echo Yii::app()->createAbsoluteUrl('member/site/myProfile'); ?>">account information</a></li>
                  <li id="profile" class="active"><a href="<?php echo Yii::app()->createAbsoluteUrl('member/site/profileInfo'); ?>">profile information</a></li>
                  <li id="orders"><a href="<?php echo Yii::app()->createAbsoluteUrl('member/site/myOrder'); ?>">my order</a></li>
              <?php
              }else if($Tcontroller=='site' && $Taction=='myProfile'){ ?>
                  <li id="account" class="active"><a href="<?php echo Yii::app()->createAbsoluteUrl('member/site/myProfile'); ?>">account information</a></li>
                  <li id="profile"><a href="<?php echo Yii::app()->createAbsoluteUrl('member/site/profileInfo'); ?>">profile information</a></li>
                  <li id="orders"><a href="<?php echo Yii::app()->createAbsoluteUrl('member/site/myOrder'); ?>">my order</a></li>
              <?php
              }else if($Tcontroller=='site' && $Taction=='viewOrder'){ ?>
                  <li id="account" ><a href="<?php echo Yii::app()->createAbsoluteUrl('member/site/myProfile'); ?>">account information</a></li>
                  <li id="profile"><a href="<?php echo Yii::app()->createAbsoluteUrl('member/site/profileInfo'); ?>">profile information</a></li>
                  <li id="orders" class="active"><a href="<?php echo Yii::app()->createAbsoluteUrl('member/site/myOrder'); ?>">my order</a></li>
              <?php
              }
              ?>
              </ul>
        </div>
        <div class="col-xs-9 form-type">
            <?php echo $content; ?>
		</div>  
  </div>
</div>
<?php $this->endContent(); ?>
