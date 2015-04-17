<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta charset="utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="copyright" content="<?php echo CHtml::encode($this->pageTitle); ?>" />

<?php 
$desc = $this->getMetaDescription();
$keyword = $this->getMetaKeywords();
if (!empty($desc)) {
   echo "<meta content='{$desc}' name='description' />";
}
if (!empty($keyword)) {
    echo "<meta content='{$keyword}' name='keywords' />";
} 
?>
<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" /> -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<!-- <meta name="viewport" content="width=1280" />  -->
<meta content="telephone=no" name="format-detection" />
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />



<!-- CSS -->
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/t3-assets/css/style.css?t=148" rel="stylesheet" type="text/css"  />
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/t3-assets/css/main_style.css?t=512" rel="stylesheet" type="text/css"  />
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/t3-assets/css/common.css" rel="stylesheet" media="screen" /> 
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/t3-assets/css/style5.css" rel="stylesheet" media="screen" /> 
<!-- <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet" media="screen" />  -->
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/nguyen.css" rel="stylesheet" /> 

<!--<link rel="icon" type="image/png" href="<?php echo Yii::app()->theme->baseUrl; ?>/favicon.png" />-->
<!--<link rel="icon" type="image/x-icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/favicon.png" />-->
<!--<link rel="apple-touch-icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/favicon.png" />-->
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/images/favicon.ico" rel="shortcut icon" type="<?php echo Yii::app()->theme->baseUrl; ?>/image/vnd.microsoft.icon" />
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/images/favicon.png" rel="shortcut icon" type="image/vnd.microsoft.icon" />
<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>


<?php 
Yii::app()->clientScript->registerCoreScript('jquery'); 
Yii::app()->clientScript->registerCoreScript('jquery.ui'); 
?> 
<!-- JS -->
<!-- <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.js" type="text/javascript"> </script> -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/t3-assets/js/js-4084b9545.js?t=149" type="text/javascript"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/t3-assets/js/modernizr.custom.79639.js" type="text/javascript"></script> 
<!-- <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js" type="text/javascript"></script>  -->
<script src="https://www.google.com/recaptcha/api.js"></script>
<script type="text/javascript" async="" src="https://www.gstatic.com/recaptcha/api2/r20150406160312/recaptcha__vi.js"></script>




<script src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/js/holder.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/custom.js"></script>

<!-- Le HTML5 shim and media query for IE8 support -->
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<script type="text/javascript" src="/raovat/plugins/system/t3/base-bs3/js/respond.min.js"></script>
<![endif]-->

<style type="text/stylesheet">
  @-webkit-viewport   { width: device-width; }
  @-moz-viewport      { width: device-width; }
  @-ms-viewport       { width: device-width; }
  @-o-viewport        { width: device-width; }
  @viewport           { width: device-width; }
</style>
<script type="text/javascript">
  //<![CDATA[
  if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
    var msViewportStyle = document.createElement("style");
    msViewportStyle.appendChild(
      document.createTextNode("@-ms-viewport{width:auto!important}")
    );
    document.getElementsByTagName("head")[0].appendChild(msViewportStyle);
  }
  //]]>
</script>
<meta name="HandheldFriendly" content="true"/>
<meta name="apple-mobile-web-app-capable" content="YES"/>









<!-- <script src="../working/phongle/final/scroll/jquery.min.js"></script> -->
<!-- <script type="text/javascript" src="../working/phongle/final/scroll/jquery-ias.min.js"></script> -->
<!-- <script type="text/javascript">
  var ias = $.ias({
    container: ".loadmoread",
    item: ".row",
    pagination: "#pagination",
    next: ".next a"
  });

  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASTriggerExtension({offset: 10}));
  ias.extension(new IASNoneLeftExtension({text: 'There are no more pages left to load.'}));
</script> -->

<!-- <script type="text/javascript">
    $(document).ready(function() {
      parentfield = $(".ad_city_1755050116").closest('form').find("#ad_state");
      $(".ad_city_1755050116").remoteChained(parentfield,"images/com_adsmanager/plugins/cascade/plug52bc.html?fieldid=3",{defaultvalue:""});
    });
</script>
<script>
    $('#myTab a').click(function (e) {
      e.preventDefault()
      $(this).tab('show')
    });
</script> -->

<!-- 
<script>
        $('#myTab a').click(function (e) {
          e.preventDefault()
          $(this).tab('show')
        })
      </script> -->
