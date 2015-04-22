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
                                
                                echo '<div style="display:block; height: 20px;"></div>';

                            
                            ?>

                            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                <!-- Ad raobanusa.com 04 -->
                                <ins class="adsbygoogle"
                                     style="display:block"
                                     data-ad-client="ca-pub-9511385175886331"
                                     data-ad-slot="8496591600"
                                     data-ad-format="auto"></ins>
                                <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>

                        </div>
                </div>              
                <div class="col span_2_of_3">
                         <div class="contact-form" style="margin-top: 20px">
                    
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
                                <?php echo $form->labelEx($model, 'title'); ?>
                                <?php echo $form->textField($model,'title', array('class'=>'textbox', 'placeholder'=>'')); ?>
                                <?php echo $form->error($model,'title'); ?> 
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
                    <br /> <br />
                    <style type="text/css">



        .row_table {
          display: table-row;
          background: #f6f6f6;
        }
        .row_table:nth-of-type(odd) {
          background: #e9e9e9;
        }
        .row_table.header {
          font-weight: bold;
          font-family: Museo Slab;
          color: #ffffff;
          background: #ea6153;
          font-size: 25pt;
        }
        .row_table.green {
          background: #27ae60;
        }
        .row_table.orange {
          background: orange;
        }
        .row_table.blue {
          background: #2980b9;
        }

        .cell_table {


          display: table-cell;
          font-weight: 500;
          font-size: 16pt;
        }
</style>
<div>
<table class="table" cellspacing="0" cellpadding="0" >
            <tr class="row_table header">
            <td class="cell_table" colspan="0" align="center" style="border-radius: 15px 0px 0px 0px;">Loại tin</td>
            <td class="cell_table" colspan="0" align="center" >Chi phí</td>
            <td class="cell_table" colspan="0" align="center" >Loại tin</td>
            <td class="cell_table" colspan="0" align="center" style="border-radius: 0px 15px 0px 0px;">Chi phí</td>
            </tr>     
              
            <tr class="row_table">
            <td class="cell_table" align="center">3 ngày</td>
            <td class="cell_table" align="center">Free</td>
            <td class="cell_table" align="center">2 tháng</td>
            <td class="cell_table" align="center">29 $</td>
            </tr>    
               
            <tr class="row_table">
            <td class="cell_table" align="center">7 ngày</td>
            <td class="cell_table" align="center">4.5 $</td>
            <td class="cell_table" align="center">3 tháng</td>
            <td class="cell_table" align="center">43.5 $</td>
            </tr>
            
            <tr class="row_table">
            <td class="cell_table" align="center">14 ngày</td>
            <td class="cell_table" align="center">9.0 $</td>
            <td class="cell_table" align="center">6 tháng</td>
            <td class="cell_table" align="center">87 $</td>
            </tr>
            
            <tr class="row_table">
            <td class="cell_table" align="center" style="border-radius: 0px 0px 0px 15px;">1 tháng</td>
            <td class="cell_table" align="center">14.5 $</td>
            <td class="cell_table" align="center">1 năm</td>
            <td class="cell_table" align="center" style="border-radius: 0px 0px 15px 0px;">174  $</td>        
            </tr>

    </table>
     <h4><font color="red" size="">***Giá trên đã được Discount 50%.</font></h4>
    </div>
                </div>      
              </div>
    <!-- //MAIN CONTENT -->

  </div>
</div> 
</div>
<br>              



                

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