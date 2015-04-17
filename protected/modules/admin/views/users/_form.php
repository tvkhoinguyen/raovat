<?php 
    // if( $model->hasErrors()  )
    // {
    //     echo '<pre>';
    //     print_r($model->getErrors());
    //     echo '</pre>';
    // }

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="<?php echo $model->isNewRecord ? $this->iconCreate : $this->iconEdit; ?>"></span> <?php echo $model->isNewRecord ? 'Create' : 'Update'; ?> <?php echo $this->singleTitle ?></h3>
    </div>
    <div class="panel-body">
        <div class="form">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'users-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data'),
            ));
            ?>
            <h4>Account</h4>
            <div class='form-group form-group-sm'>
                <?php echo $form->labelEx($model, 'email', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
                <?php 
                if( !$model->isNewRecord )
                {
                    echo $form->textField($model, 'email', array('class' => 'form-control', 'maxlength' => 255, 'readonly'=>'readonly'));
                }else{
                    echo $form->textField($model, 'email', array('class' => 'form-control', 'maxlength' => 255));  
                }
                ?>
                    <?php echo $form->error($model, 'email'); ?>
                </div>
            </div>
            <div class="form-group form-group-sm">				
                    <?php echo $form->labelEx($model, 'temp_password', array('class' => "col-sm-1 control-label")); ?>
                    <div class="col-sm-3">
                            <?php echo $form->passwordField($model, 'temp_password', array('size' => 47, 'maxlength' => 30, 'value' => '', 'class' => "form-control")); ?>
                            <?php echo $form->error($model, 'temp_password'); ?>
                    </div>
            </div>
            <div class="form-group form-group-sm">
                    <?php echo $form->labelEx($model, 'password_confirm', array('class' => "col-sm-1 control-label")); ?>
                    <div class="col-sm-3">
                            <?php echo $form->passwordField($model, 'password_confirm', array('size' => 47, 'maxlength' => 50, 'value' => '', 'class' => "form-control")); ?>
                            <?php echo $form->error($model, 'password_confirm'); ?>
                             <?php 
                            if( !$model->isNewRecord )
                            { ?>
                                <div class='notes'><font color="red">Leave blank if you don't want to change password. </font></div>
                            <?php } ?>
                    </div>
            </div>  
            <div class='form-group form-group-sm'>
                <?php echo $form->labelEx($model, 'title', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
                    <?php echo $form->dropDownList($model, 'title', Salutations::model()->getList(),array('class' => 'form-control', 'maxlength' => 255)); ?>
                    <?php echo $form->error($model, 'title'); ?>
                </div>
            </div>
            <div class='form-group form-group-sm'>
                <?php echo $form->labelEx($model, 'first_name', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
                    <?php echo $form->textField($model, 'first_name', array('class' => 'form-control', 'maxlength' => 255)); ?>
                    <?php echo $form->error($model, 'first_name'); ?>
                </div>
            </div>
            <div class='form-group form-group-sm'>
                <?php echo $form->labelEx($model, 'last_name', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
                    <?php echo $form->textField($model, 'last_name', array('class' => 'form-control', 'maxlength' => 255)); ?>
                    <?php echo $form->error($model, 'last_name'); ?>
                </div>
            </div>             
            <h4>Contact Information</h4>        
            <div class='form-group form-group-sm'>
                <?php echo $form->labelEx($model, 'phone', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
                    <?php echo $form->textField($model, 'phone', array('class' => 'form-control', 'maxlength' => 20)); ?>
                    <?php echo $form->error($model, 'phone'); ?>
                </div>
            </div>
            <div class='form-group form-group-sm'>
                <?php echo $form->labelEx($model, 'company', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
                    <?php echo $form->textField($model, 'company', array('class' => 'form-control', 'maxlength' => 255)); ?>
                    <?php echo $form->error($model, 'company'); ?>
                </div>
            </div>
            <h4>Address</h4>
            <div class='form-group form-group-sm'>
                <?php echo $form->labelEx($model, 'address1', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
                    <?php echo $form->textField($model, 'address1', array('class' => 'form-control', 'maxlength' => 255)); ?>
                    <?php echo $form->error($model, 'address1'); ?>
                </div>
            </div>
            <div class='form-group form-group-sm'>
                <?php echo $form->labelEx($model, 'address2', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
                    <?php echo $form->textField($model, 'address2', array('class' => 'form-control', 'maxlength' => 255)); ?>
                    <?php echo $form->error($model, 'address2'); ?>
                </div>
            </div>
            <div class='form-group form-group-sm'>
                <?php echo $form->labelEx($model, 'postal_code', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
                    <?php echo $form->textField($model, 'postal_code', array('class' => 'form-control', 'maxlength' => 10)); ?>
                    <?php echo $form->error($model, 'postal_code'); ?>
                </div>
            </div>           
            <div class='form-group form-group-sm'>
                <?php echo $form->labelEx($model, 'area_code_id', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
                    <?php echo $form->dropDownList($model,'area_code_id', AreaCode::model()->loadArrArea(), array('class'=>'form-control')); ?>
                    <?php echo $form->error($model, 'area_code_id'); ?>
                </div>
            </div> 
            <div class='form-group form-group-sm'>
                <?php echo $form->labelEx($model, 'status', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
                    <?php echo $form->dropDownList($model, 'status', $model->optionActive , array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'status'); ?>
                </div>
            </div>  

            <div class="clr"></div>
            <div class="well">
                <?php echo CHtml::htmlButton($model->isNewRecord ? '<span class="' . $this->iconCreate . '"></span> Create' : '<span class="' . $this->iconSave . '"></span> Save', array('class' => 'btn btn-primary', 'type' => 'submit')); ?> &nbsp;  
                <?php echo CHtml::htmlButton('<span class="' . $this->iconCancel . '"></span> Cancel', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\'' . $this->baseControllerIndexUrl() . '\'')); ?>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>