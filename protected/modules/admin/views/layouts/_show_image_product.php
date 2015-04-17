<?php
if (isset($model)) {
    $models = GocProductImages::listImageColor($model->product_id, $model->color_id);
    if (!empty($models)) {
    foreach ($models as $photo) {
       
        ?>
        <li class="span2 img_<?php echo $photo->id ?>" id="<?php echo $photo->id; ?>" style="margin-left: 0px; margin-right: 32px;">
            <div class="thumbnail" style="margin-bottom: 10px">
                <a rel="lightbox[group]" href="<?php echo Utils::uploadUrl($this->folderImage . '/' . $model->id . '/' . $photo->image) ?>" title="<?php echo $photo->image;?>">
                    <?php echo '<img src="' . Utils::uploadUrl($this->folderImage . '/' . $model->product_id.'/'.$model->color_id . '/' . $this->thumbDefault . '/' . $photo->image) . '" />'; ?>
                </a>       
            </div>
            <div class="caption_icon" style="text-align: center; margin-bottom: 15px">
                <?php
                $showF = 'none';
                $hideF = 'inline-table';
                $hideD = 'inline-table';
                if ($photo->is_default == TYPE_YES) {
                    $showF = 'inline-table';
                    $hideF = 'none';
                    $hideD = 'none';
                }
                ?>
                <a href="javascript: void(0)" photo-id="<?php echo $photo->product_color_id ?>" class="btn btn-success feature" title="Feature" style="display: <?php echo $showF; ?>"> <i class="glyphicon glyphicon-star"></i></a>
                <a href="javascript: void(0)" photo-id="<?php echo $photo->product_color_id ?>" class="btn btn-primary unfeature" title="Set Feature" style="display: <?php echo $hideF; ?>"> <i class="glyphicon glyphicon-star-empty"></i></a>
                <a href="javascript: void(0)" photo-id="<?php echo $photo->product_color_id; ?>" class="btn btn-danger delete" title="Delete" style="display: <?php echo $hideD; ?>"><i class="glyphicon glyphicon-trash"></i></a>
            </div>
        </li>
    <?php }
    }
}
?>