

/*~~~~~~~~~~~~~~~~~~~>> SEARCHBOX JS START <<~~~~~~~~~~~~~~~~~~~~~*/

// $('.header-search-wrapper .search-main').click(function(){
//     $('.search-form-main').toggleClass('active-search');
//     $('.search-form-main .search-field').focus();
// });

$(document).ready(function() {
  $('.header-search-wrapper .search-main').click(function(event) {
    event.stopPropagation(); // Prevent the click event from bubbling up

    $('.search-form-main').toggleClass('active-search');
    $('.search-form-main .search-field').focus();
  });

  $('body').click(function(event) {
    var target = $(event.target);
    if (!target.closest('.search-form-main').length && !target.closest('.header-search-wrapper').length) {
      $('.search-form-main').removeClass('active-search');
    }
  });
});


/*~~~~~~~~~~~~~~~~~~>> SHRINK ON SCROLL JS START <<~~~~~~~~~~~~~~~~~~*/

$(function(){
  $(window).scroll(function() {
     if($(window).scrollTop() >= 100) {
       $('nav').addClass('scrolled');
     }
    else {
      $('nav').removeClass('scrolled');
    }
  });
});


/*~~~~~~~~~~~~~~~~~>> INSTANT ORDER OWL CAROUSEL <<~~~~~~~~~~~~~~~~~~*/
$(document).ready(function() {
  $(".owl-carousel-1").owlCarousel({
    items: 4,
    loop: false,
    mouseDrag: false,
    touchDrag: false,
    pullDrag: false,
    rewind: true,
    autoplay: true,
    margin: 0,
    nav: true
  });
});



var $swiperSelector = $('.swiper-container');

$swiperSelector.each(function(index) {
    var $this = $(this);
    $this.addClass("swiper-slider-" + index);
    
    var dragSize = $this.data('drag-size') ? $this.data('drag-size') : 50;
    var freeMode = $this.data('free-mode') ? $this.data('free-mode') : false;
    var loop = $this.data('loop') ? $this.data('loop') : false;

    var swiper = new Swiper(".swiper-slider-" + index, {
      direction: "horizontal",
      loop: true,
      freeMode: freeMode,
      breakpoints: {
        1920: {
          slidesPerView: 4,
          spaceBetween: 44
        },
        992: {
          slidesPerView: 4,
          spaceBetween: 44
        },
        480: {
           slidesPerView: 3,
           spaceBetween: 44
        }
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
      },
      scrollbar: {
        el: ".swiper-scrollbar",
        draggable: true,
        dragSize: dragSize
     }
  });
});


// =================== testimonial slider =============>>

$('.owl-carousel-2').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    dots: true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
})


// =================== testimonial slider =============>>

$('.owl-carousel-3').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    dots: true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:4
        }
    }
})