$(document).ready(function(){
    //If we have js hide the traditional button and show the ajax button
    $('#urlShorted').hide();
    $('#create').hide();
    $('#create_ajax').show();
    
    $('#create_ajax').click(function(){
        $.ajax({
            type: 'POST',
            url: '/',
            data: 'url=' + $('#f-url').val(),
            success: function(slug){
                $('#f-url').val(slug).focus();
            }
         });
    });
});