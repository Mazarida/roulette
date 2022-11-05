sc1ban = new Swiper('.sc1__banner-slider', {
    loop: true,
    autoplay: {
        delay: 4000,
    },
    speed: 500,
});
sc1subban = new Swiper('.sc1__banner-subslider', {
    loop: true,
    slidesPerView: 'auto',
    resizeObserver: true,
    spaceBetween: 20,
    autoplay: {
        delay: 3030,
    },
    speed: 500,
});