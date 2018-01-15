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
  initAjaxSearch('#ajaxSearchForm');
  initCustomContentBox();
  initCloseCustomContentModal();
//   googleCSE();
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

// Init Ajax Search
function initAjaxSearch(form_selector) {
	var form = $(form_selector);
	if(form.length) {
		var url = form.attr('data-action');
		var url_suggestions = form.attr('data-action-suggestions');
		var keyword_input = form.find('input[name="keyword"]');
		var keyword = keyword_input.attr('value');

		// On form submit
		form.on('submit', function(e) {
			e.preventDefault();
			$.ajax({
				url: url, 
				data: {data: form.serializeArray()},
				success: function(result){
					if(result == 'no_result') {
						// Do nothing
						return false;
					} else {
						form.closest('.container').html(result);
						initAjaxSearch('#ajaxSearchForm');
					}
		    }});
		});

		// On tab press
		keyword_input.on('blur keydown', function(e) {
			var keyCode = e.keyCode || e.which; 

  			if (keyCode == 9) { 
				var $this = $(this);
				setTimeout(function() {
					var trimmed_value = $.trim($this.val());
					if(trimmed_value.length >= 2) {
						$.ajax({
							url: url_suggestions, 
							data: {data: form.serializeArray()},
							success: function(result){
								if(result == 'no_result') {
									// Do nothing
									return false;
								} else {
									$('.suggestions-wrapper').remove();
									var suggestions = $('<\div>');
									suggestions.addClass('suggestions-wrapper');
									form.append(suggestions);
									$('.suggestions-wrapper').html(result);
									$('.suggestions-wrapper').find('.result-element').first().addClass('selected').find('a').first().focus();
									// Next/Prev element using up/down arrows
									focusResultElement();
									initAjaxSearch('#ajaxSearchForm');
								}
					    }});
					}
				}, 200);
				return false;
			}
		});
	}
	return false;
}
function focusResultElement() {
	$('.suggestions-wrapper').unbind().keydown(function(e) {
		var e = e;
		
		setSelectedSuggestion(e);
	});

	$('.js-up').unbind().on('click', function(e) {
		console.log('Here up!');
		if($('.suggestions-wrapper').find('.selected').prev().length) {
			$('.suggestions-wrapper').find('.selected').prev().addClass('selected').find('a').focus();
			$('.suggestions-wrapper').find('.selected').next().removeClass('selected');
		}
	});

	$('.js-down').unbind().on('click', function(e) {
		console.log('Here down!');
		if($('.suggestions-wrapper').find('.selected').next().length) {
			$('.suggestions-wrapper').find('.selected').next().addClass('selected').find('a').focus();
			$('.suggestions-wrapper').find('.selected').prev().removeClass('selected');
		}
	});
}

function setSelectedSuggestion(e) {
	$('.suggestions-wrapper').find('.result-element').each(function(i, v) {
		if (e.keyCode == 40) {
			if($('.suggestions-wrapper').find('.result-element').length == $(this).data('index').match(/\d+/)) {
				return false;
			}
			if($(this).find('a:focus').length) {
				$('.result-element').removeClass('selected');
				$(this).next().addClass('selected').find('a').focus();
				return false;
			}
		}
		if (e.keyCode == 38) {
			if($('.suggestions-wrapper').find('.result-element.selected').data('index').match(/\d+/) == 1) {
				return false;
			}
			if($(this).find('a:focus').length) {
				$('.result-element').removeClass('selected');
	    		$(this).prev().addClass('selected').find('a').focus();
	    		return false;
			}
		}
	});
}

$.fn.setArrowDirection = function (degrees, class_name) {
	var _this = this;
	_this.css({
		'-ms-transform': 'rotate(' + degrees + 'deg)',
		'-webkit-transform': 'rotate(' + degrees + 'deg)',
		'transform': 'rotate(' + degrees + 'deg)'
	})
	.addClass(class_name);
	
	return false;
};

$.fn.toInt = function () {
	var time = parseInt($(this).selector);
	return time;
}

function googleCSE() {
	var YOUR_API_KEY = 'AIzaSyBCvwVQ0eela9lIX0Wx46EelodWcYMBtXQ';
	var cx = '007745925954021933777%3Ackvjqw6v5d0';
	var query = 'elenaalexie';
	query = encodeURIComponent(query);
	var url = 'https://www.googleapis.com/customsearch/v1?q=www.linkedin.com/in/' + query + '&cx=' + cx + '&key=' + YOUR_API_KEY;
	
	var containerCSE = $('#googleCSE');
	$.ajax({
		url: url,
		data: {},
		success: function (result) {
			if (!result) {
				// Do nothing
				return false;
			} else {
				if (result.items) {
					var items = result.items;
					console.log(items);
					var elements = [];
					if (items.length) {
						$(items).each(function(i, v) {
							elements.push(v);
						});
					}

					if (elements.length) {
						$(elements).each(function (j, k) {
							var element = $('<li>');
							var element_data = '<span>Kind: </span>' + '<span>' + k.kind + '</span>';
							element_data += '<br /><span>Title: </span>' + '<span>' + k.title + '</span>';
							element_data += '<br /><span>Link: </span>' + '<span>' + k.link + '</span>';
							element.html(element_data);
							$(containerCSE).append(element);
							return false;
						});
					}
				}
			}
		}
	});
}

function setTimeForAnalogClock() {
	var time = new Date();
	var hours_time = time.toLocaleString('en-US', { hour: 'numeric', hour12: true });
	var minutes_time = time.toLocaleString('en-US', { minute: 'numeric', hour12: true });
	var hours_int = $(hours_time).toInt();
	var minutes_int = $(minutes_time).toInt();
	// Divide by 12 cause our timing is based on 12 hours
	var hours_to_degrees = hours_int / 12 * 360;
	var minutes_to_degrees = minutes_int / 60 * 360;

	$('.arrow-hours').setArrowDirection(hours_to_degrees, 'arrow-hours');
	$('.arrow-minutes').setArrowDirection(minutes_to_degrees, 'arrow-minutes');
}

/**
 * Init Custom Content Modal
 */
function initCustomContentBox() {
	// Define trigger element
	var trigger = $('.colorbox');
	
	trigger.on('click', function() {
		// Remove existing modal
		if ($('.content-modal').length) {
			$('.content-modal').remove();
		}

		// Get the HTML content from triggered element
		var modal_new_content = trigger.html();

		if (modal_new_content.length) {
			// Define and append the new modal to the body
			var modal = $('<div>');
			$(modal).addClass('content-modal');
			$(modal).html('<h4>Click anywhere to close!</h4>');
			$('body').append($(modal));

			// Define and append the new modal container with HTML content to the modal
			var modal_container = $('<div>');
			$(modal_container).addClass('content-modal-container');
			$(modal_container).html(modal_new_content);
			$(modal).append($(modal_container));

			// Add Caption to the modal container, based on image alt attribute
			if(modal_container.find('img').length) {
				var caption = $('<caption>');
				$(caption).text(modal_container.find('img').first().attr('alt'));
				$(caption).addClass('bottom');
				modal_container.append($(caption));
			}

			// Init the event for closing the modal
			initCloseCustomContentModal();

			// Return false to avoid changing the page in browser
			return false;
		}
	});
}

function initCloseCustomContentModal() {
	$('.content-modal').on('click', function() {
		$('.content-modal').remove();
	});
}
