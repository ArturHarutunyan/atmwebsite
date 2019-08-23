
// --------------------------------------------- js svg code 
// svg first head breackpoint

var lastScrollPosition = 0
var go_to_another_page = false;

// $(document).load().scrollTop(0);
window.onbeforeunload = function () {
	// console.log(go_to_another_page)
	if (!go_to_another_page) {
		// window.scrollTo(0, 0);
	}
}

function getOffset(element) {
	var bound = element.getBoundingClientRect();
	var html = document.documentElement;

	return {
		top: bound.top + window.pageYOffset - html.clientTop,
		left: bound.left + window.pageXOffset - html.clientLeft
	};
}
var arrayForCountLimit = [20, 100, 4700, 80]
var copyStart = [0, 0, 0, 0]
function countEfect(needToAnimate, plasValue, speed) {
	var countSteps = 0
	$('.achievement__col-article__number').css('color', '#0069b2')
	$('.achievement__col-article__text').css('color', '#57585b')
	var a = 0;
	var element = $('.scroll-count');
	if (element.length > 0) {
		var oTop = $('.scroll-count').offset().top - window.innerHeight + plasValue ? plasValue : 300;

		var i = 0;
		if (a === 0 && $(window).scrollTop() > oTop) {
			$('.count').each(function (index) {

				console.log(123)
				var count = (!speed ? copyStart[index] : 0)
				$(this).stop(true).prop({ 'Counter': count }).animate({
					Counter: arrayForCountLimit[i]
				}, {
						duration: needToAnimate ? speed ? speed : 2000 : 0,
						easing: 'swing',
						step: function (now) {
							$(this).text(Math.ceil(now));

							copyStart[index] = $(this).text();
							// countSteps++
							// if (countSteps == 4) countSteps = 0;
						}
					});
				i++;
			});
			a = 1;
		}
	}
}



window.onpageshow = function () {


	document.body.style.minHeight = 5400 + 'px';
	// title animation traing
	$('.ml3').each(function () {
		$(this).html($(this).text().replace(/([^\x00-\x80]|\w|\,|\:|\!|\?)/g, "<span class='letter'>$&</span>"));
	});
	if (anime) {
		anime.timeline
			({
				loop: false,
				delay: 1000
			})
			.add({
				delay: 300
			})
			.add({
				targets: '.ml3 .letter',
				opacity: [0, 1],
				easing: "easeInOutQuad",
				duration: 20,
				delay: function (el, i) {
					return 50 * (i + 1)
				}
			}).add({
				targets: '.ml3',
				opacity: 0,
				duration: 100,
				easing: "easeOutExpo",
				delay: 100
			});
	}

	// 


	// drow line plugin dont work 
	// TweenMax.to('#first_path_background', 1.5, 
	// {delay:20, drawSVG:'100%', 
	//  strokeDashoffset:3, ease:Expo.easeInOut})

	$('.preloader_container').remove();
	document.getElementById("MainBlock").style.visibility = "visible";
	// 
	if ($(window).width() >= 1008) {
		SvgLogic()

		if ($(document).scrollTop() < 2) {
			$('.mask').addClass("work_on_top")
			$(".background_container").addClass('background_container_animation')
			setTimeout(function () {
				$('.banner__title').removeClass('hide_discover_with_armenia')
				setTimeout(function () {
					$('.svgContainer').css('opacity', '1')


				}, 500)
			}, 1000)
			$('html').css({ 'margin-right': $.position.scrollbarWidth() + 'px' })
			$('#headerBlock').css({
				"padding-right": $.position.scrollbarWidth() + 'px',
				'transition': 'all 0s'
			})
			$('.hiddenScrollbar').css({
				'visibility': 'visible'


			})
		} else {
			$('#headerBlock').css({
				"padding-right": 0,
				'transition': 'all 0.2s'
			})
			$('html,body').css({ 'margin-right': '0' })
			$('.hiddenScrollbar').css({ 'visibility': 'hidden' })
			$(".background_container").css({
				"transition": 'all 0s linear',
			})
			$(".background_container").addClass('background_container_animation')

			$("html , body").css("overflow-y", "visible")
			$('.background_container').css('transition', 'all 0s linear')
			$('.banner__title').removeClass('hide_discover_with_armenia')
			$('.svgContainer').css({
				"transition": 'all 0s linear',
				'opacity': '1'
			})
			$('.banner__title').css('transition', 'all 0s linear')
			$('.mask').addClass("work_on_top")
			$('.mask').addClass("work_on_top_ready")
		}


	} else {
		$(".tour").removeClass("fullRigth")
		$(".gallery ").removeClass("fullRigth")


		// $(".about").css({
		//     "transition": "all 0s linear",
		//     'opacity' :1
		// })
		$('.banner__title').removeClass('hide_discover_with_armenia')

		$('.animated').removeClass('testimonialsAnimation')
	}

	var animationBackgroundArmenia = document.querySelector(".background_container")
	// Code for Chrome, Safari and Opera
	animationBackgroundArmenia.addEventListener("webkitAnimationEnd", animatingArmenia);
	// Standard syntax
	animationBackgroundArmenia.addEventListener("animationend", animatingArmenia);
	function animatingArmenia() {

		$('.background_container').addClass('changeBackground');
	}
}
// $(document).ready(function () {
// 	$("a").attr('target', "_blank");
// })
function SvgLogic() {

	function createFlexiblePath() {
		$('.svgContainer').css('visibility', "visible")
		var firstSvgBreackpoint = document.querySelector('.svgFirstBreakpoint').getBoundingClientRect().top + document.documentElement.scrollTop + 175 + 'px';

		$(".svgContainer").css({ top: firstSvgBreackpoint });

		var vh100 = $(".banner").height()
		var elem = document.querySelector('.testimonials p');
		var distanceScrolled = $(document).scrollTop();
		var elemRect = elem.getBoundingClientRect();
		var elemViewportOffset = elemRect.top;
		var totalOffset = distanceScrolled + elemViewportOffset;
		totalOffset = vh100 < 600 ? totalOffset + 200 : totalOffset

		//responsice 
		var p1_q2_4 = 520
		var p1_q2_1 = 400
		var p1_q3_1 = 1800
		var p1_q3_4 = 300
		var p1_q3_3 = 1300
		if ($(window).width() <= 1281) {
			p1_q2_4 = 480
			p1_q2_1 = 250
			p1_q3_4 = 260
			// p2_q3_4 = 3070
			p1_q3_1 = 1780
			p1_q3_4 = 430
			// this
			p1_q3_3 = 1440

			p1_q3_4 = 190
			// this
		}















		var first_path_responsive = " M 1900 -1405 Q 630 -561 184 -709Q -" + p1_q2_1 + " -904 -1043 -" + p1_q2_4 + "Q -" + p1_q3_1 + " -80.4355 -" + p1_q3_3 + " " + p1_q3_4
		// var secend_path_responsive = " M -" + p2_m_l + " " + q2_m_t + " Q " + p2_q1_1 + " 1068.7 -" + p2_q1_3 + " 1242.89Q -" + p2_q2_1 +
		// "  1403.54 -800 2258.96Q -474.449 2527.01 -" + p2_q3_3 + " " + p2_q3_4


		var first_path = "M 1900 -1405 Q 630 -561 184 -709Q -" + p1_q2_1 + " -904 -1043 -" + p1_q2_4 + "Q -" + p1_q3_1 + "-80.4355 -" + p1_q3_3 + " " + p1_q3_4


		var new_secend_path = 'M -1302 300 Q 200 1068.7 -1087.86 1242.89Q -2250  1403.54 -500 2758.96Q 4.449 3127.01 -550 3490Q -1050  3803.54 -900 4358.96'
		var new_secend_path_responsive = 'M -1512 150 Q 200 1068.7 -1087.86 1242.89Q -2250  1403.54 -500 2758.96Q 4.449 3127.01 -550 3490Q -1050  3803.54 -900 4358.96'


		if ($(window).width() < 1071) {
			new_secend_path_responsive = 'M -1512 150 Q 200 1068.7 -1087.86 1242.89Q -2250  1403.54 -500 2758.96Q 4.449 3827.01 -550 4090Q -1450  4503.54 -900 5008.96'
		}
		//set path d attribut
		$('#first_path_background').attr('d', $(window).width() > 1161 ? first_path : first_path_responsive)
		$('#first_path').attr('d', $(window).width() > 1161 ? first_path : first_path_responsive)

		$('#secend_path_background').attr('d',
			//  $(window).width() > 1161 ? secend_path : secend_path_responsive
			$(window).width() > 1281 ? new_secend_path : new_secend_path_responsive


		)
		$('#secend_path').attr('d',
			//  $(window).width() > 1161 ? secend_path : secend_path_responsive

			$(window).width() > 1281 ? new_secend_path : new_secend_path_responsive

			// new_secend_path
		)

		// console.log($(window).width())
	}
	createFlexiblePath()
	var changePath = 830
	var pathMinusPosition = $(window).width() >= 1410 ? 2500 : 2370;
	$(window).resize(function () {
		createFlexiblePath()
		setBreackpointsPositions()
	})











	var scrollPosition = $(document).scrollTop(),
		scrollingFromTop,
		scrollDistenceLimit
	function isScrollingToTop() {
		if (scrollPosition < $(document).scrollTop()) {

			scrollPosition = $(document).scrollTop()
			return true;
			// console.log("scrolling from top")
		}
		else {
			scrollPosition = $(document).scrollTop()
			return false;
			// console.log("scrolling From bottom")
		}
	}







	var needToStop1 = true;
	var needToStop2 = false;
	var needToStop3 = false;
	var needToStop4 = false;
	var
		forthBreackpointPositionOnTop,
		thirdBreackpointPositionOnTop,
		secendBreackpointPositionOnTop,
		firstBreackpointPositionOnTop

	(function setBreackpointsPositionsOnready() {




		function BrowserDetection() {
			//Check if browser is IE
			if (navigator.userAgent.search("MSIE") >= 0) {
				// insert conditional IE code here
				return 'IE'
			}

			//Check if browser is Firefox 
			else if (navigator.userAgent.search("Firefox") >= 0) {
				return 'Firefox'
			}
			//Check if browser is Safari
			else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
				return 'Safari'
			}
			else if (navigator.userAgent.search("Edge") >= 0) {
				return 'Edge'
			}			//Check if browser is Chrome
			//Check if browser is Opera
			else if (navigator.userAgent.search("Build/MRA58N") >= 0) {
				return 'Opera'
				// insert conditional Opera code here
			}
			else if (navigator.userAgent.search("Chrome") >= 0) {
				return 'Chrome';
			}
		}
		var browserType = BrowserDetection();
		console.log(browserType)


		firstBreackpointPositionOnTop = ($(window).width() >= 1281) ? 625 : 576;
		secendBreackpointPositionOnTop = $(window).width() < 1410 ? 1010 : 1050;
		thirdBreackpointPositionOnTop = $(window).width() < 1410 ? 1590 : 1630;


		forthBreackpointPositionOnTop = 2380



		if ($(window).width() < 1528) {
			forthBreackpointPositionOnTop = 2390
		}
		if ($(window).width() < 1410) {
			forthBreackpointPositionOnTop = 2347
		}


		if ($(window).width() < 1282) {
			secendBreackpointPositionOnTop = 1000;
			forthBreackpointPositionOnTop = 2290
		}
		if ($(window).width() < 1220) {
			forthBreackpointPositionOnTop = 2300
		}

		if ($(window).width() < 1167) {
			forthBreackpointPositionOnTop = 2310
		}
		if ($(window).width() < 1072) {
			forthBreackpointPositionOnTop = 2320;
		}
		if ($(window).width() < 1071) {
			secendBreackpointPositionOnTop = 1015;
			thirdBreackpointPositionOnTop = 1580;
			forthBreackpointPositionOnTop = 2610;

		}
		if ($(window).width() < 1048) {
			forthBreackpointPositionOnTop = 2620;
		}
		if (browserType == 'Firefox') {
			firstBreackpointPositionOnTop += 10;
			secendBreackpointPositionOnTop += 10;
			thirdBreackpointPositionOnTop += 30;
			forthBreackpointPositionOnTop += 40;
		} else if (browserType == 'Edge') {
			firstBreackpointPositionOnTop += 10;
			secendBreackpointPositionOnTop += 13;
			thirdBreackpointPositionOnTop += 25;
			forthBreackpointPositionOnTop += 40;
		}

		else if (browserType == 'Chrome' || browserType == 'Opera') {
			firstBreackpointPositionOnTop += 10;
			secendBreackpointPositionOnTop += 10;
			thirdBreackpointPositionOnTop += 20;
			forthBreackpointPositionOnTop += 27;

		}

		// console.log(14654545)

		if ($(window).width() < 1536 && $(window).width() >= 1528) {
			console.log(1)
			if ($(".header__languagePicker__button").html() == "ru") {


			} else {
				console.log(2)
				forthBreackpointPositionOnTop += 15
			}
		}
		if ($(window).width() < 1410) {
			forthBreackpointPositionOnTop += 10
		}
		if ($(window).width() < 1282) {
			if ($(".header__languagePicker__button").html() == "ru") {

				firstBreackpointPositionOnTop -= 68
			} else {
				firstBreackpointPositionOnTop += 15
			}
		}


		if ($(window).width() < 1281) {
			if ($(".header__languagePicker__button").html() == "ru") {

				firstBreackpointPositionOnTop += 45
			} else {
				secendBreackpointPositionOnTop += 10
				firstBreackpointPositionOnTop -= 25
			}
		}
		if ($(window).width() < 1220) {
			if ($(".header__languagePicker__button").html() == "ru") {

				thirdBreackpointPositionOnTop += 10
			} else {

				thirdBreackpointPositionOnTop += 15
			}
		}
		if ($(window).width() <= 1179) {
			secendBreackpointPositionOnTop += 5
			if ($(".header__languagePicker__button").html() == "ru") {
				firstBreackpointPositionOnTop += 10
				forthBreackpointPositionOnTop += 10
			}
		}
		if ($(window).width() < 1167) {
			if ($(".header__languagePicker__button").html() == "ru") {

			} else {

				secendBreackpointPositionOnTop += 10
				thirdBreackpointPositionOnTop += 15
				forthBreackpointPositionOnTop += 10;
			}
		}
		if ($(window).width() < 1116) {
			if ($(".header__languagePicker__button").html() == "ru") {

				thirdBreackpointPositionOnTop += 5
				forthBreackpointPositionOnTop -= 10
			} else {
				secendBreackpointPositionOnTop -= 10
				thirdBreackpointPositionOnTop -= 10
				forthBreackpointPositionOnTop -= 5
			}
		}
		if ($(window).width() < 1083) {
			if ($(".header__languagePicker__button").html() == "ru") {
				forthBreackpointPositionOnTop += 15
			} else {

			}
		}
		if ($(window).width() < 1071) {
			if ($(".header__languagePicker__button").html() == "ru") {
				forthBreackpointPositionOnTop -= 10
			} else {
				firstBreackpointPositionOnTop += 80
				secendBreackpointPositionOnTop -= 10
				thirdBreackpointPositionOnTop += 10
			}
		}
		if ($(window).width() < 1048) {
			if ($(".header__languagePicker__button").html() == "ru") {

			} else {
				thirdBreackpointPositionOnTop += 15
			}
		}




		if ($(".header__languagePicker__button").html() == "ru") {
			secendBreackpointPositionOnTop -= 5;
			// ru
			if ($(window).width() >= 1552) {
				firstBreackpointPositionOnTop += 20;
			}
			else if ($(window).width() <= 1548 && $(window).width() > 1507) {
				firstBreackpointPositionOnTop += 20;
			} else if ($(window).width() <= 1507 && $(window).width() > 1466) {
				firstBreackpointPositionOnTop += 20;
			}
			else if ($(window).width() <= 1466 && $(window).width() > 1457) {
				firstBreackpointPositionOnTop += 20;
			} else if ($(window).width() <= 1411 && $(window).width() > 1410) {
				firstBreackpointPositionOnTop += 20;
			} else if ($(window).width() <= 1410 && $(window).width() > 1409) {
				firstBreackpointPositionOnTop += 20;
			} else if ($(window).width() <= 1409 && $(window).width() > 1381) {
				firstBreackpointPositionOnTop += 20;
			} else if ($(window).width() <= 1380 && $(window).width() > 1379) {
				firstBreackpointPositionOnTop += 20;

			} else if ($(window).width() <= 1379 && $(window).width() > 1281) {
				firstBreackpointPositionOnTop += 20;

			}
			else if ($(window).width() <= 1281 && $(window).width() > 1280) {
				firstBreackpointPositionOnTop += 100;

			} else if ($(window).width() <= 1280 && $(window).width() > 1070) {
				firstBreackpointPositionOnTop += 20;


			}
			else if ($(window).width() <= 1070 && $(window).width() > 1068) {
				firstBreackpointPositionOnTop += 100;

			} else if ($(window).width() <= 1068) {
				firstBreackpointPositionOnTop += 100;

			}
			else {
				firstBreackpointPositionOnTop += 20;
			}



			secendBreackpointPositionOnTop += 35
			thirdBreackpointPositionOnTop += 45
			forthBreackpointPositionOnTop += 65

			if ($(window).width() < 1410) {
				secendBreackpointPositionOnTop -= 8;
				thirdBreackpointPositionOnTop -= 5;
				forthBreackpointPositionOnTop -= 20;
			}
			if ($(window).width() < 1290) {
				secendBreackpointPositionOnTop += 5
			}
			if ($(window).width() < 1282) {
				secendBreackpointPositionOnTop -= 5
			}
			if ($(window).width() < 1169) {
				secendBreackpointPositionOnTop += 5
			}
			if ($(window).width() < 1083) {
				secendBreackpointPositionOnTop += 5
			}
			if ($(window).width() < 1072) {
				secendBreackpointPositionOnTop += 5
			}
			if ($(window).width() < 1071) {
				secendBreackpointPositionOnTop -= 22
			}
			if ($(window).width() < 1290) {
				thirdBreackpointPositionOnTop += 12
			}
			if ($(window).width() < 1282) {
				thirdBreackpointPositionOnTop -= 60
			}
			if ($(window).width() < 1212) {
				thirdBreackpointPositionOnTop += 5
			}
			if ($(window).width() < 1169) {
				thirdBreackpointPositionOnTop += 15
			}
			if ($(window).width() < 1116) {
				thirdBreackpointPositionOnTop -= 20
			}


			if ($(window).width() < 1113) {
				thirdBreackpointPositionOnTop += 5
			}
			if ($(window).width() < 1083) {
				thirdBreackpointPositionOnTop += 9
			}

			if ($(window).width() < 1072) {
				thirdBreackpointPositionOnTop += 10
			}







		}
		// en
		else if ($(".header__languagePicker__button").html() == "en") {
			thirdBreackpointPositionOnTop -= 5
			forthBreackpointPositionOnTop -= 10

			if ($(window).width() < 1410) {
				secendBreackpointPositionOnTop -= 5;
				forthBreackpointPositionOnTop -= 5;
			}

			if ($(window).width() < 1410 && $(window).width() >= 1305) {
				forthBreackpointPositionOnTop -= 5;
			}

			if ($(window).width() < 1179 && $(window).width() >= 1072) {
				forthBreackpointPositionOnTop += 5;
			}


			if ($(window).width() < 1171 && $(window).width() >= 1062) {
				forthBreackpointPositionOnTop -= 5;
			}
			if ($(window).width() < 1282) {
				secendBreackpointPositionOnTop -= 5;
				thirdBreackpointPositionOnTop -= 38;				// forthBreackpointPositionOnTop-=5;
			}


			if ($(window).width() < 1600) {

				// secendBreackpointPositionOnTop -=10
				// thirdBreackpointPositionOnTop -=40
			}


		}

	})()
	// ______________________________ breackpoints on redy ___________________________________



	// $('.hiddenScrollbar').css({
	// 	'visibility':'visible',

	// })

	$('.hiddenScrollbar div').css({
		'height': $(document).height() + 'px'

	})
	if ($(document).scrollTop() >= forthBreackpointPositionOnTop) {
		needToStop1 = false;
		needToStop2 = false;
		needToStop3 = false;
		needToStop4 = false;

		$("#thirdBreackpoint").attr('r', 75)
		$("#secendBreackpoint").attr('r', 75)
		$("#firstBreackpoint").attr('r', 65)

		$(".gallery").css("transition", "all 0s linear")
		$(".tour").removeClass("fullRigth")
		$(".gallery ").css({ 'opacity': '1' })
		$(".gallery ").addClass('galleryShow')

		$("#fordBreackpoint").attr('r', 65)
		$('.unicue_services_content').css({ 'opacity': '1', 'margin-right': '0', 'transition': "all 0s" })

		countEfect(false)
		$(".about").css({
			"transition": "all 0s linear",
			'opacity': 1
		})
		$(".tour").css({
			"transition": "all 0s linear",
			'opacity': '1',
		})


	}

	else if ($(document).scrollTop() >= thirdBreackpointPositionOnTop) {
		needToStop1 = false;
		needToStop2 = false;
		needToStop3 = false;
		needToStop4 = true;
		$("#thirdBreackpoint").attr('r', 75)
		$("#secendBreackpoint").attr('r', 75)
		$("#firstBreackpoint").attr('r', 65)
		$(".tour").css({ 'opacity': '1' })
		$(".gallery ").css({ 'opacity': '1' })
		$(".gallery ").addClass('galleryShow')
		$(".tour").css({
			"transition": "all 0s linear",
			'opacity': '1',
		})
		$(".gallery").css({
			"transition": "all 0s linear",
			'opacity': '1',
		})

		// $('.unicue_services_content').css({ 'opacity': '1' })
		// $('.unicue_services').css({'margin':'auto'})
		countEfect(false)
		$(".about").css({
			"transition": "all 0s linear",
			'opacity': 1
		})

	} else if ($(document).scrollTop() >= secendBreackpointPositionOnTop) {
		$("#secendBreackpoint").attr('r', 75)
		$("#firstBreackpoint").attr('r', 65)
		countEfect(false)
		$(".about").css({
			"transition": "all 0s linear",
			'opacity': 1
		})
		needToStop1 = false;
		needToStop2 = false;
		needToStop4 = false;
		needToStop3 = true;
	} else if ($(document).scrollTop() >= firstBreackpointPositionOnTop) {
		$("#firstBreackpoint").attr('r', 65)
		$(".about").css({
			"transition": "all 0s linear",
			'opacity': 1
		})

		needToStop1 = false;
		needToStop2 = true;
		needToStop3 = false;
		needToStop4 = false
	}


	var canAnimate = true;
	
	function slowAnimate() {
		// console.log($(window).scrollTop() > firstBreackpointPositionOnTop)

		if ($(window).scrollTop() > firstBreackpointPositionOnTop+50 && canAnimate) {
			countEfect(true, 0, 20000)
			canAnimate = false;
		}
	}

	if($(window).scrollTop() <= secendBreackpointPositionOnTop && $(window).scrollTop() > firstBreackpointPositionOnTop )
		slowAnimate()
	if($(window).scrollTop() >= secendBreackpointPositionOnTop)
		canAnimate = false;
	// else if(){
	// }
	//_____________________________________________________________ SCROLLING !!!! __________________________________________________________ 

	var globusPosition
	var isItAnimated = false;

	var canScrolling = true

	function stopScrolling() {
		$('.hiddenScrollbar').css({ 'visibility': 'visible' })
		$('body').css({
			'overflow-y': 'scroll',
		})
		$('html').css({
			'overflow-y': 'hidden',
		})

		$('.header').css({
			'width': "calc(100% - " + $.position.scrollbarWidth() + "px)",
			'transition': 'all 0s'
		})
		$('.svgContainer').css('padding-right', '' + $.position.scrollbarWidth() + 'px')

		// returnBackInterval = setInterval(function(){
		// 	$(document).scrollTop(lastScrollPosition);
		// })


		canScrolling = false
	}



	function continueScrolling() {
		canScrolling = true
		$('.hiddenScrollbar').css({ 'visibility': 'hidden' })
		$('.svgContainer').css('padding-right', '0')
		$('body').css({
			'overflow-y': 'hidden'
		})
		$('html').css({
			'overflow-y': 'scroll'
		})


		$('.header').css({
			'width': "100%",
			'transition': 'all 0s'
		})

		// clearInterval(returnBackInterval)
	}




	var returnBackInterval


	// document.addEventListener('scroll', scrollHandling, { passive: false });

	document.addEventListener('scroll', scrollHandling, { passive: false })

	document.addEventListener('mousewheel', scrollHandling, { passive: false })





	var scrollNotAvailable = false;



	var isAnimated = false

	// if (window.addEventListener) window.addEventListener('DOMMouseScroll', wheel, false);
	// window.onmousewheel = document.onmousewheel = wheel;

	// function wheel(event) {


	// 		var delta = 0;
	// 		if (event.wheelDelta) delta = event.wheelDelta / 120;
	// 		else if (event.detail) delta = -event.detail / 3;

	// 		handle(delta);

	// 		if (event.preventDefault) event.preventDefault();
	// 		event.returnValue = false;

	// }

	// function handle(delta) {
	// 	var time = 0;
	// 	var distance = 300;

	// 	$('html, body').stop().animate({
	// 		scrollTop: lastScrollPosition
	// 	}, time);
	// }
	function wheel(event) {
		var delta = 0;
		if (event.wheelDelta) { (delta = event.wheelDelta / 120); }
		else if (event.detail) { (delta = -event.detail / 3); }


		// console.log($('html:animated , body:animated'))
		// if(!$('html:animated , body:animated')){

		handle(delta);
		// }
		if (event.preventDefault) { (event.preventDefault()); }
		event.returnValue = false;
	}


	var scrollIsAnimated = false;
	var freeScrolling = false
	function handle(delta) {

		var time = 200;
		var distance = 350;

		if ($(window).scrollTop() + distance > firstBreackpointPositionOnTop && needToStop1) {
			distance -= ($(window).scrollTop() + distance) - firstBreackpointPositionOnTop;
			distance < 0 ? distance = 0 : null;
		} else if ($(window).scrollTop() + distance > secendBreackpointPositionOnTop && needToStop2) {
			distance -= ($(window).scrollTop() + distance) - secendBreackpointPositionOnTop;
			distance < 0 ? distance = 0 : null;
		} else if ($(window).scrollTop() + distance > thirdBreackpointPositionOnTop && needToStop3) {
			distance -= ($(window).scrollTop() + distance) - thirdBreackpointPositionOnTop;
			distance < 0 ? distance = 0 : null;
		} else if ($(window).scrollTop() + distance > forthBreackpointPositionOnTop && needToStop4) {
			distance -= ($(window).scrollTop() + distance) - forthBreackpointPositionOnTop;
			distance < 0 ? distance = 0 : null;

			freeScrolling = true;

		}

		if (!scrollIsAnimated) {
			scrollIsAnimated = true
			$('html, body').stop().animate({
				scrollTop: canScrolling ? $(window).scrollTop() - (distance * delta) : lastScrollPosition
			}, time, function () {

				scrollIsAnimated = false
			});
		}



		if (freeScrolling && $(window).scrollTop() >= forthBreackpointPositionOnTop) {


			window.removeEventListener('mousewheel', wheel, false)
			document.removeEventListener('mousewheel', wheel, false)
		}
	}


	window.addEventListener('mousewheel', wheel, { passive: false })
	document.addEventListener('mousewheel', wheel, { passive: false })

	var isFirstStep = true;

	// $(document).scrollDistenceLimit
	$(window).scroll(scrollHandling)

	function scrollHandling(e) {




		slowAnimate();


		if ($('html').css('overflow-y') == 'hidden') {
			e.returnValue = false; /* IE */
			e.stopImmediatePropagation();

			$('.hiddenScrollbar').scrollTop(lastScrollPosition);
			$(document).scrollTop(lastScrollPosition);

			// $('html').stop().animate({
			// 	scrollTop: lastScrollPosition
			// }, 0);



			if (!e) { e = window.event; } /* IE7, IE8, Chrome, Safari */
			// if (e.preventDefault) { e.preventDefault(); } /* Chrome, Safari, Firefox */


			return


		}


		$('.hiddenScrollbar').scrollTop($(document).scrollTop())


		// 




		// stop on breackpoints posiutions

		var scrollingFromTop = isScrollingToTop()
		// gallery  tour  
		if (scrollingFromTop) {

			if ($(document).scrollTop() >= firstBreackpointPositionOnTop && needToStop1) {


				scrollNotAvailable = true

				lastScrollPosition = firstBreackpointPositionOnTop

				stopScrolling()

				$('.hiddenScrollbar').scrollTop(firstBreackpointPositionOnTop)

				$(document).scrollTop(firstBreackpointPositionOnTop)

				$(".about").css({

					'opacity': 1
				})
				setTimeout(function () {
					$("#firstBreackpoint").attr('r', 65)
					$("#firstBreackpoint").attr('transform', ($("#dot").attr('transform')))
				}, 100)



				setTimeout(function () {

					needToStop1 = false;
					needToStop2 = true;
					needToStop3 = false;
					needToStop4 = false;

					continueScrolling()
					scrollNotAvailable = false;

				}, 500)
				// e.stopImmediatePropagation()
				// e.preventDefault()


			} else if ($(document).scrollTop() >= secendBreackpointPositionOnTop && needToStop2) {
				scrollNotAvailable = true
				$(document).scrollTop(secendBreackpointPositionOnTop)

				lastScrollPosition = secendBreackpointPositionOnTop
				stopScrolling()
				// $('.hiddenScrollbar').scrollTop(secendBreackpointPositionOnTop)


				setTimeout(function () {
					$("#secendBreackpoint").attr('r', 65)
					$("#secendBreackpoint").attr('transform', ($("#dot").attr('transform')))
				}, 100)

				setTimeout(function () {
					needToStop1 = false;
					needToStop2 = false;
					needToStop3 = true;
					needToStop4 = false;
					continueScrolling()
					scrollNotAvailable = false
				}, 500)
				// e.stopImmediatePropagation()
				// e.preventDefault()

			}
			else if ($(document).scrollTop() >= thirdBreackpointPositionOnTop && needToStop3) {
				scrollNotAvailable = true
				$('.hiddenScrollbar').scrollTop(thirdBreackpointPositionOnTop)
				$(document).scrollTop(thirdBreackpointPositionOnTop)

				lastScrollPosition = thirdBreackpointPositionOnTop

				stopScrolling()


				setTimeout(function () {
					$("#thirdBreackpoint").attr('r', 65)
					$("#thirdBreackpoint").attr('transform', ($("#dot").attr('transform')))
				}, 10)

				$(".tour").css({ 'opacity': '1' })

				$(".gallery ").addClass('galleryShow')

				console.log(1)
				$(".gallery ").css({ 'opacity': '1' })

				setTimeout(function () {
					needToStop1 = false;
					needToStop2 = false;
					needToStop3 = false;
					needToStop4 = true;
					continueScrolling()
					scrollNotAvailable = false
				}, 500)
				// e.stopImmediatePropagation()
				// e.preventDefault()


			} else if ($(document).scrollTop() >= forthBreackpointPositionOnTop && needToStop4) {
				scrollNotAvailable = true
				$('.hiddenScrollbar').scrollTop(forthBreackpointPositionOnTop)
				lastScrollPosition = forthBreackpointPositionOnTop;
				$(document).scrollTop(forthBreackpointPositionOnTop)
				stopScrolling()
				$('.unicue_services_content').css({ 'opacity': '1', 'margin-right': '0' })

				setTimeout(function () {
					$("#fordBreackpoint").attr('r', 65)
					$("#fordBreackpoint").attr('transform', ($("#dot").attr('transform')))
				}, 100)

				setTimeout(function () {
					needToStop1 = false;
					needToStop2 = false;
					needToStop3 = false;
					needToStop4 = false;
					continueScrolling()
					scrollNotAvailable = false
				}, 500)
				// e.stopImmediatePropagation()
				// e.preventDefault()

			}
			if (globusPosition && document.getElementById('secend_path').getTotalLength() <= globusPosition) {
				$("#lastBreackpoint").attr('r', 75)
				$('.animated').removeClass('testimonialsAnimation')
			}

			if ($(document).scrollTop() >= secendBreackpointPositionOnTop && needToStop2 && !isItAnimated) {
				countEfect(true)
				isItAnimated = true
			}


		}



		// scrolling from
		// isScrollingToTop()


		var $nav = $(".navigation");
		$nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());

		//drowing path 
		var dashedLength = Math.ceil(+document.getElementById('first_path').style.strokeDasharray.split(",")[0])
		var firstPathLength = Math.ceil(document.getElementById('first_path').getTotalLength());



		if ($(this).scrollTop() < changePath) {
			drawLine($(document),
				document.getElementById('first_path'));
		} else {
			drawLine($(document),
				document.getElementById('secend_path'));
		}

		positionTheDot($(this).scrollTop())




		//globus position 



	}
	// init the line length
	drawLine($(document),
		document.getElementById('first_path'));

	drawLine($(document),
		document.getElementById('secend_path'));

	//draw the line




	function drawLine(container, line, plasLnegth) {
		// animateLineDrowing = animateLineDrowing || false

		// console.log(plasLnegth)
		if (plasLnegth != undefined && plasLnegth > 0) {
			plasLnegth = plasLnegth
		} else {

			plasLnegth = ($(window).width() < 1281) ? 2200 : 2000;
		}
		if ($(this).scrollTop() <= changePath) {
			var pathLength = line.getTotalLength(),
				maxScrollTop = $(document).height() - $(window).height(),
				percentDone = $(window).scrollTop() / maxScrollTop,
				length = (percentDone * pathLength) / 0.35 + plasLnegth;
			line.style.strokeDasharray = [length, pathLength].join(' ');

			document.getElementById('secend_path').style.strokeDasharray = [0, document.getElementById('first_path').getTotalLength()].join(' ');
		} else {

			var pathLength = line.getTotalLength(),
				maxScrollTop = $(document).height() - $(window).height(),
				percentDone = $(window).scrollTop() / maxScrollTop,
				length = (percentDone * pathLength) / 0.45 - pathMinusPosition;
			line.style.strokeDasharray = [length, pathLength].join(' ');

			// console.log(length)

			document.getElementById('first_path').style.strokeDasharray =
				[document.getElementById('first_path').getTotalLength()
					, document.getElementById('first_path').getTotalLength()].join(' ');
		}

	}




	var dot = document.getElementById("dot");
	var dotBackground = document.getElementById("circl")




	function setBreackpointsPositions() {
		var firstBreackpoint = document.getElementById("firstBreackpoint")
		var firstPath = document.getElementById("first_path_background");
		var firstBreackpointPosition = firstPath.getPointAtLength(3690);
		firstBreackpoint.setAttribute("transform", "translate(" +
			firstBreackpointPosition.x + "," +
			firstBreackpointPosition.y + ")");






		var SecendPath = document.getElementById("secend_path_background");

		var secendBreackpoint = document.getElementById("secendBreackpoint")
		var secendBreackpointPosition = SecendPath.getPointAtLength(
			$(window).width() >= 1282 ? 600 : 700);

		secendBreackpoint.setAttribute("transform", "translate(" +
			secendBreackpointPosition.x + "," +
			secendBreackpointPosition.y + ")");


		// thirdBreackpoint
		var thirdBreackpoint = document.getElementById("thirdBreackpoint")
		var tbp = $(window).width() >= 1282 ? 2300 : 2400
		var thirdBreackpointPosition = SecendPath.getPointAtLength(tbp);


		thirdBreackpoint.setAttribute("transform", "translate(" +
			thirdBreackpointPosition.x + "," +
			thirdBreackpointPosition.y + ")");




		// 4 breackpoint 
		var fordBreackpoint = document.getElementById("fordBreackpoint")
		var tbp = $(window).width() >= 1282 ? 4500 : 4650
		if ($(window).width() < 1071) {
			tbp = 5500
		}
		var fordbreackpointPosition = SecendPath.getPointAtLength(tbp);


		fordBreackpoint.setAttribute("transform", "translate(" +
			fordbreackpointPosition.x + "," +
			fordbreackpointPosition.y + ")");




		var lastBreackpoint = document.getElementById("lastBreackpoint")
		var lastBreackpointPosition = SecendPath.getPointAtLength(
			90000);

		lastBreackpoint.setAttribute("transform", "translate(" +
			lastBreackpointPosition.x + "," +
			lastBreackpointPosition.y + ")");


	}

	setBreackpointsPositions()

	// ////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	function positionTheDot(scrollTopPixel, plasLnegth) {

		// What percentage down the page are we? 
		var scrollPercentage = (document.documentElement.scrollTop + document.body.scrollTop) / (document.documentElement.scrollHeight - document.documentElement.clientHeight);
		// SVGRoadInstance.setStrokeDasharrayInPercent(+scrollPercentage);
		// Get path length]
		if (plasLnegth != undefined && plasLnegth > 0) {
			plasLnegth = plasLnegth
		} else {

			plasLnegth = ($(window).width() < 1281) ? 2200 : 2000;
		}

		if (scrollTopPixel <= changePath) {
			var path = document.getElementById("first_path_background");
			var pathLen = path.getTotalLength();

			globusPosition = (scrollPercentage * pathLen) / 0.35 + plasLnegth
			// Get the position of a point at <scrollPercentage> along the path.
			var pt = path.getPointAtLength((scrollPercentage * pathLen) / 0.35 + plasLnegth);
			// Position the globus dot at this point
		} else {
			var path = document.getElementById("secend_path_background");
			var pathLen = path.getTotalLength();

			// Get the position of a point at <scrollPercentage> along the path.

			globusPosition = Math.ceil((scrollPercentage * pathLen) / 0.45 - pathMinusPosition + 24)
			var pt = path.getPointAtLength((scrollPercentage * pathLen) / 0.45 - pathMinusPosition + 24);
		}

		var dotWidth = 1


		if ($(window).width() < 1360) {
			dotWidth = 1.1
		}
		// if($(window).width() < 1200){
		// 	dotWidth = 1.2
		// }
		if ($(window).width() < 1200) {
			dotWidth = 1.2
		}
		if ($(window).width() < 1160) {
			dotWidth = 1.3
		}

		dot.setAttribute("transform", "translate(" + pt.x + "," + pt.y + ")  scale(" + dotWidth + " , 1) ");


		// dotBackground.setAttribute("style", "transform:translate(" + pt.x + "px," + pt.y + "px)")
		if (globusPosition && document.getElementById('secend_path').getTotalLength() <= globusPosition) {
			$("#lastBreackpoint").attr('r', 75)
			$('.animated').removeClass('testimonialsAnimation')
			// $('.animated').css('transition','all 0s linear')
		}

	};

	// Set the initial position of the dot.
	positionTheDot($(window).scrollTop());

	// __________________________ drowing line animatin on first time _____________________________

	if ($(document).scrollTop() < 2) {




		var startPosition = ($(window).width() < 1281) ? 2200 : 2000;
		var linePosition = 1;
		drawLine(
			$(document),
			document.getElementById('first_path'),
			linePosition
		);

		positionTheDot($(this).scrollTop(), startPosition)
		positionTheDot($(this).scrollTop(), linePosition)
		$('.svgContainer').css('opacity', '1')
		setTimeout(function () {
			$('#dot').css({ 'r': '35' })
			var animationOnInterval = setInterval(function () {
				drawLine(
					$(document),
					document.getElementById('first_path'),
					linePosition
				);

				linePosition += 15

				positionTheDot($(this).scrollTop(), linePosition)

				if (linePosition >= startPosition) {
					clearInterval(animationOnInterval)
					setTimeout(function () {


						$(".background_container").css({
							backgroundSize: '100% 30%,52vw 16.4vh,40% 10.5%,100% 100% ',
							transition: "background 0s "
						})
						$('.hiddenScrollbar').css('visibility', 'hidden')
						$('html').css({ 'margin-right': '0' })
						$('#headerBlock').css({
							"padding-right": 0,
							'transition': 'all 0s'
						})

						setTimeout(function () {
							$('#headerBlock').css({
								"padding-right": 0,
								'transition': 'all 0.2s'
							})
						}, 100)
						$("html , body").css("overflow-y", "visible")
					}, 100)


				}
			}, 10)
		}, 2550)



	} else {
		$('#dot').css({
			'r': '35',
			'transition': 'r 0s'
		})
	}


}
// ____________________________ animations on mibile time ______________________
var needToAnimateMobile = true
function mobileAnimations() {
	var oTop1 = $(".about").offset().top + $(document).scrollTop()
	oTop1 /= 3

	if ($(document).scrollTop() >= oTop1) {
		$('.about').removeClass('mobileTopAnimation')
	}

	oTop2 = $(".tour").offset().top + $(document).scrollTop()
	oTop2 /= 2.5

	if ($(document).scrollTop() >= oTop2) {
		$('.tour').removeClass('mobileTopAnimation')
		// console.log($(document).scrollTop())
	}
	oTop3 = $(".gallery").offset().top + $(document).scrollTop()
	oTop3 /= 2.5

	if ($(document).scrollTop() >= oTop3 && window.width < 1008) {
		// $('.gallery').css({
		// 	'transform': 'scale(1)'
		// })
		$(".gallery ").addClass('galleryShow')
		$('.gallery').removeClass('mobileTopAnimation')
		// console.log($(document).scrollTop())
	}
	if ($(document).scrollTop() >= oTop3 + 900) {
		$('.unicue_services_content').css({ 'opacity': '1', 'margin-right': '0' })
	}
	// testimonials
	oTop4 = $(".testimonials").offset().top + $(document).scrollTop()
	oTop4 /= 2.1

	if ($(document).scrollTop() >= oTop4) {
		$('.testimonials').removeClass('mobileTopAnimation')
	}

	oTop5 = $('.animated').eq(1).offset().top + $(document).scrollTop()
	oTop5 /= 2.2

	if ($(document).scrollTop() >= oTop5) {
		$('.animated').removeClass('mobileTopAnimation')
	}
	// counting efect on mobile
	oTop6 = $('.achievement').offset().top
	oTop6 -= 200
	if ($(document).scrollTop() >= oTop6 && $(document).width() <= 1008 && needToAnimateMobile) {
		needToAnimateMobile = false
		countEfect(true)
	}

}

$(document).ready(function () {
	$(document).scroll(function () {
		mobileAnimations()
	})
	mobileAnimations()
	//________________________armenia word animation




})