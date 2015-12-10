 var swiper = new Swiper('.swiper-container-v', {
        direction: 'vertical',
        slidesPerView: 1,
        spaceBetween: 0,
        speed: 300,
        parallax:true,
        keyboardControl: true,
        mousewheelControl: true,
        watchSlidesProgress: true,
      wrapperClass: 'swiper-wrapper',
      slideVisibleClass: 'slide-visible',
      loop:'true',
      autoplay: 2000,
    
            draggable: true
        
      });


function fixSwiperForIE(swiper) {
    setTimeout(function () {
        swiper.onResize();
    });
}