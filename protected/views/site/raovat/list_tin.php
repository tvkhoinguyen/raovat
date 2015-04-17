<div class="loadmoread">  
    <div class="row">
            <!-- rao vặt hot -->
            <h3><a href="<?php echo Yii::app()->createAbsoluteUrl('site/index'); ?>">Rao Vặt</a>  
                <?php if(!empty($job)){ ?>
                <font color="#000">
                    &gt; <a href="<?php echo Yii::app()->createAbsoluteUrl('site/listTin', array('j_slug'=>$job->slug)  ); ?>" ><?php echo $job->name; ?></a>
                </font>
                <?php } ?>
            </h3>
            <div class="row">    
                  <?php
                    $this->widget('zii.widgets.CListView', array(
                                    'id' => 'list_tin',
                                    'dataProvider'=>$list_raovat_dataProvider,
                                    'itemView'=>'raovat/_item_list_tin',
                                    // 'enableHistory'=> true,
                                    // 'pagerCssClass' => 'pagination',
                                    // 'ajaxUpdate'=>'list_tin',
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
                  ?>
            </div>  

            <!-- google adsense -->
              <div class="col-lg-13 google-ad-list text-center ">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/body2.jpg" width="1160px" height="100px">
              </div>
    </div>
</div>