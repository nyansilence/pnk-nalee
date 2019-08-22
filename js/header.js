$(document).ready(function(){
    $window = $(window)
    $body_html = $('body, html')
    $mod_header = $('.mod-header')
    $menu_ham = $('.menu-ham')
    $menu_mb = $('.menu-mb')
    $menu_ham.on('click', function(){
        if($(this).hasClass('active')) {
            $(this).removeClass('active')
            $menu_mb.removeClass('active')
            $mod_header.removeClass('menu-open')
            $body_html.removeClass('ofl-hidden')
            if ($window.scrollTop() > 1) {
                $mod_header.addClass('is-scroll')
            }
        } else {
            $(this).addClass('active')
            $menu_mb.addClass('active')
            $mod_header.addClass('menu-open').removeClass('is-scroll')
            $body_html.addClass('ofl-hidden')
        }
    })
})


$(window).scroll(function() {
    $window = $(this)
    $mod_banner = $('.mod-banner')
    var x = $mod_banner.offset();
    // alert("Top: " + x.top ); 
    // alert("Height of div: " + $mod_banner.height());
    if($window.scrollTop() > ($mod_banner.height()+x.top)) {
        $mod_header.addClass('is-scroll')
    } else {
        $mod_header.removeClass('is-scroll')
    }
})