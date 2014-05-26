jQuery(document).ready(function($) {


    $(function() {
        $('.header.header').data('size', 'big');
    });

    $(window).scroll(function() {
        if ($(document).scrollTop() > 0) {
            if ($('.header.header').data('size') == 'big') {
                $('.header.header').data('size', 'small');
                $('.header.header > a').stop().animate({
                    opacity: 0
                }, 600);
                $('.header.header').stop().animate({
                    height: '30px'
                }, 600);
                $('.header.header > a').css('height', 0);
            }
        } else {
            if ($('.header.header').data('size') == 'small') {
                $('.header.header').data('size', 'big');
                $('.header.header > a').css('height', 'auto');
                $('.header.header > a').stop().animate({
                    opacity: 80
                }, 8000);

                $('.header.header').stop().animate({
                    height: '350px'
                }, 600);
            }
        }
    });


});