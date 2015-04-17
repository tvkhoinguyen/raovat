<div class="row">
    <?php echo $form->labelEx($model, 'contact_first_name', array('class' => 'col-sm-1 control-label')); ?>
    <div class="col-sm-3">
        <?php echo $form->textField($model, 'contact_first_name', array('class' => 'form-control', 'maxlength' => 255)) ?>
        <?php echo $form->error($model, 'contact_first_name') ?>
    </div>
</div>
<div class="row">
    <?php echo $form->labelEx($model, 'contact_last_name', array('class' => 'col-sm-1 control-label')); ?>
    <div class="col-sm-3">
        <?php echo $form->textField($model, 'contact_last_name', array('class' => 'form-control', 'maxlength' => 255)) ?>
        <?php echo $form->error($model, 'contact_last_name') ?>
    </div>
</div>
<div class="row">
    <?php echo $form->labelEx($model, 'email', array('class' => 'col-sm-1 control-label')); ?>
    <div class="col-sm-3">
        <?php echo $form->textField($model, 'email', array('class' => 'form-control', 'maxlength' => 255)) ?>
        <?php echo $form->error($model, 'email') ?>
    </div>
</div>
<div class="row">
    <?php echo $form->labelEx($model, 'address1', array('class' => 'col-sm-1 control-label')); ?>
    <div class="col-sm-3">
        <?php echo $form->textField($model, 'address1', array('class' => 'form-control', 'maxlength' => 255)) ?>
        <?php echo $form->error($model, 'address1') ?>
    </div>
</div>

<div class="row">
    <?php echo $form->labelEx($model, 'address2', array('class' => 'col-sm-1 control-label')); ?>
    <div class="col-sm-3">
        <?php echo $form->textField($model, 'address2', array('class' => 'form-control', 'maxlength' => 255)) ?>
        <?php echo $form->error($model, 'address2') ?>
    </div>
</div>


<div class="row">
    <?php echo $form->labelEx($model, 'postal_code', array('class' => 'col-sm-1 control-label')); ?>
    <div class="col-sm-3">
        <?php echo $form->textField($model, 'postal_code', array('class' => 'form-control', 'maxlength' => 255)) ?>
        <?php echo $form->error($model, 'postal_code') ?>
    </div>
</div>


<div class="row">
    <?php echo $form->labelEx($model, 'area_code_id', array('class' => 'col-sm-1 control-label')); ?>
    <div class="col-sm-3">
        <?php
        echo $form->dropDownList($model, 'area_code_id', Countries::getDropdownlistWithTableName(), array('class' => 'form-control', 'empty' => '---Select country--'))
        ?>
        <?php echo $form->error($model, 'area_code_id') ?>
    </div>
</div>