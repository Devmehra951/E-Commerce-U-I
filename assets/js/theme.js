document.addEventListener('DOMContentLoaded', () => {
  const animatedElements = document.querySelectorAll('.fade-in');

  if ('IntersectionObserver' in window && animatedElements.length) {
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
          }
        });
      },
      {
        threshold: 0.18,
      }
    );

    animatedElements.forEach((element) => observer.observe(element));
  } else {
    animatedElements.forEach((element) => element.classList.add('is-visible'));
  }

  if (window.ecommerceMobileTheme && window.ecommerceMobileTheme.useSwiper && typeof Swiper !== 'undefined') {
    const sliderRoot = document.querySelector('.brand-slider__viewport.swiper');

    if (sliderRoot) {
      new Swiper(sliderRoot, {
        slidesPerView: 2.4,
        spaceBetween: 12,
        loop: true,
        speed: 650,
        autoplay: {
          delay: 2200,
          disableOnInteraction: false,
        },
      });
    }
  }
});
