<h1>Admin Controller Generator</h1>

<p>This generator helps you to quickly generate a new controller class,
one or several controller actions and their corresponding views.</p>

<?php $form=$this->beginWidget('CCodeForm', array('model'=>$model)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'controller'); ?>
		<?php echo $form->textField($model,'controller',array('size'=>65)); ?>
		<div class="tooltip">
			Controller ID is case-sensitive. Below are some examples:
			<ul>
				<li><code>post</code> generates <code>PostController.php</code></li>
				<li><code>postTag</code> generates <code>PostTagController.php</code></li>
				<li><code>admin/user</code> generates <code>admin/UserController.php</code>.
					If the application has an <code>admin</code> module enabled,
					it will generate <code>UserController</code> within the module instead.
				</li>
			</ul>
		</div>
		<?php echo $form->error($model,'controller'); ?>
	</div>

	<div class="row sticky">
		<?php echo $form->labelEx($model,'baseClass'); ?>
		<?php echo $form->textField($model,'baseClass',array('size'=>65, 'value' => 'AdminController')); ?>
		<div class="tooltip">
			This is the class that the new controller class will extend from.
			Please make sure the class exists and can be autoloaded.
		</div>
		<?php echo $form->error($model,'baseClass'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'actions'); ?>
                <?php if (isset($_POST['ControlleradminCode'])) { ?>
                <?php echo $form->textField($model, 'actions', array('size' => 65)); ?>
                <?php } else { ?>
		<?php echo $form->textField($model,'actions',array('size'=>65, 'value' => 'index, view, create, update, delete, _form, _search')); ?>
                <?php } ?>
		<div class="tooltip">
			Action IDs are case-insensitive. Separate multiple action IDs with commas or spaces.
		</div>
		<?php echo $form->error($model,'actions'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'model_name'); ?>
		<?php //echo $form->textField($model,'model_name',array('size'=>65)); ?>
                <?php $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
			'model'=>$model,
			'attribute' => 'model_name',
			/*'name'=> 'model_name',
			'source' => Yii::app()->getUrlManager()->createUrl('gii/controlleradmin/getModelName'),
			'options'=>array(
				'minLength'=>'0',
				'focus'=>new CJavaScriptExpression('function(event,ui) {
					$("#ControlleradminCode_model_name").val(ui.item.label);
					return false;
				}')
			),*/
			'htmlOptions'=>array(
                            'size'=>'65',
                            'id' => 'ControlleradminCode_model_name'
			),
		)); ?>
		<div class="tooltip">
			Enter model name and load attributes
		</div>
		<?php echo $form->error($model,'model_name'); ?>
	</div>
        <div class="row">
            <a href="#" class="load-attribute">Load attributes</a>
        </div>
        <div id="ajax-result"></div>
<?php $this->endWidget(); ?>

<script type="text/javascript">
    $(document).ready(function(){
        $('.load-attribute').live('click', function(e) {
            e.preventDefault();
            var model = $('#ControlleradminCode_model_name').val();
            var action = $('#ControlleradminCode_actions').val();
            if (model != '') {
                $.ajax({
                   type: 'POST',
                   url: '<?php echo Yii::app()->createAbsoluteUrl('gii/controlleradmin/GetAttributes'); ?>',
                   data: {model:model, action: action},
                   success: function(response) {
                       $('#ajax-result').html(response);
                       updatePosition();
                   }
                });
            } else {
                alert('Please enter model name');
            }
        });
        
        $('.add_attribute_index').live('click', function(e) {
            e.preventDefault();
            var model = $('#ControlleradminCode_model_name').val();
            $.ajax({
               type: 'POST',
               url: '<?php echo Yii::app()->getUrlManager()->createUrl('gii/controlleradmin/getRelation'); ?>',
               data: {model: model},
               context: this,
               success: function(response) {
                   $(this).next().next().prepend(response);
                   updatePosition();
                   updateNameIndex();
               }
            });
        });
        
        $('.add_attribute_view').live('click', function(e) {
            e.preventDefault();
            var model = $('#ControlleradminCode_model_name').val();
            $.ajax({
               type: 'POST',
               url: '<?php echo Yii::app()->getUrlManager()->createUrl('gii/controlleradmin/getRelation'); ?>',
               data: {model: model},
               context: this,
               success: function(response) {
                   $(this).next().next().prepend(response);
                   updatePosition();
                   updateNameView();
               }
            });
        });
        
        $('.up').live('click', function(e) {
            var element = $(this).parent().clone();
            $(this).parent().prev().before(element);
            $(this).parent().remove();
            updatePosition();
            updateNameIndex();
            updateNameView();
        });
        
        $('.down').live('click', function(e) {
            var element = $(this).parent().clone();
            $(this).parent().next().after(element);
            $(this).parent().remove();
            updatePosition();
            updateNameIndex();
            updateNameView();
        });
        
        $('.more_attr').live('change', function(e) {
            var parent = $(this).parent();
            var str = $(this).find(":selected").text();
            var a = str.split(':');
            $(parent).find('.relation_name').attr('value', a[0]);
        });
        
        function updatePosition() {
            $('.up').show();
            $('.down').show();
            $('.view_box li:first-child').find('.up').hide();
            $('.view_box li:last-child').find('.down').hide();
        }
        
        function updateNameIndex() {
            $('.view_box_index .more_attr').each(function(index) {
               $(this).attr('name', 'ControlleradminCode[type_option][index][extend_attributes]['+index+'][attr_name]'); 
            });
            $('.view_box_index .relation_type').each(function(index) {
               $(this).attr('name', 'ControlleradminCode[type_option][index][extend_attributes]['+index+'][relation_type]'); 
            });
            $('.view_box_index .relation_name').each(function(index) {
               $(this).attr('name', 'ControlleradminCode[type_option][index][extend_attributes]['+index+'][relation_name]'); 
            });
        }
        
        function updateNameView() {
            $('.view_box_view .more_attr').each(function(index) {
               $(this).attr('name', 'ControlleradminCode[type_option][view][extend_attributes]['+index+'][attr_name]'); 
            });
            $('.view_box_view .relation_type').each(function(index) {
               $(this).attr('name', 'ControlleradminCode[type_option][view][extend_attributes]['+index+'][relation_type]'); 
            });
            $('.view_box_view .relation_name').each(function(index) {
               $(this).attr('name', 'ControlleradminCode[type_option][view][extend_attributes]['+index+'][relation_name]'); 
            });
        }
        
        $( "#ControlleradminCode_model_name" ).live('focus.autocomplete', function(){
            <?php
                $filenames = CFileHelper::findFiles(Yii::getPathOfAlias("application.models"), array ( 
                    'fileTypes'=> array('php'),
                ));
                $modelNames = array();
                foreach ($filenames as $filename) {
                  $file = pathinfo($filename);
                  $modelNames[] = $file['filename'];
                }
            ?>
            var names = <?php echo json_encode($modelNames); ?>;
            var accentMap = {
              "á": "a",
              "ö": "o"
            };
            var normalize = function( term ) {
                var ret = "";
                for ( var i = 0; i < term.length; i++ ) {
                    ret += accentMap[ term.charAt(i) ] || term.charAt(i);
                }
                return ret;
            };

            $(this).autocomplete({
                source: function( request, response ) {
                    var matcher = new RegExp( $.ui.autocomplete.escapeRegex( request.term ), "i" );
                    response( $.grep( names, function( value ) {
                      value = value.label || value.value || value;
                      return matcher.test( value ) || matcher.test( normalize( value ) );
                    }) );
                },
                select: function( event, ui ) {
                    var model = ui.item.value;
                    var action = $('#ControlleradminCode_actions').val();
                    if (model != '') {
                        $.ajax({
                           type: 'POST',
                           url: '<?php echo Yii::app()->createAbsoluteUrl('gii/controlleradmin/GetAttributes'); ?>',
                           data: {model:model, action: action},
                           success: function(response) {
                               $('#ajax-result').html(response);
                               updatePosition();
                           }
                        });
                    } else {
                        alert('Please enter model name');
                    }
                }
            });
        });
        /*$('#ControlleradminCode_model_name').live('blur', function(e) {
            e.preventDefault();
            var model = $('#ControlleradminCode_model_name').val();
            var action = $('#ControlleradminCode_actions').val();
            if (model != '') {
                $.ajax({
                   type: 'POST',
                   url: '<?php echo Yii::app()->createAbsoluteUrl('gii/controlleradmin/GetAttributes'); ?>',
                   data: {model:model, action: action},
                   success: function(response) {
                       $('#ajax-result').html(response);
                   }
                });
            } else {
                alert('Please enter model name');
            }
        });*/
        
        $('.del').live('click', function(e) {
           e.preventDefault();
           $(this).parent().remove();
           updatePosition();
           updateNameIndex();
           updateNameView();
        });
       
    });
</script>

<style>
    .view_content{
        background: #f2f2f2;
        padding: 8px 0;
        margin-bottom: 10px;
    }
    .view_content h4{
        font-weight: bold;
        font-size: 14px;
        margin: 0;
        margin-bottom: 5px;
    }
    .view_box{
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .view_box li{
        border: 1px solid #ccc;
        margin-bottom: 5px;
        padding: 5px;
        background: white;
    }
    .view_box .del{
        float: right;
        cursor: pointer;
        padding: 2px;
    }
    .view_box .up{
        float: right;
        cursor: pointer;
        padding: 0 3px;
    }
    .view_box .down{
        float: right;
        cursor: pointer;
        padding: 0 3px;
    }
    .view_box .attname, .view_header .attname{
        float: left;
        width: 200px;
    }
    .view_box .type_option{
        border: 1px solid #ccc;
        padding: 2px;
        margin: 0;
    }
    .view_box li.action label{
        display: inline-block;
        margin-right: 5px;
    }
    .view_box .editor_select{
        margin-right: 5px !important;
    }
    .load-attribute{
        margin-bottom: 50px;
        display: inline-block;
    }
    .more_attr{
        padding: 2px;
        margin: 0;
        border: 1px solid #ccc;
        width: 180px;
        margin-right: 20px !important;
    }
    .add_attribute{
        margin-bottom: 5px;
        display: inline-block;
        cursor: pointer;
    }
    .view_header{
        border: 1px solid #ccc;
        padding: 5px;
        margin-bottom: 7px;
    }
</style>
