<?php
/**
 * Created by PhpStorm.
 * User: Phuong Ho
 * Date: 11/3/14
 * Time: 11:10 AM
 */
?>
<div class='form-group form-group-sm'>
    <?php echo $form->labelEx($model,'order_no', array('class' => 'col-sm-1 control-label')); ?>
    <div class="col-sm-3">
        <?php echo $form->textField($model,'order_no', array('class' => 'form-control', 'maxlength' => 255, 'disabled' => 'disabled')); ?>
        <?php echo $form->error($model,'order_no'); ?>
    </div>
</div>
<div class='form-group form-group-sm'>
    <?php echo $form->labelEx($model,'shipping_fee', array('class' => 'col-sm-1 control-label')); ?>
    <div class="col-sm-3">
        <?php echo $form->textField($model,'shipping_fee', array('class' => 'form-control', 'maxlength' => 255, 'disabled' => 'disabled', 'value' => Yii::app()->format->price($model->shipping_fee))); ?>
        <?php echo $form->error($model,'shipping_fee'); ?>
    </div>
</div>
<?php if(Yii::app()->params['enable_gst']) :?>
    <div class='form-group form-group-sm'>
        <?php echo $form->labelEx($model,'gst', array('class' => 'col-sm-1 control-label', 'label' => 'GST (' . Yii::app()->params['gst']. '%)')); ?>
        <div class="col-sm-3">
            <?php echo $form->textField($model,'gst', array('class' => 'form-control', 'maxlength' => 255, 'disabled' => 'disabled', 'value' => Yii::app()->format->price($model->gst))); ?>
            <?php echo $form->error($model,'gst'); ?>
        </div>
    </div>
<?php endif; ?>
<div class='form-group form-group-sm'>
    <?php echo $form->labelEx($model,'total', array('class' => 'col-sm-1 control-label')); ?>
    <div class="col-sm-3">
        <?php echo $form->textField($model,'total', array('class' => 'form-control', 'maxlength' => 255, 'disabled' => 'disabled', 'value' => Yii::app()->format->price($model->total))); ?>
        <?php echo $form->error($model,'total'); ?>
    </div>
</div>

<div class='form-group form-group-sm'>
    <?php echo $form->labelEx($model,'status', array('class' => 'col-sm-1 control-label')); ?>
    <div class="col-sm-3">
        <?php
            $statusData = $model->getStatusReportBE($model);
        ?>
        <?php if(is_array($statusData)):?>
            <?php echo $form->dropDownList($model,'status', $statusData, array('class' => 'form-control')); ?>
        <?php else: ?>
            <?php echo $form->textField($model,'gst', array('class' => 'form-control', 'maxlength' => 255, 'disabled' => 'disabled', 'value' => $statusData)); ?>
        <?php endif;?>
        <?php echo $form->error($model,'status'); ?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var status = $('#SpOrders_status').val();
        $('#SpOrders_status').change(function() {
           var r = confirm("Are you sure change status");           
           if (r == true) {
               return;
           } else {
               $('#SpOrders_status').val(status);
           }
       });
    });
</script>