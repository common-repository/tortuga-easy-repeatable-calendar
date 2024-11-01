jQuery(document).ready(function($){
	// Start
	var currentdt = new Date();
	var currentyear = currentdt.getFullYear();
	var currentmonth = currentdt.getMonth() + 1;
	var currentday = currentdt.getDate();
	$('.caldate-year').append('<div data-value="'+currentyear+'" class="caldate-year-'+currentyear+'">'+currentyear+'</div>');
	var addYear = parseInt(currentyear) + 1;
	$('.caldate-year').append('<div data-value="'+addYear+'" class="caldate-year-'+addYear+'">'+addYear+'</div>');
	// Initial
    var initialMonth = currentdt.getMonth() + 1;
	$('.caldate-month-'+initialMonth).addClass('caldate-month-active');
	$('.caldate-month-'+initialMonth).prepend('<i class="fa fa-angle-right"></i>');
	$('.caldate-year-'+currentyear).addClass('caldate-year-active');
	$('.caldate-year-'+currentyear).prepend('<i class="fa fa-angle-right"></i>');
	refreshcalDate();
	// Select date
	$(document).on('click', '.caldate-month div', function(){
		$('.caldate-month-active').removeClass('caldate-month-active');
		$(this).addClass('caldate-month-active');
		refreshcalDate();
	});
	$(document).on('click', '.caldate-year div', function(){
		$('.caldate-year-active').removeClass('caldate-year-active');
		$(this).addClass('caldate-year-active');
		refreshcalDate();
	});
	// Refresh calendar
	function refreshcalDate() {
		// Reset
		$('.calcdate-append').html('');
		// Get number of days of the month
	    var dt = new Date($('.caldate-year-active').attr('data-value')+'-'+$('.caldate-month-active').attr('data-value')+'-1');
	    var month = dt.getMonth() + 1;
	    var year = dt.getFullYear();
	    var daysInMonth = new Date(year, month, 0).getDate();
		// Write days of current month
		var dayCount = daysInMonth;
		for(var i = 0; i < dayCount; i++) {
			var num = i+1;
			var currentDate = new Date(year+'-'+month+'-'+num);
			var getUTC = currentDate.getUTCDay();
			var currentMonth = currentDate.toLocaleString('default', { month: 'short' })
			if (getUTC == 0) {
				var dayofWeek = 'Sun';
			}
			if (getUTC == 1) {
				var dayofWeek = 'Mon';
			}
			if (getUTC == 2) {
				var dayofWeek = 'Tue';
			}
			if (getUTC == 3) {
				var dayofWeek = 'Wed';
			}
			if (getUTC == 4) {
				var dayofWeek = 'Thu';
			}
			if (getUTC == 5) {
				var dayofWeek = 'Fri';
			}
			if (getUTC == 6) {
				var dayofWeek = 'Sat';
			}
			// Today check
			var currentDate = currentyear+'-'+currentmonth+'-'+currentday;
			var dateinloop = year+'-'+month+'-'+num;
			if (currentDate == dateinloop) {
				var currentDateClass = 'caldate-today '
			} else {
				var currentDateClass = ''
			}
			// UTC position
			var utcPosition = $('.caldate-utc-'+getUTC).length + 1;
			// Less than date check
			var generatedloopDate = new Date(dateinloop);
			var generatedcurrentDate = new Date(currentDate);
			if (generatedcurrentDate > generatedloopDate) {
				var currentLessthan = ' caldate-lessthan';
			} else {
				var currentLessthan = '';
			}
			// Append days of month
		    $('.calcdate-append').append('<div class="caldate-itemcontainer'+currentLessthan+'"><div class="caldate-header '+currentDateClass+'caldate-utc-'+getUTC+'" data-utcposition="'+utcPosition+'" data-utc="'+getUTC+'">'+dayofWeek+' - '+currentMonth+' '+num+'</div><div class="caldate-event caldate-active"></div></div>');
			// Everyday
			$('.caldate-event-everyday').each(function(){
			    $('.caldate-active').append($(this).html());
			});
			// Every day of week
			$('.caldate-event-every'+getUTC).each(function(){
			    $('.caldate-active').append($(this).html());
			});
			// Every specific day of month
			$('.caldate-event-everydayof'+num).each(function(){
			    $('.caldate-active').append($(this).html());
			});
			// On specific date
			$('.caldate-event-ondate-'+dateinloop).each(function(){
			    $('.caldate-active').append($(this).html());
			});
			// On specific position of month
			$('.caldate-event-every-'+utcPosition+'-'+getUTC).each(function(){
			    $('.caldate-active').append($(this).html());
			});
			// Remove active status
			$('.caldate-active').removeClass('caldate-active');
		}
		// On last day of month events
		$('.caldate-event-lastdayofmonth').each(function(){
			$('.caldate-itemcontainer').last().find('.caldate-event').append($(this).html());
		});
		// Sort events
		$('.caldate-event').each(function(){
			$(this).find('.calcdate-event-inneritem').sort(function(a, b) {
				return $(a).data('sort') - $(b).data('sort');
			}).appendTo(this);
		});
		// If less than date check
		if ($('.caldate-lessthan').length) {
			$('.caldate-loadpastdates').show();
		} else {
			$('.caldate-loadpastdates').hide();
		}
		$('.caldate-hidepastdates').hide();
	}
	// Load past dates
	$(document).on('click', '.caldate-loadpastdates', function(){
		$('.caldate-lessthan').show();
		$('.caldate-loadpastdates').hide();
		$('.caldate-hidepastdates').show();
	});
	// Hide past dates
	$(document).on('click', '.caldate-hidepastdates', function(){
		$('.caldate-lessthan').hide();
		$('.caldate-loadpastdates').show();
		$('.caldate-hidepastdates').hide();
	});
	// Show event details
	$(document).on('click', '.caldate-expand-content', function(){
		$(this).parent().find('.caldate-item-content').toggle();
		if ($(this).parent().find('.caldate-item-content').css('display') == 'none') {
			$(this).find('.caldate-indicator').attr('class','fa fa-plus caldate-indicator');
		} else {
			$(this).find('.caldate-indicator').attr('class','fa fa-minus caldate-indicator');
		}
	});
	// Click event link
	$(document).on('click', '.caldate-link-holder', function(){
		window.open($(this).attr('data-url'), '_blank');
	});
});