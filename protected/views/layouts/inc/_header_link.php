<div class="col-lg-4 col-md-4 col-sm-2 hidden-xs">
    <ul class="web-tre hidden-xs hidden-sm hidden-md">
        <li class="tt"><a href="<?php echo Yii::app()->setting->getItem('rao_vat_link_tin_tuc'); ?>">Tin tức</a></li>
        <li class="qc"><a href="<?php echo Yii::app()->setting->getItem('rao_vat_link_forum'); ?>">Quảng Cáo</a></li>
        <li class="fr"><a href="<?php echo Yii::app()->setting->getItem('rao_vat_link_quang_cao'); ?>">Forum</a></li>
    </ul>

<!-- Menu out on Mobile devices -->
    <div class="dropdown hidden-lg web-tre-ipad">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
        
        <span class="caret">Thangbomaz</span>
        </button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
            <li role="presentation" class="tt"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->setting->getItem('rao_vat_link_tin_tuc'); ?>">Tin tức</a></li>
            <li role="presentation" class="qc"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->setting->getItem('rao_vat_link_quang_cao'); ?>">Quảng Cáo</a></li>
            <li role="presentation" class="qc"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->setting->getItem('rao_vat_link_forum'); ?>">Forum</a></li>
        </ul>
    </div>
</div>