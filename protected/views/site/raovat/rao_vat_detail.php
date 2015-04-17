<div class="row">

    <!-- Banner Detail -->
    <div class="col-lg-4 col-md-5 col-sm-6 hidden-xs">
      <div class="google_ad">
          <?php
          $quang_cao1 = QuangCao::model()->findByPk(3);
          if(!empty($quang_cao1))
              echo '<a href="'.$quang_cao1->link.'" target="_blank"><img src="'.$quang_cao1->getImageUrl('image', QUANG_CAO_TIN_CHI_TIET ).'" /></a>';
          
          
          ?>
        <!-- <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/detail2.jpg" width="370px" height="280px"> -->
      </div>
      <div class="ad_map" style="margin-top: 70px;">
          <?php
            $quang_cao2 = QuangCao::model()->findByPk(4);
            if(!empty($quang_cao2))
                echo '<a href="'.$quang_cao2->link.'" target="_blank"><img src="'.$quang_cao2->getImageUrl('image', QUANG_CAO_TIN_CHI_TIET ).'" /></a>';
          ?>
        <!-- <a href="" target="_blank"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/detail3.jpg" width="370px" height="200px"></a> -->
      </div>
    </div>


    <!-- Detail content -->
    <div class="col-lg-5 col-md-7 col-sm-6">
        <div class="ad_detail">
            <h1><?php echo $model->title; ?></h1>
            <span class="timestamp"><?php echo Yii::app()->format->date($model->updated_date);  ?></span>
            <font color="#fff">
                <div class="col-lg-6 col-md-6 col-sm-12 detail-img">
                    <a rel="lytebox[roadtrip14957]">
                      <!-- <img class="thumbnail" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/detail.jpg" alt="<?php echo $model->title; ?>"> -->
                      <?php if(!empty($model->image1)){ ?>
                        <img class="thumbnail" src="<?php echo $model->getImageUrl('image1', RAOVAT_SIZE ); ?>" alt="<?php echo $model->title; ?>">
                      <?php } ?>
                    </a>
                    <a rel="lytebox[roadtrip14957]">
                      <!-- <img class="thumbnail" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/detail1.jpg" alt="<?php echo $model->title; ?>"> -->
                      <?php if(!empty($model->image2)){ ?>
                        <img class="thumbnail" src="<?php echo $model->getImageUrl('image2', RAOVAT_SIZE ); ?>" alt="<?php echo $model->title; ?>">
                      <?php } ?>
                    </a>
                </div>   

                <h2 align="justify"><?php echo $model->content; ?></h2>
                <div class="phone">
                      <?php if(!empty($model->phone))
                              echo '<font size="4px"><i class="glyphicon glyphicon-phone"></i></font> '.$model->phone;
                       ?>
                       <br>
                       <?php if(!empty($model->mobile))
                              echo '<font size="4px"><i class="glyphicon glyphicon-phone-alt"></i></font> '.$model->mobile;
                       ?>
                      <!-- <font size="4px"><i class="glyphicon glyphicon-phone"></i></font> 843-379-9333
                      <br>
                      <font size="4px"><i class="glyphicon glyphicon-phone-alt"> </i></font> 714-234-0209 -->
                </div>
                <div class="detail_wrapper_chitiet">
                  <div>Người đăng: <?php echo $model->post_user_name; ?></div>
                  <div>Địa chỉ: <?php echo $model->address; ?></div>
                  <div>City: <?php echo $model->city; ?></div>
                  <div>State: <?php echo (!empty($model->rState) ? $model->rState->name : ""); ?></div>
                  <div>Danh mục: <?php echo (!empty($model->rJob) ? $model->rJob->name : ""); ?></div>
                </div>
            </font>


            <div class="row"></div>

        </div>
    </div>

    <!-- Detail Right -->
    <div class="col-lg-3 hidden-md hidden-sm hidden-xs">
            <ul class="mostread">
                <h3><font color="#000">Rao vặt Hot trong tuần</font></h3>
                <?php
                $this->widget('zii.widgets.CListView', array(
                                'id' => 'list-trong-tuan',
                                'dataProvider'=>$list_raovat_trong_tuan,
                                'itemView'=>'raovat/_item_detail_trong_tuan',
                                // 'enableHistory'=> true,
                                // 'pagerCssClass' => 'pagination',
                                // 'ajaxUpdate'=>'list-trong-tuan',
                                'ajaxUpdate' => true,
                                // 'loadingCssClass' => '', //remove loading icon
                                'summaryText' => '',
                                'emptyText' => '<div class="alert alert-info">Sorry! No data found</div>',
                                // 'emptyText' => '<div class="review clearfix">Sorry! No data found.</div>',
                                'enablePagination' => true,
                                
                                'pager' => array(
                                    'maxButtonCount' => 10,
                                    // 'id'=>'pager_list',
                                    'header' => false,
                                    'firstPageLabel' => '<<',
                                    'prevPageLabel' => '<',
                                    // 'previousPageCssClass' => 'prev',
                                    'nextPageLabel' => '>',
                                    // 'nextPageCssClass' => 'next',
                                    'lastPageLabel' => '>>',
                                    // 'cssFile' => false,
                                    // 'htmlOptions' => array('class' => 'pager'),                            
                                    // 'htmlOptions' => array('class' => 'pager'),                            
                                ),
                            ));
                ?>

            </ul>
      </div>
</div>

<br/>
<br/>








<!-- Rao vặt cùng chuyên mục -->
<div class="row">
<h3><font color="#000">Rao vặt cùng chuyên mục</font></h3>
<div class="row-fluid">
      <?php
      $c = new TinRaoVat;
      $list_cung_chuyen_muc = $c->searchListDetailCungChuyenMuc($model->id, $model->job_id);
      $this->widget('zii.widgets.CListView', array(
                      'id' => 'list-rao-vat-cung-chuyen-muc',
                      'dataProvider'=>$list_cung_chuyen_muc,
                      'itemView'=>'raovat/_item_detail_cung_chuyen_muc',
                      // 'enableHistory'=> true,
                      // 'pagerCssClass' => 'pagination',
                      // 'ajaxUpdate'=>'list-rao-vat-cung-chuyen-muc',
                      'ajaxUpdate' => true,
                      // 'loadingCssClass' => '', //remove loading icon
                      'summaryText' => '',
                      'emptyText' => '<div class="alert alert-info">Sorry! No data found</div>',
                      // 'emptyText' => '<div class="review clearfix">Sorry! No data found.</div>',
                      'enablePagination' => true,
                      
                      'pager' => array(
                          'maxButtonCount' => 10,
                          'id'=>'pager_list',
                          'header' => false,
                          'firstPageLabel' => '<<',
                          'prevPageLabel' => '<',
                          // 'previousPageCssClass' => 'prev',
                          'nextPageLabel' => '>',
                          // 'nextPageCssClass' => 'next',
                          'lastPageLabel' => '>>',
                          // 'cssFile' => false,
                          // 'htmlOptions' => array('class' => 'pager'),                            
                          // 'htmlOptions' => array('class' => 'pager'),                            
                      ),
                  ));
      ?>    
      <!-- <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="ad-square ad-regular">
              <h3><a href="detail.php">SANG TIỆM NAIL</a></h3><span class="timestamp">20 Sep 2014</span>
                <p align="justify">
                   Cần sang tiệm ở Myrtle Beach, SC. Tiệm mới remodel, rất đẹp và sang trọng. Giá nails cao, income ổn định....            
                </p>
                <h3 class="phone-listing">325-450-7655</h3>
                <h4 class="location"><i class="glyphicon glyphicon-map-marker"></i>
                  <a href="">SC</a> &gt; <a href=""> Myrtle Beach</a>
                </h4>
                
                <span class="xem-tiep"><a href="detail.php">Xem tiếp <i class="glyphicon glyphicon-arrow-right"></i></a></span>
            </div>
        </div> -->
</div>
</div>









<!--  -->
<div class="row">
  <div class="md-col-12 hidden-xs hidden-sm">
      <center>
      <img src="<?php  echo Yii::app()->theme->baseUrl; ?>/images/body2.jpg" width="1160px" height="100px">
        </center>
    </div>
</div>