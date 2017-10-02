var mobileResolution = 767; // Maximum mobile resolution value in pixels
var videoSlider;

$(document).ready(function(){
  videoSlider = $('.js-video-slider').bxSlider();
  toggleFixedHeight();
  equalHeightBoxes();
});

$(window).on('load', function(){
  // equalHeightBoxes();
});

$(window).on('resize', function() {
	equalHeightBoxes();
});

function toggleFixedHeight() {
	var trigger = $('.js-toggle-fixed-height');
	var fixed 	= 'fixed-height';

	if(trigger.length) {
		trigger.on('click', function(e) {
			trigger.removeClass('open');
			if($(e.target).is('li')) {
				$(this).addClass('open');
			}
		});
		$('.close').on('click', function() {
			$(this).closest('.fixed-height').removeClass('open');
		});
		$('body').on('mousedown', function() {
			trigger.removeClass('open');
		});
	}
}

// Equal Height Boxes
// Use data-eq-height attribute in the HTML tag
// Place the boxes in a .row element
function equalHeightBoxes() {
	var box = $('[data-eq-height]');
	var row = $(box).closest('.row');

	// Equalize height only for !mobile resolutions

	// Make sure the boxes have height set to auto before making the adaptation
	row.each(function() {
		$(this).find(box).css('height', 'auto'); 
	});
	if($(window).width() > mobileResolution) {
		if(box.length && row.length) {
			// Calculate the max height
			var verticalPadding = 15; // Default to 30px
			var maxHeight = 0;
			row.each(function() {
				$(this).find(box).each(function() {
					if($(this).height() > maxHeight) {
						maxHeight = $(this).height();
					}
				});
				
				// Apply the max height with .css
				box.each(function() {
					$(this).css('height', maxHeight + verticalPadding);
				});
			});
		}
	}
}