<?php
$this->breadcrumbs=array(
    $this->pluralTitle => array('index'),
    'View ' . $this->singleTitle . ' : ' . $title_name,
);

$this->menu = array(
    array('label'=> $this->pluralTitle, 'url'=>array('index'), 'icon' => $this->iconList),  
    array('label'=> 'Update '. $this->singleTitle, 'url'=>array('update', 'id'=>$model->id)),
    array('label' => 'Create ' . $this->singleTitle, 'url' => array('create')),
);   

?>
<h1>View <?php echo $this->singleTitle . ' : ' . $title_name; ?></h1>

<?php
//for notify message
$this->renderNotifyMessage(); 
//for list action button
echo $this->renderControlNav();
?><div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list-alt"></span> View <?php echo $this->singleTitle?></h3>
    </div>
    <div class="panel-body">
    <?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array( 
        
				array(
                        'label'=> 'Post User Name',
                        'name' => 'post_user_name',
                        'type' => 'html',
                    ),
                array(
                        'label'=> 'Edit User Name',
                        'name' => 'edit_user_name',
                        'type' => 'html',
                    ),
                array(
                        //'label'=> 'customLabel',
                        'name' => 'title',
                        'type' => 'html',
                    ),
				array(
                        //'label'=> 'customLabel',
                        'name' => 'short_content',
                        'type' => 'html',
                    ),
				array(
                        //'label'=> 'customLabel',
                        'name' => 'content',
                        'type' => 'html',
                    ),
				
                array(
                        'name' => 'image1',
                        'type'=>'raw',
                        'value' => $model->image1 != '' ?  '<div class="thumbnail col-sm-3">' . CHtml::image(
                                        Yii::app()->createAbsoluteUrl($model->uploadImageFolder . '/'.$model->id.'/'.$model->image1) ,
                                        '' , array(
                                        'style' => 'width :100%',
                                    )) . '</div>' : ''
                    ),
                array(
                        'name' => 'image2',
                        'type'=>'raw',
                        'value' => $model->image2 != '' ?  '<div class="thumbnail col-sm-3">' . CHtml::image(
                                        Yii::app()->createAbsoluteUrl($model->uploadImageFolder . '/'.$model->id.'/'.$model->image2) ,
                                        '' , array(
                                        'style' => 'width :100%',
                                    )) . '</div>' : ''
                    ),

				array(
                        //'label'=> 'customLabel',
                        'name' => 'order_display',
                        'type' => 'html',
                    ),
                array(
                        //'label'=> 'customLabel',
                        'name' => 'status',
                        'type' => 'status',
                    ),

				array(
                        //'label'=> 'customLabel',
                        'name' => 'is_hot',
                        'type' => 'YesNo',
                        // 'value'=> $model->is_hot==TYPE_YES ? "<b style='color:red'>Yes</b>" : "",
                    ),

				array(
                        //'label'=> 'customLabel',
                        'name' => 'is_new',
                        'type' => 'YesNo',
                        // 'value'=> $model->is_new==TYPE_YES ? "<b style='color:blue'>NEW</b>" : "",
                    ),

				array(
                        //'label'=> 'customLabel',
                        'name' => 'phone',
                        'type' => 'html',
                    ),

				array(
                        //'label'=> 'customLabel',
                        'name' => 'mobile',
                        'type' => 'html',
                    ),

				array(
                        //'label'=> 'customLabel',
                        'name' => 'state_id',
                        'type' => 'html',
                        'value'=> !empty($model->rState) ? $model->rState->name  : "",
                    ),
                array(
                        //'label'=> 'customLabel',
                        'name' => 'job_id',
                        'type' => 'html',
                        'value'=> !empty($model->rJob) ? $model->rJob->name  : "",
                    ),

				array(
                        //'label'=> 'customLabel',
                        'name' => 'city',
                        'type' => 'html',
                    ),
				array(
                        //'label'=> 'customLabel',
                        'name' => 'created_date',
                        'type' => 'datetime',
                    ),
				array(
                        //'label'=> 'customLabel',
                        'name' => 'updated_date',
                        'type' => 'datetime',
                    ),
                array(
                        'label'=> 'Ngày Được Approved',
                        // 'name' => 'updated_date_status',
                        'type' => 'html',
                        'value'=> Yii::app()->format->datetime($model->updated_date_status)."<br/>
                            <font color='red'>Từ ngày này, tùy loại tin (3 ngày, 7 ngày, 30 ngày ) sẽ bị Hidden<br/>
                            Từ ngày này, Tin đang Hidden + quá 2 tháng sẽ bị delete bằng Cronjob<br/>
                            </font>",
                    ),
        ),
    )); ?>
    <div class="well">
        <?php echo CHtml::htmlButton('<span class="' . $this->iconBack . '"></span> Back', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\''.  $this->baseControllerIndexUrl() . '\'')); ?>    </div>
    </div>
</div>
