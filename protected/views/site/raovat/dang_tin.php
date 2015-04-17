<style type="text/css">
    .errorMessage{
    color: red;
}
.require{
    color: red;
}
span.required{
    color: red !important;
}
.contact-form span{
    display: inline;
}
.captcha_css{
    width: 150px; height: 30px;  display: inline;
    font-size: 16px;
}
</style>
<div class="row">
    <div class="content_right" style="margin: -40px 0 0 0 ">
        <div class="contact">
            <div class="section group">             
                <div class="col span_1_of_3">

                        <div class="company_address" style="margin-top:30px">
                            <?php
                            $quang_cao1 = QuangCao::model()->findByPk(1);
                            if(!empty($quang_cao1))
                                echo '<a target="_blank" href="'.$quang_cao1->link.'"><img src="'.$quang_cao1->getImageUrl('image', QUANG_CAO_DANG_TIN ).'" /></a>';
                            
                            echo '<div style="display:block; height: 20px;"></div>';

                            $quang_cao2 = QuangCao::model()->findByPk(2);
                            if(!empty($quang_cao2))
                                echo '<a target="_blank" href="'.$quang_cao2->link.'"><img src="'.$quang_cao2->getImageUrl('image', QUANG_CAO_DANG_TIN ).'" /></a>';
                            ?>
                        </div>
                </div>              
                <div class="col span_2_of_3">
                         <div class="contact-form" style="margin-top: 20px">
                    <h3><font color="#000">Nội dung tin</font></h3>
                            <!-- <form method="post" action="" onsubmit="return checkform();"> -->
                            <?php 
                                $form=$this->beginWidget('CActiveForm', array(
                                    'id'=>'dang-tin-form',
                                    'htmlOptions'=>array('class'=>'form-horizontal', 'role'=>'form', 'enctype'=>'multipart/form-data' ),
                                    // 'enableClientValidation' => false,
                                    // 'enableAjaxValidation' => false,
                                    'clientOptions' => array(
                                        'validateOnSubmit' => true,
                                    ),
                                ));
                            ?>
                            <?php 
                            // echo '<pre>';
                            // print_r($model->getErrors());
                            // echo '</pre>';
                            ?>
                            <?php $this->getMessageSuccess(); ?>
                            <div>
                                <!-- <span><label>Name</label></span> -->
                                <?php echo $form->labelEx($model, 'post_user_name'); ?>
                                <!-- <span><input name="name" id="name" type="text" class="textbox"></span> -->
                                <?php echo $form->textField($model,'post_user_name', array('class'=>'textbox', 'placeholder'=>'')); ?>
                                <?php echo $form->error($model,'post_user_name'); ?> 
                            </div>
                            <div>
                                <?php echo $form->labelEx($model, 'title'); ?>
                                <?php echo $form->textField($model,'title', array('class'=>'textbox', 'placeholder'=>'')); ?>
                                <?php echo $form->error($model,'title'); ?> 
                            </div>
                            <div>
                                <!-- <span><label>Address</label></span> -->
                                <?php echo $form->labelEx($model, 'address'); ?>
                                <!-- <span><input name="address" id="address" type="text" class="textbox"></span> -->
                                <?php echo $form->textField($model,'address', array('class'=>'textbox', 'placeholder'=>'')); ?>
                                <?php echo $form->error($model,'address'); ?> 
                            </div>
                            <div>
                                <?php echo $form->labelEx($model, 'email'); ?>
                                <?php echo $form->textField($model,'email', array('class'=>'textbox', 'placeholder'=>'')); ?>
                                <?php echo $form->error($model,'email'); ?> 
                            </div>
                            <div style="float:left">
                                <!-- <span><label>Job</label></span> -->
                                <?php echo $form->labelEx($model, 'job_id'); ?>
                                <?php echo $form->dropDownList($model,'job_id', Job::getListData(), array('class' => '')); ?>
                                <?php echo $form->error($model,'job_id'); ?> 
                                <!-- <select id="ad_job_post" name="ad_job_post">
                                            <option value="">All Job</option>
                                </select> -->
                            </div>
                            <div style="float:left; margin-left: 80px">
                                <!-- <span><label>State</label></span> -->
                                <?php echo $form->labelEx($model, 'state_id'); ?>
                                <?php echo $form->dropDownList($model,'state_id', State::getListData(), array('class' => '')); ?>
                                <?php echo $form->error($model,'state_id'); ?>
                                <!-- <select id="ad_state_post" name="ad_state_post">
                                            <option value="">All State</option>
                                            <option value="250">Wyoming</option>
                                </select> -->
                            </div>
                            
                            <div style="float:left; margin-left: 70px">
                                <!-- <span><label>City</label></span> -->
                                <?php echo $form->labelEx($model, 'city'); ?>
                                <!-- <input name="name" id="name" type="text" class="textbox"> -->
                                <?php echo $form->textField($model,'city', array('class'=>'textbox', 'placeholder'=>'')); ?>
                                <?php echo $form->error($model,'city'); ?> 
                            </div>

                            <div style="clear: both;">
                                <!-- <span><label>MOBILE</label></span> -->
                                <?php echo $form->labelEx($model, 'phone'); ?>
                                <!-- <span><input name="phone" id="phone" type="text" class="textbox"></span> -->
                                <?php echo $form->textField($model,'phone', array('class'=>'textbox', 'placeholder'=>'')); ?>
                                <?php echo $form->error($model,'phone'); ?>
                            </div>
                            <div style="clear: both;">
                                <?php echo $form->labelEx($model, 'mobile'); ?>
                                <?php echo $form->textField($model,'mobile', array('class'=>'textbox', 'placeholder'=>'')); ?>
                                <?php echo $form->error($model,'mobile'); ?>
                            </div>

                            <div>
                                <?php echo $form->labelEx($model, 'loai_tin'); ?>
                                <?php echo $form->dropDownList($model,'loai_tin', TinRaoVat::$loai_tin, array('class' => '')); ?>
                                <?php echo $form->error($model,'loai_tin'); ?>
                            </div>
                            <div>
                                <!-- <span><label>Content</label></span> -->
                                <?php echo $form->labelEx($model, 'content'); ?>
                                <!-- <span><textarea name="message" id="message"> </textarea></span> -->
                                <?php echo $form->textArea($model, 'content', array( 'placeholder'=>'')); ?>
                                <?php echo $form->error($model,'content'); ?>
                            </div>
                            <div style="float:left">
                                <!-- <span><label>Image 01</label></span> -->
                                <?php echo $form->labelEx($model, 'image1'); ?>
                                <!-- <span><input name="image1" id="image1" type="file" class="textbox"></span> -->
                                <?php echo $form->fileField($model, 'image1', array('class' => 'textbox')); ?>
                                <?php echo $form->error($model,'image1'); ?>
                            </div>
                            <div style="float:left">
                                <!-- <span><label>Image 02</label></span> -->
                                <?php echo $form->labelEx($model, 'image2'); ?>
                                <!-- <span><input name="image2" id="image2" type="file" class="textbox"></span> -->
                                <?php echo $form->fileField($model, 'image2', array('class' => 'textbox')); ?>
                                <?php echo $form->error($model,'image2'); ?>
                            </div>

                            <div style="  clear: both;">
                                    <?php if(CCaptcha::checkRequirements()): ?>
                                            <?php echo $form->labelEx($model,'verifyCode'); ?>
                                            <div>
                                            <?php $this->widget('CCaptcha'); ?>
                                            <br/>
                                            <?php echo $form->textField($model,'verifyCode', array('style'=>'width: 150px; height: 40px;  display: inline;    font-size: 20px; margin-top:5px;', 'placeholder'=>'Enter captcha')); ?>
                                            </div>
                                            <?php echo $form->error($model,'verifyCode'); ?>
                                        <?php endif; ?>
                            </div>
                            <!-- <div style="float:left">
                                <p align="center">      
                                    </p><div class="g-recaptcha" data-sitekey="6LfSyAQTAAAAAByCP1TsFr3zTUUC0PgtSITx-mUQ"><div><div style="width: 304px; height: 78px;"><iframe frameborder="0" hspace="0" marginheight="0" marginwidth="0" scrolling="no" style="" tabindex="0" vspace="0" width="304" title="tiện ích con mã xác thực lại" role="presentation" height="78" id="I0_1428844430000" name="I0_1428844430000" src="https://www.google.com/recaptcha/api2/anchor?k=6LfSyAQTAAAAAByCP1TsFr3zTUUC0PgtSITx-mUQ&amp;co=aHR0cDovL3Jhb2JhbnVzYS5jb20.&amp;hl=vi&amp;v=r20150406160312&amp;usegapi=1&amp;jsh=m%3B%2F_%2Fscs%2Fapps-static%2F_%2Fjs%2Fk%3Doz.gapi.vi.SPmH4gm-cIw.O%2Fm%3D__features__%2Fam%3DIQ%2Frt%3Dj%2Fd%3D1%2Ft%3Dzcms%2Frs%3DAGLTcCMDXvCxK_0AO1XTtg9Ud5lNcpCIaw#id=I0_1428844430000&amp;parent=http%3A%2F%2Fraobanusa.com&amp;pfname=&amp;rpctoken=29519814"></iframe></div><textarea dir="ltr" id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 80px; border: 1px solid #c1c1c1; margin: 0px; padding: 0px; resize: none;  display: none; "></textarea></div></div>
                              
                              <p></p>
                            </div> -->

                            <br/>
                            <div style="  clear: both;  float: left;  background-color: #ccc; margin-top:5px;">
                                <span><input type="submit" value="Submit" class="btn btn-primary" /></span>
                            </div>
                        <!-- </form> -->
                        <?php $this->endWidget(); ?>
                    </div>
                </div>      
              </div>
    <!-- //MAIN CONTENT -->

  </div>
</div> 
</div>
<br>              










            <h1>Bạn muốn quảng cáo của mình hiển thị trong:</h1>

                <ul class="ch-grid">
                    <li>
                        <div class="ch-item ch-img-1">              
                            <div class="ch-info-wrap">
                                <div class="ch-info">
                                    <div class="ch-info-front ch-img-1"></div>
                                    <div class="ch-info-back">
                                        <h3><br>Free for 3 days</h3>
                                        
                                    </div>  
                                </div>
                            </div>
                        </div><br>
                        <div style="width:100%;text-align:center;">
                        <input name="" type="button" value="Free Post" style="color:#3366FF;background-color:;font-family:Comic Sans MS;font-size:20px;font-weight:bold;font-style:italic;border-radius: 5px 5px 5px 5px;" onclick="window.open('')">
                        <p href="" style="display:block;font-size:12px;color:#ff0000;margin:4px 0 0 0;">Secure Payments</p></div>
                    </li>
                    <li>
                        <div class="ch-item ch-img-2">
                            <div class="ch-info-wrap">
                                <div class="ch-info">
                                    <div class="ch-info-front ch-img-2"></div>
                                    <div class="ch-info-back">
                                        <h3>Just 4.5$ for a week<br>(Discount 50%)</h3>
                                        
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div style="width:100%;text-align:center">
                        <input name="" type="button" value="Subscrible" style="color:#f4b400;background-color:;font-family:Comic Sans MS;font-size:20px;font-weight:bold;font-style:italic;border-radius: 5px 5px 5px 5px;" onclick="window.open('https://payments.paysimple.com/Login/CheckOutFormLogin/UIHw8lXpGp1u-a7-L4J5CcZJ2cw-')">
                        <p style="display:block;font-size:12px;color:#ff0000;margin:4px 0 0 0;">Secure Payments</p></div>
                    </li>
                    <li>
                        <div class="ch-item ch-img-3">
                            <div class="ch-info-wrap">
                                <div class="ch-info">
                                    <div class="ch-info-front ch-img-3"></div>
                                    <div class="ch-info-back">
                                        <h3>Just 14.5$ for a week<br>(Discount 50%)</h3>
                                        
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div style="width:100%;text-align:center">
                        <input name="" type="button" value="Subscrible" style="color:#db4437;background-color:;font-family:Comic Sans MS;font-size:20px;font-weight:bold;font-style:italic;border-radius: 5px 5px 5px 5px;" onclick="window.open('https://payments.paysimple.com/Login/CheckOutFormLogin/dDgS2oH9ssO51APXrIC30dYW6vE-')">
                        <p style="display:block;font-size:12px;color:#ff0000;margin:4px 0 0 0;">Secure Payments</p></div>
                    </li>
                </ul>

                

                <div class="company_address" style="margin-left: 100px">
                        <h2><font color="#000"> Qui định</font></h2>
                        <p align="justify"><font size="+1.5"><b>Tin rao vặt chỉ tồn tại trong 3 ngày kể từ ngày đăng tin đối với tin miễn phí.</b></font></p>
                        <p align="justify"><font size="+1.5"><b>Tin rao vặt chỉ tồn tại trong 7 ngày kể từ ngày đăng tin đối với dạng tin trả phí 1 tuần.</b></font></p>
                        <p align="justify"><font size="+1.5"><b>Tin rao vặt chỉ tồn tại trong 30 ngày kể từ ngày đăng tin đối với dạng tin trả phí 1 tháng.</b></font></p>
                        
                        <p align="justify"><font color="#003366" size="+1">
                            + Thời gian duyệt tin và hiển thị chậm nhất là 12 tiếng sau khi đăng.<br>
                            + Không đăng các tin và hình ảnh có nội dung phản cảm.<br>
                            + Nội dung tin phải rõ ràng, không mơ hồ.<br>
                            + Số điện thoại và địa chỉ phải có thật.<br>
                        </font> </p>
                                            
                   </div>
