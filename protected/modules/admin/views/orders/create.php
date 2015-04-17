<?php
$this->breadcrumbs=array(
	$this->pluralTitle => array('index'),
	'Create ' . $this->singleTitle,
);

$this->menu = array(		
        array('label'=> $this->pluralTitle , 'url'=>array('index'), 'icon' => $this->iconList),
);
if (isset($_GET['user_id'])) {
?>

<h1>Create <?php echo $this->singleTitle; ?> For User: <?php echo $user->first_name; ?></h1>
<?php } else { ?>
<h1>Create <?php echo $this->singleTitle; ?></h1>
<?php } ?>

<?php
//for notify message
$this->renderNotifyMessage(); 
//for list action button
echo $this->renderControlNav();
if (isset($_GET['email'])) {
    echo $this->renderPartial('_form', array('model'=>$model)); 
} else {
    echo $this->renderPartial('_form_step1', array('model'=>$model)); 
}
?>
