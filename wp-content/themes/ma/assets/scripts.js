sc1ban = new Swiper('.sc1__banner-slider', {
    loop: true,
    autoplay: {
        delay: 4000,
    },
    speed: 500,
});
function vw(px) {
    return Math.round(px * window.outerWidth / 1600);
}
sc1subban = new Swiper('.sc1__banner-subslider', {
    loop: true,
    slidesPerView: 'auto',
    resizeObserver: true,
    spaceBetween: vw(20),
    autoplay: {
        delay: 3030,
    },
    speed: 500,
});

function checkInput(e) {
    console.log(e.files[0].name);
    document.querySelector('.uploadr-legend.flz').innerHTML = e.files[0].name;
}

if (window.location.href.indexOf('upload-success') !== -1) {
    window.history.replaceState('page2', document.title, '/');
}