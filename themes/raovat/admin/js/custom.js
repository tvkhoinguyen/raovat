$(document).ready(function(){
    $('.hidden-symbol').live('click',function(){
        var menuid = $(this).parent('li').attr('id');
        $('#' + menuid + ' .data-' + menuid).show();
        $('#' + menuid + ' .close-' + menuid).html('-');
        $('#' + menuid + ' .close-' + menuid).removeClass('hidden-symbol');
        $('#' + menuid + ' .close-' + menuid).addClass('showing-symbol');
    });
    $('.showing-symbol').live('click',function(){
        var menuid = $(this).parent('li').attr('id');
        $('#' + menuid + ' .data-' + menuid).hide();
        $('#' + menuid + ' .close-' + menuid).html('+');
        $('#' + menuid + ' .close-' + menuid).removeClass('showing-symbol');
        $('#' + menuid + ' .close-' + menuid).addClass('hidden-symbol');
    });
    
    // $('.dd').nestable({ /* config options */ });

    validateNumber();

    $('.ui-datepicker-trigger').click(function(){
        $('.ui-datepicker').css({'z-index':9999});
    });

    /* Nguyen Dung add for multiselect */
    $('.group_subscriber').find('.ui-multiselect').eq(0).click(function(){
//            $('.group_subscriber .fix-label').find('.ui-multiselect-checkboxes').css({height:'350px'});
        if($(".ui-multiselect-menu").css('display')=='block')
            $('.ui-multiselect-menu').hide()
        else{
            $('.ui-multiselect-menu').show()
        }
    });

    //$('input[type=file]').bootstrapFileInput();
    
    $('.thumbnail').hover(
        function(){
            $(this).find('.caption').slideDown(250); //.fadeIn(250)
        },
        function(){
            $(this).find('.caption').slideUp(250); //.fadeOut(205)
        }
    ); 
    
    $('.removedfile').click(function(event){
        event.preventDefault();
        var url = $(this).attr('href');
         var request = $.ajax({
            type: "get",
            url: url,
          }).done(function(data) {
            if (data != '')
                $("#" + data).remove();              
          });

          request.fail(function() {
            alert( "Sory cannot remove the image");
          });
    });
});

function countdownChar(numberChar,classInput,classText){
    var count_char = $('.'+classInput).val().length;
    $('.'+classText).val(count_char);

    $('.'+classInput).keyup(function(){
        var count_char = $('.'+classInput).val().length;
        $('.'+classText).val(count_char);
    });
}

function runEditorBasic(url, toolbar, width, height) {
    $('.my-editor-basic').each(function(){            
        CKEDITOR.replace(this.id,
        {
            toolbar: toolbar,
            filebrowserBrowseUrl : url + 'ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl : url + 'ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl : url + 'ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl : url + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : url + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl : url + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
            width: width,
            height: height,
            allowedContent: true,
        });
    });

    $('.ver_editor_basic').each(function(){            
        CKEDITOR.replace(this.id,
        {
            toolbar: toolbar,
            filebrowserBrowseUrl : url + 'ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl : url + 'ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl : url + 'ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl : url + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : url + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl : url + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
            width: width,
            height: height,
            allowedContent: true,
        });
    });
}

function runEditorBasic_NguyenCustom(url, toolbar, width, height) {
    $('.my-editor-basic-nguyen').each(function(){            
        CKEDITOR.replace(this.id,
        {
            toolbar: toolbar,
            filebrowserBrowseUrl : url + 'ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl : url + 'ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl : url + 'ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl : url + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : url + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl : url + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
            width: width,
            height: height,
            allowedContent: true,
        });
    });
}

//HuuThoa Run ckeditor with toobar full
function runEditorFull(url, toolbar, width, height) {
    $('.my-editor-full').each(function(){            
        CKEDITOR.replace(this.id,
        {
            toolbar: toolbar,
            filebrowserBrowseUrl : url + 'ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl : url + 'ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl : url + 'ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl : url + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : url + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl : url + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
            width: width,
            height: height,
            allowedContent: true,
        });
    });

    jQuery('.ver_editor_full').each(function(){            
        CKEDITOR.replace(this.id,
        {
            toolbar: toolbar,
            filebrowserBrowseUrl : url + 'ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl : url + 'ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl : url + 'ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl : url + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : url + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl : url + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
            width: width,
            height: height,
            allowedContent: true,
        });
    });
}

//HuuThoa run datepicker
function runDatePicker(url, format) {
    $('.my-datepicker-control').each(function(){
        var id = $(this).attr('id');
        $('#'+id).datepicker(
            jQuery.extend(
                {showMonthAfterYear:false}, 
                jQuery.datepicker.regional['en-GB'], 
                {
                    'dateFormat':format,
                    'regional':'en_us',
                    'changeMonth':'true',
                    'changeYear':'true',
                    
                    'showOn':'button',
                    'buttonImage': url + '/admin/images/icon_calendar_r.gif',
                    'buttonImageOnly':true
                }
            )
        );
    });

    $('.my-datepicker-control-dd-mm-yy').each(function(){
        var id = $(this).attr('id');
        $('#'+id).datepicker(
            jQuery.extend(
                {showMonthAfterYear:false}, 
                jQuery.datepicker.regional['en-GB'], 
                {
                    'dateFormat':'dd-mm-yy',
                    'regional':'en_us',
                    'changeMonth':'true',
                    'changeYear':'true',
                    
                    'showOn':'button',
                    'buttonImage': url + '/admin/images/icon_calendar_r.gif',
                    'buttonImageOnly':true
                }
            )
        );
    });
    
    $('.my-datepicker-control-mindate').each(function(){
        var id = $(this).attr('id');
        $('#'+id).datepicker(
            jQuery.extend(
                {showMonthAfterYear:false}, 
                jQuery.datepicker.regional['en-GB'], 
                {
                    'dateFormat':'dd-mm-yy',
                    'regional':'en_us',
                    'changeMonth':'true',
                    'changeYear':'true',
                    'minDate': 0, 
                    'showOn':'button',
                    'buttonImage': url + '/admin/images/icon_calendar_r.gif',
                    'buttonImageOnly':true
                }
            )
        );
    });
}
//HuuThoa run datetimepicker
function runDateTimePicker(url, format) {    
    $('.my-datetimepicker-control').each(function(){
        var id = $(this).attr('id');
        $('#'+id).datetimepicker(
            jQuery.extend(
                {showMonthAfterYear:false}, 
                jQuery.datepicker.regional['en-GB'], 
                {
                    'dateFormat':format,
                    'regional':'en_us',
                    'changeMonth':'true',
                    'changeYear':'true',
                    'showOn':'button',
                    'buttonImage': url + '/admin/images/icon_calendar_r.gif',
                    'buttonImageOnly':true
                }
            )
        );
    });
}

//HuuThoa run timepicker
function runTimePicker(url) {
    $('.ver_timepicker').each(function(){
        var id = $(this).attr('id');
        $('#'+id).timepicker(
            jQuery.extend({showMonthAfterYear:false}, 
                jQuery.datepicker.regional['en-GB'], 
                {
                    'regional':'en_us',
                    'minDate':0,
                    'showOn':'button',
                    'buttonImage': url + '/admin/images/icon_calendar_r.gif',
                    'buttonImageOnly':true
                }
            )
        );
    });
}

function validateNumber() {    
    $(".numeric-control").keydown(function(e){
        var key = e.which;    
        // backspace, add, tab, left arrow, up arrow, right arrow, down arrow, delete, numpad decimal pt, period, enter
        if (key != 8 && key != 107 &&  key != 187 &&  key != 16 && key != 9 && 
            key != 37 && key != 38 && key != 39 && key != 40 && key != 46 && key != 110 && 
            key != 190 && key != 13 && key != 96 && key != 97 && key != 98 &&  key != 99 
            && key != 100 && key != 101 && key != 102 && key != 103 && key != 104 && key != 105)
        {
            if (e.shiftKey)
            {
                if (key == 61)
                    return key.returnValue;
                else
                    e.preventDefault();
            }
            else
            {
                if (key < 48){
                    e.preventDefault();
                }
                else if (key > 57){
                    e.preventDefault();
                }
            }
        }
    });
}


