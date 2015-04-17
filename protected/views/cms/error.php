<?php
$this->pageTitle=Yii::app()->name . ' - Error';
?>
<div class="main">
    <div class="container">
        <div class="breadcrumb"><a href="<?php echo yii::app()->createAbsoluteUrl('site/index')?>">Home</a> / Error</div>
        <div class="row">
            <div class="col-sm-9">
                <h1 class="title-page"></h1>
                <h2>Error <?php echo 404; ?></h2>
                <div class="error">
                <?php echo 'The requested page does not exist.'; ?>
                </div>
            </div>

            <!--right menu-->

        </div>

    </div>
</div>



