
function preloadImage(img) {
    if(!img.src)
        img.src = img.getAttribute('data-src');
}





// Get all of the images that are marked up to lazy load


function lazyLoad() {

    const images = document.querySelectorAll('img[data-src]:not([src])');
    const config = {
        // If the image gets within 50px in the Y axis, start the download.
        rootMargin: '0px',
        threshold: 1.0
    };

    // The observer for the images on the page
    if (!('IntersectionObserver' in window)) {
        Array.from(images).forEach(image => preloadImage(image));
    } else {
        let observer = new IntersectionObserver(onIntersection,{rootMargin: '50px 20px 75px 30px',
        threshold: [0, 0.25, 0.75, 1]});



        function onIntersection(entries) {
            // Loop through the entries
            entries.forEach(entry => {
                // Are we in viewport?
                if (entry.intersectionRatio > 0) {

                    // Stop watching and load the image
                    observer.unobserve(entry.target);
                    preloadImage(entry.target);
                }
            });
        }
        images.forEach(image => {
            observer.observe(image);
        });
    }

}
lazyLoad()


var mobSHow = Array.from(document.querySelectorAll('.mobileShowForm'));
mobSHow.forEach(function(button){
    button.onclick= function(event){
        var form = button.previousElementSibling;
        form.classList.toggle('show');
        button.classList.toggle('close');
        if(button.classList.contains('close')){
            button.querySelector('span').innerHTML = 'x'
        }else{
            button.querySelector('span').innerHTML = 'pick tour options'
        }
    }
})

document.querySelector('.shopListMobileShow').onclick = function(event){
    event.stopImmediatePropagation()
    document.querySelector('.shop_list_container').classList.toggle('show');
    if(document.querySelector('.shop_list_container').classList.contains('show')){

        document.querySelector("body > div.wrapper.container-fluid > div.row.limitWidth > div.col-lg-4.shop_list_container.show > div.position-sticky").scrollTo(0,0)
    }else{
        document.documentElement.click()
    }
}