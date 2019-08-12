/* @arr array you want to listen to
   @callback function that will be called on any change inside array
 */


function listenChangesinArray(arr, callback) {
	// Add more methods here if you want to listen to them


	// object for extend
	['pop', 'push', 'reverse', 'shift', 'unshift', 'splice', 'sort'].forEach((m) => {
		arr[m] = function () {
			var res = Array.prototype[m].bind(arr, arguments);  // call normal behaviour
			callback.apply(arr, arguments);  // finally call the callback supplied
			return res;
		}
	});
}









var entityMap = {
	'&': '&amp;',
	'<': '&lt;',
	'>': '&gt;',
	'"': '&quot;',
	"'": '&#39;',
	'/': '&#x2F;',
	'`': '&#x60;',
	'=': '&#x3D;'
};


function escapeHtml(string) {
	return String(string).replace(/[&<>"'`=\/]/g, function (s) {
		return entityMap[s];
	});
}


function setTurItemsTop() {

	[...document.querySelectorAll('.checkbox_show_hide_content')].forEach(elem => {
		var parent = elem.closest('.tur_description_item');
		var showContainer = parent.querySelector('.showHideContainer')
		var height = showContainer.offsetHeight;
		if (!elem.checked) {

			showContainer.style.marginTop = -height -100 + 'px';



		} else {
			showContainer.style.marginTop = '0' + 'px'
		}
	})
}


function shopListMinusTopPosition() {
	var shopList = document.querySelector('.shopList_block_container');

	if (shopList.classList.contains('showShop')) return;
	var shopListHeight = shopList.offsetHeight;
	// shopList.style.bottom = - (shopListHeight + 200) + 'px';



}




function getFormObject(selector, data_attribute) {

	var formsObject = {};
	var forms = [...document.querySelectorAll(selector)];



	forms.forEach(function (form, index) {

		var currentElementNumber = '' + (1 + index)
		form.setAttribute('data-' + data_attribute, currentElementNumber);
		var hiddenInputs = [...form.querySelectorAll('[data-name]')];
		// creating form object places
		formsObject[currentElementNumber] = {};
		hiddenInputs.forEach(function (oneHiddenInput) {
			var key = oneHiddenInput.getAttribute('data-name');
			formsObject[currentElementNumber][key] = { element: oneHiddenInput, isValid: false };
		})

		formsObject[currentElementNumber].adds = false;
		formsObject[currentElementNumber].parent = form;
	})

	return formsObject
}

function inputEventListener(selector, collBack) {
	var elements = [...document.querySelectorAll(selector)];
	elements.forEach(function (elem) {
		elem.addEventListener('input', collBack)
	})
}

function clickEventListener(selector, collBack) {
	var elements = [...document.querySelectorAll(selector)];

	elements.forEach(function (elem) {
		elem.onclick =  collBack

	})
}

function checkFormValidation(form) {
	var isFormValid = true;
	var keys = Object.keys(form);
	keys.forEach(function (key) {
		if (key != 'adds' && key != 'parent') {

			isFormValid = form[key].isValid && isFormValid;
		}
	})
	return isFormValid;
}


function clearAllForm() {
	var hotelsForm = [...document.querySelectorAll('.added')];
	hotelsForm.forEach(function (oneForm) {
		oneForm.classList.remove('added')
	})


}

function initOrders() {
	clearAllForm();


	userOrders.forEach(function (order) {
		order.parent.classList.add('added');

		if (order.parent.classList.contains('Booking_details_form')) {
			countingHotelBookingPrice(order.parent)
		}
	})

	var sopItemsContainer = document.querySelector('.shop_item_container');
	sopItemsContainer.innerHTML = '';
	var total = 0

	var  countOrders = userOrders.length;
	// console.log(userOrders)



	userOrders.forEach(function (oneOrder) {

		var DomForm = oneOrder.parent;


		// console.log(DomForm)





		var shopItem = document.createElement('div');
		shopItem.classList.add('shope_item');

		var serviceNameContainer = document.createElement('div');
		serviceNameContainer.classList.add('service_item');


		var priceContainer = document.createElement('div');
		priceContainer.classList.add('price_item');


		var QtyContainer = document.createElement('div');
		QtyContainer.classList.add('Qty_item');

		var AmountContainer = document.createElement('div');
		AmountContainer.classList.add('Amount_item');


		shopItem.appendChild(serviceNameContainer)
		shopItem.appendChild(priceContainer)
		shopItem.appendChild(QtyContainer)
		shopItem.appendChild(AmountContainer)




		var removeOrders = document.createElement('span');
		
		removeOrders.classList.add('removeOrderButton')
		removeOrders.innerHTML = '<svg aria-hidden="true" width="15" focusable="false" data-prefix="fas" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14 fa-3x"><path fill="currentColor" d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z" class=""></path></svg>';



		// sopItemsContainer
		// shop_item_container shope_item
		if (DomForm.classList.contains('Booking_details_form')) {

			var hotelName = DomForm.getAttribute('data-hotel_name').toLowerCase();
			var date = JSON.parse(oneOrder.date.element.value);
			var room = +oneOrder.Room.element.value - 1;
			var roomPrice = rooms[hotelName][room];

			var date = [new Date(date[0]), new Date(date[1])];

			var price = ((+getPastDays(date) ) * +roomPrice);

			var qty = oneOrder.Qty.element.value;
			var hotelName = DomForm.getAttribute('data-hotel_name');
			var totalPrice = price * +qty

			serviceNameContainer.innerHTML = hotelName;
			priceContainer.innerHTML = valuta +  price  ;
			QtyContainer.innerHTML = qty;


			AmountContainer.innerHTML = valuta +  totalPrice ;
			total += totalPrice;

			sopItemsContainer.appendChild(shopItem)

			// console.log(totalPrice);

			AmountContainer.appendChild(removeOrders);

			removeOrders.onclick = function(){
				removeOrderFromArray(oneOrder)
				
				DomForm.querySelector('.add_booking').click();
				
			}
			DomForm.querySelector('.datepicker_input').onblur = function(){
				if(!totalPrice && this.closest('.added')) removeOrders.click();
			}
			// if(!totalPrice) removeOrders.click();

		} else if (DomForm.classList.contains('tur_description')) {
			var date = JSON.parse(oneOrder.date.element.value);
			// changing for one date 

			var tourPrice = parseFloat(DomForm.getAttribute('data-tour_price'));

			var qty = oneOrder.Qty.element.value;
			var price = tourPrice;
			var totalPrice = price * qty;

			var serviceName = DomForm.getAttribute('data-tour_name');


			serviceNameContainer.innerHTML = serviceName;
			priceContainer.innerHTML = valuta + price ;
			QtyContainer.innerHTML = qty;


			AmountContainer.innerHTML = valuta + totalPrice ;
			total += totalPrice;

			sopItemsContainer.appendChild(shopItem);

			AmountContainer.appendChild(removeOrders);


			// console.log(DomForm)
			removeOrders.onclick = function(){
				removeOrderFromArray(oneOrder)
				DomForm.querySelector('.add_tour_btn').click();

				
			}
		} else if (DomForm.classList.contains('transport_section')) {

			var keys = Object.keys(oneOrder);
			
			// console.log(oneOrder);

			var carType = oneOrder.carType;

			var tripPrice = 0

			countOrders--
			keys.forEach(function (key) {
				if (!oneOrder[key].checked) return;
				countOrders++

				var shopItem = document.createElement('div');
				shopItem.classList.add('shope_item');

				var serviceNameContainer = document.createElement('div');
				serviceNameContainer.classList.add('service_item');


				var priceContainer = document.createElement('div');
				priceContainer.classList.add('price_item');


				var QtyContainer = document.createElement('div');
				QtyContainer.classList.add('Qty_item');

				var AmountContainer = document.createElement('div');
				AmountContainer.classList.add('Amount_item');


				shopItem.appendChild(serviceNameContainer)
				shopItem.appendChild(priceContainer)
				shopItem.appendChild(QtyContainer)
				shopItem.appendChild(AmountContainer)








				var ownForm = oneOrder[key].ownForm;
				var parent = oneOrder[key].parent

				var serviceName = parent.querySelector('label').innerHTML;

				var qty = 1;
				var price = 0;


				var date = JSON.parse(ownForm.date.value);



				var date1 = new Date(date[0]);
				var date2 = new Date(date[1]);




				// console.log(days);

				if (key != 'Car-Rent') {
					// plas static price 


					price = carPrices[carType - 1];

					tripPrice += carPrices[carType - 1];



				} else {
					var days = getPastDays([date1, date2]) + 1;

					price = +parent.getAttribute('data-static_price')

					price *= days;

					document.querySelector('.car_rante_price').innerHTML = valuta +price  ;


					// count cra rante in day
				}

				QtyContainer.innerHTML = qty;
				AmountContainer.innerHTML =  valuta+ price ;
				priceContainer.innerHTML = valuta + price ;

				serviceNameContainer.innerHTML = serviceName;
				sopItemsContainer.appendChild(shopItem);

				var removeOrders =  document.createElement('span');

				removeOrders.classList.add('removeOrderButton')
				removeOrders.innerHTML = '<svg aria-hidden="true" width="15" focusable="false" data-prefix="fas" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14 fa-3x"><path fill="currentColor" d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z" class=""></path></svg>';


				AmountContainer.appendChild(removeOrders);

				// console.log(shopItem)
				removeOrders.onclick = function(){
					var checkbox = parent.querySelector('[type="checkbox"]')
					checkbox.checked = false;
					checkbox.dispatchEvent(new Event('change'));
					
					console.log(DomForm)

					var checkboxes =  oneOrder.parent.querySelector('.select_trip_form').querySelectorAll('[type="checkbox"]');
					console.log('====================================');
					console.log(checkboxes[0],checkboxes[1]);
					console.log('====================================');
					if(checkboxes[0] && !checkboxes[0].checked && checkboxes[1]  && !checkboxes[1].checked ){
						document.querySelector('.add_transport_btn').click()
					}
					
					
					initOrders();

				}

				total += price;
			})
			if(!tripPrice) tripPrice =  carPrices[carType - 1];



			var carsPrice = document.querySelectorAll('.car_price .bold_font')

			carsPrice[0].innerHTML = carsPrice[1].innerHTML = valuta +  tripPrice ;


		} else if(DomForm.classList.contains('rent_form')){

				// countOrders++


				var shopItem = document.createElement('div');
				shopItem.classList.add('shope_item');

				var serviceNameContainer = document.createElement('div');
				serviceNameContainer.classList.add('service_item');


				var priceContainer = document.createElement('div');
				priceContainer.classList.add('price_item');


				var QtyContainer = document.createElement('div');
				QtyContainer.classList.add('Qty_item');

				var AmountContainer = document.createElement('div');
				AmountContainer.classList.add('Amount_item');


				shopItem.appendChild(serviceNameContainer)
				shopItem.appendChild(priceContainer)
				shopItem.appendChild(QtyContainer)
				shopItem.appendChild(AmountContainer)



				serviceNameContainer.innerHTML  = 'rent car';
				priceContainer.innerHTML = valuta + carRentPrice  ;

				QtyContainer.innerHTML = 1;

				AmountContainer.innerHTML = oneOrder.totalPrice;



				sopItemsContainer.appendChild(shopItem);
				total+= parseFloat(oneOrder.totalPrice.substr(1));
				console.log(total,oneOrder.totalPrice)
				// oneOrder.totalPrice = valuta+oneOrder.totalPrice


				AmountContainer.appendChild(removeOrders);
				removeOrders.onclick = function(){
					removeOrderFromArray(oneOrder)

					DomForm.querySelector('.add_transport_rante_btn').click()
				}


				// console.log(14564)
		}

		// console.log(DomForm);

	})

	document.querySelectorAll('.shopTitle .blue_color')[0].innerHTML = document.querySelectorAll('.shopTitle .blue_color')[1].innerHTML = countOrders
	document.querySelector('.shop_total .blue_color').innerHTML = valuta + total ;

	if (total) {
		document.querySelector('.shopList').classList.add('show')
		document.querySelector('.mobile_shopList_fi').classList.add('show');
	} else {
		document.querySelector('.shopList').classList.remove('show')
		document.querySelector('.mobile_shopList_fi').classList.remove('show');
		
		document.querySelector('.mobile_shopList_fi').style.top = '';


	}
	shopListMinusTopPosition()
}
function addOrderToArray(order) {
	userOrders.push(order);
	initOrders()
}
function removeOrderFromArray(order) {


	if (~userOrders.indexOf(order))
		userOrders.splice(userOrders.indexOf(order), 1);

	initOrders();
}

function countingHotelBookingPrice(form) {
	var hotelName = (form.getAttribute('data-hotel_name')).toLowerCase();



	var room = form.querySelector('[data-name="Room"]').value;
	var qty = form.querySelector('[data-name="Qty"]').value;
	var date = form.querySelector('[data-name="date"]').value;

	var newDates = [new Date(JSON.parse(date)[0]), new Date(JSON.parse(date)[1])]

	var roomPrice = rooms[hotelName][room - 1];
	var days = getPastDays(newDates);
	var nights = days ;
	var price = qty * nights * roomPrice;


	var totalPrises = form.closest('.hotel_info_container').querySelectorAll('.total_price');

	// days adults

	if (room == 2) {
		qty *= 2;
	}
	totalPrises[1].nextElementSibling.innerHTML = totalPrises[0].nextElementSibling.innerHTML = nights + ' nights ' + qty + (qty == 1 ? ' adult' : 'adults');



	var hotelIncludes = form.closest('.hotel_info_container').querySelectorAll('.gold_color');


	hotelIncludes[0].innerHTML = hotelIncludes[1].innerHTML = '';

	totalPrises[0].innerHTML = totalPrises[1].innerHTML = valuta +  price  ; 


	// console.log(price, days, nights)
}



function getPastDays(dateArray) {
	var date2 = dateArray[0];
	var date1 = dateArray[1];
	var timeDiff = Math.abs(date2.getTime() - date1.getTime());
	return Math.ceil(timeDiff / (1000 * 3600 * 24));
}


function checkTransportFormValidation(form) {


	var keys = Object.keys(form);


	var hasCheckboxes = false;
	var isFormValid = true;


	keys.forEach(function (key) {
		if (key == 'added' || key == 'carType') return;
		var oneForm = form[key]
		if (!oneForm.checked) return;
		hasCheckboxes = true
		var formDetail = oneForm.ownForm;

		var formDetailKeys = Object.keys(formDetail);

		formDetailKeys.forEach(function (key) {
			if (!formDetail[key].value.trim()) {

				var currentIterationInput = formDetail[key].input
				if (currentIterationInput.classList.contains('hidden_input')) {
					currentIterationInput.nextElementSibling.style.border = '2px solid red';
					isFormValid = false
				} else {
					currentIterationInput.style.border = '2px solid red';
					isFormValid = false
				}
			}

		})
	})

	// console.log(hasCheckboxes && isFormValid)
	if (!hasCheckboxes || !isFormValid) {

		removeOrderFromArray(form)
	}
	return hasCheckboxes && isFormValid;

}






function getTransportationFormObject() {


	var form = {};
	form.carType = 2;

	form.added = false;

	form.parent = document.querySelector('.transport_section')
	var checkableForms = [...document.querySelectorAll('.transport_section  [data-form_name]')];

	checkableForms.forEach(function (elem) {
		var elemName = elem.getAttribute('data-form_name');
		form[elemName] = {};
		form[elemName].isFormValid = false;
		form[elemName].checked = false;
		form[elemName].parent = elem;

		form[elemName].ownForm = {}
		var checkbox = elem.querySelector('input[type="checkbox"]');
		checkbox.addEventListener('change', function (event) {
			var target = event.target;
			var checked = target.checked;
			if (checked) {
				form[elemName].checked = true;
			} else {
				form[elemName].checked = false;
			}

			if (form.added) {



				if (checkTransportFormValidation(form)) {

					removeOrderFromArray(form)
					addOrderToArray(form)
				} else {
					form.added = false
					removeOrderFromArray(form)
				}

			}


		})


		var formElements = [...elem.querySelectorAll('[data-name]')];

		formElements.forEach(function (oneInput) {


			var formKey = oneInput.getAttribute('data-name');

			form[elemName].ownForm[formKey] = { input: oneInput, value: oneInput.value };



			oneInput.addEventListener('input', function (event) {
				var value = event.target.value;
				form[elemName].ownForm[formKey].value = value.trim();
				if (!value.trim()) {
					if (!oneInput.classList.contains('.hidden_input')) {
						oneInput.style.border = '2px solid red'
						form.added = false;


					}

				} else {
					oneInput.style.border = '';
				}
				if (form.added) {

					
					(form);
					initOrders()
				}
			})

		})
	})
	var radiosContainer = document.querySelector('.transport_section .radios');
	radiosContainer.addEventListener('change', function (event) {
		form.carType = +event.target.value;
	})
	return form;

}





