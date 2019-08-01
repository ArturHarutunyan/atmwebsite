

var documentClick = false;


// here shud be inif function for orders lists 

if ('ontouchstart' in window) {

    document.addEventListener('touchstart', function () {



        documentClick = true;
    });
    document.addEventListener('touchmove', function () {
        documentClick = false;
        
    });



    // document.addEventListener('mousedown', function (event) {

    //     // alert(event)
    //     // documentClick = false;
    //     // if(event.target.closest('address')&&event.target.closest('a')){

            
            
    //     // }
        
    // });

   
} else {
    documentClick = true
}


// var myObj = document.querySelector('a');
// for(var key in myObj){
//     if(key.search('on') === 0) {
//        myObj.addEventListener(key.slice(2), function(event){
//            event.preventDefault()
//         event.stopImmediatePropagation()
//         alert(event.type)
//     })
//     }
// }

var now = new Date

var startDate = new Date("2019-10-14");
var eventStartDate = new Date("2019-10-17")

var endDate = new Date("2019-10-27");
var eventEndDate = new Date('2019-10-21')

hotelDateP.forEach(elem => {

    var calendarType = 'range'
    if (elem.classList.contains('oneDay')) {
        calendarType = 'single'
    }

    pickmeup(elem, {
        position: 'right',
        hide_on_select: true,
        mode: calendarType,
        date: calendarType == 'range' ? [startDate.setDate(13), startDate] : startDate,
        calendars: 1,
        format: 'd.m.y',
        render: function (date) {


            if (startDate.setDate(13) > date || date > endDate) {

                var classes = 'enabled_date';
                return { disabled: true, class_name: classes };
            }
            var classes = ''
            if (eventStartDate <= date && date < eventEndDate) {
                classes += 'event_date'

                return { class_name: classes };
            }
            return {};
        }
    });
    startDate.setDate(14)

    // set default selected to hidden input
    // var date = calendarType=='range'?[startDate,endDate]:startDate;
    // elem.previousElementSibling.value = JSON.stringify(date);
    // var event = new Event('input', {
    //     'bubbles': true,
    //     'cancelable': true
    // });

    // elem.previousElementSibling.dispatchEvent(event);
    // elem.previousElementSibling.dispatchEvent(new Event('change'));
    elem.value = ''

    // ___________________________________________________

    elem.addEventListener('pickmeup-change', function (e) {

        // console.log(e.detail.formatted_date); // New date according to current format
        // console.log(e.detail.date);           // New date as Date object

        var dates  = e.detail.date;
        if(dates instanceof Array){
            var d1 = new Date(dates[0]);
            d1.setDate(d1.getDate()+1)
            var d2 =  new Date(dates[1]);
            d2.setDate(d2.getDate()+1);
            dates = [d1,d2]
            dates = JSON.stringify(dates)
        }else{
            var d1 = new Date(dates)

            d1.setDate(d1.getDate()+1)
            
            dates = d1
            dates = JSON.stringify(dates)
        }

        console.log(dates)
        elem.previousElementSibling.value = dates
        var event = new Event('input', {
            'bubbles': true,
            'cancelable': true
        });

        elem.previousElementSibling.dispatchEvent(event);
        elem.previousElementSibling.dispatchEvent(new Event('change'));

        // console.log(JSON.parse(elem.previousElementSibling.value));
    })
    elem.addEventListener('pickmeup-hide', function (e) {

        if (elem.previousElementSibling.value) {
            elem.style.border = '';
        }
        elem.blur();

    })
    elem.addEventListener('pickmeup-show', function (e) {
        // elem.blur();
        elem.setAttribute('readonly', 'readonly')


    })




})
document.addEventListener('click', function (event) {
    var target = event.target;
    if (target.closest('.datePic_container')) {

        target.closest('.datePic_container').querySelectorAll('input')[1].focus();
        target.closest('.datePic_container').querySelectorAll('input')[1].click();

    } else if (target.closest('.datePicerInputContainer')) {

        target.closest('.datePicerInputContainer').querySelectorAll('input')[1].focus();
        target.closest('.datePicerInputContainer').querySelectorAll('input')[1].click();
    }
})

var documentWidth = document.documentElement.clientWidth + window.innerWidth - document.documentElement.clientWidth;


document.addEventListener("DOMContentLoaded", function () {
    let showHide = document.querySelectorAll('.show_hide_container');

    showHide[1].classList.add('closed');
    showHide[2].classList.add('closed');

    showHide[1].querySelector('*').style.marginTop = - showHide[1].querySelector('*').offsetHeight + 'px';
    showHide[2].querySelector('*').style.marginTop = - showHide[2].querySelector('*').offsetHeight + 'px';



    setTurItemsTop();

    setTimeout(function () {

        var event = new Event('click');


        Object.defineProperty(event, 'target', { writable: false, value: document.querySelector('.sections_icon_container p') });
        document.dispatchEvent(event)
        // alert(1)

    }, 0)


    // First we get the viewport height and we multiple it by 1% to get a value for a vh unit
    let vh = window.innerHeight * 0.01;
    // Then we set the value in the --vh custom property to the root of the document
    document.documentElement.style.setProperty('--vh', `${vh}px`);
    // document.querySelector('.main_Content').style.minHeight = showHide[0].querySelector('*').offsetHeight +200 + 'px';

});



// showHide[2].querySelector('*').style.marginTop = - showHide[2].offsetHeight + 'px';


window.addEventListener('resize', function (event) {

    if (event.isTrusted) {

        setTimeout(function () {
            [...document.querySelectorAll('.closed')].forEach(elem => {

                elem.querySelector('*').style.marginTop = - elem.querySelector('*').offsetHeight - 10000 + 'px';
            }, 10)
        })


        setTurItemsTop();
    }
    shopListMinusTopPosition()
    // First we get the viewport height and we multiple it by 1% to get a value for a vh unit
    let vh = window.innerHeight * 0.01;
    // Then we set the value in the --vh custom property to the root of the document
    document.documentElement.style.setProperty('--vh', `${vh}px`);

    // if(document.querySelector('.shopList_block_container ').classList.contains('showShop')){
    //     document.querySelector('.mobile_shopList_fi').click()
    // }


    var containerWidth =    document.querySelector('.mainTb').offsetWidth;
    document.querySelector('.tabs_container').style.width = containerWidth+ 'px';
})

// wrapper 

var isFirstClick = true;
document.addEventListener('click', function (event) {
    var target = event.target.closest('.sections_icon_container');


    if (!event.target.closest('p') || !target) return;

    var wrapperScrollTop = Math.abs(document.querySelector('.mainTb').getBoundingClientRect().top - document.querySelector('.wrapper').getBoundingClientRect().top);

    setTurItemsTop();

    var navButtons = [...document.querySelectorAll('.sections_icon_container')]

    navButtons.forEach(function (button) {
        button.classList.remove('selected')
    })
    target.classList.add('selected')



    // console.log('====================================');
    // console.log(11);
    // console.log('====================================');



    var containerClass = target.getAttribute('data-container');
    var container = document.querySelector('.' + containerClass);


    var showContainer = container.closest('.show_hide_container');


    var allShowHideContainers = [...document.querySelectorAll('.show_hide_container')];
    allShowHideContainers.forEach(function (container) {
        container.classList.remove('open');
        container.classList.add('closed');

        container.querySelector('*').style.marginTop = - container.querySelector('*').offsetHeight + 'px'
    })

    // document.querySelector('.main_Content').style.minHeight = showContainer.querySelector('*').offsetHeight +200 + 'px';

    if (container.closest('.show_hide_container').classList.contains('closed')) {

        showContainer.classList.remove('closed');
        showContainer.classList.add('open')

        showContainer.querySelector('*').style.marginTop = '0';

    } else {
        showContainer.classList.add('closed');
        showContainer.classList.remove('open');
        svg.style.transform = 'rotate(0deg)';

        showContainer.querySelector('*').style.marginTop = - showContainer.querySelector('*').offsetHeight + 'px';



    }

    if(!isFirstClick)
       document.querySelector('.main_wrap').scrollTo(0,wrapperScrollTop);
    else isFirstClick = false;
})


// mobile show hide hotel items 
document.addEventListener(touchendEvent, function (event) {

    if (!documentClick) return;
    var target = event.target
    if (!target.closest('.show_all_content_button_container') && !target.closest('.hide_all_content_button_container')) return;

    var allParent = target.closest('.one_hotel_item_container');

    var mobile_shower_item = allParent.querySelector('.mobile_shower_item_container');
    var big_shower_item = allParent.querySelector('.hotels_block');


    if (target.closest('.show_all_content_button_container')) {
        mobile_shower_item.style.marginTop = -mobile_shower_item.offsetHeight + 'px';
        big_shower_item.style.marginTop = '0';
    } else {
        mobile_shower_item.style.marginTop = '0';
        big_shower_item.style.marginTop = -big_shower_item.offsetHeight + 'px';
    }

    // mobile_shower_item_container
    // hotels_block  

})
// mobile show hide hotel items  end




// mobile show hide shopList 



// set shopList top 
shopListMinusTopPosition()

document.onclick = function (event) {

    var shopList = document.querySelector('.shopList_block_container');

    if (!userOrders.length) {
        shopList.classList.remove('showShop')

    }
    var target = event.target;
    if (!target.closest('.mobile_shopList_fi')) return;
    var top = shopList.style.bottom;
    var rotateIcon = document.querySelector('.mobile_shopList_fi span:nth-child(2)')

    // console.log(rotateIcon)


    shopList.classList.toggle('showShop')
    if (!shopList.classList.contains('showShop')) {

        shopList.style.top = '-1000px';

        rotateIcon.style.transform = 'rotate(180deg)';

        target.closest('.mobile_shopList_fi').style.top = ''


    } else {
        shopListMinusTopPosition()

        rotateIcon.style.transform = 'rotate(0deg)';
        shopList.style.top = '1000px';

        target.closest('.mobile_shopList_fi').style.top = '0';
        shopList.scrollTo(0,0)


    }
}
// mobile show hide shopList  end




let fixedBar = document.querySelector('.shopList_block');
let fixedBarParent = document.querySelector('.Accommodation_SH');


var scrollPositionInIframe



var tabsContainer = document.querySelector('.tabs_container');



var tabsContainerRelativeTop = parseInt(tabsContainer.getBoundingClientRect().top);





document.querySelector('.main_wrap').addEventListener('scroll', function (event) {
    documentWidth = document.documentElement.clientWidth + window.innerWidth - document.documentElement.clientWidth;



    var plusTop = iframeTop;

    if (documentWidth <= 1141) {
        plusTop -= 55
    } else {
        plusTop -= 71
    }

   

    if (documentWidth >= 1200) {
        let top = fixedBarParent.getBoundingClientRect().top;


        if (top < 0 || event.otherScroll && top - event.otherScroll < 0) {
            fixedBar.style.marginTop = Math.abs(top - (event.otherScroll ? event.otherScroll : 0)) + 'px';
        } else {
            fixedBar.style.marginTop = 0 + 'px';

        }
        if (event.otherScroll > tabsContainerRelativeTop + plusTop) {



            // (event.otherScroll + event.otherHeight) 
    
    
    
            tabsContainer.style.top = Math.abs((event.otherScroll) - (tabsContainerRelativeTop + plusTop)) + 'px';
    
        } else {
            tabsContainer.style.top = 0;
        }



    } else {
        fixedBar.style.marginTop = '0'
    }




    if (documentWidth < 660) {

        // console.log(event)
        if (event.otherHeight) {
            var shopContainer = document.querySelector('.shopList_block_container');
            var shopListHeight = shopContainer.offsetHeight;



            var isShopListShow = document.querySelector('.shopList_block_container').classList.contains('showAll')


            shopContainer.style.maxHeight = (event.otherHeight) + 'px';
            if (!isShopListShow) {

                if (!(((event.otherScroll + event.otherHeight) - iframeTop) > event.iframeHeight))
                    shopContainer.style.marginTop = event.otherScroll + shopListHeight / 6 + 'px';
            } else {
                shopContainer.style.top = (event.otherScroll + event.otherHeight + shopListHeight) - iframeTop + 'px';
            }

            if (!(((event.otherScroll + event.otherHeight) - iframeTop) > event.iframeHeight)) {
                document.querySelector('.mobile_shopList_fi').style.bottom = '';
                document.querySelector('.mobile_shopList_fi').style.position = 'absolute'
                document.querySelector('.mobile_shopList_fi').style.top = ((event.otherScroll + event.otherHeight) - iframeTop) - 84 + 'px';
            } else {
                document.querySelector('.mobile_shopList_fi').style.position = 'fixed';
                document.querySelector('.mobile_shopList_fi').style.top = 'initial';
                document.querySelector('.mobile_shopList_fi').style.bottom = -1015 + 'px';

            }









        }
        // event.otherHeight

        // event.otherScroll
        // shopList_block_container

        // mobile_shopList_fi
    }

    var tabContainer = document.querySelector('.mainTb');
    var tabs = document.querySelector('.tabs_container')

    // alert(tabContainer.getBoundingClientRect().top | 0)
    if((tabContainer.getBoundingClientRect().top | 0)<=0){

        // alert(tabContainer.innerHTML)
        if(tabContainer.innerHTML.trim()){
            
            // alert(1)
            document.body.appendChild(tabs)
            tabs.style.position = 'fixed'
            // alert(document.documentElement.offsetWidth+'|'+window.screen.width )
            if(document.documentElement.offsetWidth < 1261){

                tabs.style.top = '-15px'
                console.log(111)
            }
            
            tabs.style.left = tabContainer.getBoundingClientRect().left + 'px';

            // console.log(tabs.offsetWidth)
            tabs.style.width = tabContainer.offsetWidth + 'px'


            
        }

    }else{
        // alert(document.documentElement.offsetWidth+'|'+window.screen.width )

        if(document.querySelector('body > .tabs_container')){
            tabContainer.appendChild(tabs);
            tabs.style.position = 'initial'
            tabs.style.top = '';
            tabs.style.left = '';
            tabs.style.width = '' ;

        }
    }
});







document.addEventListener('change', function (event) {
    if (event.target.closest('.checkbox_show_hide_content'))
        setTurItemsTop()
})

setTurItemsTop();




// buck hotel

document.addEventListener(touchendEvent, function (event) {
    if (!documentClick) return;
    var target = event.target;
    if (!target.closest('.add_booking')) return;
    var form_parent = target.closest('.Booking_details_form');
    if (!form_parent) return;
})

var selects = [...document.querySelectorAll('select')];

selects.forEach(function (elem) {

    elem.addEventListener('change', function (event) {

        var target = event.target;
        var parent = target.closest('.select_container');
        var hidden_input = parent.querySelector('.hidden_input');
        hidden_input.value = target.value;
        hidden_input.dispatchEvent(new Event('input'));

        var event = new Event('input', {
            'bubbles': true,
            'cancelable': true
        });
        hidden_input.dispatchEvent(event);

    })
})



// *********************************************************************change cars slider
// **********************************************************************

window.dispatchEvent(new Event('resize'))

document.querySelector('.radios').addEventListener('change', function (event) {
    var target = event.target;

    // alert(1)
    if (!target.closest('[name="radio-group"]')) return;



    var formParent = document.querySelector('.selectCarForem')
    var value = target.value;
    var sliders = formParent.querySelectorAll('.swipe_container');
    sliders.forEach(function (slider) {
        slider.style.cssText = '';
        slider.style.opacity = '0';
        slider.style.position = 'absolute';
        slider.style.zIndex = '-9999';
    })
    formParent.querySelector('.car_' + value).style.cssText = '';



    setTimeout(function () {

        initOrders();
    })


})

// **********************************************************************



// **************************************************************************** booking form actions 

// geting  Booking forms 
// ***********************************************************************
var BookingFormObjects = getFormObject('.Booking_details_form', 'hotel_form');
// ***********************************************************************


// *******************************************  tur form change inputs handling
// ************************************************************************************************
inputEventListener('.Booking_details_form', function (event) {

    var target = event.target;
    var value = target.value;
    var inputSelector = target.getAttribute('data-name');



    var formKey = (event.target.closest('[data-hotel_form]').getAttribute('data-hotel_form'));
    var form = BookingFormObjects[formKey];



    if (isNaN(parseFloat(value))) {
        form[inputSelector].isValid = true;
    } else {
        form[inputSelector].isValid = +value > 0 ? true : false;
    }



    var inputParent = target.closest('div');

    var viewElement = inputParent.querySelector('.selector-element') ? inputParent.querySelector('.selector-element') : inputParent.querySelector('.check_in_out_hotel');

    if (!form[inputSelector].isValid) {

        viewElement.style.border = '2px solid red';

    } else {
        viewElement.style.border = '';
    }


    if (form.adds && !checkFormValidation(form)) {
        form.adds = false;

        removeOrderFromArray(form)
    } else if (checkFormValidation(form)) {
        if (form.adds)
            initOrders();
        countingHotelBookingPrice(form.parent);
    }


})
// ************************************************************************************************

// ************************ tur form button click event handling
// *********************************************************************
clickEventListener('.Booking_details_form .add_booking', function (event) {
    var target = event.target;
    var parent = target.closest('[data-hotel_form]');
    var formKey = parent.getAttribute('data-hotel_form');
    var form = BookingFormObjects[formKey];
    var isFormValid = checkFormValidation(form);


    // console.log(form['date'])

    if (isFormValid) {
        form.adds = !form.adds;

        if(form.date.element.value){

            var dates =  JSON.parse(form.date.element.value)
            if(dates[0] ==  dates[1]){ 

                form.adds = false;
                form.date.element.nextElementSibling.style.border= "2px solid red";
            
            };
        }
        if (form.adds) {

            addOrderToArray(form)

            this.innerHTML = 'ADDED'
        }
        else {
            removeOrderFromArray(form)
            this.innerHTML = 'ADD'
        }


    } else {
        removeOrderFromArray(form)
        this.innerHTML = 'ADD'
        var selects = form.parent.querySelectorAll('.selector-element');
        var datepicker = form.parent.querySelector('.datepicker_input');


        if (!form['date'].isValid) datepicker.style.border = '2px solid red';
        if (!form['Room'].isValid) selects[0].style.border = '2px solid red';
        if (!form['Qty'].isValid) selects[1].style.border = '2px solid red';
    }
})
// *********************************************************************

// **************************************************************************** booking form actions  END @@@@@@@@@@@@@@@@



// **************************************************************************** tur form actions 

// geting turs form 
// *****************************************
var TourFormsObject = getFormObject('.tur_description', 'tour_form');
// *************************************************


// *******************************************  tur form change inputs handling
// ************************************************************************************************
inputEventListener('.tur_description', function (event) {
    var target = event.target;
    var value = target.value;
    var inputSelector = target.getAttribute('data-name');
    var formKey = (event.target.closest('[data-tour_form]').getAttribute('data-tour_form'));
    var form = TourFormsObject[formKey];

    if (isNaN(parseFloat(value))) {
        form[inputSelector].isValid = true;
    } else {
        form[inputSelector].isValid = +value > 0 ? true : false;
    }



    var inputParent = target.closest('div');

    var viewElement = inputParent.querySelector('.selector-element') ? inputParent.querySelector('.selector-element') : inputParent.querySelector('.check_in_out_hotel');

    if (!form[inputSelector].isValid) {

        viewElement.style.border = '2px solid red';

    } else {
        viewElement.style.border = '';
    }


    if (form.adds && !checkFormValidation(form)) {
        form.adds = false;

        removeOrderFromArray(form)
    } else if (checkFormValidation(form)) {
        if (form.adds)
            initOrders();
        // countingHotelBookingPrice(form.parent);
    }

})
// ************************************************************************************************


// ************************ tur form button click event handling
// *********************************************************************
clickEventListener('.tur_description .add_tour_btn', function (event) {
    var target = event.target;
    var parent = target.closest('[data-tour_form]');
    var formKey = parent.getAttribute('data-tour_form');
    var form = TourFormsObject[formKey];
    var isFormValid = checkFormValidation(form);


    if (isFormValid) {
        form.adds = !form.adds;

        if (form.adds) {

            addOrderToArray(form)
            this.innerHTML = 'ADDED TOUR'
        }
        else {
            removeOrderFromArray(form)
            this.innerHTML = 'ADD TOUR'
        }


    } else {
        removeOrderFromArray(form)
        this.innerHTML = 'ADD TOUR'
        var selects = form.parent.querySelectorAll('.selector-element');
        var datepicker = form.parent.querySelector('.datepicker_input');

        if (!form['date'].isValid) datepicker.style.border = '2px solid red';
        if (!form['Qty'].isValid) selects[0].style.border = '2px solid red';
    }
})
// *********************************************************************

// **************************************************************************** tur form actions  END @@@@@@@@@@@@@@@@







// **************************************************************************** transportTrip form actions  


// geting transportaition form 
// *****************************************


var transportFormObject = getTransportationFormObject();



//****************************************************************************  transportation button form add

clickEventListener('.selectCarForem .add_transport_btn', function (event) {


    // console.log(transportFormObject);

    console.log(1544)
    if (!transportFormObject.added && checkTransportFormValidation(transportFormObject)) {

        transportFormObject.added = true
        addOrderToArray(transportFormObject);
        this.innerHTML = 'ADDED'

    } else {
        transportFormObject.added = false
        removeOrderFromArray(transportFormObject);
        this.innerHTML = 'ADD'

    }
})
//****************************************************************************


// **************************************************************************** transportTrip form actions  END @@@@@@@@@@@@@@@@




// *****************************************************************************  all rent car  functionality
// **********************************************************************************************************************************************************


// get rent car object 

var rentCarObject = {
    checked: false,
    date: '',
    added: false,
    days: '',
    totalPrice: '',
    parent: document.querySelector('.rent_form')
}



// *********************************************************************************** dinamic change date

document.querySelector('.rent_form .hidden_input').addEventListener('change', function (event) {
    var target = event.target;
    rentCarObject.date = target.value;
    var priceContainer = document.querySelector('.car_rante_price');
    var dates = JSON.parse(rentCarObject.date);
    var newDates = [new Date(dates[0]), new Date(dates[1])];

    var pastDays = getPastDays(newDates) + 1;
    priceContainer.innerHTML = valuta + (pastDays * carRentPrice);
    rentCarObject.days = pastDays;
    rentCarObject.totalPrice = valuta + (pastDays * carRentPrice);

    if (userOrders.indexOf(rentCarObject) != '-1')
        initOrders()


})




// ******************************************************************************** check watcher 
document.querySelector('#Car_rent').addEventListener('change', function (event) {
    rentCarObject.checked = event.target.checked;

    checkAddRent();
})

// *******************************************************************************  add rent transport  button click handling

document.querySelector('.add_car_rante button').onclick = function (event) {



    var target = event.target;
    // get button and input parent
    var allParent = target.closest('.form-group');

    // get date picker inputs 
    var datePickerContainer = allParent.querySelector('.datePicerInputContainer');
    var datepickerInput = datePickerContainer.querySelector('.datepicker_input');
    var hiddenInput = datePickerContainer.querySelector('.hidden_input');

    if (!hiddenInput.value.trim()) {
        datepickerInput.style.border = '2px solid red';
        rentCarObject.added = false;
        allParent.classList.remove('added');
        checkAddRent()

    } else {
        rentCarObject.added = !rentCarObject.added;

        allParent.classList.toggle('added');
        checkAddRent()
    }
}


// function to chack if car can be ranted 

function checkAddRent() {
    var button = document.querySelector('.add_transport_rante_btn')
    if (rentCarObject.checked && rentCarObject.added) {

        addOrderToArray(rentCarObject);
        button.innerHTML = "ADDED"


    } else {
        removeOrderFromArray(rentCarObject);
        button.innerHTML = "ADD"
    }

}









// getFormObject

function getDateFromString(stringDate) {
    var date = JSON.parse(stringDate);

    if (typeof date == 'object') {
        date = date.map(function (elem) {
            return escapeHtml(elem)
        })
        // date = date.split(',')
        // console.log(date);
    } else {
        date = escapeHtml(date)
    }
    return date
}


//********************************************************************************  send orders to database
document.querySelector('.shopList_block .button_container button').onclick =  function (event) {
    var contactContainer = [...document.querySelectorAll('.contact_form_inputs input')]

    var contacts = {}

    if (!userOrders.length) {

        alert('order list is empty');
        return;

    };



    var areInputsValid = true
    for (var i = 0; i < contactContainer.length; ++i) {
        var input = contactContainer[i];
        var value = escapeHtml(input.value.trim());

        var key = input.getAttribute('placeholder');

        if (key != 'Comments' && !value) {
            input.style.border = '1px solid red';


            areInputsValid = false;
        } else {
            contacts[key] = value;
        }
    }

    if (!areInputsValid) {
        return;
    }

    // console.log(contacts);



    var hotelOrders = [];
    var carOrders = [];
    var ExcursionOrders = [];
    userOrders.forEach(function (orderObj) {

        var objectParent = orderObj.parent;

        if (objectParent.classList.contains('Booking_details_form')) {

            // escapeHtml(
            var date = getDateFromString(orderObj.date.element.value);


            var startDate = date[0];
            var endDate = date[1];




            var nights = (getPastDays([new Date(startDate), new Date(endDate)]) )





            var room = orderObj.Room.element.value;
            room = room - 1;
            var qty = escapeHtml(orderObj.Qty.element.value);

            var hotelName = escapeHtml(objectParent.getAttribute('data-hotel_name'));

            // var hotelIndex = rooms.indexOf(hotelName.toLowercase());


            var index = roomsIndex.indexOf(hotelName.toLowerCase())

            var hotelOrder = { startDate, endDate, room, qty, hotelName, nights, index }

            hotelOrders.push(hotelOrder)

        } else if (objectParent.classList.contains('transport_section')) {

            var keys = Object.keys(orderObj);
            var carType = orderObj.carType;
            var index = 0
            keys.forEach(function (key) {

                if (key == 'added' || key == 'carType' || key == 'parent') return;
                if (!orderObj[key].checked) return;

                var oneCarOrder = {}

                var ownForm = orderObj[key].ownForm;
                var date = getDateFromString(ownForm.date.value);

                var localPrice
                var staticPrice = carPrices[carType - 1];
                var eType = orderObj[key].parent.getAttribute('data-form_name')

                if (eType != 'Car-Rent') {
                    var flight = escapeHtml(ownForm.flight.value);
                    localPrice = +staticPrice;
                    oneCarOrder.flight = flight;
                    oneCarOrder.price = valuta + localPrice;
                    oneCarOrder.date = date;
                    oneCarOrder.event = eType;
                    oneCarOrder.carType = carType;
                    oneCarOrder.index = eType == 'hotel-airport' ? 1 : 0;

                } else {
                    staticPrice = 125;

                    var startDate = date[0];
                    var endDate = date[1];
                    localPrice = (getPastDays([new Date(startDate), new Date(endDate)]) + 1) * (+staticPrice);


                    oneCarOrder.price = valuta + localPrice;
                    oneCarOrder.date = date;
                    oneCarOrder.event = eType;
                    oneCarOrder.index = 2;

                }


                carOrders.push(oneCarOrder)

            })
        } else if (objectParent.classList.contains('tur_description')) {
            var turName = escapeHtml(objectParent.getAttribute('data-tour_name'));
            var turPrice = escapeHtml(objectParent.getAttribute('data-tour_price'));

            var index = +objectParent.getAttribute('data-index')
            var Qty = +orderObj.Qty.element.value;
            var date = orderObj.date.element.value;


            var oneTurOrder = {
                turName,
                turPrice,
                Qty,
                date,
                index
            }

            ExcursionOrders.push(oneTurOrder)
        } else if (objectParent.classList.contains('rent_form')) {

            // console.log(orderObj);


            //  es kara error beri bayc ej@ refresh a linum normal a 
            delete orderObj.checked;
            delete orderObj.added;
            delete orderObj.parent;

            orderObj.event = 'rent car in Yerevan';
            orderObj.price = orderObj.totalPrice;


            carOrders.push(orderObj)
        }




    })



    // ********************************************************************************************  REQ TO SERVER   n
    var allOrders = { hotelOrders, carOrders, ExcursionOrders };

    console.log(allOrders)
    var finalForm = JSON.stringify({ allOrders, contacts });
    var http = new XMLHttpRequest();
    var url = '/hotelbooking/ajax/sendmail.php';
    var params = 'data=' + finalForm;
    http.open('POST', url, true);

    //Send the proper header information along with the request
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function () {//Call a function when the state changes.
        if (http.readyState == 4 && http.status == 200) {

            if (parseInt(http.responseText) == 1) {
                alert('thank you  for your orders. our specialists will contact you soon');
                window.location.reload(true); 
            } else {
                alert('there is an error in program . pleas contact with us ');
                window.location.reload(true); 
            }
        }
    }
    http.send(params);

}

//************************************************************************************ 





// **************************************************************************** send form inputs border clear
document.querySelector('.contact_form_inputs').addEventListener('input', function (event) {
    event.target.style.border = ''
})
// **************************************************************************** send form inputs border clear end



// detect iframe massages 

var iframeTop
function displayMessage(evt) {


    // console.log(evt.data)
    var evn = new Event('scroll');
    evn.otherScroll = evt.data.otherScroll;

    evn.otherHeight = evt.data.screenHeight;

    evn.iframeHeight = evt.data.iframeOffsetHeight
    iframeTop = evt.data.iframeTop;
    document.dispatchEvent(evn);


}

if (window.addEventListener) {
    // For standards-compliant web browser
    window.addEventListener("message", displayMessage, false);
}
else {
    window.attachEvent("onmessage", displayMessage);
}




// ******************************************************************** show hide text content



document.querySelector('.showMore').onclick = function (event) {
    document.querySelector('.moreContent').style.display = 'inline';
    document.querySelector('.showMore').style.display = 'none'
}


document.querySelector('.showLess').onclick = function (event) {
    document.querySelector('.moreContent').style.display = 'none';
    document.querySelector('.showMore').style.display = 'inline-block';


}




document.addEventListener('click', function (event) {

    var target = event.target;
    if (target.closest('button')) {
        if (target.closest('.add_transport_rante_btn')) {

            if (target.closest('.rent_form').classList.contains('added')) {
                event.stopImmediatePropagation();
                event.preventDefault()
            }


        } else {

            if (target.closest('.added')) {



                event.stopImmediatePropagation();
                event.preventDefault()
            }
        }

    }
}, true)

// document.addEventListener("touchmove", function(event){
//     event.stopImmediatePropagation();
//     // event.preventDefault()
// }, false);

// document.addEventListener('focus', function(event){
//     // document.scrol
// })