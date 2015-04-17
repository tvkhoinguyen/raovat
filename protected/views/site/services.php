
    <ul class="breadcrumb">
        <li><a href="index.html">Home</a></li>
    <li>Services</li>
</ul>
<h3 class="ttl-cnt">Services</h3>
<div class="list-news">
    
    <?php    
        $data = $model->getData();
        if (!empty($data)) {
            $this->widget('zii.widgets.CListView', array(
                'id'=>'',
                'dataProvider' => $model,
                'itemView'=>'item/service_item',
                'itemsCssClass' => false,
                'summaryText'=> 'Showing {start} - {end} of {count} products',
                'template' => '<div class="pager-wrap clearfix"><div class="show-page"></div>{pager}</div><div class="clearfix"></div><div class="grid clearfix">{items}</div>',
                'enablePagination'=>true,
                'pagerCssClass' => 'pager',
                'pager'=>array(
                        'header' => false,
                        'firstPageLabel' => '<span class="glyphicon glyphicon-fast-backward"></span>',
                        'prevPageLabel' =>  '<span class="glyphicon glyphicon-chevron-left"></span>',
                        'nextPageLabel' =>  '<span class="glyphicon glyphicon-chevron-right"></span>',
                        'lastPageLabel' =>  '<span class="glyphicon glyphicon-fast-forward"></span>',
                        'maxButtonCount'=> 4,
                        'firstPageCssClass'=>'hidden',
                        'lastPageCssClass'=>'hidden',
                        'htmlOptions' => array('class' => 'pagination clearfix'),
                        'selectedPageCssClass' => 'active',
                )
            ));
        } else {
            echo 'No results found.';
        }
    ?>     
                            
</div>
