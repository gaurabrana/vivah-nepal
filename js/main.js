AOS.init({
	duration: 1500,
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
// scroll
var scrollWindow = function () {
	$(window).scroll(function () {
	  var $w = $(this),
		st = $w.scrollTop(),
		lastScrollTop = 0,
		navbar = $('.ftco_navbar'),
		sd = $('.js-scroll-wrap'),
		hero = $('.hero-wrap');
  
	  if (st > 300) {
		if (!navbar.hasClass('scrolled')) {
		  navbar.addClass('scrolled');
		}
	  }
	  if (st < 300) {
		if (navbar.hasClass('scrolled')) {
		  navbar.removeClass('scrolled sleep');
		}
	  }
	  if (!navbar.hasClass('scrolled')) {
		if (st > 400) {
		  if (!navbar.hasClass('awake')) {
			navbar.addClass('awake');
		  }
  
		  if (sd.length > 0) {
			sd.addClass('sleep');
		  }
  
		  if (hero.length > 0) {
			if (st > lastScrollTop) {
			  hero.css('background-position', 'center ' + (-st/3) + 'px');
			} else {
			  hero.css('background-position', 'center 0');
			}
			lastScrollTop = st;
		  }
		}
		if (st < 400) {
		  if (navbar.hasClass('awake')) {
			navbar.removeClass('awake');
			navbar.addClass('sleep');
		  }
		  if (sd.length > 0) {
			sd.removeClass('sleep');
		  }
		  if (hero.length > 0) {
			hero.css('background-position', 'center 0');
		  }
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

	$("#highlightedEventPopup").click(function (){
		
	});



	function moveNavbarBrand() {
		if ($(window).width() < 992) {
			$('.last-link').children().appendTo('.first-link');
			$('.last-link').hide();
		}
	}

	moveNavbarBrand();


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
			window.location.href = "booking-services.php?type=" + splitter + "&id=" + bookingId + "";
		});
	});

	$('.bookingForm').submit(function (e) {
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
		var fromDate = new Date(bookingFrom.value);
      var toDate = new Date(bookingTo.value);

      if (toDate < fromDate) {
        toastr.error('The to date should be the same as or later than the from date.', 'Booking!');        
		return;
      }
		// Show overlay
		$('#overlay').show();
		$.ajax({
			url: "database/booking.php",
			type: "POST",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function (result) {
				console.log(result);
				var data = JSON.parse(result);
				if (data.code == 200) {
					//order placed succesfully
					toastr.success('Booking placed successfully.', 'Booking Placement!');
					$(this).delay(2000).queue(function (next) {
						window.location.href = "booking-history.php";
						next();
					});
				} else if (data.code == 201) {
					toastr.error('Booking placing failed. Please try again.', 'Booking Placement!');
				}
				else if (data.code == 202) {
					toastr.success('Booking placing successfully. But failed to send email notification. Please update your email address', 'Booking Placement');
					$(this).delay(2000).queue(function (next) {
						window.location.href = "booking-history.php";
						next();
					});
				}
			},
			complete: function () {
      // Hide overlay
      $('#overlay').hide();
    }
		});
	});


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

	$(".img-wrapper").hover(
		function () {
			$(this).find(".img-overlay").animate({ opacity: 1 }, 600);
		}, function () {
			$(this).find(".img-overlay").animate({ opacity: 0 }, 600);
		}
	);

	flipGallery();
	function flipGallery() {
		$('.flip-gallery > div.active').siblings('div').children().css('opacity', '0');
		//for mobiles
		$('.flip-gallery .filter').click(function () {

			if ($(this).hasClass('open')) {
				fgSetFilter();

			}
			else {
				var $size = $(this).siblings().size() * 32;
				$('.flip-gallery .tab-titles').css('height', $size + 'px');
				$('.flip-gallery').css('padding-top', ($size + 20) + 'px');
				$(this).addClass('open')
			}
		});

		//action of tab click
		$('.flip-gallery .tab-titles span:not(.filter)').click(function () {
			if ($(this).hasClass('active')) {
				return;
			}
			fgSetFilter(); $(this).addClass('active').siblings().removeClass('active');
			var index = $(this).index() - 1;

			$('.flip-gallery > div.active').animate({
				opacity: 0
			}, 100, function () {
				// Animation complete.

				$('.flip-gallery > div.active').slideToggle().removeClass('active');
				$('.flip-gallery > div').eq(index).slideToggle().addClass('active');
				$('.flip-gallery > div.active > div:first-child').addClass('current');
				$('.flip-gallery > div.active').siblings('div').children().css('opacity', '0');
				fadeInItems();
			});

		});
	}
	function fgSetFilter() {
		$('.flip-gallery .tab-titles').removeAttr('style');
		$('.flip-gallery .filter').removeClass('open');
		$('.flip-gallery').removeAttr('style');
	}
	function fadeInItems() {

		if ($('.flip-gallery > .active').find('.current').length == 0) {
			$('.flip-gallery > div.active').siblings('div').css('opacity', '1');
			return;
		}
		$('.flip-gallery > .active .current').animate({
			opacity: 1
		}, 300, function () {
			$('.flip-gallery > .active .current').removeClass('current').next().addClass('current');
			fadeInItems();
		});
	}

	$('#highlightedEventPopup .close').on('click', function () {
		// Set a cookie for 30 minutes
		var date = new Date();
		date.setTime(date.getTime() + (30 * 60 * 1000));
		document.cookie = 'close_clicked=true; expires=' + date.toUTCString() + '; path=/';
	});

	var cookieName = 'close_clicked';
	var cookieValue = '';

	// Split the document.cookie string into individual cookies
	var cookies = document.cookie.split(';');
	for (var i = 0; i < cookies.length; i++) {
		var cookie = cookies[i].trim();

		// Check if the current cookie matches the desired cookie name
		if (cookie.indexOf(cookieName + '=') === 0) {
			// Extract the cookie value
			cookieValue = cookie.substring(cookieName.length + 1);
			break;
		}
	}

	// Use the cookie value as needed
	if (cookieValue === 'true') {
	} else {
		$(document).ready(function () {
			var demoButton = $('#demoButton');
			if (demoButton.length > 0) {
				demoButton.click();
			}
		});
	}
	  

})(jQuery);

