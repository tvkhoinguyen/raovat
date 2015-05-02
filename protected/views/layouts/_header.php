
  <div class="container">
	<div class="row">
		<!-- LOGO -->
		<div class="col-xs-12 col-sm-2 col-lg-3 logo">
			<div class="logo-image logo-control">
				<a href="<?php echo Yii::app()->createAbsoluteUrl('/'); ?>" title="Rao vặt Thằng Bờm">
            <img class="logo-img" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/headers/tb_logo.png" alt="Thằng Bờm Rao Vặt" />
            <img class="logo-img-sm" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/headers/tb_mobile_logo.png" alt="Thằng Bờm Rao Vặt" />
            <span>Thangbomaz Rao Vặt</span>
				</a>
				<small class="site-slogan"></small>
			</div>
		</div>
		<!-- //LOGO -->

                <!-- Header Links-->
                <div class="col-lg-4 col-md-4 col-sm-2 hidden-xs">
                    <ul class="web-tre hidden-xs hidden-sm hidden-md">
                        <li class="tt"><a href="<?php echo Yii::app()->setting->getItem('rao_vat_link_tin_tuc'); ?>">Tin tức</a></li>
                        <li class="qc"><a href="<?php echo Yii::app()->setting->getItem('rao_vat_link_quang_cao'); ?>">Quảng Cáo</a></li>
                        <li class="fr"><a href="<?php echo Yii::app()->setting->getItem('rao_vat_link_forum'); ?>">Forum</a></li>
                    </ul>
                    <div class="dropdown hidden-lg web-tre-ipad">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                            Thangbomaz
                            <span class="caret"></span>
                            </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                            <li role="presentation" class="tt"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->setting->getItem('rao_vat_link_tin_tuc'); ?>">Tin tức</a></li>
                            <li role="presentation" class="qc"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->setting->getItem('rao_vat_link_quang_cao'); ?>">Quảng Cáo</a></li>
                        </ul>
                    </div>
                </div>
                <!-- // Header Links-->
                
                <!-- Contact info-->
               <div class="col-lg-5 col-md-6 col-sm-8 hidden-xs">
                       <i class="pull-left phone-icon"></i>
                       <div class="pull-left TX">
                       Liên hệ quảng cáo<br/>
                       <b><font color="#00ff00"><?php echo Yii::app()->setting->getItem('rao_vat_sdt_trai'); ?></font></b><br/>
                       </div>
                       <div class="pull-right FL">
                       Hỗ trợ : &nbsp;&nbsp;<b><font color="#00ff00"><?php echo Yii::app()->setting->getItem('rao_vat_sdt_phai'); ?></font></b><br/>
                       Email: &nbsp;&nbsp;<b><font color="#00ff00"><?php echo Yii::app()->setting->getItem('rao_vat_email'); ?></font></b>
                       </div>
               </div><!-- // contact info-->
        </div>
</div>