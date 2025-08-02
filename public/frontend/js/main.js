$(function () {

    "use strict";

    //=========MENU FIX JS=========
    if ($('.main_menu').offset() != undefined) {
        var navoff = $('.main_menu').offset().top;
        $(window).scroll(function () {
            var scrolling = $(this).scrollTop();

            if (scrolling > navoff) {
                $('.main_menu').addClass('menu_fix');
            } else {
                $('.main_menu').removeClass('menu_fix');
            }
        });
    }


    //*==========MINI CART==========
    $('.cart_icon').on('click', function () {
        $('.mini_cart').addClass('.show_cart');
    });

    $('.wsus_close_mini_cart').on('click', function () {
        $('.mini_cart').removeClass('.show_cart');
    });


    // ======CATEGORY MENU======
    $('.wsus_menu_category_bar').on('click', function () {
        $('.toggle_menu').toggleClass('.show_category');
    });


    //=======POP_UP========
    $("#cross").on("click", function () {
        $("#pop_up").fadeOut();
    });


    //=======SELECT2======
    $(document).ready(function () {
        $('.select_2').select2();
    });


    //*======BANNER SLIDER=====
    $('.banner_slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: true,
        arrows: false,
    });


    //*==========BRAND SLIDER=========
    $('.brand_slider').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: false,
        arrows: true,
        nextArrow: '<i class="fas fa-chevron-right nxt_arr"></i>',
        prevArrow: '<i class="fas fa-chevron-left prv_arr"></i>',

        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });
    $('.collection_slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: false,
        arrows: true,
        nextArrow: '<i class="fas fa-chevron-right nxt_arr"></i>',
        prevArrow: '<i class="fas fa-chevron-left prv_arr"></i>',

        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            }
        ]
    });


    //*==========FLASH SELL SLIDER=========
    $('.flash_sell_slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: false,
        arrows: true,
        nextArrow: '<i class="fas fa-chevron-right nxt_arr"></i>',
        prevArrow: '<i class="fas fa-chevron-left prv_arr"></i>',

        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });



    //*======HOT DETAILS SLIDER=====
    $('.hot_deals_slider').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: false,
        arrows: true,
        nextArrow: '<i class="fas fa-chevron-right nxt_arr"></i>',
        prevArrow: '<i class="fas fa-chevron-left prv_arr"></i>',

        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });




    //*======BANNER SLIDER=====
    $('.modal_slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1000,
        dots: false,
        arrows: true,
        nextArrow: '<i class="fas fa-chevron-right nxt_arr"></i>',
        prevArrow: '<i class="fas fa-chevron-left prv_arr"></i>',
    });


    //*==========ISOTOPE==============
    var $grid = $('.grid').isotope({});

    $('.monthly_top_filter').on('click', 'button', function () {
        var filterValue = $(this).attr('data-filter');
        $grid.isotope({
            filter: filterValue
        });
    });

    //active class
    $('.monthly_top_filter button').on("click", function (event) {

        $(this).siblings('.active').removeClass('active');
        $(this).addClass('active');
        event.preventDefault();

    });


    //*==========ISOTOPE==============
    var $grid2 = $('.grid2').isotope({});

    $('.monthly_top_filter2').on('click', 'button', function () {
        var filterValue = $(this).attr('data-filter');
        $grid2.isotope({
            filter: filterValue
        });
    });

    //active class
    $('.monthly_top_filter2 button').on("click", function (event) {

        $(this).siblings('.active').removeClass('active');
        $(this).addClass('active');
        event.preventDefault();

    });



    //*==========TEAM SLIDER=========
    $('.home_blog_slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: false,
        arrows: true,
        nextArrow: '<i class="fas fa-angle-right prv_arr"></i>',
        prevArrow: '<i class="fas fa-angle-left nxt_arr"></i>',

        responsive: [
            {
                breakpoint: 1399.99,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });


    //*==========TEAM SLIDER=========
    $('.weekly_best').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: false,
        arrows: true,
        vertical: true,
        nextArrow: '<i class="fas fa-angle-up nxt_arr"></i>',
        prevArrow: '<i class="fas fa-angle-down prv_arr"></i>',
    });


    //=======COUNTDOWN======
    var d = new Date(),
        countUpDate = new Date();
    d.setDate(d.getDate() + 90);

    // default example
    // simplyCountdown('.simply-countdown-one', {
    //     year: d.getFullYear(),
    //     month: d.getMonth() + 1,
    //     day: d.getDate(),
    //     enableUtc: true
    // });


    //*==========SCROLL BUTTON==========
    $('.scroll_btn').on('click', function () {
        $('html, body').animate({
            scrollTop: 0,
        }, 400);
    });

    $(window).on('scroll', function () {
        var scrolling = $(this).scrollTop();

        if (scrolling > 300) {
            $('.scroll_btn').fadeIn();
        } else {
            $('.scroll_btn').fadeOut();
        }
    });


    //==========PRODUCT ZOOMER============
    if ($("#exzoom").length > 0) {
        $("#exzoom").exzoom({
            autoPlay: true,
        });
    }


    //==========VENOBOX JS============
    $('.venobox').venobox();


    //=========main.js=========
    $('.counter').countUp();


    //*==========MOBILE MENU==========
    $('.mobile_menu_icon').on('click', function () {
        $('#mobile_menu').addClass('show_m_menu');
    });

    $('.mobile_menu_close').on('click', function () {
        $('#mobile_menu').removeClass('show_m_menu');
    });


    // ======SIDEBAR FILTER======
    $('.sidebar_filter').on('click', function () {
        $('.product_sidebar').toggleClass('show_filter');
    });

    $('.sidebar_filter').on('click', function () {
        $('#plus').toggleClass('show_plus');
    });


    //*==========TEAM SLIDER=========
    $('.team_slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: false,
        arrows: false,

        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });


    //*==========STICKY SIDEBAR=========
    $("#sticky_sidebar").stickit({
        top: 70,
    })

    $("#sticky_pro_zoom").stickit({
        top: 70,
    })

    $("#sticky_sidebar2").stickit({
        top: 70,
    })

    $("#sticky_sidebar3").stickit({
        top: 70,
    })


    //*==========BLOG DETAILS SLIDER=========
    $('.blog_det_slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: true,
        arrows: false,

        responsive: [
            {
                breakpoint: 1400,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });


    //*==========PRICE SLIDER=========
    // jQuery(function () {
    //     jQuery("#slider_range").flatslider({
    //         min: 0, max: 10000,
    //         step: 100,
    //         values: [0, 8000],
    //         range: true,
    //         einheit: '$'
    //     });
    // });


    //*========IMG & VIDEO UPLOAD=======
    $('.gallery').miv({ image: '.cam', video: '.vid' });


    //*========classycountdown=======
    $('#countdown17').ClassyCountdown({
        theme: "flat-colors-very-wide",
        end: $.now() + 10000
    });


    //*==========DASHBOARD SIDEBAR==========
    $('.close_icon').on('click', function () {
        $('.dashboard_sidebar').toggleClass('show_dash_menu');
    });

    $('.close_icon').on('click', function () {
        $('.dash_close').toggleClass('dash_opasity');
    });



    //*======HOT DETAILS SLIDER=====
    $('.hot_deals_slider_2').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: false,
        arrows: true,
        nextArrow: '<i class="fas fa-chevron-right nxt_arr"></i>',
        prevArrow: '<i class="fas fa-chevron-left prv_arr"></i>',

        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });


    //*==========TEAM SLIDER=========
    $('.weekly_best2').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: false,
        arrows: true,
        nextArrow: '<i class="fas fa-long-arrow-alt-right nxt_arr"></i>',
        prevArrow: '<i class="fas fa-long-arrow-alt-left prv_arr"></i>',
    });

    // AOS.init();
    AOS.init({
        easing: 'ease-in-out-sine'
    });

    // Swipe Slider
    var swiper = new Swiper(".workout-time", {
        spaceBetween: 15,
        loop: true,
        autoplay: {delay: 3000,disableOnInteraction: false,},
        breakpoints: {
            320: {slidesPerView: 2,},
            480: {slidesPerView: 3,},
            768: {slidesPerView: 4,},
            1024: {slidesPerView: 5,},
        },
        navigation: {nextEl: ".swiper-button-next",prevEl: ".swiper-button-prev",},
        pagination: {el: ".swiper-pagination",clickable: true,},
    });

    var newDate = new Date();
    var endDate = new Date();
    var customDate = new Date();
    var outputx = newDate.setHours("00");
    newDate.setMinutes("00");
    var outputy = endDate.setHours("23");
    endDate.setMinutes("59");

    var startDates = ((newDate.getHours()<10?'0':'') + newDate.getHours());
    let startDate = ((newDate.getHours()<10?'0':'') + newDate.getHours()) + "" + ((newDate.getMinutes()<10?'0':'') + newDate.getMinutes());

    let customHours = ((customDate.getHours()<10?'0':'') + customDate.getHours()) + "" + ((customDate.getMinutes()<10?'0':'') + customDate.getMinutes());

    let endDate_date = ((endDate.getHours()<10?'0':'') + endDate.getHours()) + "" + ((endDate.getMinutes()<10?'0':'') + endDate.getMinutes());

    var customOutput = outputy - outputx;
    var getcustomhr = Math.floor((customOutput % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));

    if (customHours >= startDate && customHours <= endDate_date){
    var countDownDate = (new Date(newDate)).setHours(newDate.getHours() + getcustomhr);
    // countDownDate = (new Date(countDownDate)).setMinutes(newDate.getMinutes());
        var x = setInterval(function () {
            var now = new Date().getTime();
            var distance = countDownDate - now;
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            // Output the result in an element with id="sale-timer"
            hours += days>0?(days*24):"";
            $(".days").html((days<10?'0':'') + days);
            $(".hours").html((hours<10?'0':'') + hours);
            $(".minutes").html((minutes<10?'0':'') + minutes);
            $(".seconds").html((seconds<10?'0':'') + seconds);
            //timerContent;
            $("#moving_slide").show();
            //document.getElementById("moving_slide").style.display = 'block';
            if (distance < 0) {
                clearInterval(x);
                var stickerstr = document.getElementById("moving_slide");
                stickerstr.remove();
                //document.getElementById("sale-timer").innerHTML = "EXPIRED";
                //alert('Offer Timeout Please Visit Next Day Thanks for Shopping');
            }
        }, 1000);
    } else {
        console.log('Offer Timeout Please Visit Next Day Thanks for Shopping');
    };

    if($(window).width() < 767){
        if ($('.customMobileSlide').length) {
            $('.customMobileSlide').slick({
                dots: true,
                infinite: false,
                nextArrow: '<i class="fa-regular fa-angle-right nxt_arr"></i>',
                prevArrow: '<i class="fa-regular fa-angle-left prv_arr"></i>',
                speed: 300,
                spaceBetween: 15,
                slidesToShow: 4,
                slidesToScroll: 4,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                        }
                    }
                ]
            });
        }
    }

});

