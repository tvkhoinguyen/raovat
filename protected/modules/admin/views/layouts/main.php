<!DOCTYPE html>
<html lang="en" ng-app="NgValidationTestApp" ng-controller="TodoCtrl" >
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="noindex" />
        <meta name="googlebot" content="noindex" />
        <title>
            <?php //echo CHtml::encode($this->pageTitle) . ' - ' . Yii::app()->params['projectName'] . ' Admin'; ?>
            <?php
            // echo CHtml::encode($this->pageTitle);
            
            if(!empty($this->pluralTitle)) 
                echo CHtml::encode($this->pluralTitle) . ' - ' . Yii::app()->params['projectName'] . ' Admin'; 
            elseif(!empty($this->pageTitle)) 
                echo CHtml::encode($this->pageTitle) . ' - ' . Yii::app()->params['projectName'] . ' Admin';
            else
                echo Yii::app()->params['projectName'] . ' Admin';
            ?>
        </title>
	<link rel="SHORTCUT ICON" href="<?php echo Yii::app()->theme->baseUrl; ?>/favicon.ico" type="image/x-icon" />	
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
        <meta name="viewport" content="width=1360">
        <meta name="description" content="Admin panel developed with the Bootstrap from Twitter.">
        <meta name="author" content="travis">

        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/jquery-ui-1.8.18.custom.css" type=text/css rel=stylesheet>
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/site.css" rel="stylesheet">
		<link href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/multiple-select.css" rel="stylesheet">
        
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/bootstrap-multiselect.css" type="text/css">
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/js/bootstrap-multiselect.js"></script>

        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/bootstrap-responsive.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/nestable.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/chosen.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/custom.css" />
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/prettyphoto/pretty_photo.css" rel="stylesheet">
		

        <?php Yii::app()->getClientScript()->registerCoreScript('jquery'); ?>
        <?php Yii::app()->clientScript->registerCoreScript('jquery.ui'); ?>

        
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/js/menu/jquery.nestable.js"></script>
		<script src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/js/jquery.multiple.select.js"></script>
                <script src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/js/jquery.block.ui.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->baseUrl . '/resources/ckeditor/ckeditor.js'; ?>"></script>
        <!--<script type="text/javascript" src="<?php //echo Yii::app()->theme->baseUrl . '/admin/js/jquery-ui-timepicker-addon.js'; ?>"></script>-->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/js/bootstrap.min.js"></script>
<!--		<script src="--><?php //echo Yii::app()->theme->baseUrl; ?><!--/admin/js/bootstrap.file-input.js"></script>-->
		<script src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/js/bootbox.min.js"></script>
		<script src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/js/chosen.jquery.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/js/custom.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/js/holder.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/js/prettyphoto/jquery.prettyPhoto.js"></script>

    <script type="text/javascript">
            jQuery(document).ready(function(){
                validateNumber();
                validatePhone();
            });

            function validateNumber(){
                $(".number_only").each(function(){
                        $(this).unbind("keydown");
                        $(this).bind("keydown",function(event){
                            if( !(event.keyCode == 8                                // backspace
                                || event.keyCode == 46                              // delete
                                || event.keyCode == 9							// tab
                                || (event.keyCode == 190 || event.keyCode == 110 )							// dấu chấm (point) 
                                || (event.keyCode >= 35 && event.keyCode <= 40)     // arrow keys/home/end
                                || (event.keyCode >= 48 && event.keyCode <= 57)     // numbers on keyboard
                                || (event.keyCode >= 96 && event.keyCode <= 105))   // number on keypad
                                ) {
                                    event.preventDefault();     // Prevent character input
                                }
                        });
                });
            }        

            function validatePhone(){
                $(".phone_only").each(function(){
                        $(this).unbind("keydown");
                        $(this).bind("keydown",function(event){
                            if( !(event.keyCode == 8                                // backspace
                                || event.keyCode == 46                              // delete
                                || event.keyCode == 9							// tab
                                || event.keyCode == 107                              // +
                                || event.keyCode == 109                              // -
    //                            || (event.keyCode == 190 || event.keyCode == 110 )							// dấu chấm (point) 
                                || (event.keyCode >= 35 && event.keyCode <= 40)     // arrow keys/home/end
                                || (event.keyCode >= 48 && event.keyCode <= 57)     // numbers on keyboard
                                || (event.keyCode >= 96 && event.keyCode <= 105))   // number on keypad
                                ) {
                                    event.preventDefault();     // Prevent character input
                                }
                        });
                });
            }        

    </script>

    </head>
    <body>
        <div class="navbar">
            <div class="navbar-inner">
				<div class="container-fluid">
					<a class="brand" href="<?php echo Yii::app()->createAbsoluteUrl('admin/site/index'); ?>"><?php echo Yii::app()->params['projectName'];?></a>
					<?php if (isset(Yii::app()->user->id)): ?>
					<div class="btn-group pull-right loginas">
						<a class="btn btn-danger" href="<?php echo Yii::app()->createAbsoluteUrl('admin/manageadmin/update_my_profile'); ?>"><i class="icon-user"></i> <?php echo Yii::app()->user->name; ?></a>
						<a class="btn btn-danger dropdown-toggle" data-toggle="dropdown" href="#">
							<span class="caret"></span>
						</a>
						
						<ul class="dropdown-menu">
							<li><a href="<?php echo Yii::app()->createAbsoluteUrl('admin/manageadmin/update_my_profile'); ?>">Profile</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo Yii::app()->createAbsoluteUrl('admin/manageadmin/change_my_password'); ?>">Change password</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo Yii::app()->createAbsoluteUrl('admin/site/logout'); ?>">Logout</a></li>
						</ul>
					</div>
					<div class="welcome">Welcome </div>
				<?php endif; ?>
				</div>
				<div class="clr"></div>
				<?php if (isset(Yii::app()->user->id)): ?>
				<div class="nav-collapse">
					<?php
					$menu = new ShowAdminMenu();
					echo $menu->showMenu();
					?>
				</div>
				<?php else: ?>
				<div class="nav-collapse">&nbsp;</div>
				<?php endif;?>
            </div>
        </div>
        <div class="clr"></div>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php if (isset($this->breadcrumbs)): ?>
					<?php
					$this->widget('ext.CBreadcrumbs.Cbreadcrumbs', array(
						'links' => $this->breadcrumbs,
					));
					?><!-- breadcrumbs -->
<?php endif ?>
<?php echo $content; ?>
            </div>

        </div>
		<footer class="footer">
			Copyright &copy; <?php echo date('Y'); ?> <a href="<?php echo Yii::app()->createAbsoluteUrl('/'); ?>"><?php echo Yii::app()->params['projectName'];?></a> <br/>
			Execution Time: <?php 
			$log = new CLogger();
			echo round($log->getExecutionTime(),3);?> sec | 
			Memory Usage: <?php echo round($log->getMemoryUsage()/1048576,2);?> mb
            <br/>
            <?php echo date('Y-m-d H:i:s'); ?>
		</footer>
		
        
		<script type="text/javascript">
			//set class my-editor-basic for basic
			//set class my-editor-full for full toolbars
			$(document).ready(function() {
                runEditorBasic('<?php echo Yii::app()->baseUrl; ?>/resources/', <?php echo Yii::app()->params['ckeditor_basic']; ?>, '100%', 300);
                runEditorBasic_NguyenCustom('<?php echo Yii::app()->baseUrl; ?>/resources/', <?php echo Yii::app()->params['ckeditor_basic_nguyen_custom']; ?>, '100%', 300);
				runEditorFull('<?php echo Yii::app()->baseUrl; ?>/resources/', <?php echo Yii::app()->params['ckeditor_full']; ?>, '100%', 300);
				runDatePicker('<?php echo Yii::app()->theme->baseUrl; ?>', 'dd/mm/yy');
				runTimePicker('<?php echo Yii::app()->theme->baseUrl; ?>');
				runDateTimePicker('<?php echo Yii::app()->theme->baseUrl; ?>');
				validateNumber();
			});
        </script>
    </body>
</html>




