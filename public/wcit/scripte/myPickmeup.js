
(function (ELEMENT) {
    ELEMENT.matches = ELEMENT.matches || ELEMENT.mozMatchesSelector || ELEMENT.msMatchesSelector || ELEMENT.oMatchesSelector || ELEMENT.webkitMatchesSelector;
    ELEMENT.closest = ELEMENT.closest || function closest(selector) {
        if (!this) return null;
        if (this.matches(selector)) return this;
        if (!this.parentElement) { return null }
        else return this.parentElement.closest(selector)
    };
}(Element.prototype));



var datepickerInputs = document.querySelectorAll('.datepicker_input');

var today = new Date();
var todaysDate = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
var startDate = new Date(todaysDate);
var eventStartDate = new Date("2019-10-6");

var endDate = new Date("2019-10-13");
var eventEndDate = new Date('2019-10-9');



[].forEach.call(datepickerInputs, function (elem) {


    pickmeup(elem, {
        position: 'right',
        hide_on_select: true,
        mode: 'simple',
        date: new Date("2019-10-23"),
        calendars: 1,
        format: 'd.m.Y',
        render: function (date) {

            // console.log(date)

            var isDateSelected = false;

            var BreakException = {};

            try {
                [].forEach.call(datepickerInputs, (elem2) => {

                    if (elem2.selectedInfo && elem2.selectedInfo.date && elem2.selectedInfo.datepicker != elem && (+new Date(elem2.selectedInfo.date) == +new Date(date))){
                        // tourForm 

                        if(elem2.selectedInfo.datepicker.closest('.tourForm.added'))
                            isDateSelected = true;
                    } 
                    if (isDateSelected) throw BreakException
                })
            } catch (e) {
                // if (e !== BreakException) throw e;
            }

            if (isDateSelected ) {

                var classes = 'enabled_date selected';
                return { disabled: true, class_name: classes };
            }

            if (startDate > date || date > endDate) {

                var classes = 'enabled_date';
                return { disabled: true, class_name: classes };
            }
            var classes = ''
            if (eventStartDate <= date && date <= eventEndDate) {
                classes += 'event_date'

                return { class_name: classes };
            }
            return {};
        }
    });
    elem.value = '';
    elem.setAttribute('placeholder', 'Date');

    elem.selectedInfo = { date: null, datepicker: elem }

    var parent = elem.closest('.datePickerContainer');



    elem.addEventListener('pickmeup-change', function (e) {

        elem.selectedInfo.date = pickmeup(elem).get_date();
        
    })

    elem.addEventListener('pickmeup-hide', function (e) {

        // console.log('hide');

        if (document.querySelector('.pickmeup:not(.pmu-hidden)')) {
            var event;
            if (typeof (Event) === 'function') {
                event = new Event('change', { bubbles: true, cancelable: false });
            } else {
                event = document.createEvent('Event');
                event.initEvent('change', true, true);
            }
            elem.dispatchEvent(event);
            parent.classList.remove('opened');
        }
        
        isFoc = false
        parent.classList.remove('opened');

    })


    elem.addEventListener('pickmeup-show', function (e) {

        parent.classList.add('opened')

    })

    var isFoc = false

    elem.onclick = function (event) {
        // event.stopImmediatePropagation()
        if (isFoc) {

            elem.dispatchEvent(new Event('pickmeup-hide'))
            document.querySelector('.pickmeup:not(.pmu-hidden)').classList.add('pmu-hidden')

            isFoc = false
        } else {
            isFoc = true
        }
        // isFoc = !isFoc
    }



    // elem.addEventListener('pickmeup-change', function (e) {


    // })
});