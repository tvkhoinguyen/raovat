
<div class="t3-wrapper">
  <div class="navbar-fixed-top">


      <!-- //HEADER -->
        <header id="t3-header" class="t3-header ">
          <div class="container">
        	  <div class="row">
                    <?php include('inc/_logo.php'); ?>
                    <!-- //LOGO -->

                    <?php include('inc/_header_link.php'); ?>
                    <!-- // Header Links-->

                    <?php include('inc/_contact_info.php'); ?>
                   <!-- // contact info-->

                </div> 
                <!-- //End Row -->
            </div>
            <!-- //ENd div containner -->
          </header>
      <!-- //HEADER -->

      <!-- MAIN NAVIGATION -->
      <nav id="t3-mainnav" class="wrap navbar navbar-default t3-mainnav hidden-lg hidden-md">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".t3-navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
          </div>
             
          <div class="t3-navbar-collapse navbar-collapse collapse "></div>
          
          <div class="t3-navbar navbar-collapse collapse">
              <font color="#980000">
                <ul class="nav navbar-nav">
                  <li class="item-28">          <a href="index.php">Home</a></li>
                  <li class="item-202">       <a href="chuyen_muc.php" >Cần thợ nail</a></li>
                  <li class="item-203">       <a href="chuyen_muc.php" >Sang tiệm</a></li>
                  <li class="item-204">       <a href="chuyen_muc.php" >Giữ trẻ</a></li>
                  <li class="item-205">       <a href="chuyen_muc.php" >Share Phòng</a></li>
                  <li class="item-206">       <a href="chuyen_muc.php" >Cần người</a></li>
                  <li class="item-207">       <a href="chuyen_muc.php" >Tìm việc miễn phí</a></li>
                  <li class="item-207">        <a href="chuyen_muc.php" >Cần bán</a></li>
                  <li class="item-207">        <a href="dang_tin.php" >Đăng tin</a></li>
                  <li class="item-208">       <a href="lien_he.php" >Liên hệ</a></li>
                </ul>
              </font>
          </div>
        </div>
      </nav>
      <!-- //MAIN NAVIGATION -->
      
      <?php include('inc/_nav_helper.php'); ?>
      <!-- //END NAV HELPER -->
</div>


<?php include('inc/_tim_kiem.php'); ?>

</div>
        
    </div>
</div>
  


<script type="text/javascript">
  $('#myTab a').click(function (e) {
    e.preventDefault()
    $(this).tab('show')
  });
</script>
<script type="text/javascript">
    $(document).ready(function() {
      parentfield = $(".ad_city_1755050116").closest('form').find("#ad_state");
      $(".ad_city_1755050116").remoteChained(parentfield,"images/com_adsmanager/plugins/cascade/plug52bc.html?fieldid=3",{defaultvalue:""});
    });
</script>