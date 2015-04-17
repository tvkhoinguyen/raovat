<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="<?php echo $model->isNewRecord ? $this->iconCreate : $this->iconEdit; ?>"></span> <?php echo $model->isNewRecord ? 'Create' : 'Update'; ?> <?php echo $this->singleTitle ?></h3>
	</div>
	<div class="panel-body">
		<div class="form">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id' => 'goc-orders-form',
			'enableAjaxValidation'=>false,
			'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data'),
		)); ?>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <?php if(!$model->isNewRecord):?>
                    <li class="active"><a href="#tab1" role="tab" data-toggle="tab" class="title-tab1">Order Information </a></li>
                    <li><a href="#tab2" role="tab" data-toggle="tab" class="title-tab2">Product Information</a></li>
                <?php else: ?>
                    <li class="active"><a href="#tab2" role="tab" data-toggle="tab" class="title-tab2">Product Information</a></li>
                <?php endif; ?>
                    <li><a href="#tab3" role="tab" data-toggle="tab" class="title-tab3">Address Infomation</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <?php if(!$model->isNewRecord):?>
                    <div class="tab-pane active" id="tab1">
                        <?php $this->renderPartial('tab/_order_form', array('form' => $form, 'model' => $model)) ?>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <?php $this->renderPartial('tab/_product_detail_form_update', array('form' => $form, 'model' => $model)) ?>
                    </div>
                <?php else : ?>
                    <div class="tab-pane active" id="tab2">
                        <?php $this->renderPartial('tab/_product_detail_form_create', array('form' => $form, 'model' => $model)) ?>
                    </div>
                <?php endif;?>

                <div class="tab-pane" id="tab3">
                    <div class="col-lg-5">
                        <?php $this->renderPartial('tab/_billing_address_form', array('form' => $form, 'model' => $billing_model, 'order'=> $model)) ?>
                    </div>
                    <div class="col-lg-5">
                        <?php $this->renderPartial('tab/_shipping_address_form', array('form' => $form, 'model' => $shipping_model, 'order'=> $model)) ?>
                    </div>
                </div>
            </div>
			<div class="clr"></div>
			<div class="well">
				<?php echo CHtml::htmlButton($model->isNewRecord ? 'Next' : '<span class="' . $this->iconSave . '"></span> Save', array('class' => 'btn btn-primary', 'type' => 'submit')); ?> &nbsp;  
				<?php echo CHtml::htmlButton('<span class="' . $this->iconCancel . '"></span> Cancel', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\'' . $this->baseControllerIndexUrl() . '\'')); ?>
			</div>
		<?php $this->endWidget(); ?>
		</div>
	</div>
</div>
<style type="text/css">
    .col-lg-5 label{
        width: 20%;
    }
    .col-lg-5 .col-sm-3{
        width: 80%;
    }
    .tab-content{
        margin-top: 20px;
    }
    .title_error{border: 1px solid red !important;}
</style>

<script type="text/javascript">
    $(document).ready(function() {
        var err1 = $('#tab1 .error').length;
        var err2 = $('#tab2 .error').length;
        var err3 = $('#tab3 .error').length;
        if (err1 > 0) {
            $('.title-tab1').addClass('title_error');
        }        
        if (err2 > 0) {
            $('.title-tab2').addClass('title_error');
        }
        if (err3 > 0) {
            $('.title-tab3').addClass('title_error');
        }
    });
    function shiptothisaddress11()
    {
        var bill = new Array();
        if($("#shiptothisaddress").is(':checked'))
        {
            bill['contact_first_name'] = $("#GocBillingAddress_contact_first_name").val();
            bill['contact_last_name'] = $("#GocBillingAddress_contact_last_name").val();

            bill['email'] = $("#GocBillingAddress_email").val();
            bill['company'] = $("#GocBillingAddress_company").val();
            bill['phone'] = $("#GocBillingAddress_phone").val();

            bill['address1'] = $("#GocBillingAddress_address1").val();
            bill['address2'] = $("#GocBillingAddress_address2").val();
            bill['postal_code'] = $("#GocBillingAddress_postal_code").val();
            bill['city'] = $("#GocBillingAddress_city").val();
            bill['state'] = $("#GocBillingAddress_state").val();
            bill['area_name'] = $("#GocBillingAddress_area_code_id option:selected").text();
            bill['area_id'] = $("#GocBillingAddress_area_code_id option:selected").val();


            $("#GocShippingAddress_contact_first_name").val( bill['contact_first_name'] );
            $("#GocShippingAddress_contact_last_name").val(bill['contact_last_name']);

            $("#GocShippingAddress_email").val(bill['email']);
            $("#GocShippingAddress_company").val(bill['company']);
            $("#GocShippingAddress_phone").val(bill['phone']);

            $("#GocShippingAddress_address1").val(bill['address1']);
            $("#GocShippingAddress_address2").val(bill['address2']);
            $("#GocShippingAddress_postal_code").val(bill['postal_code']);
            $("#GocShippingAddress_city").val(bill['city']);
            $("#GocShippingAddress_state").val(bill['state']);
            $("#GocShippingAddress_area_code_id option:selected").text(bill['area_name']);
            $("#GocShippingAddress_area_code_id option:selected").val(bill['area_id']);

        }
    }
    
</script>