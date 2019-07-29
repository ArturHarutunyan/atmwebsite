var swipes = [...document.querySelectorAll('.swipe')];


// check if is touch devise  





function is_touch_device() {
    if (matchMedia('(pointer:fine)').matches) {
        return true
    }
    return false;
}
var swipe2

swipes.forEach((swipeElement, index) => {



    swipeElement.cloneInnerHtml = swipeElement.innerHTML;
    var swipe = new Swipe(swipeElement, {


        // Enable lazy loading
        lazy: {      
            loadPrevNext: true,
            loadPrevNextAmount: 1,//上一張下一張的加載數量,如果輸入為2,就是加載上2張下兩張
            elementClass: 'swiper-lazy',//img 要加上得css

            preloadImages:false,
            
          },
        // loop: true,
        
        // updateOnImagesReady: false,
        // lazyLoadingInPrevNextAmount: 0,



        startSlide: 1,

        // speed: 400,
        // auto: 3000,
        draggable: !is_touch_device() ? true : false,
        // continuous: true,
        // autoRestart: true,
        disableScroll: false, // prevent touch events from scrolling the page
        stopPropagation: false,
        callback: function (index, elem, dir) { 
            var elem = elem.querySelector('img')
           var dataSrc =  elem.getAttribute('data-src');

        //    console.log(elem)
           if(dataSrc){
               elem.removeAttribute('data-src');
               elem.setAttribute('src',dataSrc);
           }
        },
        transitionEnd: function (index, elem) { },
    });
    swipe.slide(2,1);

    

    // console.log(swipeElement)
    var next = swipeElement.querySelector('.next_swipe');
    var prev = swipeElement.querySelector('.prev_swipe');
    next.addEventListener(touchEvent, swipe.next)
    prev.addEventListener(touchEvent, swipe.prev)

    let drag = false;

    document.addEventListener('mousedown', () => drag = false);
    document.addEventListener('mousemove', () => drag = true);
    document.addEventListener('mouseup', () => {
        // console.log(drag ? 'drag' : 'click')
        drag = false;
    });

    if (is_touch_device()) {

        swipeElement.addEventListener(touchendEvent, function (event) {

            var target = event.target;
            if (!target.closest('img')) return;

            if (drag) return;


            swipeElement.dispatchEvent(new Event('mouseup'))


            var indexOfSlide = swipe.getPos();
            // console.log(indexOfSlide);


            var html = swipeElement.cloneInnerHtml;
            var newSwiper = document.createElement('div');

            newSwiper.classList.add('swipe');
            newSwiper.innerHTML = html;

            newSwiper.innerHTML+= `<div class="ring">
                                                    Loading
                                                  <span></span>      
                                                </div>`

            var fixedContainer = document.querySelector('.fixed_swipe_container');

            fixedContainer.innerHTML = '';
            fixedContainer.appendChild(newSwiper);




            fixedContainer.style.display = 'flex';

            swipe2 = new Swipe(newSwiper, {
                startSlide: 1,
                // speed: 400,
                // auto: 3000,

                lazy: true,
                lazyLoading: true,
                lazyLoadingInPrevNext: true,
                draggable: true,
                continuous: true,
                autoRestart: true,
                disableScroll: true, // prevent touch events from scrolling the page
                stopPropagation: true,
                callback: function (index, elem, dir) { 
                    var elem = elem.querySelector('img')
                   var dataSrc =  elem.getAttribute('data-src');
        
                //    console.log(elem)
                   if(dataSrc){
                       elem.removeAttribute('data-src');
                       elem.setAttribute('src',dataSrc);
                   }
                },
                transitionEnd: function (index, elem) { },

            });

            swipe2.slide(indexOfSlide,1); 

            var next = newSwiper.querySelector('.next_swipe');
            var prev = newSwiper.querySelector('.prev_swipe');
            next.addEventListener(touchEvent, swipe2.next);
            prev.addEventListener(touchEvent, swipe2.prev);




        })
    }
})


document.querySelector('.fixed_swipe_container').addEventListener(touchEvent, function (event) {
    var target = event.target;
    if (!target.closest('img') && !target.closest('span')) {

        swipe2.kill()
        this.style.display = 'none';
        this.innerHTML = '';

        setTimeout(function () {

            window.dispatchEvent(new Event('resize'))
        })
    }


})




document.addEventListener('DOMContentLoaded',function(){

    // var dataSrcElements = document.querySelectorAll('[data-src]');
})

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

