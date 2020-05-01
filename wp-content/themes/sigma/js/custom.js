/*
 *
 *		CUSTOM.JS
 *
 */

(function(window) {
	'use strict';

	var Waves = Waves || {};
	var $$ = document.querySelectorAll.bind(document);

	// Find exact position of element
	function isWindow(obj) {
		return obj !== null && obj === obj.window;
	}

	function getWindow(elem) {
		return isWindow(elem) ? elem : elem.nodeType === 9 && elem.defaultView;
	}

	function offset(elem) {
		var docElem, win,
			box = {top: 0, left: 0},
			doc = elem && elem.ownerDocument;

		docElem = doc.documentElement;

		if (typeof elem.getBoundingClientRect !== typeof undefined) {
			box = elem.getBoundingClientRect();
		}
		win = getWindow(doc);
		return {
			top: box.top + win.pageYOffset - docElem.clientTop,
			left: box.left + win.pageXOffset - docElem.clientLeft
		};
	}

	function convertStyle(obj) {
		var style = '';

		for (var a in obj) {
			if (obj.hasOwnProperty(a)) {
				style += (a + ':' + obj[a] + ';');
			}
		}

		return style;
	}

	var Effect = {

		// Effect delay
		duration: 750,

		show: function(e, element) {

			// Disable right click
			if (e.waves === 2) {
				return false;
			}

			var el = element || this;

			// Create ripple
			var ripple = document.createElement('div');
			ripple.className = 'waves-ripple';
			el.appendChild(ripple);

			// Get click coordinate and element witdh
			var pos	 = offset(el);
			var relativeY   = (e.pageY - pos.top);
			var relativeX   = (e.pageX - pos.left);
			var scale       = 'scale('+((el.clientWidth / 100) * 15)+')';

			// Support for touch devices
			if ('touches' in e) {
				relativeY   = (e.touches[0].pageY - pos.top);
				relativeX   = (e.touches[0].pageX - pos.left);
			}

			// Attach data to element
			ripple.setAttribute('data-hold', Date.now());
			ripple.setAttribute('data-scale', scale);
			ripple.setAttribute('data-x', relativeX);
			ripple.setAttribute('data-y', relativeY);

			// Set ripple position
			var rippleStyle = {
				'top': relativeY+'px',
				'left': relativeX+'px'
			};

			ripple.className = ripple.className + ' waves-notransition';
			ripple.setAttribute('style', convertStyle(rippleStyle));
			ripple.className = ripple.className.replace('waves-notransition', '');

			// Scale the ripple
			rippleStyle['-webkit-transform'] = scale;
			rippleStyle['-moz-transform'] = scale;
			rippleStyle['-ms-transform'] = scale;
			rippleStyle['-o-transform'] = scale;
			rippleStyle.transform = scale;
			rippleStyle.opacity   = '1';

			rippleStyle['-webkit-transition-duration'] = Effect.duration + 'ms';
			rippleStyle['-moz-transition-duration']    = Effect.duration + 'ms';
			rippleStyle['-o-transition-duration']      = Effect.duration + 'ms';
			rippleStyle['transition-duration']	 = Effect.duration + 'ms';

			rippleStyle['-webkit-transition-timing-function'] = 'cubic-bezier(0.250, 0.460, 0.450, 0.940)';
			rippleStyle['-moz-transition-timing-function']    = 'cubic-bezier(0.250, 0.460, 0.450, 0.940)';
			rippleStyle['-o-transition-timing-function']      = 'cubic-bezier(0.250, 0.460, 0.450, 0.940)';
			rippleStyle['transition-timing-function']	 = 'cubic-bezier(0.250, 0.460, 0.450, 0.940)';

			ripple.setAttribute('style', convertStyle(rippleStyle));
		},

		hide: function(e) {
			TouchHandler.touchup(e);

			var el = this;
			var width = el.clientWidth * 1.4;

			// Get first ripple
			var ripple = null;
			var ripples = el.getElementsByClassName('waves-ripple');
			if (ripples.length > 0) {
				ripple = ripples[ripples.length - 1];
			} else {
				return false;
			}

			var relativeX   = ripple.getAttribute('data-x');
			var relativeY   = ripple.getAttribute('data-y');
			var scale       = ripple.getAttribute('data-scale');

			// Get delay beetween mousedown and mouse leave
			var diff = Date.now() - Number(ripple.getAttribute('data-hold'));
			var delay = 350 - diff;

			if (delay < 0) {
				delay = 0;
			}

			// Fade out ripple after delay
			setTimeout(function() {
				var style = {
					'top': relativeY+'px',
					'left': relativeX+'px',
					'opacity': '0',

					// Duration
					'-webkit-transition-duration': Effect.duration + 'ms',
					'-moz-transition-duration': Effect.duration + 'ms',
					'-o-transition-duration': Effect.duration + 'ms',
					'transition-duration': Effect.duration + 'ms',
					'-webkit-transform': scale,
					'-moz-transform': scale,
					'-ms-transform': scale,
					'-o-transform': scale,
					'transform': scale,
				};

				ripple.setAttribute('style', convertStyle(style));

				setTimeout(function() {
					try {
						el.removeChild(ripple);
					} catch(e) {
						return false;
					}
				}, Effect.duration);
			}, delay);
		},

		// Little hack to make <input> can perform waves effect
		wrapInput: function(elements) {
			for (var a = 0; a < elements.length; a++) {
				var el = elements[a];

				if (el.tagName.toLowerCase() === 'input') {
					var parent = el.parentNode;

					// If input already have parent just pass through
					if (parent.tagName.toLowerCase() === 'i' && parent.className.indexOf('waves') !== -1) {
						continue;
					}

					// Put element class and style to the specified parent
					var wrapper = document.createElement('i');
					wrapper.className = el.className + ' waves-input-wrapper';

					var elementStyle = el.getAttribute('style');

					if (!elementStyle) {
						elementStyle = '';
					}

					wrapper.setAttribute('style', elementStyle);

					el.className = 'waves-waves-input';
					el.removeAttribute('style');

					// Put element as child
					parent.replaceChild(wrapper, el);
					wrapper.appendChild(el);
				}
			}
		}
	};


	/**
	 * Disable mousedown event for 500ms during and after touch
	 */
	var TouchHandler = {
		
		touches: 0,
		allowEvent: function(e) {
			var allow = true;

			if (e.type === 'touchstart') {
				TouchHandler.touches += 1; //push
			} else if (e.type === 'touchend' || e.type === 'touchcancel') {
				setTimeout(function() {
					if (TouchHandler.touches > 0) {
						TouchHandler.touches -= 1; //pop after 500ms
					}
				}, 500);
			} else if (e.type === 'mousedown' && TouchHandler.touches > 0) {
				allow = false;
			}

			return allow;
		},
		touchup: function(e) {
			TouchHandler.allowEvent(e);
		}
	};


	
	function getWavesEffectElement(e) {
		if (TouchHandler.allowEvent(e) === false) {
			return null;
		}

		var element = null;
		var target = e.target || e.srcElement;

		while (target.parentElement !== null) {
			if (!(target instanceof SVGElement) && target.className.indexOf('waves') !== -1) {
				element = target;
				break;
			} else if (target.classList.contains('waves')) {
				element = target;
				break;
			}
			target = target.parentElement;
		}

		return element;
	}

	/**
	 * Bubble the click and show effect if .waves elem was found
	 */
	function showEffect(e) {
		var element = getWavesEffectElement(e);

		if (element !== null) {
			Effect.show(e, element);

			if ('ontouchstart' in window) {
				element.addEventListener('touchend', Effect.hide, false);
				element.addEventListener('touchcancel', Effect.hide, false);
			}

			element.addEventListener('mouseup', Effect.hide, false);
			element.addEventListener('mouseleave', Effect.hide, false);
		}
	}

	Waves.displayEffect = function(options) {
		options = options || {};

		if ('duration' in options) {
			Effect.duration = options.duration;
		}

		//Wrap input inside <i> tag
		Effect.wrapInput($$('.waves'));

		if ('ontouchstart' in window) {
			document.body.addEventListener('touchstart', showEffect, false);
		}

		document.body.addEventListener('mousedown', showEffect, false);
	};

	
	Waves.attach = function(element) {
		
		if (element.tagName.toLowerCase() === 'input') {
			Effect.wrapInput([element]);
			element = element.parentElement;
		}

		if ('ontouchstart' in window) {
			element.addEventListener('touchstart', showEffect, false);
		}

		element.addEventListener('mousedown', showEffect, false);
	};

	window.Waves = Waves;

	document.addEventListener('DOMContentLoaded', function() {
		Waves.displayEffect();
	}, false);

})(window);

(function($){

	"use strict";

	// DETECT TOUCH DEVICE //
	function is_touch_device() {
		return !!('ontouchstart' in window) || ( !! ('onmsgesturechange' in window) && !! window.navigator.maxTouchPoints);
	}

	// PAGE LOADER //
        function page_loader() {

                var hash = window.location.hash;

                $(".loader").delay(500).fadeOut();
                $("#page-loader").delay(200).fadeOut("slow");

                if(!hash) {

                } else {
                        $(document).scrollTop( $(hash).offset().top);
                }
        }


	// SHOW/HIDE MOBILE MENU //
	function show_hide_mobile_menu() {

		$(".mobile-menu-button").on("click", function(e) {

			e.preventDefault();
			e.stopPropagation();

			$("#mobile-menu").toggleClass("open");
			$('body').toggleClass("body-overlay");

		});

		$("body").on("click", function() {
			if ($("#mobile-menu").hasClass("open")) {
				$("#mobile-menu").removeClass("open");
				$('body').removeClass("body-overlay");
			}
		});

	}


	// MOBILE MENU //
	function mobile_menu() {

		if ($(window).width() < 992) {

			if ($("#menu").length < 1) {

				$("#header").append('<ul id="menu" class="menu-2">');

				$("#menu-left").clone().children().appendTo($("#menu"));
				$("#menu-right").clone().children().appendTo($("#menu"));

			}

			if ($("#menu").length > 0) {

				if ($("#mobile-menu").length < 1) {

					$("#menu").clone().attr({
						id: "mobile-menu",
						class: ""
					}).insertAfter("#header");

					$("#mobile-menu > li > a").addClass("waves");

					$("#mobile-menu li").each(function() {

						if ($(this).hasClass('dropdown') || $(this).hasClass('megamenu')) {
							$(this).append('<span class="arrow"></span>');
						}

					});

					$("#mobile-menu .megamenu .arrow").on("click", function(e) {

						e.preventDefault();
						e.stopPropagation();

						$(this).toggleClass("open").prev("div").slideToggle(300);

					});

					$("#mobile-menu .dropdown .arrow").on("click", function(e) {

						e.preventDefault();
						e.stopPropagation();

						$(this).toggleClass("open").prev("ul").slideToggle(300);

					});

				}

			}

		} else {

			$("#mobile-menu").removeClass("open");
			$(".menu-2").hide();
			$('body').removeClass("body-overlay");

		}

	}


	// STICKY //
	function sticky() {

		var sticky_point = 155;
		var sticky_logo = $('.sticky-logo').attr('data-sticky-logo');

		$("#header").clone().attr({
			id: "header-sticky",
			class: ""
		}).insertAfter("header");
		
			$("#header-sticky #logo img").attr("src", sticky_logo);
			
		$(window).scroll(function(){

			if ($(window).scrollTop() > sticky_point) {
				$("#header-sticky").slideDown(300).addClass("header-sticky");
				$("#header .menu ul, #header .menu .megamenu-container").css({"visibility": "hidden"});
			} else {
				$("#header-sticky").slideUp(100).removeClass("header-sticky");
				$("#header .menu ul, #header .menu .megamenu-container").css({"visibility": "visible"});
			}

		});

	}


	// PROGRESS BARS //
	function progress_bars() {

		$(".progress .progress-bar:in-viewport").each(function() {

			if (!$(this).hasClass("animated")) {
				$(this).addClass("animated");
				$(this).animate({
					width: $(this).attr("data-width") + "%"
				}, 2000);
			}

		});

	}


	// CHARTS //
	function pie_chart() {

		if (typeof $.fn.easyPieChart !== 'undefined') {

			$(".pie-chart:in-viewport").each(function() {

				$(this).easyPieChart({
					animate: 1500,
					lineCap: "square",
					lineWidth: $(this).attr("data-line-width"),
					size: $(this).attr("data-size"),
					barColor: function(percent) {
						var gradient_start = "#26d0ce";
						var gradient_stop = "#1a2980";
						var ctx = this.renderer.getCtx();
						var canvas = this.renderer.getCanvas();
						var gradient = ctx.createLinearGradient(0,0,canvas.width,0);
						gradient.addColorStop(0, gradient_start);
						gradient.addColorStop(0.5, gradient_stop);
						return gradient;
					},
					trackColor: $(this).attr("data-track-color"),
					scaleColor: "transparent",
					onStep: function(from, to, percent) {
						$(this.el).find(".pie-chart-percent .value").text(Math.round(percent));
					}
				});

			});

		}

	}

	// COUNTER //
	function counter() {

		if (typeof $.fn.jQuerySimpleCounter !== 'undefined') {

			$(".counter .counter-value:in-viewport").each(function() {

				if (!$(this).hasClass("animated")) {
					$(this).addClass("animated");
					$(this).jQuerySimpleCounter({
						start: 0,
						end: $(this).attr("data-value"),
						duration: 2000
					});
				}

			});

		}
	}


	// SHOW/HIDE SCROLL UP //
	function show_hide_scroll_top() {

		if ($(window).scrollTop() > $(window).height()/2) {
			$("#scroll-up").fadeIn(300);
		} else {
			$("#scroll-up").fadeOut(300);
		}

	}


	// SCROLL UP //
	function scroll_up() {

		$("#scroll-up").on("click", function() {
			$("html, body").animate({
				scrollTop: 0
			}, 1500, 'easeInOutExpo');
			return false;
		});

	}


	// INSTAGRAM FEED //
	function instagram_feed() {

		if ((typeof Instafeed !== 'undefined') & ($("#instafeed").length > 0)) {

			var nr = $("#instafeed").data('number');
			var userid = $("#instafeed").data('user');
			var accesstoken = $("#instafeed").data('accesstoken');

			var feed = new Instafeed({
				target: 'instafeed',
				get: 'user',
				userId: userid,
				accessToken: accesstoken,
				limit: nr,
				resolution: 'thumbnail',
				sortBy: 'most-recent'
			});

			feed.run();

		}

	}


	// ANIMATIONS //
	function animations() {

		if (typeof WOW !== 'undefined') {

			animations = new WOW({
				boxClass: 'wow',
				animateClass: 'animated',
				offset: 100,
				mobile: false,
				live: true
			});

			animations.init();

		}

	}


	// SMOOTH SCROLLING //
	function smooth_scrolling() {

		$(".menu a, #mobile-menu a").on("click", function() {

			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {

				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');

				if (target.length) {
					$('html,body').animate({
						scrollTop: target.offset().top
					}, 1500, 'easeInOutExpo');

					return false;

				}

			}

		});

		$("#mobile-menu a").on("click", function(e) {

			if ($("#mobile-menu").hasClass("open")) {
				$("#mobile-menu").removeClass("open");
				$('body').removeClass("body-overlay");
			}

		});

	}


	// SWITCH BUTTON //
	function switch_button() {

		$(".switch-button span").on("click", function(){

			$(this).toggleClass("show-map");
			$(".map-overlay").fadeToggle(300);

		});

	}


	// FULL SCREEN //
	function full_screen() {

		if ($(window).width() > 767) {
			$(".full-screen").css("height", $(window).height() + "px");
		} else {
			$(".full-screen").css("height", "auto");
		}

	}

        // DOCUMENT LOADING //
        $( window ).load(function() {

                // PAGE LOADER //
                page_loader();

        });


	// DOCUMENT READY //
	$(document).ready(function() {

		$('html,body').animate({
			scrollTop: $(window).scrollTop() + 1
		}, 1000);

		// SCROLLSPY //
		$("body").scrollspy({
			target: 'nav',
			offset: 50
		});


		// STICKY //
		if ($(".default-header").hasClass("sticky-header")) {
			sticky();
		}


		// MENU //
		if (typeof $.fn.superfish !== 'undefined') {

			$(".menu").superfish({
				delay: 500,
				animation: {
					opacity: 'show',
					height: 'show'
				},
				speed: 'fast',
				autoArrows: true
			});

		}


		// SHOW/HIDE MOBILE MENU //
		show_hide_mobile_menu();


		// MOBILE MENU //
		mobile_menu();


		// FANCYBOX //
		if (typeof $.fn.fancybox !== 'undefined') {

			$(".fancybox").fancybox({
				prevEffect: 'none',
				nextEffect: 'none',
				padding: 0
			});

		}

		// OWL Carousel //
		if (typeof $.fn.owlCarousel !== 'undefined') {

			// IMAGES SLIDER //
			$(".owl-carousel.images-slider").owlCarousel({
				items: 1,
				autoplay: true,
				autoplayTimeout: 3000,
				autoplayHoverPause: true,
				smartSpeed: 1200,
				loop: true,
				nav: true,
				navText: false,
				dots: true,
				mouseDrag: true,
				touchDrag: true,
				animateIn: 'fadeIn',
				animateOut: 'fadeOut'
			});


			/* MAIN SLIDER */
			var main_slider = $(".owl-carousel.main-slider");

			main_slider.on('initialize.owl.carousel', function(event) {
				window.setTimeout(function() {
					$(".main-slider .slide-description").addClass("animated");
				}, 700);
			});

			main_slider.owlCarousel({
				items: 1,
				autoplay: true,
				autoplayTimeout: 50000,
				autoplayHoverPause: true,
				smartSpeed: 1200,
				loop: true,
				nav: true,
				navText: false,
				dots: true,
				mouseDrag: false,
				touchDrag: true,
				animateIn: 'fadeIn',
				animateOut: 'fadeOut'
			});

			main_slider.on('translate.owl.carousel', function(event) {
				$(".main-slider .slide-description").delay(200).removeClass("animated");
			});

			main_slider.on('translated.owl.carousel', function(event) {
				$(".main-slider .slide-description").addClass("animated");
			});


			// TESTIMONIALS SLIDER //
			$(".owl-carousel.testimonials-slider").owlCarousel({
				items: 1,
				autoplay: true,
				autoplayTimeout: 4000,
				autoplayHoverPause: true,
				smartSpeed: 300,
				loop: true,
				nav: false,
				navText: false,
				dots: true,
				mouseDrag: true,
				touchDrag: true
			});

			$(".owl-carousel.testimonials-carousel").owlCarousel({
				autoplay: true,
				autoplayTimeout: 5000,
				autoplayHoverPause: true,
				smartSpeed: 1200,
				loop: true,
				nav: true,
				navText: false,
				dots: false,
				mouseDrag: true,
				touchDrag: true,
				center: true,
				responsive: {
					0:{
						items: 1
					},
					768:{
						items: 3
					},
				}
			});


			// BLOG ARTICLES SLIDER //
			$(".owl-carousel.blog-articles-slider").owlCarousel({
				autoplay: true,
				autoplayTimeout: 3000,
				autoplayHoverPause: true,
				smartSpeed: 1200,
				loop: true,
				nav: true,
				navText: false,
				dots: true,
				mouseDrag: true,
				touchDrag: true,
				margin: 30,
				responsive: {
					0:{
						items: 1
					},
					768:{
						items: 2
					},
					1200:{
						items: 3
					}
				}
			});

			// PORTFOLIO ITEMS SLIDER //
			$(".owl-carousel.portfolio-items-slider").owlCarousel({
				autoplay: true,
				autoplayTimeout: 3000,
				autoplayHoverPause: true,
				smartSpeed: 1200,
				loop: true,
				nav: true,
				navText: false,
				dots: false,
				mouseDrag: true,
				touchDrag: true,
				responsive: {
					0:{
						items: 1
					},
					480:{
						items: 2
					},
					768:{
						items: 3
					},
					1200:{
						items: 4
					}
				}
			});

			// CLIENTS SLIDER //
			$(".owl-carousel.clients-slider").owlCarousel({
				autoplay: true,
				autoplayTimeout: 3000,
				autoplayHoverPause: true,
				smartSpeed: 1200,
				loop: true,
				nav: true,
				navText: false,
				dots: true,
				mouseDrag: true,
				touchDrag: true,
				responsive: {
					0:{
						items: 1
					},
					480:{
						items: 2
					},
					768:{
						items: 3
					},
					992:{
						items: 4
					},
					1200:{
						items: 5
					}
				}
			});

			// TEAM MEMBERS SLIDER //
			$(".owl-carousel.team-members-slider").owlCarousel({
				autoplay: true,
				autoplayTimeout: 3000,
				autoplayHoverPause: true,
				smartSpeed: 1200,
				loop: true,
				nav: false,
				navText: false,
				dots: false,
				mouseDrag: true,
				touchDrag: true,
				responsive: {
					0:{
						items: 1
					},
					480:{
						items: 2
					},
					768:{
						items: 3
					},
					992:{
						items: 4
					},
					1200:{
						items: 5
					},
					1400:{
						items: 6
					}
				}
			});

			// FEATURES SLIDER //
			$(".owl-carousel.features-slider").owlCarousel({
				items: 1,
				autoplay: true,
				autoplayTimeout: 3000,
				autoplayHoverPause: true,
				smartSpeed: 1200,
				loop: true,
				nav: true,
				navText: false,
				dots: false,
				mouseDrag: true,
				touchDrag: true,
				animateIn: 'fadeIn',
				animateOut: 'fadeOut'
			});

		}


		// GOOGLE MAPS //
		if (typeof $.fn.gmap3 !== 'undefined') {

			$(".map").each(function() {

				var data_zoom = 15,
					data_height,
					data_popup = false;

				if ($(this).attr("data-zoom") !== undefined) {
					data_zoom = parseInt($(this).attr("data-zoom"),10);
				}

				if ($(this).attr("data-height") !== undefined) {
					data_height = parseInt($(this).attr("data-height"),10);
				}

				if ($(this).attr("data-address-details") !== undefined) {

					data_popup = true;

					var infowindow = new google.maps.InfoWindow({
						content: $(this).attr("data-address-details")
					});

				}


				$(this)
					.gmap3({
						address: $(this).attr("data-address"),
						zoom: data_zoom,
						mapTypeId: "shadeOfGrey",
						mapTypeControlOptions: {
							mapTypeIds: [google.maps.MapTypeId.ROADMAP, "shadeOfGrey"]
						},
						scrollwheel: false
					})
					.marker([
						{address: $(this).attr("data-address")}
					])
					.on({
						click: function(marker, event){
							if (data_popup) {
								infowindow.open(marker.get('map'), marker);
							}
						}
					})
					.styledmaptype(
						"shadeOfGrey",
						[{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]},{"featureType":"administrative.country","elementType":"geometry.stroke","stylers":[{"saturation":"-9"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"landscape.natural.landcover","elementType":"geometry.fill","stylers":[{"saturation":"-4"},{"color":"#cdcdcd"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]}],
						{name: "Shades of Grey"}
					);

				$(this).css("height", data_height + "px");

			});

		}


		// ISOTOPE //
		if ((typeof $.fn.imagesLoaded !== 'undefined') && (typeof $.fn.isotope !== 'undefined')) {

			$(".isotope").imagesLoaded( function() {

				var container = $(".isotope");

				container.isotope({
					itemSelector: '.isotope-item',
					layoutMode: 'masonry',
					transitionDuration: '0.8s'
				});

				$(".filter li a").on("click", function() {
					$(".filter li a").removeClass("active");
					$(this).addClass("active");

					var selector = $(this).attr("data-filter");
					container.isotope({
						filter: selector
					});

					return false;
				});

				$(window).resize(function() {
					container.isotope();
				});

                                $('body').scrollspy('refresh');

			});

		}



		// CONTACT FORM VALIDATE & SUBMIT //


		// PARALLAX //
		if (typeof $.fn.stellar !== 'undefined') {

			if (!is_touch_device()) {

				$(window).stellar({
					horizontalScrolling: false,
					verticalScrolling: true,
					responsive: true
				});

			} else {

				$(".parallax").addClass("parallax-disable");

			}

		}
		
		$(".widget a, .footer-widget a").filter(function() {
			return !this.attributes['href'];
		}).parent('li').fadeOut();


		// SHOW/HIDE SCROLL UP
		show_hide_scroll_top();


		// SCROLL UP //
		scroll_up();


		// PROGRESS BARS //
		progress_bars();


		// PIE CHARTS //
		pie_chart();


		// COUNTER //
		counter();


		// YOUTUBE PLAYER //
		if (typeof $.fn.mb_YTPlayer !== 'undefined') {

			$(".youtube-player").mb_YTPlayer();

		}
		
		 //Menu Widget Class Remove //
		if($('.widget_nav_menu ul.menu').length){
		$(".widget_nav_menu ul.menu").removeClass("menu");
		}


		// INSTAGRAM FEED //
		instagram_feed();


		// TWITTER //
		if(typeof twitterFetcher !== 'undefined' && ($('.widget-twitter').length > 0)) {

			$('.widget-twitter').each(function(index){

				var account_id = $('.tweets-list', this).attr('data-account-id'),
					items = $('.tweets-list', this).attr('data-items'),
					newID = 'tweets-list-' + index;

				$('.tweets-list', this).attr('id', newID);

				var config = {
					"id": account_id,
					"domId": newID,
					"maxTweets": items,
					"showRetweet": false,
					"showTime": false,
					"showUser": false,
					"showInteraction": false
				};

				twitterFetcher.fetch(config);
			});

		}


		// COUNTDOWN //
		if (typeof $.fn.countdown !== 'undefined') {

			$(".countdown").countdown('2019/12/31 00:00', function(event) {
				$(this).html(event.strftime(
					'<div><div class="count">%-D</div> <span>Days</span></div>' +
					'<div><div class="count">%-H</div> <span>Hours</span></div>' +
					'<div><div class="count">%-M</div> <span>Minutes</span></div>' +
					'<div><div class="count">%S</div> <span>Seconds</span></div>'
				));
			});

		}


		// ANIMATIONS //
		animations();


		// SMOOTH SCROLLING
		smooth_scrolling();


		// SWITCH BUTTON //
		switch_button();


		// FULL SCREEN //
		full_screen();

	});


	// WINDOW SCROLL //
	$(window).scroll(function() {

		progress_bars();
		pie_chart();
		counter();
		show_hide_scroll_top();

	});


	// WINDOW RESIZE //
	$(window).resize(function() {

		mobile_menu();
		full_screen();

	});

})(window.jQuery);