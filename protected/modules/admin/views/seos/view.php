<?php
$this->breadcrumbs=array(
	$this->pluralTitle . ' Management' => array('index'),
	'View ' . $this->singleTitle . ' : ' . $title_name,
);

$this->menu = array(
    array('label'=> $this->pluralTitle . ' Management', 'url'=>array('index')),	
    array('label'=> 'Update '. $this->singleTitle, 'url'=>array('update', 'id'=>$model->id)),
	array('label' => 'Create ' . $this->singleTitle, 'url' => array('create')),
);   

?>
<h1>View <?php echo $this->singleTitle . ' : ' . $title_name; ?></h1>

<?php
//for list action button
$this->renderNotifyMessage(); 
echo $this->renderControlNav();
?><div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="glyphicon glyphicon-list-alt"></span> View <?php echo $this->singleTitle?></h3>
	</div>
	<div class="panel-body">
	<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        	'title_tag',
	'url',
	array(
                        'name' => 'meta_keyword',
                        'type' => 'html',
                    ),
	array(
                        'name' => 'meta_desc',
                        'type' => 'html',
                    ),
		),
	)); ?>
	</div>
</div>
