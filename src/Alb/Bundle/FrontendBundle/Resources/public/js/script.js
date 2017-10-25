var mobileResolution = 767; // Maximum mobile resolution value in pixels
var videoSlider;
var playlistLinksSlider;
var COOKIE_COLOUR_THEME = 'colour-theme';

$(document).ready(function(){
  initBxSliders();
  toggleFixedHeight();
  equalHeightBoxes();
  initColorboxes();
  initHamburgerMenu('.js-hamburger');
  initChangeColourTheme();
  initAddFileUploadPreview();
  initDatatables();
});

$(window).on('load', function(){
  // equalHeightBoxes();
});

$(window).on('resize', function() {
	equalHeightBoxes();
});

$(window).on('scroll', function() {
  // Set page-scrolled class to body
  setPageScrolledToBody('page-scrolled');
});

function initDatatables() {
	var priceHunter = $('#priceHunter');

	if($(priceHunter) != 'undefined' && $(priceHunter).length) {
		$(priceHunter).DataTable( {
		    "ajax": {
	            "url": $(this).attr("data-ajax-url"),
	            "dataSrc": "",
	            "type": "GET"
	        },
	        "columns": [
	            { "data": "title" },
				{ "data": "price" },
				{ "data": "link" },
				{ "data": "date" },
				{ "data": "image" },
				{ "data": "price_min" },
				{ "data": "price_max" }
	        ]
		} );
	}
}

// Init bxSlider calls
function initBxSliders() {
  // Video Slider
  video_slider = $('.js-video-slider');
  if(video_slider.length) {
  	console.log(video_slider);
  	videoSlider = video_slider.bxSlider();
  }

  // Playlist Links Slider
  var playlist_links_slider = $('.js-playlist-links-slider');
  if(playlist_links_slider.length) {
  	playlistLinksSlider = playlist_links_slider.bxSlider({
  		mode: 'vertical',
  		slideWidth: 740,
	    minSlides: 10,
	    maxSlides: 10,
	    slideMargin: 0
  	});
  }
}

// Set page-scrolled class to body
function setPageScrolledToBody(class_name) {
  var body = $('body');
  var header = $('header');
  var topOffset = 50;
  if(header.length) {
    topOffset += header.height();
  }

  if($( window ).scrollTop() >= topOffset) {
    body.addClass(class_name);
  } else {
    body.removeClass(class_name);
  }
}

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

// Init Colorboxes
function initColorboxes() {
	var colorbox_object = $('.colorbox');
	
	if(colorbox_object.length) {
		// $(colorbox_object).colorbox({width: "80%", height: "80%", opacity: "0.85"});
	}
}

/* Init Hamburger Menu Functionality.
 * 
 * @param string trigger
 *   Can be class or id of the hamburger trigger element [.js-hamburger, #js-hamburger, etc.].
 */
function initHamburgerMenu(trigger) {
	var trigger = $(trigger);
	var body = $('body');
	var nav = $('.header').find('nav');

	if(trigger.length) {
		trigger.on('click', function() {
			if(body.attr('data-hamburger-status') == 'open') {
				nav.removeClass('open');
				$(this).text($(this).attr('data-open'));
				body.attr('data-hamburger-status', 'closed');
			} else {
				nav.addClass('open');
				$(this).text($(this).attr('data-closed'));
				body.attr('data-hamburger-status', 'open');
			}
		});
	}
}

/** Init Change Colour Theme.
 */
function initChangeColourTheme() {
	var default_css = '/bundles/albbundle/frontend/css/style.css';
	var link_tag = $('link.js-colour-theme');
	if(link_tag.length) {
		link_tag.each(function() {
			default_css = $(this).attr('href');
		});
	}

	var trigger = $('.js-change-colour-theme');

	if(trigger.length) {
		trigger.on('click', function() {
			if(default_css.length) {
				if($(this).find('option:selected').attr('value').length) {
					link_tag.attr('href', $(this).find('option:selected').attr('value'));
					setColourTheme(COOKIE_COLOUR_THEME, $(this).find('option:selected').attr('value'));
				}
			}
		});
	}
}

// Set Colour Theme.
function setColourTheme(cookie_name, cookie_value) {
    if(cookie_name) {
	    if(getCookie(cookie_name)) {
	      deleteCookie(cookie_name); // Reset cookie
	    }
	    var expires = cookieFutureTimeExpiration();
	    document.cookie = cookie_name + '=' + cookie_value + ';expires='+expires+';path=/;';
    }
}

// Cookie Future Time Expiration
function cookieFutureTimeExpiration() {
  var now = new Date();
  var time = now.getTime();
  var expireTime = time + 50000*36000;
  now.setTime(expireTime);
  var expirationTime = now.toGMTString();

  return expirationTime;
}

// Delete Cookie
function deleteCookie(name) {
  var expires = cookieFutureTimeExpiration();
  document.cookie = name + '='+ '' +';expires='+expires+';path=/;';
}

// Get Cookie
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

// Add Preview after File upload
function initAddFileUploadPreview() {
	var trigger = $('.file-input');
	var selected_element = $('.selected-element');
	if(trigger.length) {
		trigger.find('input[type="file"]').unbind().on('change', function() {
			if($(selected_element).length) { 
				$(selected_element).remove();
			}
			$(this).after('<p class="selected-element"><span class="uploaded-filename">' + this.files[0].name + '</span> <span class="pull-right cursor-pointer" onclick="javascript:cancelFileupload(this)">&#10005;</span></p>');
			initAddFileUploadPreview();
		});
	}
}

function cancelFileupload(this_obj) {
	$(this_obj).closest('.form-group').find('input[type="file"]').val('');
	$(this_obj).closest('.selected-element').remove();
}
