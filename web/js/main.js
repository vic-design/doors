$('.fancybox').fancybox(/*{
    fitToView: false,
    autoSize: false
}*/);

//Tooltip on hover
$("[data-toggle='tooltip']").tooltip();

// Makes tooltips work on ajax generated content
$(document).ajaxStop(function () {
    $("[data-toggle='tooltip']").tooltip();
});

$('#list-view').click(function () {
    $('#grid-view').removeClass('active');
    $('.product-layout').removeClass('col-sm-4');
    $('#list-view').addClass('active');
});

$('#grid-view').click(function () {
    $('#list-view').removeClass('active');
    $('.product-layout').addClass('col-sm-4');
    $('#grid-view').addClass('active');
});
$('ul.nav > li').hover(function() {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn();
}, function() {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut();
});

$('.shopping-button').click(function (e) {
    e.preventDefault();
    var modal = $('#basketModal');
    modal.modal('show');
    modal.find('#modal-content').load($(this).attr('href'));
});

$('.backCall').click(function (e) {
    e.preventDefault();
    var modal = $('#msgModal');
    modal.modal('show');
    modal.find('#modal-content').load($(this).attr('href'));
});

$('.measureCall').click(function (e) {
    e.preventDefault();
    var modal = $('#callModal');
    modal.modal('show');
    modal.find('#modal-content').load($(this).attr('href'));
});

$(document).ready(function () {
    var element = $('.aside-menu a.active');
    element.click(function (e) {
        e.preventDefault();
        $(this).siblings('ul').slideToggle();
    });
});

$(document).ready(function () {
    var url=document.location.pathname + document.location.search;
    $.each($(".nav li"),function(){
        if($(this).find('a').attr('href') == url){
            $(this).find('a').addClass('active');
        }
    });
});

$(document).ready(function () {
    var url=document.location.pathname + document.location.search;
    $.each($(".nav li"),function(){
        if($(this).find('a').attr('href') == url){
            $(this).find('a').addClass('active');
        }
    });
});



