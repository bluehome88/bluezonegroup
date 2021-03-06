/* global nozama_lite_vars */

jQuery(function ($) {
	'use strict';

	var $window = $(window);
	var $body = $('body');
	var isRTL = $body.hasClass('rtl');

	/* -----------------------------------------
	 Responsive Menus Init with mmenu
	 ----------------------------------------- */
	var $navWrap = $('.nav');
	var $navSubmenus = $navWrap.find('ul');
	var $mainNav = $('.navigation-main');
	var $mobileNav = $('#mobilemenu');

	$mainNav.each(function () {
		var $this = $(this);
		$this.clone()
			.removeAttr('id')
			.removeClass()
			.appendTo($mobileNav.find('ul'));
	});
	$mobileNav.find('li').removeAttr('id');

	$mobileNav.mmenu({
		offCanvas: {
			position: 'top',
			zposition: 'front'
		},
		autoHeight: true,
	});

	/* -----------------------------------------
	Menu classes based on available free space
	----------------------------------------- */
	function setMenuClasses() {
		if (!$navWrap.is(':visible')) {
			return;
		}

		var windowWidth = $window.width();

		$navSubmenus.each(function () {
			var $this = $(this);
			var $parent = $this.parent();
			$parent.removeClass('nav-open-left');
			var leftOffset = $this.offset().left + $this.outerWidth();

			if (leftOffset > windowWidth) {
				$parent.addClass('nav-open-left');
			}
		});
	}

	setMenuClasses();

	var resizeTimer;

	$window.on('resize', function () {
	  clearTimeout(resizeTimer);
	  resizeTimer = setTimeout(function () {
			setMenuClasses();
	  }, 350);
	});

	/* -----------------------------------------
	 Responsive Videos with fitVids
	 ----------------------------------------- */
	$body.fitVids();

	$window.on('load', function () {
		/* -----------------------------------------
		 Hero Slideshow
		 ----------------------------------------- */
		var $heroSlideshow = $('.page-hero-slideshow');
		var navigation = $heroSlideshow.data('navigation');
		var effect = $heroSlideshow.data('effect');
		var speed = $heroSlideshow.data('slide-speed');
		var auto = $heroSlideshow.data('autoslide');

		if ($heroSlideshow.length) {
			$heroSlideshow.slick({
				arrows: navigation === 'arrows' || navigation === 'both',
				dots: navigation === 'dots' || navigation === 'both',
				fade: effect === 'fade',
				autoplaySpeed: speed,
				autoplay: auto === true,
				slide: '.page-hero',
				rtl: isRTL,
				appendArrows: '.page-hero-slideshow-nav',
				prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-angle-left"></i></button>',
				nextArrow: '<button type="button" class="slick-next"><i class="fa fa-angle-right"></i></button>',
				responsive: [
					{
						breakpoint: 992,
						settings: {
							dots: true,
						}
					},
				]
			});
		}
	});

	$body.on("click", "#media_gallery-5 .gallery-item, #media_gallery-5 h2.section-title", function(e){
	    e.preventDefault();
		window.location.href = "/gallery";
	})

	$body.on("click", "#ci-latest-posts-3 h2.section-title", function(e){
	    e.preventDefault();
		window.location.href = "/latest-news/";
	})
});

/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
( function() {
	var isIe = /(trident|msie)/i.test( navigator.userAgent );

	if ( isIe && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
}() );
