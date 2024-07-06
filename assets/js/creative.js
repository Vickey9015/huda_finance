/*!
 * Start Bootstrap - Creative Bootstrap Theme (http://startbootstrap.com)
 * Code licensed under the Apache License v2.0.
 * For details, see http://www.apache.org/licenses/LICENSE-2.0.
 */

(function($) {
    "use strict"; // Start of use strict

    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });

    // Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 51
    });

    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a').click(function() {
        $('.navbar-toggle:visible').click();
    });

    // Fit Text Plugin for Main Header
    $("h1").fitText(
        1.2, {
            minFontSize: '35px',
            maxFontSize: '65px'
        }
    );

    // Offset for Main Navigation
    $('#mainNav').affix({
        offset: {
            top: 100
        }
    });

    // Initialize WOW.js Scrolling Animations
    new WOW().init();
	
	var work = ["All", "1+", "2+", "4+", "5+"];
    var workvalue = {"All":"0", "1+":"1","2+":"2","4+":"4","5+":"5",};
	$("#circles-slider").slider({ 
        max: work.length - 1, 
        min: 0,
        value: 0,
		slide: function( event, ui ) {
		        var value =workvalue[work[ui.value]];
                $("#workid").val(value);
                searchres();
            }
    }).slider("pips", {
         rest: "label",
		labels: work
    });	
	
	var experience = ["All", "1+", "2+", "4+", "5+"];
    var expvalue = {"All":"0", "1+":"1","2+":"2","4+":"4","5+":"5",};
	$("#circles-slider-ex")
                    
    .slider({ 
        max: experience.length - 1, 
        min: 0,
        value: 0,
		slide: function(event,ui){
		        var value =expvalue[experience[ui.value]];
                $("#expid").val(value);
                searchres();
            }
    })
                    
    .slider("pips", {
        rest: "label",
		labels: experience
    });	

	//$('#upload-cv').validator();
	
	
})(jQuery); // End of use strict


function searchall(searchdata,search){
    var location = $('#search-location').val();
    var edu = $('#edu').val();
        $.ajax({
                url: "<?php echo base_url() ?>user/employeesearchajax",
                data: {location: location,edu: edu,searchdata: searchdata,search: search},
                type: 'post',
                async: false,
                success: function(output) {
                           alert(output);
                            document.getElementById('filterdata').innerHTML = output;
                        }
        });
}