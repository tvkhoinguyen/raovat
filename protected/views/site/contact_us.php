<div class="row">
    <div id="t3-content" class="t3-content">
        <div class="row">
            <div class="content_right" style="margin: -40px 0 0 0 ">
                <div class="contact">
                    <div class="section group">             
                        <div class="col span_1_of_3">
                            <div class="contact_info">
                                    <h3>Find Us Here</h3>
                                    <div class="map">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3325.6210460624675!2d-112.218088!3d33.53723699999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x872b6a8c508a5ab1%3A0x9ab1975df488d4a4!2sAAQ+Solution!5e0!3m2!1svi!2s!4v1425977921897" width="100%" height="200" frameborder="0" style="border:0"></iframe>
                                    </div>
                            </div>
                            <div class="company_address">
                                <h3>Our Information :</h3>
                                        <p><font size="+1.5"><b>AAQsolution, Inc.</b></font></p>
                                        <p><i>6942 N 74th Ave</i></p><i>
                                        <p>Glendale, AZ 85303</p>
                                        <p></p></i>
                                <p>Phone: <b>(714) 224-8238</b></p>
                                <p>Email: <span>aaqsolution@gmail.com</span></p>
                                <p>Appointment Monday - Saturday 8 am to 7 pm.</p>
                                <p>Follow on: 
                                        <span><a href="https://www.facebook.com/promotionptaz"><img src="<?php echo Yii::app()->theme->baseUrl;  ?>/images/face_follow.png"></a></span>        
                                        <span><a href="https://plus.google.com/109124683524310781773/"><img src="<?php echo Yii::app()->theme->baseUrl;  ?>/images/g+_follow.png"></a>
                                                </span>
                                </p>
                           </div>
                        </div>   

                        <div class="col span_2_of_3">
                            <div class="contact-form">
                            <h3>Contact Us</h3>
                                    <form method="post" action="" onsubmit="return checkform();">
                                    <div id="errormessage" style="color:red;"></div>

                                    <div>
                                        <span><label>NAME</label></span>
                                        <span><input name="name" id="name" type="text" class="textbox"></span>
                                    </div>
                                    <div>
                                        <span><label>E-MAIL</label></span>
                                        <span><input name="email" id="email" type="text" class="textbox"></span>
                                    </div>
                                    <div>
                                        <span><label>MOBILE</label></span>
                                        <span><input name="phone" id="phone" type="text" class="textbox"></span>
                                    </div>
                                    <div>
                                        <span><label>SUBJECT</label></span>
                                        <span><textarea name="message" id="message"> </textarea></span>
                                    </div>
                                   <div>
                                        <span><input type="submit" value="Submit"></span>
                                  </div>
                                </form>
                            </div>
                        </div>              
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

<?php /*
    <ul class="breadcrumb">
        <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/'); ?>">Home</a></li>
        <li>Contact Us</li>
    </ul>
    <h3 class="ttl-cnt">Contact Us</h3>
     <div class="cnt-pages clearfix">
        <div class="cnt-left">
            <div class="frm-cnt">
                <h4>Enquiry Form</h4>
                <?php if (Yii::app()->user->hasFlash('msg')): ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <?php echo Yii::app()->user->getFlash('msg'); ?>
                    </div>
                <?php endif; ?> 
                
                <?php 
                    $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'contact-us-form',
                        'htmlOptions'=>array('class'=>'form-horizontal', 'role'=>'form'),
                        'enableClientValidation' => false,
                        'enableAjaxValidation' => false,
                        'clientOptions' => array(
                            'validateOnSubmit' => true,
                        ),
                    ));
                ?>
                <?php echo $form->textField($model,'name', array('class'=>'iptct', 'placeholder'=>'Enter your name here')); ?>
                <?php echo $form->error($model,'name'); ?> 

                <?php echo $form->textField($model,'email', array('class'=>'iptct', 'placeholder'=>'Email')); ?>
                <?php echo $form->error($model,'email'); ?> 

                <?php echo $form->textField($model,'company', array('class'=>'iptct', 'placeholder'=>'Company')); ?>
                <?php echo $form->error($model,'company'); ?> 

                <?php echo $form->textField($model,'phone', array('class'=>'iptct', 'placeholder'=>'Tel')); ?>
                <?php echo $form->error($model,'phone'); ?>  

                <?php echo $form->textArea($model, 'message', array('class' => 'txt', 'rows'=>"0", 'cols'=>"0", 'placeholder'=>'Enquiry')); ?>
                <?php echo $form->error($model,'message'); ?>   

                <!-- <input type="text" placeholder="Enter your name here" class="iptct"/>
                <input type="text" placeholder="Email" class="iptct"/>
                <input type="text" placeholder="Company" class="iptct"/>
                <input type="text" placeholder="Tel" class="iptct"/>
                <textarea placeholder="Enquiry"  rows="0" cols="0" class="txt"> </textarea> -->
                <div class="groupbtn">
                    <input type="submit" class="btn-ct" value="Submit"/>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
        <div class="cnt-right">
            <?php 
            $contact_info = SmartBlock::model()->findByPk(50);
            if(!empty($contact_info))
                echo $contact_info->content;
            ?>
            <!-- <h3>Contact Information</h3>
            <h4>Ark Cleaning Specialists Pte Ltd</h4>
            <table>
                <tr>
                    <td>
                    <p class="icon-home">2 Yishun Industrial Street 1, # 01 - 32,<br/>
                        Northpoint Bizhub, Singapore 768159</p>
                        <p class="icon-email"><a href="mailto:info@arkclean@gmail.com"/>info@arkclean@gmail.com</p>
                    </td>
                    <td><p class="icon-phone">+65 6734 1384</p>
                    <p class="icon-fax">+65 6725 8438</p>
                    <p class="icon-mobile">8111 1803</p>
                    </td>
                </tr>
            </table> -->
            <div id="map_canvas" class="map" style='height:288px; width:100%;'></div>
        </div>
   
   </div>
        <!-- <script src="http://maps.google.com/maps/api/js?sensor=false"></script> -->
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script type="text/javascript">
    function initialize() 
    {
        var latitude;
        var longitude;
        var geocoder = new google.maps.Geocoder();
        var map_address = "<?php echo Yii::app()->setting->getItem('map_address'); ?>";
        var map_title = "<?php echo Yii::app()->setting->getItem('map_title'); ?>";
        console.log(map_address);
        console.log(map_title);
        geocoder.geocode( { 'address': map_address}, function(results, status) {

            if (status == google.maps.GeocoderStatus.OK) 
            {
                    latitude = results[0].geometry.location.lat();
                    longitude = results[0].geometry.location.lng();
                    var myLatlng = new google.maps.LatLng(latitude, longitude);
                    var myOptions = {
                      zoom: 18,
                      center: myLatlng,
                      mapTypeId: google.maps.MapTypeId.ROADMAP
                    }
                    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                    
                    var contentString = '<div id="content">'+
                                        '<h1>'+map_title+'</h1>'+
                                        '<div>'+
                                        '<p>'+map_address+'</p>'+
                                        '</div>'+
                                        '</div>';
                    var infowindow = new google.maps.InfoWindow({
                        content: contentString,
                        maxWidth: 500
                    });
                    var link_png = '<?php echo Yii::app()->theme->baseUrl."/img/pin.png"; ?>' ;
                    var companyImage = new google.maps.MarkerImage( 
                        link_png,
                        new google.maps.Size(131,76),
                        new google.maps.Point(0,0)
                    );
                    var marker = new google.maps.Marker({
                        position: myLatlng,
                        map: map,
                        icon: companyImage,
                        title: map_title
                    });
                    google.maps.event.addListener(marker, 'click', function() {
                      infowindow.open(map,marker);
                    });
            }else{
                console.log('status fail');
            } 
        }); 
    }
    initialize();  
</script>


<div class="main clearfix">
    <div class="breadcrumb"><a href="<?php echo Yii::app()->createAbsoluteUrl('/'); ?>">Home</a> <strong>contact Us</strong></div>
    <h1 class="title-2">Contact Us</h1>                
    <div class="contact-wrap clearfix">
        <?php if (Yii::app()->user->hasFlash('msg')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <?php echo Yii::app()->user->getFlash('msg'); ?>
            </div>
        <?php endif; ?> 
        <div class="contact-form">
            <div class="contact-info">
                <?php
                    $content = SmartBlock::model()->findByPk(CONTACT_BLOCK);
                    echo $content->content;
                ?>
            </div>
            <?php 
                $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'contact-us-form',
                    'htmlOptions'=>array('class'=>'form-horizontal', 'role'=>'form'),
                    'enableClientValidation' => false,
                    'enableAjaxValidation' => false,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                    ),
                ));
            ?>
                <div class="form-group">
                    <label class="col-xs-4 control-label">Your Name<span class="required">*</span>:</label>
                    <div class="col-xs-8">
                        <?php echo $form->textField($model,'name', array('class'=>'form-control')); ?>
                        <?php echo $form->error($model,'name'); ?>    
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-xs-4 control-label">Company Name:</label>                    
                    <div class="col-xs-8">
                         <?php echo $form->textField($model,'company', array('class'=>'form-control')); ?>
                        <?php echo $form->error($model,'company'); ?> 
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-xs-4 control-label">Email:</label>
                    <div class="col-xs-8">
                         <?php echo $form->textField($model,'email', array('class'=>'form-control')); ?>
                        <?php echo $form->error($model,'email'); ?> 
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-xs-4 control-label">Contact Number<span class="required">*</span>:</label>
                    <div class="col-xs-8">
                        <?php echo $form->textField($model, 'phone', array('class'=>'form-control')); ?>
                        <?php echo $form->error($model,'phone'); ?> 
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-xs-4 control-label">Type of Enquiry<span class="required">*</span>:</label>
                    <div class="col-xs-8">
                        <?php 
                            echo $form->dropDownList($model, 'enquiry_type', SpEnquiryTypes::getItem(), array('class' => 'selectpicker')); 
                        ?>
                        <?php echo $form->error($model,'enquiry_type'); ?> 
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-xs-4 control-label">Message<span class="required">*</span>:</label>
                    <div class="col-xs-8">
                        <?php echo $form->textArea($model, 'message', array('class' => 'form-control', 'rows'=>"5", 'cols'=>"30")); ?>
                        <?php echo $form->error($model,'message'); ?> 
                    </div>
                </div>            
                <div class="form-group">
                    <label for="inputEmail3" class="col-xs-4 control-label">Captcha:</label>
                    <div class="col-xs-8 captcha">
                        <div class="image">
                            <?php $this->widget('CCaptcha'); ?>
                        </div>
                        <div class="in-captcha">
                            <?php echo $form->textField($model,'verifyCode', array('class' => 'form-control')); ?>
                            <?php echo $form->error($model,'verifyCode'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-offset-4 col-xs-8">
                        <button type="submit" class="btn-contact">Submit</button>
                    </div>
                </div>
            <?php $this->endWidget(); ?>
        </div>
        <div class="contact-info">
            <h3><?php echo Yii::app()->params['companyName']; ?></h3>
            <address><?php echo Yii::app()->params['companyAddress']; ?></address>
            <div class="clearfix">
                <div class="col-1">
                    <p class="ico-mobile"><?php echo Yii::app()->params['mobileNumber']; ?></p>
                    <p class="ico-fax"><?php echo Yii::app()->params['faxNumber']; ?></p>
                </div>
                <div class="col-2">
                    <p class="ico-phone-2"><?php echo Yii::app()->params['phoneNumber']; ?></p>
                    <p class="ico-mail"><a href="mailto:<?php echo Yii::app()->params['emailContact']; ?>"><?php echo Yii::app()->params['emailContact']; ?></a></p>
                </div>
            </div> 
            <!--<div id="map_canvas" class="map"></div>       --> 
            <div class="open-time">
                <?php echo Yii::app()->params['openHour']; ?>
            </div>
        </div>
    </div>
</div>
*/?>