$(document).ready(function(){
	$('#content').delegate("header", "click", function(){
        if(!$(this).hasClass('open')){
            $(this).nextAll('.quickedit').slideDown('fast');
            $(this).addClass('open');
        }else{
            $(this).nextAll('.quickedit').slideUp('fast');
            $(this).removeClass('open');
        }
    });
    
    /*$('')click(function(){
    
    });*/
});