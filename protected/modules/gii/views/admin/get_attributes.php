<?php
foreach ($action as $item) {
    //Index
    if ($item == 'index') {
        echo '<div class="view_content">';
        echo '<h4>Index</h4>';
        if (!empty($relation)) {
            echo '<span class="add_attribute add_attribute_index"> + Add</span>';
        }
        echo '<div class="view_header">';
        echo '<span class="attname"><b>Column</b></span>';
        echo '<span><b>View type</b></span>';
        echo '</div>';
        echo '<ul class="view_box view_box_index">';
        foreach ($table->columns as $key => $val) {
            if($val->autoIncrement || $table->columns[$key]->dbType == 'text' || $table->columns[$key]->name == 'slug')
		continue;
            echo '<li>';
            echo '<span class="attname">'.$table->columns[$key]->name.'</span>';            
            if($table->columns[$key]->dbType == 'datetime' || $table->columns[$key]->dbType == 'timestamp') {
                echo '<select class="type_option" name="ControlleradminCode[type_option][index]['.$table->columns[$key]->name.']">';
                echo '<option selected="selected" value="date">Date</option>';
                echo '<option value="date_time">Date Time</option>';
                echo '</select>';
            } elseif(strpos($table->columns[$key]->dbType, 'text') !== false) {
                echo '<select class="type_option" name="ControlleradminCode[type_option][index]['.$table->columns[$key]->name.']">';
                echo '<option selected="selected" value="html">Html</option>';     
                echo '</select>';
            } elseif ($table->columns[$key]->name == 'status') {
                echo '<select class="type_option" name="ControlleradminCode[type_option][index]['.$table->columns[$key]->name.']">';
                echo '<option slected="selected" value="status">Status</option>';
                echo '</select>';
            } elseif ($table->columns[$key]->type == 'integer') {
                echo '<select class="type_option" name="ControlleradminCode[type_option][index]['.$table->columns[$key]->name.']">';
                echo '<option slected="selected" value="number">Number</option>';
                echo '</select>';
            } else {
                echo '<select class="type_option" name="ControlleradminCode[type_option][index]['.$table->columns[$key]->name.']">';
                echo '<option slected="selected" value="string">String</option>';
                echo '</select>';
            }
            echo '<span class="del" title="Delete">X</span>';
            echo '<span class="up" title="Move Up">&#8593;</span>';
            echo '<span class="down" title="Move Down">&#8595;</span>';
            echo '</li>';
        }
        echo '<li class="action">';
        echo '<span class="attname">Actions</span>';
        echo '<label><input type="checkbox" checked="checked" name="ControlleradminCode[type_option][index][action][view]" value="{view}" />View</label>';
        echo '<label><input type="checkbox" checked="checked" name="ControlleradminCode[type_option][index][action][update]" value="{update}" />Update</label>';
        echo '<label><input type="checkbox" checked="checked" name="ControlleradminCode[type_option][index][action][delete]" value="{delete}" />Delete</label>';
        echo '<span class="del" title="Delete">X</span>';
        echo '<span class="up" title="Move Up">&#8593;</span>';
        echo '<span class="down" title="Move Down">&#8595;</span>';
        echo '</li>';
        echo '</ul>';
        echo "</div>";
    }
    
    //View
    if ($item == 'view') {
        echo '<div class="view_content">';
        echo '<h4>View</h4>';
        if (!empty($relation)) {
            echo '<span class="add_attribute add_attribute_view"> + Add</span>';
        }
        echo '<div class="view_header">';
        echo '<span class="attname"><b>Column</b></span>';
        echo '<span><b>View type</b></span>';
        echo '<span class="del"><b></b></span>';
        echo "</div>";
        echo '<ul class="view_box view_box_view">';
        foreach ($table->columns as $key => $val) {
            if($val->autoIncrement)
		continue;
            echo '<li>';
            echo '<span class="attname">'.$table->columns[$key]->name.'</span>';
            if($table->columns[$key]->dbType == 'datetime' || $table->columns[$key]->dbType == 'timestamp') {
                echo '<select class="type_option" name="ControlleradminCode[type_option][view]['.$table->columns[$key]->name.']">';
                echo '<option selected="selected" value="date">Date</option>';
                echo '<option value="date_time">Date Time</option>';
                echo '</select>';
            } elseif(strpos($table->columns[$key]->dbType, 'text') !== false) {
                echo '<select class="type_option" name="ControlleradminCode[type_option][view]['.$table->columns[$key]->name.']">';
                echo '<option selected="selected" value="html">Html</option>'; 
                echo '</select>';
            } elseif ($table->columns[$key]->name == 'status') {
                echo '<select class="type_option" name="ControlleradminCode[type_option][view]['.$table->columns[$key]->name.']">';
                echo '<option slected="selected" value="status">Status</option>';
                echo '</select>';
            } elseif ($table->columns[$key]->name == 'image') {
                echo '<select class="type_option" name="ControlleradminCode[type_option][view]['.$table->columns[$key]->name.']">';
                echo '<option slected="selected" value="image">Image</option>';
                echo '</select>';
            } else {
                echo '<select class="type_option" name="ControlleradminCode[type_option][view]['.$table->columns[$key]->name.']">';
                echo '<option slected="selected" value="string">String</option>';
				echo '<option slected="selected" value="image">Image</option>';
				echo '<option slected="selected" value="file">File</option>';
                echo '</select>';
            }
            echo '<span class="del" title="Delete">X</span>';
            echo '<span class="up" title="Move Up">&#8593;</span>';
            echo '<span class="down" title="Move Down">&#8595;</span>';
            echo '</li>';
        }
        echo '</ul>';
        echo '</div>';
    }
    
    //form
    if ($item == '_form') {
        echo '<div class="view_content">';
        echo '<h4>Form create, update</h4>';
        echo '<div class="view_header">';
        echo '<span class="attname"><b>Column</b></span>';
        echo '<span><b>View type</b></span>';
        echo '<span class="del"><b></b></span>';
        echo '</div>';
        echo '<ul class="view_box">';
        foreach ($table->columns as $key => $val) {
            if($val->autoIncrement || $table->columns[$key]->name == 'created_date')
		continue;
            echo '<li>';
            echo '<span class="attname">'.$table->columns[$key]->name.'</span>';            
            if($table->columns[$key]->dbType == 'datetime') {
                echo '<select class="type_option" name="ControlleradminCode[type_option][form]['.$table->columns[$key]->name.']">';
                echo '<option selected="selected" value="date_picker">DatePicker</option>';
                echo '<option value="date_time_picker">DateTimePicker</option>';
                echo '</select>';
            } elseif(strpos($table->columns[$key]->dbType, 'text') !== false) {
                echo '<select class="type_option editor_select" name="ControlleradminCode[type_option][form]['.$table->columns[$key]->name.'][]">';
                echo '<option selected="selected" value="ckeditor">CkEditor</option>';  
                echo '<option value="textarea">TextArea</option>';  
                echo '</select>';
            } elseif ($table->columns[$key]->name == 'status' || $table->columns[$key]->dbType == 'tinyint(1)') {
                echo '<select class="type_option" name="ControlleradminCode[type_option][form]['.$table->columns[$key]->name.']">';
                echo '<option slected="selected" value="dropdown">Status</option>';
                echo '<option value="yesno">Yes/No</option>';
                echo '<option value="text">TextInput</option>';
                echo '</select>';
            } elseif ($table->columns[$key]->name == 'image') {
                echo '<select class="type_option" name="ControlleradminCode[type_option][form]['.$table->columns[$key]->name.']">';
                echo '<option slected="selected" value="file">FileInput</option>';
                echo '</select>';
            } else {
                echo '<select class="type_option" name="ControlleradminCode[type_option][form]['.$table->columns[$key]->name.']">';
                echo '<option slected="selected" value="text">TextInput</option>';
                echo '<option slected="selected" value="number">NumberInput</option>';
                echo '<option slected="selected" value="password">PasswordInput</option>';
				echo '<option slected="selected" value="image">Image</option>';
				echo '<option slected="selected" value="file">File</option>';
                echo '</select>';
            }            
            if (strpos($table->columns[$key]->dbType, 'text') !== false) {
                echo '<select class="type_option editor_select_option" name="ControlleradminCode[type_option][form]['.$table->columns[$key]->name.'][]">';
                echo '<option slected="selected" value="full">Full</option>';
                echo '<option value="basic">Basic</option>';
                echo '</select>';
            }
            echo '<span class="del" title="Delete">X</span>';
            echo '<span class="up" title="Move Up">&#8593;</span>';
            echo '<span class="down" title="Move Down">&#8595;</span>';
            echo '</li>';
        }
        echo '</ul>';
        echo "</div>";
    }
    if ($item == '_search') {
        echo '<div class="view_content">';
        echo '<h4>Form search</h4>';
        echo '<div class="view_header">';
        echo '<span class="attname"><b>Column</b></span>';
        echo '<span><b>View type</b></span>';
        echo '<span class="del"><b></b></span>';
        echo "</div>";
        echo '<ul class="view_box">';
        foreach ($table->columns as $key => $val) {
            if($val->autoIncrement || $table->columns[$key]->name == 'image' || $table->columns[$key]->dbType == 'text')
		continue;
            echo '<li>';
            echo '<span class="attname">'.$table->columns[$key]->name.'</span>'; 
            if($table->columns[$key]->dbType == 'datetime' || $table->columns[$key]->dbType == 'timestamp') {
                echo '<select class="type_option" name="ControlleradminCode[type_option][search]['.$table->columns[$key]->name.']">';
                echo '<option selected="selected" value="date_picker">DatePicker</option>';
                echo '<option value="date_time_picker">DateTimePicker</option>';
                echo '</select>';
            } elseif(strpos($table->columns[$key]->dbType, 'text') !== false) {
                echo '<select class="type_option editor_select" name="ControlleradminCode[type_option][search]['.$table->columns[$key]->name.'][]">';
                echo '<option selected="selected" value="ckeditor">CkEditor</option>';  
                echo '<option value="textarea">TextArea</option>';  
                echo '</select>';
            } elseif ($table->columns[$key]->name == 'status' || $table->columns[$key]->dbType == 'tinyint(1)') {
                echo '<select class="type_option" name="ControlleradminCode[type_option][search]['.$table->columns[$key]->name.']">';
                echo '<option slected="selected" value="dropdown">DropDown</option>';
                echo '<option value="yesno">Yes/No</option>';
                echo '<option value="text">TextInput</option>';
                echo '</select>';
            } elseif ($table->columns[$key]->name == 'image') {
                echo '<select class="type_option" name="ControlleradminCode[type_option][search]['.$table->columns[$key]->name.']">';
                echo '<option slected="selected" value="file">FileInput</option>';
                echo '</select>';
            } else {
                echo '<select class="type_option" name="ControlleradminCode[type_option][search]['.$table->columns[$key]->name.']">';
                echo '<option slected="selected" value="text">TextInput</option>';
                echo '</select>';
            }            

            echo '<span class="del" title="Delete">X</span>';
            echo '<span class="up" title="Move Up">&#8593;</span>';
            echo '<span class="down" title="Move Down">&#8595;</span>';
            echo '</li>';
        }
        echo '</ul>';
        echo '</div>';
    }
    
    //Search
    
}
//strpos($table->columns[$key]->dbType, 'tinyint')

