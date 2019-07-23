
var touchEvent = 'ontouchstart' in window ? 'touchstart' : 'click';

var touchendEvent = 'ontouchstart' in window ? 'touchend' : 'click';

let hotelDateP = [...document.querySelectorAll('.datepicker_input')];

var userOrders = [];
var cloneOrders = [];




var carPrices = [20,25]



var rooms ={
    'ani plaza hotel': [65,80],
    'minotel barsam suites': [62,72],
    'best western plus congress hotel': [72,95],
    'metropol hotel': [65,72]

}
var roomsIndex = [
    'ani plaza hotel',
    'minotel barsam suites',
    'best western plus congress hotel',
    'metropol hotel'
]

var valuta = '$'
