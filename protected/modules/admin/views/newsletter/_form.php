<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="<?php echo $model->isNewRecord ? $this->iconCreate : $this->iconEdit; ?>"></span> <?php echo $model->isNewRecord ? 'Create' : 'Update'; ?> <?php echo $this->singleTitle ?></h3>
    </div>
    <div class="panel-body">
        <div class="form">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'newsletter-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data'),
            ));
            ?>
            <div class='form-group form-group-sm'>
                    <?php echo $form->labelEx($model, 'subject', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
<?php echo $form->textField($model, 'subject', array('class' => 'form-control', 'maxlength' => 50)); ?>
<?php echo $form->error($model, 'subject'); ?>
                </div>
            </div>

            <div class='form-group form-group-sm'>
                    <?php echo $form->labelEx($model, 'send_time', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
        $this->widget('CJuiDateTimePicker',array(
            'model'=>$model, //Model object
            'attribute'=>'send_time', //attribute name
            'mode'=>'datetime', //use "time","date" or "datetime" (default)
            'language'=>'en-GB',
            'options'=>array(
                'showAnim'=>'fold',
                'showButtonPanel'=>true,
                'autoSize'=>true,
                'dateFormat'=>'dd/mm/yy',
                'timeFormat'=>'hh:mm:ss',
                'width'=>'120',
                'separator'=>' ',
//                'regional' => 'en-GB'
            ),
            'htmlOptions' => array(
                'style' => 'width:180px;',
            ),
        ));
        ?>
        <span>(dd/mm/yyyy)</span>
<?php echo $form->error($model, 'send_time'); ?>
                </div>
            </div>

            <div class='form-group form-group-sm'>
                    <?php echo $form->labelEx($model, 'newsletter_group_subscriber', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
<?php
               $this->widget('ext.multiselect.JMultiSelect',array(
                     'model'=>$model,
                     'attribute'=>'newsletter_group_subscriber',
                     'data'=>SubscriberGroup::loadItems(),
                     // additional javascript options for the MultiSelect plugin
                     'options'=>array(),
                     // additional style
                     'htmlOptions'=>array('style' => 'width: 350px;'),
               ));    
           ?>
    <?php echo $form->error($model, 'newsletter_group_subscriber'); ?>
                </div>
            </div>



            <div class='form-group form-group-sm'>
                <?php echo $form->labelEx($model, 'content', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->textArea($model, 'content', array('class' => 'my-editor-full', 'cols' => 63, 'rows' => 5, 'maxlength'=>200)); ?>
                    <?php echo $form->error($model, 'content'); ?>
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


<style type="text/css">
    .display_none{
        display: none;
    }

    .multiselect-container
    {
        width: 300px;
    }
</style>

<script>
    $(function(){
        $('.multiselect_attribute').multiselect({
              maxHeight:200,
              buttonWidth: '300px',
              numberDisplayed: 0,
          });
        
    });
    
     $(window).load(function(){
        $('.wrap_multiselect_attribute').show();
        $('.wrap_multiselect_hide').show();
     });
     
</script>
