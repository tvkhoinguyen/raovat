<?php
$this->breadcrumbs=array(
	'Ads Management'=>array('index')
);

$menus=array(
    array('label'=>'Create Ads', 'url'=>array('create')),
    array('label'=>'Update Ads', 'url'=>array('update', 'id'=>$model->id)),
    array('label'=>'Delete Ads', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>'Ads Management', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1>View Banner Ads</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'place_holder',
        array(
            'name'=>'image',
            'type' => 'html',
            'htmlOptions' => array('style' => 'text-align:center;'),
            'value'=> (!empty($model->image) ? CHtml::image(Yii::app()->baseUrl."/upload/bannerads/".$model->place_holder."/thumbs/".$model->image, "Blum & Frost"):"")
        ),
		'link',
        'order_display',
        array(
            'name'=>'status',
            'type'=>'status',
        ),
        'created_date:datetime',
		'expired_date:date',
	),
)); ?>
