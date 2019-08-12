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

            newSwiper.innerHTML+= `<div class="ring"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="lds-spin" width="80px" height="80px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid"><g transform="translate(80,50)">
            <g transform="rotate(0)">
            <circle cx="0" cy="0" r="5" fill="black" fill-opacity="1" transform="scale(1.14365 1.14365)">
              <animateTransform attributeName="transform" type="scale" begin="-0.9166666666666666s" values="1.2 1.2;1 1" keyTimes="0;1" dur="1s" repeatCount="indefinite"/>
              <animate attributeName="fill-opacity" keyTimes="0;1" dur="1s" repeatCount="indefinite" values="1;0" begin="-0.9166666666666666s"/>
            </circle>
            </g>
            </g><g transform="translate(75.98076211353316,65)">
            <g transform="rotate(29.999999999999996)">
            <circle cx="0" cy="0" r="5" fill="black" fill-opacity="0.9166666666666666" transform="scale(1.16031 1.16031)">
              <animateTransform attributeName="transform" type="scale" begin="-0.8333333333333334s" values="1.2 1.2;1 1" keyTimes="0;1" dur="1s" repeatCount="indefinite"/>
              <animate attributeName="fill-opacity" keyTimes="0;1" dur="1s" repeatCount="indefinite" values="1;0" begin="-0.8333333333333334s"/>
            </circle>
            </g>
            </g><g transform="translate(65,75.98076211353316)">
            <g transform="rotate(59.99999999999999)">
            <circle cx="0" cy="0" r="5" fill="black" fill-opacity="0.8333333333333334" transform="scale(1.17698 1.17698)">
              <animateTransform attributeName="transform" type="scale" begin="-0.75s" values="1.2 1.2;1 1" keyTimes="0;1" dur="1s" repeatCount="indefinite"/>
              <animate attributeName="fill-opacity" keyTimes="0;1" dur="1s" repeatCount="indefinite" values="1;0" begin="-0.75s"/>
            </circle>
            </g>
            </g><g transform="translate(50,80)">
            <g transform="rotate(90)">
            <circle cx="0" cy="0" r="5" fill="black" fill-opacity="0.75" transform="scale(1.19365 1.19365)">
              <animateTransform attributeName="transform" type="scale" begin="-0.6666666666666666s" values="1.2 1.2;1 1" keyTimes="0;1" dur="1s" repeatCount="indefinite"/>
              <animate attributeName="fill-opacity" keyTimes="0;1" dur="1s" repeatCount="indefinite" values="1;0" begin="-0.6666666666666666s"/>
            </circle>
            </g>
            </g><g transform="translate(35.00000000000001,75.98076211353316)">
            <g transform="rotate(119.99999999999999)">
            <circle cx="0" cy="0" r="5" fill="black" fill-opacity="0.6666666666666666" transform="scale(1.01031 1.01031)">
              <animateTransform attributeName="transform" type="scale" begin="-0.5833333333333334s" values="1.2 1.2;1 1" keyTimes="0;1" dur="1s" repeatCount="indefinite"/>
              <animate attributeName="fill-opacity" keyTimes="0;1" dur="1s" repeatCount="indefinite" values="1;0" begin="-0.5833333333333334s"/>
            </circle>
            </g>
            </g><g transform="translate(24.01923788646684,65)">
            <g transform="rotate(150.00000000000003)">
            <circle cx="0" cy="0" r="5" fill="black" fill-opacity="0.5833333333333334" transform="scale(1.02698 1.02698)">
              <animateTransform attributeName="transform" type="scale" begin="-0.5s" values="1.2 1.2;1 1" keyTimes="0;1" dur="1s" repeatCount="indefinite"/>
              <animate attributeName="fill-opacity" keyTimes="0;1" dur="1s" repeatCount="indefinite" values="1;0" begin="-0.5s"/>
            </circle>
            </g>
            </g><g transform="translate(20,50.00000000000001)">
            <g transform="rotate(180)">
            <circle cx="0" cy="0" r="5" fill="black" fill-opacity="0.5" transform="scale(1.04365 1.04365)">
              <animateTransform attributeName="transform" type="scale" begin="-0.4166666666666667s" values="1.2 1.2;1 1" keyTimes="0;1" dur="1s" repeatCount="indefinite"/>
              <animate attributeName="fill-opacity" keyTimes="0;1" dur="1s" repeatCount="indefinite" values="1;0" begin="-0.4166666666666667s"/>
            </circle>
            </g>
            </g><g transform="translate(24.019237886466836,35.00000000000001)">
            <g transform="rotate(209.99999999999997)">
            <circle cx="0" cy="0" r="5" fill="black" fill-opacity="0.4166666666666667" transform="scale(1.06031 1.06031)">
              <animateTransform attributeName="transform" type="scale" begin="-0.3333333333333333s" values="1.2 1.2;1 1" keyTimes="0;1" dur="1s" repeatCount="indefinite"/>
              <animate attributeName="fill-opacity" keyTimes="0;1" dur="1s" repeatCount="indefinite" values="1;0" begin="-0.3333333333333333s"/>
            </circle>
            </g>
            </g><g transform="translate(34.999999999999986,24.019237886466847)">
            <g transform="rotate(239.99999999999997)">
            <circle cx="0" cy="0" r="5" fill="black" fill-opacity="0.3333333333333333" transform="scale(1.07698 1.07698)">
              <animateTransform attributeName="transform" type="scale" begin="-0.25s" values="1.2 1.2;1 1" keyTimes="0;1" dur="1s" repeatCount="indefinite"/>
              <animate attributeName="fill-opacity" keyTimes="0;1" dur="1s" repeatCount="indefinite" values="1;0" begin="-0.25s"/>
            </circle>
            </g>
            </g><g transform="translate(49.99999999999999,20)">
            <g transform="rotate(270)">
            <circle cx="0" cy="0" r="5" fill="black" fill-opacity="0.25" transform="scale(1.09365 1.09365)">
              <animateTransform attributeName="transform" type="scale" begin="-0.16666666666666666s" values="1.2 1.2;1 1" keyTimes="0;1" dur="1s" repeatCount="indefinite"/>
              <animate attributeName="fill-opacity" keyTimes="0;1" dur="1s" repeatCount="indefinite" values="1;0" begin="-0.16666666666666666s"/>
            </circle>
            </g>
            </g><g transform="translate(65,24.019237886466843)">
            <g transform="rotate(300.00000000000006)">
            <circle cx="0" cy="0" r="5" fill="black" fill-opacity="0.16666666666666666" transform="scale(1.11031 1.11031)">
              <animateTransform attributeName="transform" type="scale" begin="-0.08333333333333333s" values="1.2 1.2;1 1" keyTimes="0;1" dur="1s" repeatCount="indefinite"/>
              <animate attributeName="fill-opacity" keyTimes="0;1" dur="1s" repeatCount="indefinite" values="1;0" begin="-0.08333333333333333s"/>
            </circle>
            </g>
            </g><g transform="translate(75.98076211353316,34.999999999999986)">
            <g transform="rotate(329.99999999999994)">
            <circle cx="0" cy="0" r="5" fill="black" fill-opacity="0.08333333333333333" transform="scale(1.12698 1.12698)">
              <animateTransform attributeName="transform" type="scale" begin="0s" values="1.2 1.2;1 1" keyTimes="0;1" dur="1s" repeatCount="indefinite"/>
              <animate attributeName="fill-opacity" keyTimes="0;1" dur="1s" repeatCount="indefinite" values="1;0" begin="0s"/>
            </circle>
            </g>
            </g></svg>
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

