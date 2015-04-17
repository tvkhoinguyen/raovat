<?php 
    $form=$this->beginWidget('CActiveForm', array(
            'id'=>'join-our-mailing-form',
            'enableAjaxValidation'=>false,
            'enableClientValidation'=>true,
            'clientOptions' => array(
                'validateOnSubmit' => true
            ),
            'htmlOptions'=>array(
              'class'=>'form-horizontal', 
              'role'=>'form',
              // 'enctype' => 'multipart/form-data'
              'onkeypress'=>" if(event.keyCode == 13){ jQuery('#btn_join').click(); }"
            )
        )); ?>
    <div class="col-xs-5 email-form">
        <div class="input-group">
            <span class="input-group-addon">
                <button id="btn_join" type="button" onclick="sendjoin('#btn_join','#join-our-mailing-form' ,'<?php echo Yii::app()->createAbsoluteUrl('site/ajaxjoin.Addsubscriber'); ?>');"
                 class="btn-join">Join our mailing list</button>
            </span>
            <!-- <input type="text" class="form-control" placeholder="Enter your email address" /> -->
            <?php echo $form->textField($model, 'email', array('class' => 'form-control', 'placeholder'=>'Enter your email address'))?>
        </div>
        <div style="margin-left: 120px;">
            <?php echo $form->error($model, 'email')?>
        </div>
    </div>
    <?php $this->endWidget(); ?>


<div class="modal fade" id="joinModal">
    <div class="modal-dialog" style="width: 350px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title">Join our mailing list</h3>
            </div>
            <div class="modal-body">
                <p class="p-mess">Thank you for subscribing to our newsletter.</p>                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function sendjoin(btn,form,link)
{
    var inputtext = jQuery('#Subscriber_email').val();
    if(inputtext==''){
        jQuery('#Subscriber_email').focus();
        return false;
    }
 var data=jQuery(form).serialize();
 // jQuery(btn).button('loading');
 // jQuery(btn).prop('disabled', true); 
 jQuery.ajax({
        type: 'POST',
        url: link,
        async:true,
        data:data,
        dataType:'html',
        beforeSend: function() 
        {
                $.blockUI({ message: null });
        },
        success:function(datajson)
        {
            var obj = jQuery.parseJSON( datajson );
               $.unblockUI();

               if(obj.status == 'error')
               {
                    $.unblockUI();
                    var errors = jQuery.parseJSON( obj.data );
                    console.log(obj.data);
                    jQuery.each(errors, function(key, val) 
                    {
                        jQuery('#'+key+'_em_').text(val[0]);                                                    
                        jQuery('#'+key+'_em_').show()
                    });  
               }else if(obj.status == 'success')
               {
                    console.log(obj.data);
                    // window.location.reload();
                    // window.location.href = '<?php echo Yii::app()->createAbsoluteUrl("site/index"); ?>';
                    // window.location.href = obj.data;
                    $.unblockUI();
                    $('#joinModal').modal();
               }
        },
        error: function(data)
        {
            $.unblockUI();
            console.log(data);
        }
 })
 .always(function () 
 {
    jQuery(btn).button('reset');
 });
}
</script>