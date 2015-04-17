<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="<?php echo $model->isNewRecord ? $this->iconCreate : $this->iconEdit; ?>"></span> <?php echo $model->isNewRecord ? 'Create' : 'Update'; ?> <?php echo $this->singleTitle ?></h3>
    </div>
    <div class="panel-body">
        <div class="form">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'page-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data'),
                    ));
            ?>
            <div class='form-group form-group-sm'>
                <?php echo $form->labelEx($model, 'title', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
                    <?php echo $form->textField($model, 'title', array('class' => 'form-control', 'maxlength' => 255)); ?>
                    <?php echo $form->error($model, 'title'); ?>
                </div>
            </div>
            <div class="form-group form-group-sm">
                <label class="col-sm-1 control-label">&nbsp;</label>
                <div class="col-sm-10">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab1" data-toggle="tab"><?php echo $model->getAttributeLabel('content'); ?></a></li>
                        <li><a href="#tab2" data-toggle="tab"><?php echo $model->getAttributeLabel('title_tag'); ?></a></li>
                        <li><a href="#tab3" data-toggle="tab"><?php echo $model->getAttributeLabel('meta_keywords'); ?></a></li>
                        <li><a href="#tab4" data-toggle="tab"><?php echo $model->getAttributeLabel('meta_desc'); ?></a></li>

                    </ul>
                    <br />
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <div class='form-group form-group-sm'>
                                <div class="col-sm-9">
                                    <?php echo $form->textArea($model, 'content', array('class' => 'my-editor-full', 'cols' => 63, 'rows' => 5)); ?>
                                    <?php echo $form->error($model, 'content'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <div class='form-group form-group-sm'>
                                <div class="col-sm-3">
                                    <?php echo $form->textArea($model, 'title_tag', array('cols' => 63, 'rows' => 5)); ?>
                                    <?php echo $form->error($model, 'title_tag'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab3">
                            <div class='form-group form-group-sm'>
                                <div class="col-sm-3">
                                    <?php echo $form->textArea($model, 'meta_keywords', array('cols' => 63, 'rows' => 5)); ?>
                                    <?php echo $form->error($model, 'meta_keywords'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab4">
                            <div class='form-group form-group-sm'>
                                <div class="col-sm-3">
                                    <?php echo $form->textArea($model, 'meta_desc', array('cols' => 63, 'rows' => 5)); ?>
                                    <?php echo $form->error($model, 'meta_desc'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='form-group form-group-sm'>
                <?php echo $form->labelEx($model, 'status', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
                    <?php echo $form->dropDownList($model, 'status', $model->optionActive, array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'status'); ?>
                </div>
            </div>

<!--            <div class="form-group form-group-sm">
                <?php echo $form->labelEx($model, 'parent_id', array('class' => 'col-sm-1 control-label')); ?>  
                <div class="col-sm-3">
                    <?php echo $form->dropDownList($model, 'parent_id', $model->isNewRecord ? $model->buildPagesDropdown() : $model->buildPagesDropdown($model->id)); ?>
                    <?php echo $form->error($model, 'parent_id'); ?>
                </div>
            </div>    



            <div class='form-group form-group-sm'>
                    <?php echo $form->labelEx($model, 'featured_image', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
                <?php if ($model->featured_image != '') { ?>
                        <div class="thumbnail" id="thumbnail-<?php echo $model->id; ?>">
                            <div class="caption">
                                <h4><?php echo $model->getAttributeLabel('lfeatured_image'); ?></h4>
                                <p>Click on remove button to remove <?php echo $model->getAttributeLabel('featured_image'); ?></p>
                                <p><a href="<?php echo $this->baseControllerIndexUrl(); ?>/removeimage/fieldName/featured_image/id/<?php echo $model->id; ?>" class="label label-danger removedfile" rel="tooltip" title="Remove">Remove</a>
                            </div>
                            <img src="<?php echo Yii::app()->createAbsoluteUrl($model->uploadImageFolder . '/' . $model->id . '/' . $model->featured_image); ?>"  style="width:100%;" />
                        </div>
				<?php } ?>
                    <?php echo $form->fileField($model, 'featured_image', array('title' => "Upload " . $model->getAttributeLabel('featured_image'))); ?>
                    <div class='notes'>Allow file type  <?php echo '*.' . str_replace(',', ', *.', $model->allowImageType); ?> - Maximum file size : <?php echo ($model->maxImageFileSize / 1024) / 1024; ?>M </div>
                    <?php echo $form->error($model, 'featured_image'); ?>
                </div>
            </div>-->

            <div class='form-group form-group-sm'>
<?php echo $form->labelEx($model, 'display_order', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
                <?php echo $form->textField($model, 'display_order', array('class' => 'numeric-control form-control', 'maxlength' => 10)); ?>
                    <?php echo $form->error($model, 'display_order'); ?>
                </div>
            </div>


            <div class="clr"></div>
            <div class="well">
<?php echo $form->hiddenField($model, 'post_type', array('value' => $model->pageType)); ?>
                <?php echo CHtml::htmlButton($model->isNewRecord ? '<span class="' . $this->iconCreate . '"></span> Create' : '<span class="' . $this->iconSave . '"></span> Save', array('class' => 'btn btn-primary', 'type' => 'submit')); ?> &nbsp;  
                <?php echo CHtml::htmlButton('<span class="' . $this->iconCancel . '"></span> Cancel', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\'' . $this->baseControllerIndexUrl() . '\'')); ?>
            </div>
                <?php $this->endWidget(); ?>
        </div>
    </div>
</div>