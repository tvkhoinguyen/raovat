<?php if(isset(Yii::app()->user->id)){?>
<div class="selectBox">
    <a class="show_hide" href="javascript:void();">
       <img width="16" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/setting.png" alt="" />
   </a>
   <div class="selectOptions slidingDiv">
        <a href="<?php echo Yii::app()->createAbsoluteUrl('member/profile/myprofile'); ?>"> <span class="selectOption">My Profile  </span></a>
        <a href="<?php echo Yii::app()->createAbsoluteUrl('member/profile/change_password'); ?>"><span class="selectOption">Change Password</span></a>
        <a href="<?php echo Yii::app()->createAbsoluteUrl('site/logout'); ?>"><span class="selectOption">Logout</span></a>
   </div>
</div>
<span>Welcome</span> <a href="<?php echo Yii::app()->createAbsoluteUrl('member/profile/myprofile'); ?>">
<?php echo Yii::app()->user->full_name; ?>
</a>
<?php }else{ ?>
 <a href="javascript:void();" class="showfancy">login</a> /
 <a href="<?php echo Yii::app()->createAbsoluteUrl('site/register'); ?>">register </a>
<?php } ?>