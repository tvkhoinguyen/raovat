<div class='search-form form'>
    <div class="panel panel-default">
        <div class="panel-body">

            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'action' => Yii::app()->createUrl($this->route),
                'method' => 'Post',
                'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'id' => 'search-form'),
            ));
            ?>
            <div class="col-sm-4">
                <div class="form-group form-group-sm">
                    <?php echo $form->labelEx($model, 'type', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-7">
                         <?php echo $form->dropDownList($model, 'type', ReportManualForm::getListType(), array('empty' => '----Select----', 'class' => 'form-control col-sm-4')); ?>
                        <?php echo $form->error($model, 'type'); ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group form-group-sm">
                    <?php echo $form->labelEx($model, 'date_from', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-7">
                            <div style="display: inline-flex">
                                <?php echo $form->textField($model, 'date_from', array('class' => 'my-datepicker-control form-control col-sm-4', 'value'=>$model->date_from, 'readonly'=>'readonly' )); ?>
                            </div>
                            <div>
                                <?php echo $form->error($model, 'date_from'); ?>
                            </div>
                    </div>
                    
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group form-group-sm">
                    <?php echo $form->labelEx($model, 'date_to', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-7">
                            <div style="display: inline-flex">
                                <?php echo $form->textField($model, 'date_to', array('class' => 'my-datepicker-control form-control col-sm-4', 'value'=>$model->date_to, 'readonly'=>'readonly' )); ?>
                            </div>
                            <div>
                                <?php echo $form->error($model, 'date_to'); ?>
                            </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="well">
                    <?php echo CHtml::htmlButton('<span class="' . $this->iconSearch . '"></span> Get report', array('class' => 'btn btn-default btn-sm', 'type' => 'submit')); ?>			
                    <?php echo CHtml::htmlButton('<span class="' . $this->iconCancel . '"></span> Clear', array('class' => 'btn btn-default btn-sm', 'type' => 'reset', 'id' => 'clearsearch')); ?>
                </div>
            </div> 
        <?php $this->endWidget(); ?>

        </div>
    </div>
</div>
