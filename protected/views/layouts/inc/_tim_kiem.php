<style>
/*.adsmanager_search_module select {
  max-width:180px;
  min-width:180px;
  width:180px;
}
.adsmanager_search_module input[type="text"] {
  max-width:166px;
  min-width:166px;
  width:166px;
}*/
/*#TinRaoVat_s_state_id{
  width: 170px;
    height: 45px;
    border-radius: 0;
    border: 1px solid #006692!important;
    border-radius: 0 !important;
    -moz-border-radius: 0 !important;
    margin-left: 70px;
}
#TinRaoVat_s_job_id{
  width: 180px;
  height: 45px;
  border-radius: 0;
  border: 1px solid #006692!important;
  border-radius: 0 !important;
  -moz-border-radius: 0 !important;
  margin-left: 10px;
}*/
</style>


      <div class="container">
      <?php 
      $model = new TinRaoVat();
      if(isset($_GET['TinRaoVat']))
      {
        $model->attributes = $_GET['TinRaoVat'];
        $model->title = $_GET['TinRaoVat']['title'];
        $model->s_state_id = $_GET['TinRaoVat']['s_state_id'];
        $model->s_job_id = $_GET['TinRaoVat']['s_job_id'];
      }
      
          $form=$this->beginWidget('CActiveForm', array(
              'id'=>'tim-kiem-form',
              'htmlOptions'=>array('class'=>'form-horizontal row form-inline', 'role'=>'form', 'enctype'=>'multipart/form-data' ),
              // 'enableClientValidation' => false,
              // 'enableAjaxValidation' => false,
              'action'=> Yii::app()->createAbsoluteUrl('site/listTin'),
              'method'=>'GET',
              'clientOptions' => array(
                  'validateOnSubmit' => true,
              ),
          ));
      ?>
        <div class="col-sm-3">
          <!-- <input type="text" class="form-control" /> -->
          <?php echo $form->textField($model,'title', array('class'=>'form-control', 'placeholder'=>'Enter Keywords', 'style'=>'width: 90%;')); ?> 
        </div>
        <div class="col-sm-3">
          <!-- <input type="text" class="form-control"/> -->
          <?php echo $form->dropDownList($model,'s_state_id', array(''=>'---Select---')+ State::getListData(), array('class' => 'col-sm-3 form-control', 'style'=>'width: 90%;')); ?>
        </div>
        <div class="col-sm-3">
          <!-- <input type="text" class="form-control"/> -->
          <?php echo $form->dropDownList($model,'s_job_id', array(''=>'---Select---')+Job::getListData(), array('class' => 'col-sm-3 form-control', 'style'=>'width: 90%;')); ?>
        </div>
        <button type="submit" class="col-sm-3 btn btn-default btn-primary">Search</button>
            
      <?php $this->endWidget(); ?>
      </div>
<div class="clearfix">&nbsp;</div>
