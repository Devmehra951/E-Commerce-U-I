document.addEventListener('DOMContentLoaded', () => {
  const animatedItems = document.querySelectorAll('.fade-in');

  if ('IntersectionObserver' in window && animatedItems.length) {
    const fadeObserver = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          fadeObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.18 });

    animatedItems.forEach((item) => fadeObserver.observe(item));
  } else {
    animatedItems.forEach((item) => item.classList.add('is-visible'));
  }

  const brandsSlider = document.querySelector('.js-brands-slider');

  if (brandsSlider && typeof window.Swiper !== 'undefined') {
    new window.Swiper(brandsSlider, {
      slidesPerView: 2.2,
      spaceBetween: 12,
      speed: 600,
      loop: true,
      autoplay: {
        delay: 2200,
        disableOnInteraction: false,
      },
      breakpoints: {
        420: {
          slidesPerView: 2.8,
        },
      },
    });
  }
});
