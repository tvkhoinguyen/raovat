<?php
if (isset($model->catalogues)) {
    foreach ($model->catalogues as $photo) {
        ?>
        <li class="span2 img_<?php echo $photo->id ?>" id="<?php echo $photo->{$this->modelUploadName} ?>" style="margin-left: 0px; margin-right: 32px;">
            <div class="thumbnail" style="margin-bottom: 10px">
                <a rel="lightbox[group]" href="<?php echo Utils::uploadUrl($this->folderImage . '/' . $model->id . '/' . $photo->source) ?>" title="<?php echo $photo->title;?>">
                    <?php echo '<img src="' . Utils::uploadUrl($this->folderImage . '/' . $model->id . '/' . $this->thumbDefault . '/' . $photo->source) . '" title="' . $photo->name . '" />'; ?>
                </a>       
            </div>
            <div class="caption_icon" style="text-align: center; margin-bottom: 15px">
                <?php
                $showF = 'none';
                $hideF = 'inline-table';
                $hideD = 'inline-table';
                if ($photo->is_featured == TYPE_YES) {
                    $showF = 'inline-table';
                    $hideF = 'none';
                    $hideD = 'none';
                }
                ?>
                <input type="text" name="title[<?php echo $photo->id;?>]" placeholder="Image title" value="<?php echo $photo->title;?>">
                <a href="javascript: void(0)" photo-id="<?php echo $photo->id ?>" class="btn btn-success feature" title="Feature" style="display: <?php echo $showF; ?>"> <i class="glyphicon glyphicon-star"></i></a>
                <a href="javascript: void(0)" photo-id="<?php echo $photo->id ?>" class="btn btn-primary unfeature" title="Set Feature" style="display: <?php echo $hideF; ?>"> <i class="glyphicon glyphicon-star-empty"></i></a>
                <a href="javascript: void(0)" photo-id="<?php echo $photo->id ?>" class="btn btn-danger delete" title="Delete" style="display: <?php echo $hideD; ?>"><i class="glyphicon glyphicon-trash"></i></a>
            </div>
        </li>
    <?php }
}
?>