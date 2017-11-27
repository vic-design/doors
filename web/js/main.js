$('.fancybox').fancybox({
    fitToView: false,
    autoSize: false
});

$('ul.nav > li').hover(function() {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn();
}, function() {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut();
});

$(document).ready(function () {
    var url=document.location.pathname + document.location.search;
    $.each($(".nav li"),function(){
        if($(this).find('a').attr('href') == url){
            $(this).find('a').addClass('active');
        }
    });
});


