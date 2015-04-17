<?php echo "<?php\n"; ?>
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
<?php echo "<h1>View <?php echo \$this->singleTitle . ' : ' . \$title_name; ?></h1>\n"; ?>
<?php echo "
<?php
//for notify message
\$this->renderNotifyMessage(); 
//for list action button
echo \$this->renderControlNav();
?>";?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list-alt"></span> View <?php echo "<?php echo \$this->singleTitle?>" ;?></h3>
    </div>
    <div class="panel-body">
    <?php echo "<?php"; ?> $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array( 
        <?php
            $link_img = 'CHtml::image(Yii::app()->request->baseUrl."/upload/listings/".\$model->id."/187x140/".\$model->image, "image", array("class"=>"b_img", "height" => "100px"))';
            if (isset($this->type_option['view'])){
            foreach ($this->type_option['view'] as $key_index => $val_index) {
                if ($val_index == 'string') {
                    echo "\n";
                    // echo "\t\t\t\t'".$key_index."',\n";
                    echo "\t\t\t\tarray(
                        //'label'=> 'customLabel',
                        'name' => '{$key_index}',
                        'type' => 'html',
                    ),\n";
                } elseif ($val_index == 'date') {
                    echo "\t\t\t\tarray(
                        //'label'=> 'customLabel',
                        'name' => '{$key_index}',
                        'type' => 'date',
                    ),\n";
                } elseif ($val_index == 'datetime') {
                    echo "\t\t\t\tarray(
                        //'label'=> 'customLabel',
                        'name' => '{$key_index}',
                        'type' => 'datetime',
                    ),\n";
                } elseif ($val_index == 'html') {
                    echo "\t\t\t\tarray(
                        //'label'=> 'customLabel',
                        'name' => '{$key_index}',
                        'type' => 'html',
                    ),\n";
                } elseif ($val_index == 'image') {
                    echo "\t\t\t\tarray(
                        //'label'=> 'customLabel',
                        'name' => '{$key_index}',
                        'type'=>'raw',
                        'value' => \$model->{$key_index} != '' ?  '<div class=\"thumbnail col-sm-4\">' . CHtml::image(
                                        Yii::app()->createAbsoluteUrl(\$model->uploadImageFolder . '/'.\$model->id.'/'.\$model->{$key_index}) ,
                                        '' , array(
                                        'style' => 'width :100%',
                                    )) . '</div>' : ''
                    ),\n";
                } elseif (isset($key_index) && $key_index == 'extend_attributes') {
                    foreach ($this->type_option['view']['extend_attributes'] as $ke => $ex) {
                        if ($ex["relation_type"] == 'string') {
                            echo "\t\t\t\tarray(
                                //'label'=> 'customLabel',
                                'name' => '{$ex["attr_name"]}',
                                'value' => \$model->{$ex["relation_name"]}->{$ex["attr_name"]},
                            ),\n";
                        } elseif ($ex["relation_type"] == 'number') {
                            echo "\t\t\t\tarray(
                                //'label'=> 'customLabel',
                                'name' => '{$ex["attr_name"]}',
                                'value' => \$model->{$ex["relation_name"]}->{$ex["attr_name"]},  
                            ),\n";
                        } elseif ($ex["relation_type"] == 'html') {
                            echo "\t\t\t\tarray(
                                //'label'=> 'customLabel',
                                'name' => '{$ex["attr_name"]}',
                                'value' => \$model->{$ex["relation_name"]}->{$ex["attr_name"]},  
                                'type' => 'html'
                            ),\n";
                        } elseif ($ex["relation_type"] == 'date') {
                            echo "\t\t\t\tarray(
                                //'label'=> 'customLabel',
                                'name' => '{$ex["attr_name"]}',
                                'value' => \$model->{$ex["relation_name"]}->{$ex["attr_name"]},  
                                'type' => 'date'
                            ),\n";
                        } elseif ($ex["relation_type"] == 'datetime') {
                            echo "\t\t\t\tarray(
                                //'label'=> 'customLabel',
                                'name' => '{$ex["attr_name"]}',
                                'value' => \$model->{$ex["relation_name"]}->{$ex["attr_name"]},  
                                'type' => 'datetime'
                            ),\n";
                        } elseif ($ex["relation_type"] == 'status') {
                            echo "\t\t\t\tarray(
                                //'label'=> 'customLabel',
                                'name' => '{$ex["attr_name"]}',
                                'value' => \$model->{$ex["relation_name"]}->{$ex["attr_name"]},  
                                'type' => 'status'
                            ),\n";
                        }
                    }
                }
            } 
            }
            ?>
        ),
    )); ?>
    <div class="well">
        <?php echo "<?php echo CHtml::htmlButton('<span class=\"' . \$this->iconBack . '\"></span> Back', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\''.  \$this->baseControllerIndexUrl() . '\'')); ?>"; ?>
    </div>
    </div>
</div>
