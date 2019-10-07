$ = jQuery.noConflict();
hash = window.location.hash;
$(".about-menu__link").click(function () {
    $("html , body").stop().animate(10000)
});

window.onload = function () {
    if (window.location.hash && (window.location.href.search('armenia#') > 0 || window.location.href.search('news#') > 0)) {
        $('body,html').animate({
            scrollTop: 0
        }, 1000);
    }
    $('.preloader_container').remove();
    document.getElementById("MainBlock").style.visibility = "visible";
}

//----------------------Intersection Observer Start------------------------
document.addEventListener("DOMContentLoaded", function () {
    var lazyloadImages;
    if ("IntersectionObserver" in window) {
        lazyloadImages = document.querySelectorAll(".lazy-bg");
        var imageObserver = new IntersectionObserver(function (entries, observer) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    var image = entry.target;
                    image.classList.remove("lazy-bg");
                    imageObserver.unobserve(image);
                }
            });
        });
        lazyloadImages.forEach(function (image) {
            imageObserver.observe(image);
        });
    }
    else {
        var lazyloadThrottleTimeout;
        lazyloadImages = document.querySelectorAll(".lazy-bg");
        function lazyload() {
            if (lazyloadThrottleTimeout) {
                clearTimeout(lazyloadThrottleTimeout);
            }
            lazyloadThrottleTimeout = setTimeout(function () {
                var scrollTop = window.pageYOffset;
                lazyloadImages.forEach(function (img) {
                    if (img.offsetTop < (window.innerHeight + scrollTop)) {
                        img.src = img.dataset.src;
                        img.classList.remove('lazy-bg');
                    }
                });
                if (lazyloadImages.length == 0) {
                    document.removeEventListener("scroll", lazyload);
                    window.removeEventListener("resize", lazyload);
                    window.removeEventListener("orientationChange", lazyload);
                }
            }, 20);
        }
        let scrollPosition = $(document).scrollTop();
        document.addEventListener("scroll", lazyload);
        window.addEventListener("resize", lazyload);
        window.addEventListener("orientationChange", lazyload);
    }
});
//----------------------Intersection Observer End--------------------------

$(document).ready(function () {
    // Owl carousel 1
    var scrollPosition = $(document).scrollTop();
    $(document).scroll(function () {
        scrollPosition = $(document).scrollTop();
    })

    $('.snitcher span').click(function () {
        $('.snitcher span').removeClass('activeButton')
        $(this).addClass('activeButton')
        $('.videos').toggleClass('passive')
        $('.photos').toggleClass('passive')
    });
    $('.video-container__content').click(function () {
        $('.modal-dialog').addClass('videoModal')
    });
    $('.close , .modal ').click(function (e) {

        if (e.target === this) {
            setTimeout(function () {
                $('.modal-dialog').removeClass('videoModal')
            }, 700)
        }
    });
    $(".about-menu__link , .service-menu__link").click(function (e) {

        if (scrollPosition < 400)
            window.scrollTo(0, scrollPosition);
    });
    $('.carousel1').owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        margin: 0,
        nav: false,
        dots: true,
        items: 1,
        itemsCustom: false,
        responsive: {
            0: {
                items: 1
            }
        }
    });
    // Owl carousel 2
    $('.carousel2').owlCarousel({
        loop: true,
        autoplay: true,
        autoplayHoverPause: false,
        slideTransition: 'linear',
        autoplayTimeout: 0,
        autoplaySpeed: 3000,
        nav: false,
        dots: false,
        margin: 20,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            410: {
                items: 2
            },
            600: {
                items: 3
            },
            900: {
                items: 4
            },
            1000: {
                items: 5
            },
            1300: {
                items: 8
            }
        }
    });
    // tur slider


    // owl
    var owl = $(".owl-carousel"),
        url = null,
        prev = $(".arrowleft"),
        next = $(".arrowright");




    // loop is removing because of  owl error 
    owl.owlCarousel({
        loop: false,
        items: 1,
        center: true,
        touchDrag: true,
        pagination: false,
        dots: false,
    });

    next.on("click", function () {
        $(this).closest('.tours_slider_container').find('.owl-carousel').trigger("next.owl.carousel")
    });
    prev.on("click", function () {
        $(this).closest('.tours_slider_container').find('.owl-carousel').trigger("prev.owl.carousel")
    });

    var circlesBreacking = $('.breackpointCircle');
    var paths = $('.tursSVGLine path')
    for (var i = 0; i < paths.length; i++) {
        var breackpointPosition = paths[i]
            .getPointAtLength(4000)
        circlesBreacking[i].setAttribute("transform", "translate(" +
            breackpointPosition.x + "," +
            breackpointPosition.y + ")");
    }

    // var firstBreackpoint = document.getElementById("firstBreackpoint")
    // var firstPath = document.getElementById("first_path_background");
    // var firstBreackpointPosition = firstPath.getPointAtLength(3690);
    // firstBreackpoint.setAttribute("transform", "translate(" +
    // 	firstBreackpointPosition.x + "," +
    // 	firstBreackpointPosition.y + ")");

    var needToOpenAll = false;
    var trigger = false;
    var needToCloseAll = false;
    $('.tourInner-content__location img').click(function () {
        needToOpenAll = !needToOpenAll;
        needToCloseAll = !needToOpenAll;
        trigger = true;
        $('.tourInner-content__title span').trigger("click");
        trigger = false;
        needToCloseAll = true;
    });




    $('.tourInner-content__title span ,svg.tursSVGLine circle  ,.h3Text ')
        .click(function () {
            var ThisParrent = $(this).closest('.turs_items_container');
            var NextContainer = $(ThisParrent).next();
            var NextSvgContainer = $(NextContainer).find('.tursSVGLine');
            var NextPathElement = $(NextSvgContainer).find('path');
            var Line = NextPathElement.attr('date_line');
            var isOpen = NextPathElement.attr('date_open');
            var pathDefaultPosition
            var lineTop

            var parentContainer = $(this).closest('.turs_items_container').find('.tourInner-content__text');
            var sliderHeight = 400;
            // var textHeight = $(window).width()<1008? 250:400;
            var height = $(this).closest('.turs_items_container').find('.tours_slider_container').height()





            if (isOpen == 0) {
                NextPathElement.attr('date_open', '1')
                NextPathElement.css('transition', ' all .3s ease')
            } else {
                NextPathElement.css('transition', '  all .3s ease')
                NextPathElement.attr('date_open', '0')
            }
            if (height == 0 && !trigger || (needToOpenAll && !needToCloseAll)) {
                $(this).closest('.turs_items_container').css({
                    'max-height': 460 + 'px',
                    'margin-bottom': 0,

                });
                $(this).closest('.turs_items_container')
                    .find('.tours_slider_container')
                    .css('max-height', sliderHeight + 'px');



                $(parentContainer).find('p , h2 , h3').css({ 'max-height': '1000px', })
                $(this).closest('.turs_items_container')
                    .find('.tourInner-content__text')
                    .css('max-height', 'auto')
                // if(!$(this).hasClass('h3Text'))
                //     $(this).html('-')
                // else
                //     $(this).next().html( '-')

                $(this).closest('.turs_items_container').find('.h3Text').next().html('-')

                Line == 2 ? lineTop = '-385' : lineTop = '-409'
            }


            else {

                $(this).closest('.turs_items_container').css({
                    'max-height': 100 + 'px',
                    "margin-bottom": '35px'
                });
                $(this).closest('.turs_items_container').find('.tours_slider_container').css('max-height', '0');

                $(parentContainer).find('p , h2 , h3').css({ 'max-height': '0', });
                // if(!$(this).hasClass('h3Text'))
                // $(this).html('+')
                // else
                //     $(this).next().html( '+')

                $(this).closest('.turs_items_container').find('.h3Text').next().html('+');

            }

            if (Line) {
                if (Line == 1) {

                    lineTop = lineTop || "-86"
                    if (lineTop == "-86") {
                        // "M -33 -86 Q 95.5 7.5 -48 54"

                        pathDefaultPosition = "M -33 -86 Q 50.5 -22.5 -48 54"
                    } else {
                        // "M -33 -409 Q 160.5 -143.5 -48 54"
                        pathDefaultPosition = "M -33 -409 Q 191.5 -151.5 -48 54"
                    }


                    // path("M 90 -380 Q 311.5 -264.5 -44 53");
                    // path("M -53 -76 Q -221.5 -31.5 91 78")

                } else if (Line == 2) {
                    lineTop = lineTop || "-79"

                    if (lineTop != "-79") {
                        pathDefaultPosition = "M -43 -403 Q -251.5 -219.5 -39 41"
                    } else {
                        // "M -43, -79 Q -246.5 5.5 91 84"
                        // "M -43 -79 Q -246.5 5.5 91 84"

                        pathDefaultPosition = "M -43 -80 Q -131.5 -22.5 -35 48"

                    }

                }
            }
            NextPathElement.attr('d', pathDefaultPosition)
        });

    $(document).ready(function () {
        //------------------Intersection Observer Start
        const images = document.querySelectorAll('img:not(.not-intersection)');
        const config = {
            rootMargin: '50px 0px',
            threshold: 0.01
        };
        if (!('IntersectionObserver' in window)) {
            Array.from(images).forEach(image => preloadImage(image));
        }
        else {
            observer = new IntersectionObserver(onIntersection, config);
            images.forEach(image => {
                observer.observe(image);
            });
        }
        function onIntersection(entries) {
            entries.forEach(entry => {
                if (entry.intersectionRatio > 0) {
                    observer.unobserve(entry.target);
                    preloadImage(entry.target);
                }
            });
        }
        function preloadImage(img) {
            img.setAttribute('src', img.getAttribute('data-src'));
        }
        //-------------------Intersection Observer End

        $('.slide_left').click(function () {
            var sliderContainer = $(this).parent().parent().find('.tours_slider')
            var sliderLeft = $(sliderContainer).attr('date_margin_left')
            sliderLeft -= 0;
            if (sliderLeft != 0) {
                sliderLeft += 100

                $(this).parent().parent().find('.tours_slider')
                    .css('margin-left', sliderLeft + '%')
                $(sliderContainer).attr('date_margin_left', sliderLeft)
            }

        })
        $('.slide_right').click(function () {
            var itemsLength = $(this).parent().parent().find('.tours_slider_item').length - 2
            var sliderContainer = $(this).parent().parent().find('.tours_slider');
            var sliderLeft = $(sliderContainer).attr('date_margin_left');


            sliderLeft -= 0;
            if (-(itemsLength * 100) <= sliderLeft) {
                sliderLeft -= 100;
                $(this).parent().parent().find('.tours_slider')
                    .css('margin-left', sliderLeft + '%');
                $(sliderContainer).attr('date_margin_left', sliderLeft);
            }

        });

        //  set slider length 
        var length = $('.tours_slider').length

        for (var i = 0; i < length; i++) {
            var itemsCount = $('.tours_slider').eq(i).find('.tours_slider_item').length * 100
        }
    });
    // ------ header menu part -------
    var funct = function () {
        $('.header-mobile').toggleClass("open");
        $('.header__list').toggleClass("header__positionRight");
    };
    var headerMobile = $('.header-mobile');
    headerMobile.click(function (event) {
        funct();
        event.stopPropagation();
        if (headerMobile.hasClass("open") === true) {
            $('.body').css("overflow", "hidden");
        } else {
            $('.body').css("overflow", "scroll");
        }
    });
    $(document).click(function (event) {
        var block = $('.header__list');
        if (block.hasClass("header__positionRight") === true) {
            $('.body').css("overflow", "scroll");
            funct();
        }
    });

    // header background color change
    $(function () {
        var header = $('.header');
        if (header.length !== 0) {
            $(window).scroll(function (event) {
                var y = $(this).scrollTop();
                if (y > 0) {
                    header.addClass('header__backgroundColor');
                }
                else {
                    header.removeClass('header__backgroundColor');
                }
            });
        }
    });
    // header background color change refresh time
    $(function () {
        var header = $('.header');
        if (header.length !== 0) {
            var y = $(this).scrollTop();
            if (y > 0) {
                header.addClass('header__backgroundColor');
            }
            else {
                header.removeClass('header__backgroundColor');
            }
            onScroll();
        }
    });
    // achievements number counter on scroll time

    // Tours Filter open and close
    $('.tours-filter--show').click(function () {
        var link = $(this);
        $('.tours-filter-inside').slideToggle('slow', function () {
            if ($(this).is(':visible')) {
                link.find('#arrow_down').css('display', 'none');
                link.find('#arrow_top').css('display', 'block');
                link.find('#show_p').css('display', 'none');
                link.find('#close_p').css('display', 'block');

            } else {
                link.find('#arrow_down').css('display', 'block');
                link.find('#arrow_top').css('display', 'none');
                link.find('#show_p').css('display', 'block');
                link.find('#close_p').css('display', 'none');
            }
        });
    });

    // Tours Filter outer checkbox
    var checkboxParent = $('#parent');
    var checkboxChild = $('.child');
    checkboxParent.click(function () {
        $(this).addClass('tours-filter__active');
        checkboxChild.removeClass('tours-filter__active');
    });
    checkboxChild.click(function () {
        if (checkboxParent.hasClass("tours-filter__active")) {
            checkboxParent.removeClass('tours-filter__active');
            //$(this).removeClass('tours-filter__active');
        }
        //else{
        if ($(this).hasClass('tours-filter__active')) {
            $(this).removeClass('tours-filter__active');
        }
        else {
            $(this).addClass('tours-filter__active');
            var sum = 0;
            for (var i = 0; i < checkboxChild.length; i++) {
                if (!checkboxChild.eq(i).hasClass('tours-filter__active')) {
                    sum++;
                }
            }
            if (sum === 0 || sum === checkboxChild.length) {
                checkboxParent.addClass('tours-filter__active');
                checkboxChild.removeClass('tours-filter__active');
            }
        }
        //}

    });
    // Tours Filter inner PeriodRadiobutton
    var innerRadioPeriod = $('.tours-filter-inside__formPeriod__input');
    innerRadioPeriod.click(function () {
        if ($(this).hasClass("tours-filter__active")) {
            $(this).removeClass('tours-filter__active');
        }
        else {
            innerRadioPeriod.removeClass("tours-filter__active");
            $(this).addClass("tours-filter__active");
        }
    });
    // Tours Filter inner SeasonRadiobutton
    var innerRadioSeason = $('.tours-filter-inside__formSeason__input');
    innerRadioSeason.click(function () {
        if ($(this).hasClass("tours-filter__active")) {
            $(this).removeClass('tours-filter__active');
        }
        else {
            innerRadioSeason.removeClass("tours-filter__active");
            $(this).addClass("tours-filter__active");
        }
    });
    // Tours Filter inner GroupRadiobutton
    var innerRadioGroup = $('.tours-filter-inside__formGroup__input');
    innerRadioGroup.click(function () {
        if ($(this).hasClass("tours-filter__active")) {
            $(this).removeClass('tours-filter__active');
        }
        else {
            innerRadioGroup.removeClass("tours-filter__active");
            $(this).addClass("tours-filter__active");
        }
    });
    // Tours Filter inner CategoryRadiobutton
    var innerRadioCategory = $('.tours-filter-inside__formCategory__input');
    innerRadioCategory.click(function () {
        if ($(this).hasClass("tours-filter__active")) {
            $(this).removeClass('tours-filter__active');
        }
        else {
            innerRadioCategory.removeClass("tours-filter__active");
            $(this).addClass("tours-filter__active");
        }
    });

    // ==============  about page ==============
    // about page menu fixed
    $(function () {
        var sidebar = $('#about-menuScroll');
        if (sidebar.length !== 0) {

            var top = sidebar.offset().top - sidebar[0].getBoundingClientRect().height;
            top = $(document).width() < 1070 ? top - 27 : top - 5;
            $(window).scroll(function (event) {
                onScroll();
                var y = $(this).scrollTop();
                if (y >= top) {
                    sidebar.addClass('about-menu__fixed');
                    $('#about-company').css({ "margin-top": sidebar[0].getBoundingClientRect().height })
                } else {
                    sidebar.removeClass('about-menu__fixed');
                    $('#about-company').css({ "margin-top": 0 })
                }
            });
        }
    });

    $(function () {
        var sidebar = $('#about-menuScroll');
        if (sidebar.length !== 0) {
            var top = sidebar.offset().top - sidebar[0].getBoundingClientRect().height;
            var y = $(this).scrollTop();
            if (y >= top) {
                $('#about-company').css({ "margin-top": sidebar[0].getBoundingClientRect().height });
                sidebar.addClass('about-menu__fixed');
            } else {
                sidebar.removeClass('about-menu__fixed');
                $('#about-company').css({ "margin-top": 0 })
            }
            onScroll();
        }
    });

    // smooth scroll
    var sidebar_2 = $('#about-menuScroll');
    var serviceMenuScroll = $('#service-menuScroll')
    var pageScrollTop = $(window).scrollTop()
    $('a[href^="#"]').on('mousedown', function (e) {
        pageScrollTop = $(window).scrollTop()
    })
    $('a[href^="#"]').on('click', function (e) {

        $(window).scrollTop(pageScrollTop);



        var scrollTop = $(window).scrollTop();
        $(document).scrollTo(scrollTop);
        e.stopPropagation();
        e.preventDefault();

        if (sidebar_2.length || serviceMenuScroll.length) {

            var target = this.hash;
            var $target = $(target);
            if ($target.offset()) {
                $(window).scrollTo($target.offset().top - 70, 1000).animate(1000);
            }

            return false;
        }
    });
    function onScroll() {
        if (sidebar_2.length) {
            var scrollPos = $(document).scrollTop();
            var deviationTop = document.getElementById("about-menuScroll").getBoundingClientRect().bottom;
            var active = [];
            var defaultElement;
            $('.about-menu__list a').each(function () {
                var currLink = $(this);
                var selection = $(this.hash);
                if (!defaultElement) {
                    defaultElement = currLink;
                }
                currLink.removeClass("about-menu__active");
                if (selection[0].getBoundingClientRect().top <= deviationTop) {
                    active.push(currLink);
                }
            });
            if (active.length === 0) {
                defaultElement.addClass('about-menu__active');
            } else {
                active[active.length - 1].addClass('about-menu__active');
            }
        }
    }

    // ------ about page mobile menu part -------
    var aboutMenuMobile = $('.about-menu__mobile');
    var aboutMenuList = $('.about-menu__list');
    var armeniaTabList = $('.armenia-tabs__list');
    aboutMenuMobile.click(function (event) {
        event.stopPropagation();
        event.preventDefault();
        aboutMenuList.slideToggle('fast');
        armeniaTabList.slideToggle('fast');
        $('.about-menu__mobile__icon').toggleClass('about-menu__mobile__rotateIcon');
        event.stopPropagation();
    });
    // ==============  about page ==============
    // ------------ armenia page tabs -----------

    $('.armenia-tabs__list li , .about-menu__item a , .service-menu__item ').click(function (e) {

        e.stopPropagation()
        var tab_id = $(this).attr('data-tab');
        window.location.hash = tab_id;
        $('.armenia-tabs__list li').removeClass('current');
        $('.armenia-tabs__content').removeClass('current');
        $(this).addClass('current');
        $("#" + tab_id).addClass('current');
        if ($(document).width() <= 1070) {
            aboutMenuList.slideUp('fast');
            armeniaTabList.slideUp('fast');
            $('.about-menu__mobile__icon').toggleClass('about-menu__mobile__rotateIcon');
        }
    });
    $('body').click(function () {
        if ($(document).width() < 1070) {


            aboutMenuList.slideUp('fast');
            armeniaTabList.slideUp('fast');
            if ($('.about-menu__mobile__icon').hasClass('about-menu__mobile__rotateIcon')) {
                $('.about-menu__mobile__icon').removeClass('about-menu__mobile__rotateIcon')
            }
        }
    })
    // armenia page tabs menu fixed
    $(function () {
        var hashes_array = ["tab-1", "tab-2", "tab-3", "tab-4", "tab-5", "tab-6"];
        $(window).on('hashchange', function (e) {
            var hash = window.location.hash.split('#')[1];
            if ($.inArray(hash, hashes_array) >= 0) {
                $('.armenia-tabs__list li').removeClass('current');
                $('.armenia-tabs__content').removeClass('current');
                $('[data-tab="' + hash + '"]').addClass('current');
                $("#" + hash).addClass('current');
                for (let i = 0; i < $('.header__mobile-languagePicker__link').length; ++i) {
                    let new_href = $('.header__mobile-languagePicker__link').eq(i).attr('href').split('/#')[0] + '/' + window.location.hash;
                    $('.header__mobile-languagePicker__link').eq(i).attr('href', new_href);
                }
                for (let i = 0; i < $('.header__languagePicker__link').length; ++i) {
                    let new_href = $('.header__languagePicker__link').eq(i).attr('href').split('/#')[0] + '/' + window.location.hash;
                    $('.header__languagePicker__link').eq(i).attr('href', new_href);
                }
            }
        });
        if (window.location.hash) {
            $(window).trigger('hashchange');
        }
        var sidebar1 = $('#armenia-menuScroll');
        if (sidebar1.length !== 0) {

            var top = sidebar1.offset().top - sidebar1[0].getBoundingClientRect().height;
            top = $(document).width() < 1070 ? top - 27 : top - 5;
            $(window).scroll(function (event) {
                onScroll();
                var y = $(this).scrollTop();
                if (y >= top) {
                    sidebar1.addClass('armenia-tabs__fixed');
                } else {
                    sidebar1.removeClass('armenia-tabs__fixed');
                }
            });
        }
    });
    $(function () {
        var sidebar1 = $('#armenia-menuScroll');
        if (sidebar1.length !== 0) {
            var top = sidebar1.offset().top - sidebar1[0].getBoundingClientRect().height;
            var y = $(this).scrollTop();
            if (y >= top) {
                sidebar1.addClass('armenia-tabs__fixed');
            } else {
                sidebar1.removeClass('armenia-tabs__fixed');
            }
            onScroll();
        }
    });
    // armenia page tabs menu scroll to top
    // armenia-banner news-banner
    var height = $('.armenia-banner').height() - 78
    $(function () {
        $('.armenia-tabs__list li').mouseup(function () {
            $('body,html').animate({
                scrollTop: height
            }, 1000);
            return false;
        });
    });

    $('.armenia-modal button.close').click(function () {
        $('#exampleModalCenter').find('.video_div').remove();
    });
    // ==============  services page ==============
    $('#start_date').datepicker({
        duration: 'fast',
        firstDay: 1,
        dateFormat: 'dd.mm.yy',
        constrainInput: true,
        yearRange: "0:+3",
        minDate: "+1d",
        showOtherMonths: true,
        selectOtherMonths: false,
        onSelect: function () {
            var end = $('#end_date');
            var startDate = $(this).datepicker('getDate');
            var minDate = $(this).datepicker('getDate');
            var endDate = end.datepicker('getDate');
            var dateDiff = (endDate - minDate) / (24 * 60 * 60 * 1000);

            startDate.setDate(startDate.getDate() + 30);
            if (endDate == null || dateDiff < 0) {
                end.datepicker('setDate', minDate);
            }
            else if (dateDiff > 30) {
                end.datepicker('setDate', startDate);
            }
            //sets dt2 maxDate to the last day of 30 days window
            end.datepicker('option', 'maxDate', startDate);
            end.datepicker('option', 'minDate', minDate);
        }
    });
    $('#end_date').datepicker({
        duration: 'fast',
        firstDay: 1,
        dateFormat: 'dd.mm.yy',
        constrainInput: true,
        yearRange: "0:+3",
        minDate: "+2d",
        showOtherMonths: true,
        selectOtherMonths: false
    });
    $('.service-modal__input').keydown(function () {
        return false;
    });
    $('.service-modal__plus').click(function () {
        let oldval = parseInt($(this).parent().find('input').val());
        $(this).parent().find('input').val(oldval + 1);
    });
    $('.service-modal__minus').click(function () {
        let oldval = parseInt($(this).parent().find('input').val());
        if ((oldval > 1 && $(this).parent().hasClass('adults-div'))
            || (oldval > 0 && $(this).parent().hasClass('children-div'))) {
            $(this).parent().find('input').val(oldval - 1);
        }
    });
    // about page menu fixed
    $(function () {
        var sidebar = $('#service-menuScroll');
        if (sidebar.length !== 0) {
            var top = sidebar.offset().top - sidebar[0].getBoundingClientRect().height;
            top = $(document).width() < 1070 ? top - 27 : top - 5;
            $(window).scroll(function (event) {
                onScrollService();
                var y = $(this).scrollTop();
                if (y >= top) {
                    sidebar.addClass('service-menu__fixed');
                    $('#service-packages').css({ "margin-top": sidebar[0].getBoundingClientRect().height })
                } else {
                    sidebar.removeClass('service-menu__fixed');
                    $('#service-packages').css({ "margin-top": 0 })
                }
            });
        }
    });

    $(function () {
        var sidebar = $('#service-menuScroll');
        if (sidebar.length !== 0) {
            var top = sidebar.offset().top - sidebar[0].getBoundingClientRect().height;
            var y = $(this).scrollTop();
            if (y >= top) {
                $('#service-packages').css({ "margin-top": sidebar[0].getBoundingClientRect().height });
                sidebar.addClass('service-menu__fixed');
            } else {
                sidebar.removeClass('service-menu__fixed');
                $('#service-packages').css({ "margin-top": 0 })
            }
            onScrollService();
        }
    });
    // smooth scroll
    var sidebar_1 = $('#service-menuScroll');
    $('a.service-menu__link').on('click', function (e) {
        e.stopPropagation()
        e.preventDefault();
        if (sidebar_1.length) {
            var target = this.hash;
            var $target = $(target);
            if ($target.offset()) {
                var deviationTop = document.getElementById("service-menuScroll").getBoundingClientRect().bottom;
                var additional_offset = 0;
                $(window).scrollTo($target.offset().top - 70, 1000).animate(1000);
            }
            return false;
        }
    });
    function onScrollService() {
        if (sidebar_1.length) {

            var scrollPos = $(document).scrollTop();
            var deviationTop = document.getElementById("service-menuScroll").getBoundingClientRect().bottom;
            var active = [];
            var defaultElement;
            $('.service-menu__list a').each(function () {
                var currLink = $(this);
                var selection = $(this.hash);
                if (!defaultElement) {
                    defaultElement = currLink;
                }
                currLink.removeClass("service-menu__active");
                if (selection[0]) {
                    if (selection[0].getBoundingClientRect().top <= deviationTop) {
                        active.push(currLink);
                    }
                }
            });
            if (active.length === 0) {
                defaultElement.addClass('service-menu__active');
            } else {
                active[active.length - 1].addClass('service-menu__active');
            }
        }
    }
    // ------ service page mobile menu part -------
    var serviceMenuMobile = $('.service-menu__mobile');
    var serviceMenuList = $('.service-menu__list');
    var serviceTabList = $('.service-tabs__list');
    serviceMenuMobile.click(function (event) {
        event.stopPropagation()
        event.preventDefault();
        serviceMenuList.slideToggle('fast');
        serviceTabList.slideToggle('fast');
        $('.service-menu__mobile__icon').toggleClass('service-menu__mobile__rotateIcon');
    });
    $('.service-menu__list .service-menu__item a').click(function () {
        var tab_id = $(this).attr('data-tab');
        if ($(document).width() <= 1070) {
            serviceMenuList.slideUp('fast');
            serviceTabList.slideUp('fast');
            $('.service-menu__mobile__icon').toggleClass('service-menu__mobile__rotateIcon');
        }
    });
    $('body').click(function () {
        if ($(document).width() < 1070) {
            serviceTabList.slideUp('fast');
            serviceMenuList.slideUp('fast');
            if ($('.service-menu__mobile__icon').hasClass('service-menu__mobile__rotateIcon')) {
                $('.service-menu__mobile__icon').removeClass('service-menu__mobile__rotateIcon')
            }
        }
    })
});

// language dropdown open and close
function dropdown_function() {
    document.getElementById("header__languagePicker-dropDown").classList.toggle("header__languagePicker__show");
}
function modalOpen(id, table_name, image, locale) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: 'modal',
        type: 'POST',
        data: { id: id, table_name: table_name, locale: locale },
        success: function (data) {
            if (data) {
                data = $.parseJSON(data);
                if (image) {
                    $('#exampleModalCenter').find('.modal-image').show();
                    $('#exampleModalCenter').find('.modal-image').attr('src', image);
                    $('#exampleModalCenter').find('.video_div').remove();
                }
                else if (table_name == 'video') {
                    $('#exampleModalCenter').find('.modal-image').hide();
                    $('#exampleModalCenter').find('.video_div').remove();
                    $('#exampleModalCenter').find('.modal-content').children('div').eq(0).append(`
                        <div class="video_div">`
                        + data.source_code +
                        `</div>
                    `);
                }
                if (table_name == 'video') {
                    $('#exampleModalCenter').find('.armenia-modal__title').html(data.title);
                    $('#exampleModalCenter').find('.armenia-modal__text').html("");
                }
                else {
                    if (table_name == 'news' || table_name == 'certificate') {
                        $('#exampleModalCenter').find('.armenia-modal__title').html(data.title);
                        $('#exampleModalCenter').find('.armenia-modal__text').html(data.text_content);
                    }
                    else if (table_name == 'photo') {
                        $('#exampleModalCenter').find('.armenia-modal__title').html(data.title);
                    }
                    else {
                        $('#exampleModalCenter').find('.armenia-modal__title').html(data.name);
                        $('#exampleModalCenter').find('.armenia-modal__text').html(data.description);
                    }
                }
                $('#exampleModalCenter').modal('show');
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
}
function send_hotel_request(request) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: 'hotel_mail',
        type: 'POST',
        data: request,
        success: function (data) {
            var data = $.parseJSON(data);
            if (data.errors) {
                data.errors.forEach(function (error) {
                    $('#request_form').find('.message').append(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">`
                        + error +
                        `<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    `);
                })
            }
            else {
                var theClass = data.code ? `success` : `danger`;
                $('#request_form').find('.message').append(`
                    <div class="alert alert-`+ theClass + ` alert-dismissible fade show" role="alert">`
                    + data.message +
                    `<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                `);
                $("#exampleModal").modal("hide")
                $(".modal-backdrop.fade.in").remove();
            }
        }
    });
}

function toggle_view_text(id) {
    $('[data-id=' + id + ']').children('div').toggle();
}

function toggleStaffMembers() {
    $('.about-team__toggleable').toggleClass('about-team__hidden');
}
// Close the dropdown menu if the user clicks outside of it
window.onclick = function (event) {
    if (!(event.target.matches('.header__languagePicker') || event.target.matches('.header__languagePicker__button'))) {
        var dropdowns = document.getElementsByClassName("header__languagePicker__content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('header__languagePicker__show')) {
                openDropdown.classList.remove('header__languagePicker__show');
            }
        }
    }
};
