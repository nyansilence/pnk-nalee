$(document).ready(function() {
    $main_detail = $('.main-detail')
    $slide_detail = $('.slide-detail')
    $main_detail.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        asNavFor: $slide_detail,
        arrows: false,
        dots: false   
    })
    $slide_detail.slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: $main_detail,
        arrows: false,
        dots: false,
        centerMode: true,
        focusOnSelect: true
    });
});
