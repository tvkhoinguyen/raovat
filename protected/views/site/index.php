<div class="loadmoread">  
    <div class="row">
            <h3></h3>
            <div class="row">    
        
                <?php
                $this->widget('zii.widgets.CListView', array(
                                'id' => 'list-hot',
                                'dataProvider'=>$list_hot,
                                'itemView'=>'raovat/_item_index_raovat_hot',
                                // 'enableHistory'=> true,
                                // 'pagerCssClass' => 'pagination',
                                // 'ajaxUpdate'=>'list-hot',
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
                                    'maxButtonCount' => 5,
                                    // 'cssFile' => false,
                                    // 'htmlOptions' => array('class' => 'pager'),                            
                                    // 'htmlOptions' => array('class' => 'pager'),                            
                                ),
                            ));
                /*
                for ($i=0; $i < 8; $i++) { ?>
                      <div class="col-lg-3 col-sm-6">
                        <div class="ad-square ad-regular" style="background-color: #FAF834">
                          <div class="new"></div>

                          <h3 style="margin-left:20px;"><a href="detail.php">Cần thợ nail nam nữ</a></h3>
                            <span class="timestamp">15 Mar 2015</span>

                              <p align="justify">
                                Tiệm nail ở San Angelo khu Mỹ trắng, cách Dallas 4.5hrs, Houston 6.5 hrs, Austin 3hrs. Cần [...]            
                              </p>
                              
                              <h3 class="phone-listing">325-450-7655</h3>
                              <h4 class="location"><i class="glyphicon glyphicon-map-marker"></i>
                                    <a href="">Texas</a> &gt; <a href="">San Angelo</a>
                                      </h4>
                              <span class="xem-tiep">
                                  <a href="detail.php">Xem thêm <i class="glyphicon glyphicon-arrow-right"></i></a>
                              </span>
                        </div>
                      </div>
                <?php 
                */ 
                ?>
                      
            </div>
<!-- end of rao vặt hot -->
<!-- google adsense -->
        <div class="col-lg-12 google-ad-list text-center ">
          <img class="img-responsive" src="<?php echo Yii::app()->theme->baseUrl;  ?>/images/body2.jpg" width="100%" height="100px" style="height: 100px;" >
        </div>
    </div>
<!-- rao vặt hot -->

    <div class="row"> 
        <h3></h3>
        <div class="row">    
            
            <?php
            $this->widget('zii.widgets.CListView', array(
                            'id' => 'list-khac',
                            'dataProvider'=>$list_khac,
                            'itemView'=>'raovat/_item_index_raovat_hot',
                            // 'enableHistory'=> true,
                            // 'pagerCssClass' => 'pagination',
                            // 'ajaxUpdate'=>'list-khac',
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
        </div>
        <!-- end of rao vặt khac -->
        <!-- google adsense -->
          <div class="col-lg-12 google-ad-list text-center ">
            <img class="img-responsive" src="<?php echo Yii::app()->theme->baseUrl;  ?>/images/body2.jpg" width="100%" height="100px" style="height: 100px;" >
          </div>
    </div>
</div>



<?php 
//$this->widget('RaoVatHotWidget', array('list_hot'=> $list_hot )  ); 
// $this->widget('CLinkPager', array(
//                                         'currentPage'=>$pages->getCurrentPage(),
//                                         'itemCount'=>$item_count,
//                                         'pageSize'=>$page_size,
//                                         'maxButtonCount'=>5,
//                                         //'nextPageLabel'=>'My text >',
//                                         // 'header'=>'',
//                                         'htmlOptions'=>array('class'=>'pagination'),
//                                         'header' => false,
//                                         // 'cssFile' => false,
//                                         'nextPageLabel' => 'Next',
//                                         'prevPageLabel' => 'Prev',
//                                         'firstPageLabel'=>'First',
//                                         'lastPageLabel'=>'Last',

//                                                 // 'prevPageLabel'=>'pre',
//                                                 // 'nextPageLabel'=>'',
//                                                 // 'firstPageLabel'=>'First',
//                                                 // 'lastPageLabel'=>'Last',
//                                                 // css class         
//                                                 // 'firstPageCssClass'=>'pager_first',//default "first"
//                                                 // 'lastPageCssClass'=>'pager_last',//default "last"
//                                                 'previousPageCssClass'=>'prev',//default "previours"
//                                                 'nextPageCssClass'=>'next',//default "next"
//                                                 // 'internalPageCssClass'=>'pager_li',//default "page"
//                                                 'selectedPageCssClass'=>'active',//default "selected"
//                                                 // 'hiddenPageCssClass'=>'pager_hidden_li'//default "hidden"     
//                                     ));
// $this->widget('RaoVatKhacWidget', array('list_khac'=> $list_khac ) ); 
?>