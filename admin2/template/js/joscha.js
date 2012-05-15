$(document).ready(function(){
    $('#content').delegate("header", "click", function(){
        $(this).nextAll('section').slideToggle('fast');
        if(!$(this).hasClass('open')){
            $(this).addClass('open');
        }else{
            $(this).removeClass('open');
        }
    });
});