AOS.init({
	duration: 800,
	easing: 'slide'
});

(function ($) {

	"use strict";

	var isMobile = {
		Android: function () {
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry: function () {
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS: function () {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
		Opera: function () {
			return navigator.userAgent.match(/Opera Mini/i);
		},
		Windows: function () {
			return navigator.userAgent.match(/IEMobile/i);
		},
		any: function () {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};


	$(window).stellar({
		responsive: true,
		parallaxBackgrounds: true,
		parallaxElements: true,
		horizontalScrolling: false,
		hideDistantElements: false,
		scrollProperty: 'scroll',
		horizontalOffset: 0,
		verticalOffset: 0
	});


	var fullHeight = function () {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function () {
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	// loader
	var loader = function () {
		setTimeout(function () {
			if ($('#ftco-loader').length > 0) {
				$('#ftco-loader').removeClass('show');
			}
		}, 1);
	};
	loader();

	// Scrollax
	$.Scrollax();

	var carousel = function () {
		$('.carousel-testimony').owlCarousel({
			center: true,
			loop: true,
			items: 1,
			margin: 30,
			stagePadding: 0,
			nav: true,
			navText: ['<span class="ion-ios-arrow-back">', '<span class="ion-ios-arrow-forward">'],
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 1
				},
				1000: {
					items: 1
				}
			}
		});

		$('.slider-carousel').owlCarousel({
			animateOut: 'fadeOut',
			animateIn: 'fadeIn',
			autoplay: true,
			// center: true,
			loop: true,
			items: 1,
			margin: 0,
			stagePadding: 0,
			nav: false,
			dots: false,
			navText: ['<span class="ion-ios-arrow-back">', '<span class="ion-ios-arrow-forward">'],
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 1
				},
				1000: {
					items: 1
				}
			}
		});

	};
	carousel();

	$('nav .dropdown').hover(function () {
		var $this = $(this);
		// 	 timer;
		// clearTimeout(timer);
		$this.addClass('show');
		$this.find('> a').attr('aria-expanded', true);
		// $this.find('.dropdown-menu').addClass('animated-fast fadeInUp show');
		$this.find('.dropdown-menu').addClass('show');
	}, function () {
		var $this = $(this);
		// timer;
		// timer = setTimeout(function(){
		$this.removeClass('show');
		$this.find('> a').attr('aria-expanded', false);
		// $this.find('.dropdown-menu').removeClass('animated-fast fadeInUp show');
		$this.find('.dropdown-menu').removeClass('show');
		// }, 100);
	});


	$('#dropdown04').on('show.bs.dropdown', function () {
		console.log('show');
	});

	// scroll
	var scrollWindow = function () {
		$(window).scroll(function () {
			var $w = $(this),
				st = $w.scrollTop(),
				navbar = $('.ftco_navbar'),
				sd = $('.js-scroll-wrap');

			if (st > 150) {
				if (!navbar.hasClass('scrolled')) {
					console.log("added scrolled");
					navbar.addClass('scrolled');
				}
			}
			if (st < 150) {
				if (navbar.hasClass('scrolled')) {
					console.log("removed scrolled");
					navbar.removeClass('scrolled sleep');
				}
			}
			if (st > 200) {
				if (!navbar.hasClass('awake')) {
					navbar.addClass('awake');
				}

				if (sd.length > 0) {
					sd.addClass('sleep');
				}
			}
			if (st < 200) {
				if (navbar.hasClass('awake')) {
					navbar.removeClass('awake');
					navbar.addClass('sleep');
				}
				if (sd.length > 0) {
					sd.removeClass('sleep');
				}
			}
		});
	};
	scrollWindow();

	var isMobile = {
		Android: function () {
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry: function () {
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS: function () {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
		Opera: function () {
			return navigator.userAgent.match(/Opera Mini/i);
		},
		Windows: function () {
			return navigator.userAgent.match(/IEMobile/i);
		},
		any: function () {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};


	var counter = function () {

		$('#section-counter').waypoint(function (direction) {

			if (direction === 'down' && !$(this.element).hasClass('ftco-animated')) {

				var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',')
				$('.number').each(function () {
					var $this = $(this),
						num = $this.data('number');
					console.log(num);
					$this.animateNumber(
						{
							number: num,
							numberStep: comma_separator_number_step
						}, 7000
					);
				});

			}

		}, { offset: '95%' });

	}
	counter();

	var contentWayPoint = function () {
		var i = 0;
		$('.ftco-animate').waypoint(function (direction) {

			if (direction === 'down' && !$(this.element).hasClass('ftco-animated')) {

				i++;

				$(this.element).addClass('item-animate');
				setTimeout(function () {

					$('body .ftco-animate.item-animate').each(function (k) {
						var el = $(this);
						setTimeout(function () {
							var effect = el.data('animate-effect');
							if (effect === 'fadeIn') {
								el.addClass('fadeIn ftco-animated');
							} else if (effect === 'fadeInLeft') {
								el.addClass('fadeInLeft ftco-animated');
							} else if (effect === 'fadeInRight') {
								el.addClass('fadeInRight ftco-animated');
							} else {
								el.addClass('fadeInUp ftco-animated');
							}
							el.removeClass('item-animate');
						}, k * 50, 'easeInOutExpo');
					});

				}, 100);

			}

		}, { offset: '95%' });
	};
	contentWayPoint();

	// magnific popup
	$('.image-popup').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: false,
		fixedContentPos: true,
		mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			verticalFit: true
		},
		zoom: {
			enabled: true,
			duration: 300 // don't foget to change the duration also in CSS
		}
	});

	$('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
		disableOn: 700,
		type: 'iframe',
		mainClass: 'mfp-fade',
		removalDelay: 160,
		preloader: false,

		fixedContentPos: false
	});


	// TYPEWRITE
	var TxtType = function (el, toRotate, period) {
		this.toRotate = toRotate;
		this.el = el;
		this.loopNum = 0;
		this.period = parseInt(period, 10) || 2000;
		this.txt = '';
		this.tick();
		this.isDeleting = false;
	};

	TxtType.prototype.tick = function () {
		var i = this.loopNum % this.toRotate.length;
		var fullTxt = this.toRotate[i];

		if (this.isDeleting) {
			this.txt = fullTxt.substring(0, this.txt.length - 1);
		} else {
			this.txt = fullTxt.substring(0, this.txt.length + 1);
		}

		this.el.innerHTML = '<span class="wrap">' + this.txt + '</span>';

		var that = this;
		var delta = 200 - Math.random() * 100;

		if (this.isDeleting) { delta /= 2; }

		if (!this.isDeleting && this.txt === fullTxt) {
			delta = this.period;
			this.isDeleting = true;
		} else if (this.isDeleting && this.txt === '') {
			this.isDeleting = false;
			this.loopNum++;
			delta = 500;
		}

		setTimeout(function () {
			that.tick();
		}, delta);
	};

	window.onload = function () {
		var elements = document.getElementsByClassName('typewrite');
		for (var i = 0; i < elements.length; i++) {
			var toRotate = elements[i].getAttribute('data-type');
			var period = elements[i].getAttribute('data-period');
			if (toRotate) {
				new TxtType(elements[i], JSON.parse(toRotate), period);
			}
		}
		// INJECT CSS
		var css = document.createElement("style");
		css.type = "text/css";
		css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
		document.body.appendChild(css);
	};

	// Get the current page URL
	const currentURL = window.location.href;

	// Loop through each navbar item
	$('.navbar-nav .nav-item').each(function () {
		// Get the href of the navbar item
		const itemHref = $(this).find('a').attr('href');

		// Check if the current URL contains the navbar item's href
		if (currentURL.indexOf(itemHref) > -1) {
			// Add the active class to the matching navbar item
			$(this).addClass('active');
		}
	});


	// function changeLogo(src, height, width, color) {
	// 	if ($('.logo-image').attr('src') !== src) {
	// 		$(this).animate({
	// 			opacity: '1'
	// 		}, 1000);
	// 		// $('.logo-image').attr('src', src);
	// 		$('.logo-image').css('height', height);
	// 		// $('.logo-image').css('width', width);
	// 		// $('.ftco-navbar-light .navbar-nav > .nav-item > .nav-link').css('color', color);
	// 	}
	// }

	function moveNavbarBrand() {
		if ($(window).width() < 992) {			
			$('.last-link').children().appendTo('.first-link');
			$('.last-link').hide();
		} 
	}

	moveNavbarBrand();

	// $(window).on('scroll', function () {
	// 	if ($('nav').hasClass('scrolled')) {									
	// 		$('.logo-image').attr('src', 'images/logo/large_black.png');
	// 	} else {			
	// 		$('.logo-image').attr('src', 'images/logo/logo.png');
	// 	}
	// });

	$(document).ready(function () {
		$('#register').hide();
		$('.to-login-button').click(function () {
			$('#register').hide();
			$('#modalRequestLabel').text('Welcome Back');
			$('#login').show();
		});
		$('.to-register-button').click(function () {
			$('#login').hide();
			$('#modalRequestLabel').text('Register');
			$('#register').show();
		});
		$('.bookingButton').click(function () {
			var id = $(this).attr('id');
			var bookingType = id.split("book")[1];
			var splitter = "";
			if (bookingType.indexOf("Service") >= 0) {
				splitter = "Service";
			}
			if (bookingType.indexOf("Event") >= 0) {
				splitter = "Event";
			}
			var bookingId = bookingType.split(splitter)[1];
			window.location.href = "booking-services.php?type="+ splitter +"&id="+bookingId+"";			
		});
	});
	
	$('.bookingForm').submit(function (e){
		e.preventDefault(e);
		var bookFormId = $(this).attr('id');
		var splitter = "";
		if (bookFormId.indexOf("Service") >= 0) {
			splitter = "Service";
		}
		if (bookFormId.indexOf("Event") >= 0) {
			splitter = "Event";
		}
		var bookingId = bookFormId.split(splitter)[1];		
		var formData = new FormData(this);
		formData.append("bookingType", splitter);
		formData.append("id", bookingId);		
		$.ajax({
			url: "database/booking.php",
			type: "POST",
			data: formData,
			cache: false,
			processData: false,     
			contentType: false,
			success: function(result) {
				console.log(result);
				var data = JSON.parse(result);
				if (data.statusCode == 200) {
					//order placed succesfully
					toastr.success('Booking placed successfully.', 'Booking Placement!');
					$(this).delay(2000).queue(function(next) {
						window.location.href = "booking-history.php";
						next();
					});
				} else if (data.statusCode == 201) {
					toastr.error('Booking placing failed. Please try again.', 'Booking Placement!');					
				}
				else if (data.statusCode == 202) {
					toastr.success('Booking placing successfully. But failed to send email notification. Please update your email address', 'Booking Placement');
					$(this).delay(2000).queue(function(next) {
						window.location.href = "booking-history.php";
						next();
					});
				}
			}
		});
	});

	var gallery = document.querySelector('#gallery');
	var getVal = function (elem, style) { return parseInt(window.getComputedStyle(elem).getPropertyValue(style)); };
	var getHeight = function (item) { return item.querySelector('.content').getBoundingClientRect().height; };
	var resizeAll = function () {
		var altura = getVal(gallery, 'grid-auto-rows');
		var gap = getVal(gallery, 'grid-row-gap');
		gallery.querySelectorAll('.gallery-item').forEach(function (item) {
			var el = item;
			el.style.gridRowEnd = "span " + Math.ceil((getHeight(item) + gap) / (altura + gap));
		});
	};
	gallery.querySelectorAll('img').forEach(function (item) {
		item.classList.add('byebye');
		if (item.complete) {
			console.log(item.src);
		}
		else {
			item.addEventListener('load', function () {
				var altura = getVal(gallery, 'grid-auto-rows');
				var gap = getVal(gallery, 'grid-row-gap');
				var gitem = item.parentElement.parentElement;
				gitem.style.gridRowEnd = "span " + Math.ceil((getHeight(gitem) + gap) / (altura + gap));
				item.classList.remove('byebye');
			});
		}
	});
	window.addEventListener('resize', resizeAll);	
    
        Fancybox.bind('[data-fancybox="gallery"]', {
            //
            on: {
                init: () => {
                    console.log('Fancybox has started initializing');
                    // Your code here...
                    const header = document.querySelector('nav');

// Remove the 'position: fixed' attribute from the header
header.style.position = 'static';
                },
                destroy: (fancybox) => {
                    console.log('Fancybox was destroyed!');
                    const header = document.querySelector('nav');
// Add the 'position: fixed' attribute back to the header
header.style.position = 'fixed';
                },
            }
        });    

		gallery.querySelectorAll('.gallery-item').forEach(function (item) {
			item.addEventListener('click', function () {        
				item.classList.toggle('full');        
			});
		});

})(jQuery);

