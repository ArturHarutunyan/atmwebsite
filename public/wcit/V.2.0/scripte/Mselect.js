var clickEvent = 'ontouchstart' in window ? 'touchStart' : 'click';


if (!('remove' in Element.prototype)) {
    Element.prototype.remove = function () {
        if (this.parentNode) {
            this.parentNode.removeChild(this);
        }
    };
}

function Mseletc(options) {
    this.container = options.container instanceof Element ? options.container : document.querySelector(options.container); //required 
    this.customSelectContainer;
    this.options = this.getOptionsArray(); //required
    this.userClasses = options.classes || null;
    this.currentSelected;
    this.select;
    // console.log(this.container)
    this.placeholder = this.container.getAttribute('data-placeholder') || options.placeholder;

    this.onSelect = options.onSelect || null;
    this.init();
}


Mseletc.prototype.getOptionsArray = function () {
    var optionsContainer = this.container.querySelector('.Mselect');

    var options = optionsContainer.querySelectorAll('.Moption');


    var optionsArry = [].map.call(options, function (option) {

        return {
            value: option.getAttribute('data-value'),
            html: option.innerHTML,
            selected: option.hasAttribute('selected') ? true : false
        }
    })

    // console.log(optionsArry)
    optionsContainer.remove()
    return optionsArry;
}


Mseletc.prototype.createSelect = function () { // at first create once 



    var select = document.createElement('select');
    select.classList.add('hidden_select')

    this.select = select;

    this.options.forEach(function (optionParams) {
        var option = document.createElement('option');
        option.value = optionParams.value;
        optionParams.selected ? option.selected = optionParams.selected : null; // set selected Current option object not DOM
        optionParams.text ? option.text = optionParams.text : null;


        optionParams.selected ? this.currentSelected = optionParams : null;
        // console.log(optionParams)
        select.appendChild(option);
    }.bind(this));



    this.onSelect && select.addEventListener('change', this.onSelect);  // collback on select if it exist

    this.container.appendChild(select);


}

Mseletc.prototype.createCustomSelect = function () { // at first create once 

    var customSelectContainer = document.createElement('div');
    customSelectContainer.classList.add('Mselect');

    this.customSelectContainer = customSelectContainer;
    var classes = this.userClasses.split(' '); //crash user classes string  to array
    classes.forEach(function (oneClass) { //set user classes
        if (oneClass.trim())
            customSelectContainer.classList.add(oneClass)
    })

    var selectedElementContainer = document.createElement('div'); // creating selected item container 
    selectedElementContainer.classList.add('selected_container');

    var selectedElement = document.createElement('div') //create selected element 
    selectedElementContainer.appendChild(selectedElement);

    selectedElement.innerHTML = !!this.currentSelected ? this.currentSelected.html : this.placeholder; //if is default selected option
    // console.log(this.currentSelected);

    customSelectContainer.appendChild(selectedElementContainer) // set selected container 


    var optionsContainer = document.createElement('div'); //create all options container
    optionsContainer.classList.add('options_container');

    var absoluteContainer = document.createElement('div');
    absoluteContainer.classList.add('absolute_container');

    optionsContainer.appendChild(absoluteContainer);

    this.options.forEach(function (optionParams) { // create custom options 

        var customOption = document.createElement('div');
        customOption.setAttribute('data-value', optionParams.value);
        customOption.innerHTML = optionParams.html;

        customOption.classList.add('Moption');
        absoluteContainer.appendChild(customOption)
    });

    customSelectContainer.appendChild(optionsContainer) // append all options container

    this.container.appendChild(customSelectContainer);



    // customSelectContainer.style.width =  optionsContainer.querySelector('*').offsetWidth + 'px'


    var self = this
    this.customSelectContainer.onclick = function (event) { // custom select click default handler 
        var target = event.target;
        var container = this;
        var option = target.closest('.Moption');
        var containerAllOptions = target.closest('.absolute_container')




            // if (!container.classList.contains('opened'))
                container.classList.toggle('opened');

        if (option) { //dispatch select change on select z

            if(container){
                var optionsArry =  Array.from (containerAllOptions.querySelectorAll('.Moption'));
                optionsArry.forEach(function(option){
                    option.classList.remove('selected')
                })
             }
             option.classList.add('selected')
            self.select.value = option.getAttribute('data-value');








            var event;
            if (typeof (Event) === 'function') {
                event = new Event('change', {
                    bubbles: true,
                    cancelable: true
                });
            } else {
                event = document.createEvent('Event');
                event.initEvent('change', true, true);
            }



            self.select.dispatchEvent(event)
            selectedElement.innerHTML = option.innerHTML
        }

    }
}

Mseletc.prototype.init = function () {

    this.createSelect();
    this.createCustomSelect();

}
// document.onclick = function(event){
//     console.log(event)
// }

var documentClick = document.onclick;
document.onclick = function (event) {
    var target = event.target;
    documentClick && documentClick.bind(this, event)();
    if (event.isTrusted) {

        var wasOpened = event.target.closest('.Mselect.opened');
        [].forEach.call(document.querySelectorAll('.Mselect'), function (elem) {
            elem.classList.remove('opened')
        })

        if(wasOpened){
            event.target.closest('.Mselect').classList.add('opened')
        }
    }

    // if (event.isTrusted) {

    //     // console.log(!target.closest('.Mselect.opened'));
    //     [].forEach.call(document.querySelectorAll('.Mselect'), function (elem) {
    //         elem.classList.remove('opened')
    //     })


    //     // if(target.closest('.selected_container'))
    //     if(target.closest('.Mselect.opened')){
    //         target.closest('.Mselect.opened').classList.remove('opened');
    //         // alert()
    //     }
    //     target.dispatchEvent(new Event('click', { bubbles: true }))

    // } 



}



