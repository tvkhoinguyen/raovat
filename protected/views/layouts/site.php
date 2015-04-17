<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" class="js cssanimations csstransitions">
<head>
     <?php include_once '_head.php';?>
</head>

<body>
    <?php include('inc/_facebook.php'); ?>

    <div class="t3-wrapper">
            <div class="navbar-fixed-top">
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
                        </div>
                    </header>

                    <!-- Thiet bi kich thuoc nho -->
                    <nav id="t3-mainnav" class="wrap navbar navbar-default t3-mainnav hidden-lg hidden-md">
                        <?php include('inc/_menu_main_navigation.php'); ?>
                    </nav>

                    <!-- Thiet bi kich thuoc lon -->
                    <!-- <div class="hidden-xs hidden-sm search-navigation"> -->
                    <div class="hidden-xs hidden-sm search-navigation">
                        <?php include('inc/_nav_helper.php'); ?>
                    </div>
            </div>


            <!-- TIM KIEm -->
            <div class="row" style="margin-top:150px">
                    <?php include('inc/_tim_kiem.php'); ?>

            </div>


            <!--  -->
            <div id="t3-mainbody" class="container t3-mainbody">
                <div class="row">
                    <div id="t3-content" class="t3-content col-xs-12">
                            <?php echo $content; ?>
                    </div>

                    <?php include('inc/_page_links.php'); ?>
                </div>
            </div>

    </div>




    <?php  include('_footer.php'); ?>
</body>
</html>