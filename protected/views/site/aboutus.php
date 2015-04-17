<div class="main clearfix">
    <div class="abouts desc-section">
        <div class="infor-section">
            <div class="content">
                <div class="caption" style="height: 480px;">
                    <h2><?php echo $model7->name; ?></h2>
                    <p><?php echo $model7->content; ?></p>
                </div>
            </div>
            <div class="image"><img src="<?php echo ImageHelper::getImageUrl($model7, 'image', AboutBlock::SIZE1 ); ?>" alt="image"/><h2><?php echo $model7->name; ?></h2></div>
        </div>
        <div class="infor-section">
            <div class="content">
                <div class="caption" style="height: 471px;">
                    <h2><?php echo $model8->name; ?></h2>
                    <p><?php echo $model8->content; ?></p>
                </div>
            </div>
            <div class="image"><img src="<?php echo ImageHelper::getImageUrl($model8, 'image', AboutBlock::SIZE1 ); ?>" alt="image"/><h2><?php echo $model8->name; ?></h2></div>
        </div>
    </div>
</div>