 var swiper = new Swiper('.swiper-container-v', {
        direction: 'vertical',
        slidesPerView: 1,
        paginationClickable: true,
        spaceBetween: 0,
        speed: 300,
        slidesPerView: 'auto',
        keyboardControl: true,
        mousewheelControl: true,
        slideToClickedSlide: false,
      slideClass: 'swiper-slide',
      wrapperClass: 'swiper-wrapper',
      slideActiveClass: 'mesh-page-active',
      slideVisibleClass: 'mesh-page-visible',
      preventLinksPropagation: true,
      slidesPerView: 1,
      autoResize: true,
      cssWidthAndHeight: true,
      calculateHeight: false
      // loop: true
            });

 // var swiperV = new Swiper('.swiper-container-h', {
 //        pagination: '.swiper-pagination-h',
 //        paginationClickable: true,
 //        spaceBetween: 0,
 //        slidesPerView: 'auto',
 //        nextButton: '.swiper-button-next',
 //        prevButton: '.swiper-button-prev',
 //        keyboardControl: true,
 //        grabCursor: true,
 //        slideToClickedSlide: false
 //    });

 //  var swiperV = new Swiper('.swiper-container-home', {
 //        pagination: '.swiper-pagination-home',
 //        paginationClickable: true,
 //        spaceBetween: 0,
 //        slidesPerView: 'auto',
 //        nextButton: '.swiper-button-next',
 //        prevButton: '.swiper-button-prev',
 //        keyboardControl: true,
 //        mousewheelControl: true,
 //        slideToClickedSlide: false,
 //        autoplay: 1000
 //    });