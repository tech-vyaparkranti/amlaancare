var swiper = new Swiper(".ticker-slide", {
    spaceBetween: 10,
    loop: true,
    autoplay: {
      delay: 2500,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      768: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      1024: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
    },
});


    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 4,  // Default for desktop
        spaceBetween: 20,  // Space between images
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            // For tablet
            1024: {
                slidesPerView: 3,  // 3 images for tablets
            },
            // For mobile
            767: {
                slidesPerView: 2,  // 2 images for mobile
            }
        }
    });
