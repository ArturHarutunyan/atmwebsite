var swipesContainers = document.querySelectorAll('.swipers_container');

var currentFixedSlider;


function getScrollbarWidth(element) {
    return element.offsetWidth - element.clientWidth;
}


[].forEach.call(swipesContainers, function (swiperContainer) {
    var galleryTopElem = swiperContainer.querySelector('.gallery-top');
    var galleryThumbsElem = swiperContainer.querySelector('.gallery-thumbs');

    galleryTopElem.cloneHtml = galleryTopElem.innerHTML;

    var galleryTop = new Swiper(galleryTopElem, {
        // spaceBetween: 10,
        // calculateHeight:true,
        navigation: {

            // .next_swipe , .prev_swipe
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        loop: true,
        loopedSlides: 100
    });
    var galleryThumbs = new Swiper(galleryThumbsElem, {
        // spaceBetween: 10,

        centeredSlides: true,
        slidesPerView: 'auto',
        touchRatio: 1,

        slideToClickedSlide: true,
        loop: true,
        loopedSlides: 100

    });



    galleryTop.controller.control = galleryThumbs;
    galleryThumbs.controller.control = galleryTop;






    // console.log(getScrollbarWidth(document.querySelector('body')))


    var x = window.matchMedia("(min-width: 1200px)");



    if (x.matches) { // If media query matches



        galleryTopElem.addEventListener('click', function (event) {
            var target = event.target;


            if (!target.closest('img')) return;

            var swipeContainer = document.createElement('div');
            swipeContainer.classList.add('swiper-container');
            swipeContainer.classList.add('gallery-top');
            swipeContainer.innerHTML = galleryTopElem.cloneHtml;

            var fixedContainer = document.createElement('div');
            fixedContainer.classList.add('fixedContainer');
            fixedContainer.appendChild(swipeContainer);
            document.body.appendChild(fixedContainer);
            console.log(galleryTop)
            var galleryTop2 = new Swiper(swipeContainer, {
                // spaceBetween: 10,
                initialSlide: galleryTop.activeIndex - galleryTop.loopedSlides,
                navigation: {

                    // .next_swipe , .prev_swipe
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                lazy: true,
                loop: true,
                touchRatio: 1,
                loopedSlides: 5,

            });

            currentFixedSlider = galleryTop2
            var images = fixedContainer.querySelectorAll('[data-src]')

            Array.from(images).forEach(image => preloadImage(image));
            // lazyLoad()
            // lazyLoad()

        })
    }

})



document.addEventListener('click', function (event) {

    var target = event.target;
    if (!target.classList.contains('fixedContainer')) return;
    target.closest('.fixedContainer').remove();
    currentFixedSlider.destroy(true, true)

})







// // check if is touch devise  


// function is_touch_device() {
//     if (matchMedia('(pointer:fine)').matches) {
//         return true
//       }
//     return false;
// }


// swipes.forEach(swipeElement => {


//     swipeElement.cloneInnerHtml = swipeElement.innerHTML;
//     var swipe = new Swiper(swipeElement, {
//         startSlide: 1,
//         // speed: 400,
//         // auto: 3000,
//         draggable: true,

//         continuous: true,
//         loop: true,
//         disableScroll: true, // prevent touch events from scrolling the page
//         stopPropagation: false,
//         callback: function (index, elem, dir) { },
//         transitionEnd: function (index, elem) { }

//     });

//     // console.log(swipeElement)
//     var next = swipeElement.querySelector('.next_swipe');
//     var prev = swipeElement.querySelector('.prev_swipe');
//     next.addEventListener(touchEvent, swipe.next)
//     prev.addEventListener(touchEvent, swipe.prev)



//     var galleryThumbs = new Swiper(document.querySelector('.gallery-thumbs'), {
//         spaceBetween: 15,
//         centeredSlides: true,
//         slidesPerView: 'auto',
//         touchRatio: 1,
//         slideToClickedSlide: true,
//         loop: true,
//         loopedSlides: 10
//     });
//     swipe.controller.control = galleryThumbs;
//     galleryThumbs.controller.control = swipe;





// })






//     if(is_touch_device()){

//         swipeElement.addEventListener(touchendEvent, function (event) {
//             var target = event.target;
//             if(!target.closest('img')) return;


//             var indexOfSlide =  swipe.getPos();
//             console.log(indexOfSlide);


//             var html = swipeElement.cloneInnerHtml;
//             var newSwiper = document.createElement('div');

//             newSwiper.classList.add('swipe');
//             newSwiper.innerHTML = html;


//             var fixedContainer = document.querySelector('.fixed_swipe_container');

//             fixedContainer.innerHTML = '';
//             fixedContainer.appendChild(newSwiper);




//             fixedContainer.style.display = 'flex';

//             var swipe2 = new Swipe(newSwiper, {
//                 startSlide: indexOfSlide,
//                 // speed: 400,
//                 // auto: 3000,
//                 draggable: true,
//                 continuous: true,
//                 autoRestart: true,
//                 disableScroll: true, // prevent touch events from scrolling the page
//                 stopPropagation: true,
//                 callback: function (index, elem, dir) { },
//                 transitionEnd: function (index, elem) { }

//             });

//             // swipe.slide(index, 0); 

//             var next = newSwiper.querySelector('.next_swipe');
//             var prev = newSwiper.querySelector('.prev_swipe');
//             next.addEventListener(touchEvent, swipe2.next)
//             prev.addEventListener(touchEvent, swipe2.prev)



//         })
//     }
// })


// document.querySelector('.fixed_swipe_container').addEventListener(touchEvent,function(event){
//     var target = event.target;
//     if(!target.closest('img')  && !target.closest('span')){

//         this.style.display = 'none';
//         this.innerHTML = '';
//     }


// })

        // slide to the previous slide.
        // mySwipe.prev()
        // // slide to the next slide.
        // mySwipe.next()
        // // return the current slide index position.
        // mySwipe.getPos()
        // // return the number of slides.
        // mySwipe.getNumSlides()
        // // slide to the position matching the index (integer) (duration: speed of transition in milliseconds).
        // mySwipe.slide(index, duration);
        // // restart the slider with autoplay.
        // mySwipe.restart()
        // // stop the slider and disable autoplay.
        // mySwipe.stop()
        // // reinitialize swipe.
        // mySwipe.setup(options)
        // // enable swipe.
        // mySwipe.enable()
        // // disable swipe
        // mySwipe.disable()
        // // completely remove the Swipe instance.
        // mySwipe.kill()

