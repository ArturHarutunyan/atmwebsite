
var orderForms = [];

var readyOrders;





// function getPastDays(dateArray) {
//     var date2 = dateArray[0];
//     var date1 = dateArray[1];
//     var timeDiff = Math.abs(date2.getTime() - date1.getTime());
//     return Math.ceil(timeDiff / (1000 * 3600 * 24));
// }



document.addEventListener('click', function (event) {
    var target = event.target;

    var parent = target.closest('.excursion_component');
    // console.log(parent.classList)
    if (target.closest('.showMore')) {
        parent.classList.add('showAll')
    } else if (target.closest('.showLess')) {
        parent.classList.remove('showAll')
    }
})

// document.addEventListener('change', function (event) {
//     var target = event.target;

// })

if (window.dispatchEvent) {
    var event;
    if (typeof (Event) === 'function') {
        event = new Event('resize');
    } else {
        event = document.createEvent('Event');
        event.initEvent('resize', true, true);
    }

    window.dispatchEvent(event);
}


// document.onscroll = function(){
//     this.focus()
// }
// Setup isScrolling variable
var isScrolling;

// Listen for scroll events

// var x = window.matchMedia("(min-height: "+window.innerHeight+"px)");
// x.addListener(function(){
//     alert(555)
// })
// document.body.addEventListener('scroll', function ( event ) {

//     if(window.outerWidth >991 || document.querySelector('.shop_list_container.show')) return
//     // Clear our timeout throughout the scroll
//     // alert(1)
//     document.querySelector('.shop_list_container').style.top = '100vh';
    
    
//     document.querySelector('.shop_list_container').style.transition = 'all 0s';
//     window.clearTimeout( isScrolling );
// 	// Set a timeout to run after scrolling ends
// 	isScrolling = setTimeout(function() {

// 		// Run the callback
// 		document.querySelector('.shop_list_container').style.top = '';

// 	},0);

// }, false);
// document.body.addEventListener('touchmove',function(){
//     if(window.outerWidth >991 || document.querySelector('.shop_list_container.show')) return
//     // Clear our timeout throughout the scroll
//     // alert(1)
//     document.querySelector('.shop_list_container').style.top = '100vh';
//     document.querySelector('.shop_list_container').style.transition = 'all 0s';
//     window.clearTimeout( isScrolling );
// 	// Set a timeout to run after scrolling ends
// 	isScrolling = setTimeout(function() {

// 		// Run the callback
//         document.querySelector('.shop_list_container').style.top = '';
//         document.querySelector('.shop_list_container').style.transition = '';

// 	},500);
// })
// for pickmeup bug fixing 



window.onresize = function () {
    var event;
    if (typeof (Event) === 'function') {
        event = new Event('click');
    } else {
        event = document.createEvent('Event');
        event.initEvent('click', true, true);
    }
    document.documentElement.dispatchEvent(event)
}


// get all forms 

var tourForms = document.querySelectorAll('.tourForm');
[].forEach.call(tourForms, function (oneTourForm) {

    var orderForm = {};

    var dataNames = oneTourForm.querySelectorAll('[data-name]');

    [].forEach.call(dataNames, function (dataName) {

        var name = dataName.getAttribute('data-name')
        orderForm[name] = undefined;

        if (name == 'tour_type') {
            orderForm[name] = 'Group';
        }
    })

    orderForm.tourName = oneTourForm.getAttribute('data-tourName');
    orderForm.price = +oneTourForm.getAttribute('data-tourPrice');
    orderForm.privatePrice = +oneTourForm.getAttribute('data-tourPrivatePrice');
    orderForm.added = false;
    orderForm.html = oneTourForm;


    oneTourForm.onchange = function (event) {

        // console.log(event.target,1)
        var key = event.target.closest('[data-name]').getAttribute('data-name');

        orderForm[key] = event.target.value;

        var invalidElement = orderForm.html.querySelector('[data-validator="' + key + '"]');
        if (invalidElement)
            invalidElement.style.border = '';
        // console.log(orderForm);

        var target = event.target;
        if (target.type == 'radio') {


            var descFormContainer = target.closest('.excursion_description_form');
            var contents = descFormContainer.querySelectorAll('.shortDescription_show_all');
            contents[0].classList.add('hide')
            contents[1].classList.add('hide')

           

            descFormContainer.querySelector('.shortDescription_show_all.'+target.value).classList.remove('hide')
            
            // console.log(target.value, target.closest('.tourForm'))


            console.log(oneTourForm.getAttribute('data-' + target.value))
            var prices = JSON.parse(oneTourForm.getAttribute('data-' + target.value));


            var descContainer = oneTourForm.previousElementSibling
            descContainer.querySelector('.eur h2').innerHTML =  " EUR"+ prices.eur  ;
            descContainer.querySelector('.usd').innerHTML =  "USD" + prices.usd  ;
            descContainer.querySelector('.amd').innerHTML =  "AMD" + prices.amd  ;
             
            console.log(prices)
        }
        // Private

        init();

    }

    oneTourForm.querySelector('.addButtonContainer ').onclick = function () {


        orderForm.added = true;
        init();

    }
    orderForms.push(orderForm);

})


function init() {
    
// console.log(orderForms)
    var total = 0;
    readyOrders = [];
    var shopListContainer = document.querySelector('.shop_items');
    shopListContainer.innerHTML = '';

    var countOrder = 0 

    orderForms.forEach(function (oneOrder) {
        if (!oneOrder.added) return;

        var orderKeys = Object.keys(oneOrder);

        var isOrderValid = true;
        var invalidKeys = []
        orderKeys.forEach(function (key) {
            var invalidElement = oneOrder.html.querySelector('[data-validator="' + key + '"]');
            
            if (invalidElement)
                invalidElement.classList.remove('invalid')
            if (!oneOrder[key]) {
                isOrderValid = false;
                invalidKeys.push(key)
            }
        })

        var date = oneOrder.html.querySelector('[data-validator="date"]').value
        
        orderForms.forEach(order=>{
            if (!order.added || order == oneOrder) return;

            otherDate = order.html.querySelector('[data-validator="date"]').value;
            if(otherDate == date && order.html.classList.contains('added')){

                isOrderValid = false;
                invalidKeys.push('date');
            }
        })

        if (!isOrderValid) {
            invalidKeys.forEach(function (key) {
                var invalidElement = oneOrder.html.querySelector('[data-validator="' + key + '"]');
                invalidElement.classList.add('invalid')
            })
            oneOrder.html.classList.remove('added')
            return;
        }
        oneOrder.html.classList.add('added')
        // add order to shop list ;

        var tourName = oneOrder.tourName;
        var type = oneOrder.tour_type;

        // console.log(type)

        // console.log(oneOrder.privatePrice, type)
        var price = oneOrder.price;

        if(type == 'Private')
            price = oneOrder.privatePrice
        var date = oneOrder.date;
        var persons = +oneOrder.persons;
        
        var date = new Date(new Date(date.split('.').reverse().join(' ')));



        // var countDays =  getPastDays([startDate,endDate]) + 1;

        var amount = price * persons;

        total += amount;
        var readyOrder = {
            tourName: tourName,
            type: type,
            price: price,
            persons: persons,
            date: date,
            amount: amount
        }

        // console.log(readyOrder)

        readyOrders.push(readyOrder);




        var shopListItem = '<div class="excursion_name">' + tourName + '</div><div class="excursion_price"> EUR  ' + price + '</div><div class="excursion_type">' + persons + '</div><div class="excursion_amount"> EUR  ' + amount + '</div><div class="remove_item">x</div> '

        var sItem = document.createElement('div')
        sItem.classList.add('one_item');
        sItem.innerHTML = shopListItem;



        shopListContainer.appendChild(sItem);

        sItem.querySelector('.remove_item').onclick = function () {
            oneOrder.added = false;
            oneOrder.html.classList.remove('added')
            init();
        }


    })


    document.querySelector('.tPrice').innerHTML =   ' EUR ' + total ;


    if (!total) {
        // document.querySelector('.shop_container').classList.add('hide');
        // document.querySelector('.pay_button').classList.add('hide');
        document.querySelector('.shop_list_container').classList.remove('canShowButton')
        document.querySelector('.shop_list_container').classList.remove('show');

        document.querySelector('.bigContentRow').classList.remove('show');

    } else {
        document.querySelector('.shop_container').classList.remove('hide')

        document.querySelector('.pay_button').classList.remove('hide')
        document.querySelector('.shop_list_container').classList.add('canShowButton');
        document.querySelector('.bigContentRow').classList.add('show');
    }
    var counters = document.querySelectorAll('.cartCount')
    counters[0].innerHTML = counters[1].innerHTML = readyOrders.length
}











document.querySelector('.contacts_form .inputs').addEventListener('input', function (event) {
    var target = event.target;
    target.style.borderColor = ''
})

document.querySelector('.pay_button').onclick = function (event) {
    var contactInputs = document.querySelectorAll('.contacts_form .inputs input');


    var contacts = {};
    var invalidInputs = [];
    [].forEach.call(contactInputs, function (input) {
        var key = input.getAttribute('data-name');
        if (key != 'Phone' && !input.value.trim()) {
            invalidInputs.push(input);
        }
        contacts[key] = input.value;
    })
    if (invalidInputs.length) {
        invalidInputs.forEach(function (input) {
            input.style.borderColor = 'red';
        })
        return false;
    }
    if (!readyOrders.length) return false;


    var requestObject = { readyOrders: readyOrders, contacts: contacts };
    console.log(requestObject);

}


var containerWidth = document.querySelector('.resizeContent').contentWindow.innerWidth;
resizeImages(containerWidth)

document.querySelector('.resizeContent').contentWindow.onresize = function(event){
    
    var containerWidth = event.target.innerWidth;
    resizeImages(containerWidth)
    // --swipeImageHeight



}


var ua = window.navigator.userAgent;
var isIE = /MSIE|Trident/.test(ua);


// window.onload = function(){
    
//     var images = document.querySelectorAll('img');
//     images.forEach(img=>{
//                 img.src = img.getAttribute('data-src');
        
//     })
// }

if (isIE) {
    //IE specific code goes here

    var style = document.createElement('style');
    style.innerHTML = '.col-xl-8{ max-width:64.66%} .swiper-button-next, .swiper-button-prev{height:28px}';
    document.querySelector('head').appendChild(style)

}



// on input focus secund time
var isFocused = false
document.addEventListener('focus',function(event){
    
    isFocused = true
},true)
document.addEventListener('blur',function(event){
    
    isFocused = false
},true)


var isMobileClick  = false;
document.addEventListener('touchstart',function(){
    isMobileClick =true
})
document.addEventListener('touchmove',function(){
    isMobileClick  = false
})
document.addEventListener('touchend',function(event){
    var target = event.target;
    if(isMobileClick && isFocused  && target.closest('input')){
        target.closest('input').blur()
    }
})

// document.addEventListener('click',function(event){

//     var target = event.target;

//     if( target.closest('input') && isFocused){

//             // document.querySelector('#hid').blur()
//             target.closest('input').blur()

//             if(target.closest('.datePickerContainer')){
//                 console.log(111)


//                 var click = new Event('click');
//                 Object.defineProperty(click, 'target', {
                    
//                     writable: false,
//                     value: document.querySelector('.wrapper')
//                 });
              
//                 // document.querySelector('.wrapper').dispatchEvent(click)
//             }
        

//     }
// })








