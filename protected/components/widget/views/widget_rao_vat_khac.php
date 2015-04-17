<!-- rao vặt hot -->
<h3>Rao vặt khác</h3>
<div class="row">    
      <?php 
      if(!empty($list_khac))
      {
          $arr_list = array();
          $temp = 1;
          foreach ($list_khac as $one) 
          {
              if(!empty($one)  )
              {
                  $one->setRaoVat_New();
                  $arr_list[$temp] = $one;
                  $temp++;
              }
          }


          for($i=1; $i <=3 ; $i++)
          {
              for ($j=1; $j <= 4 ; $j++) 
              { 
                  $index_=($i-1)*4+$j;
                  if(!empty($index_) && !empty($arr_list[$index_]) )
                  {
                      $one = $arr_list[$index_];
                      echo '       
                              <div class="col-lg-3 col-sm-6">';

                              if($index_%4==1)
                                  echo '<div class="ad-square ad-regular" style="background-color: #67F079">';
                              else if($index_%4==2)
                                  echo '<div class="ad-square ad-regular" style="background-color: #FAB0EB">';
                              else if($index_%4==3)
                                  echo '<div class="ad-square ad-regular" style="background-color: #F6FCA4">';
                              else if($index_%4==0)
                                  echo '<div class="ad-square ad-regular" style="background-color: #63FDF9">';

                                      if($one->is_new==TYPE_YES)
                                          echo '<div class="new"></div>';

                                      
                              echo   '<h3 style="margin-left:20px;"><a href="'.Yii::app()->createAbsoluteUrl('site/raoVatDetail', array('slug'=>$one->slug)).'">'.StringHelper::limitStringLength($one->title, 35).'</a></h3>
                                      <span class="timestamp">'.Yii::app()->format->date($one->created_date).'</span>

                                      <p align="justify">
                                          '.$one->short_content.'           
                                      </p>
                                      
                                      <h3 class="phone-listing">'.$one->mobile.'</h3>
                                      <h4 class="location"><i class="glyphicon glyphicon-map-marker"></i>';
                                          if(!empty($one->city))
                                              echo '<a href="'.Yii::app()->createAbsoluteUrl('site/raoVatDetail', array('slug'=>$one->slug)).'">Texas</a> > '.$one->city.'</a>';
                                          else
                                              echo '<a href="'.Yii::app()->createAbsoluteUrl('site/raoVatDetail', array('slug'=>$one->slug)).'">Texas</a>';
                              echo    '</h4>
                                      <span class="xem-tiep"><a href="'.Yii::app()->createAbsoluteUrl('site/raoVatDetail', array('slug'=>$one->slug)).'">Xem thêm <i class="glyphicon glyphicon-arrow-right"></i></a></span>
                                  </div>
                              </div>';
                  }
              }

          }
      }
      ?>
  <!-- <div class="col-lg-3 col-sm-6">
    <div class="ad-square ad-regular" style="background-color: #67F079">
      <div class="new"></div>

        <h3 style="margin-left:20px;"><a href="detail.html">Cần thợ nail nam nữ</a></h3>
          <span class="timestamp">15 Mar 2015</span>

            <p align="justify">
              Tiệm nail ở San Angelo khu Mỹ trắng, cách Dallas 4.5hrs, Houston 6.5 hrs, Austin 3hrs. Cần [...]            
            </p>
            
            <h3 class="phone-listing">325-450-7655</h3>
            <h4 class="location"><i class="glyphicon glyphicon-map-marker"></i>
                  <a href="">Texas</a> > <a href="">San Angelo</a>
                    </h4>
            <span class="xem-tiep"><a href="detail.html">Xem thêm <i class="glyphicon glyphicon-arrow-right"></i></a></span>
        </div>
    </div> -->

</div>
<!-- end of rao vặt hot -->
