jQuery(document).ready(function($){
	// Initial year append
	var currentdt = new Date();
	var currentmonth = currentdt.getMonth() + 1;
	var currentday = currentdt.getDate();
	var currentyear = currentdt.getFullYear();
	var currentyear2 = currentdt.getFullYear() + 1;
	$('.caldate-selectyear').html('');
	$('.caldate-selectyear').append('<option>'+currentyear+'</option');
	$('.caldate-selectyear').append('<option>'+currentyear2+'</option');
	// Load current date in specific date event
	$('.caldate-insertevents').find('.caldate-item-event').first().attr('class','caldate-show-specificdate caldate-item-event caldate-event-ondate-'+currentyear+'-'+currentmonth+'-'+currentday);
	$('.caldate-insertevents').find('.caldate-item-event').first().attr('data-year',currentyear);
	$('.caldate-insertevents').find('.caldate-item-event').first().attr('data-month',currentmonth);
	$('.caldate-insertevents').find('.caldate-item-event').first().attr('data-day',currentday);
	$('.caldate-insertevents').find('.caldate-item-event').first().find('.caldate-eventtype').html(currentmonth+'/'+currentday+'/'+currentyear);
	// Refresh date function
	function refreshcalDate() {
		// Get number of days of the month
	    var dt = new Date($('.caldate-selectyear').val()+'-'+$('.caldate-selectmonth').val()+'-1');
	    var month = dt.getMonth() + 1;
	    var year = dt.getFullYear();
	    var daysInMonth = new Date(year, month, 0).getDate();
		// Write days of current month
		$('.caldate-daysinmonth').html('');
		var dayCount = daysInMonth;
		for(var i = 0; i < dayCount; i++) {
			var num = i+1;
			$('.caldate-daysinmonth').append('<option>'+num+'</option');
		}
	}
	// Refresh date
	$(document).on('change', '.caldate-selectmonth, .caldate-selectyear', function(){
		refreshcalDate();
		$('.caldate-daysinmonth').val('1');
		$('.caldate-activeedit').attr('data-day','1');
	});
	// Load event item data
	$(document).on('click', '.caldate-item-event', function(){
		$('.caldate-settings').show();
		$('.caldate-optionbox').hide();
		$('.'+$(this).attr('data-show')).show();
		// Add active class
		$('.caldate-activeedit').removeClass('caldate-activeedit');
		$(this).addClass('caldate-activeedit');
		// Load values
		$('.caldate-selectstart').val($(this).attr('data-starttime'));
		$('.caldate-selectend').val($(this).attr('data-endtime'));
		$('.caldate-name').val($(this).attr('data-name'));
		$('.caldate-details').val($('.caldate-activeedit').find('.caldate-details-holder').html());
		$('.caldate-linktext').val($('.caldate-activeedit').find('.caldate-link-holder').html());
		$('.caldate-linkurl').val($('.caldate-activeedit').find('.caldate-link-holder').attr('data-url'));
		// Start load of data
		if ($(this).attr('data-show') == 'caldate-show-specificdate') {
			$('.caldate-selectyear').val($(this).attr('data-year'));
			if ($(this).attr('data-year') < currentyear) {
				$('.caldate-selectyear').val(currentyear);
			}
			$('.caldate-selectmonth').val($(this).attr('data-month'));
			refreshcalDate();
			$('.caldate-daysinmonth').val($(this).attr('data-day'));
		}
		if ($(this).attr('data-show') == 'caldate-show-everyday') {
			return false;
		}
		if ($(this).attr('data-show') == 'caldate-show-everyxofweek') {
			$('.caldate-everyxofweek').val($(this).attr('data-xofweek'));
		}
		if ($(this).attr('data-show') == 'caldate-show-everyxofmonth') {
			$('.caldate-everyxofmonth').val($(this).attr('data-xofmonth'));
		}
		if ($(this).attr('data-show') == 'caldate-show-firstxofmonth') {
			$('.caldate-firstxofmonth').val($(this).attr('data-firstxofmonth'));
		}
		if ($(this).attr('data-show') == 'caldate-show-secondxofmonth') {
			$('.caldate-secondxofmonth').val($(this).attr('data-secondxofmonth'));
		}
		if ($(this).attr('data-show') == 'caldate-show-thirdxofmonth') {
			$('.caldate-thirdxofmonth').val($(this).attr('data-thirdxofmonth'));
		}
		if ($(this).attr('data-show') == 'caldate-show-lastdayofmonth') {
			return false;
		}
	});
	// Update content
	$(document).on('change', '.caldate-selectmonth', function(){
		$('.caldate-activeedit').attr('data-month',$(this).val());
		$('.caldate-activeedit').attr('class','caldate-activeedit caldate-item-event caldate-event-ondate-'+$('.caldate-selectyear').val()+'-'+$('.caldate-selectmonth').val()+'-'+$('.caldate-daysinmonth').val());
		$('.caldate-activeedit').find('.caldate-eventtype').html($('.caldate-selectmonth').val()+'/'+$('.caldate-daysinmonth').val()+'/'+$('.caldate-selectyear').val());
	});
	$(document).on('change', '.caldate-daysinmonth', function(){
		$('.caldate-activeedit').attr('data-day',$(this).val());
		$('.caldate-activeedit').attr('class','caldate-activeedit caldate-item-event caldate-event-ondate-'+$('.caldate-selectyear').val()+'-'+$('.caldate-selectmonth').val()+'-'+$('.caldate-daysinmonth').val());
		$('.caldate-activeedit').find('.caldate-eventtype').html($('.caldate-selectmonth').val()+'/'+$('.caldate-daysinmonth').val()+'/'+$('.caldate-selectyear').val());
	});
	$(document).on('change', '.caldate-selectyear', function(){
		$('.caldate-activeedit').attr('data-year',$(this).val());
		$('.caldate-activeedit').attr('class','caldate-activeedit caldate-item-event caldate-event-ondate-'+$('.caldate-selectyear').val()+'-'+$('.caldate-selectmonth').val()+'-'+$('.caldate-daysinmonth').val());
		$('.caldate-activeedit').find('.caldate-eventtype').html($('.caldate-selectmonth').val()+'/'+$('.caldate-daysinmonth').val()+'/'+$('.caldate-selectyear').val());
	});
	$(document).on('change', '.caldate-everyxofweek', function(){
		$('.caldate-activeedit').attr('data-xofweek',$(this).val());
		$('.caldate-activeedit').attr('class','caldate-activeedit caldate-item-event caldate-event-every'+$(this).val());
		$('.caldate-activeedit').find('.caldate-eventtype').html('Every '+$('.caldate-everyxofweek option:selected').text()+' of the Week');
	});
	$(document).on('change', '.caldate-everyxofmonth', function(){
		$('.caldate-activeedit').attr('data-xofmonth',$(this).val());
		$('.caldate-activeedit').attr('class','caldate-activeedit caldate-item-event caldate-event-everydayof'+$(this).val());
		$('.caldate-activeedit').find('.caldate-eventtype').html('Every '+$(this).val()+' of the Month');
	});
	$(document).on('change', '.caldate-firstxofmonth', function(){
		$('.caldate-activeedit').attr('data-firstxofmonth',$(this).val());
		$('.caldate-activeedit').attr('class','caldate-activeedit caldate-item-event caldate-event-every-1-'+$(this).val());
		$('.caldate-activeedit').find('.caldate-eventtype').html('First '+$('.caldate-firstxofmonth option:selected').text()+' of the Month');
	});
	$(document).on('change', '.caldate-secondxofmonth', function(){
		$('.caldate-activeedit').attr('data-secondxofmonth',$(this).val());
		$('.caldate-activeedit').attr('class','caldate-activeedit caldate-item-event caldate-event-every-2-'+$(this).val());
		$('.caldate-activeedit').find('.caldate-eventtype').html('Second '+$('.caldate-secondxofmonth option:selected').text()+' of the Month');
	});
	$(document).on('change', '.caldate-thirdxofmonth', function(){
		$('.caldate-activeedit').attr('data-thirdxofmonth',$(this).val());
		$('.caldate-activeedit').attr('class','caldate-activeedit caldate-item-event caldate-event-every-3-'+$(this).val());
		$('.caldate-activeedit').find('.caldate-eventtype').html('Third '+$('.caldate-thirdxofmonth option:selected').text()+' of the Month');
	});
	$(document).on('change', '.caldate-selectstart', function(){
		$('.caldate-activeedit').attr('data-starttime',$(this).val());
		$('.caldate-activeedit').find('.caldate-time-holder').html('Time: '+$('.caldate-selectstart option:selected').text()+'-'+$('.caldate-selectend option:selected').text());
		$('.caldate-activeedit').find('.calcdate-event-inneritem').attr('data-sort',$(this).val());
	});
	$(document).on('change', '.caldate-selectend', function(){
		$('.caldate-activeedit').attr('data-endtime',$(this).val());
		$('.caldate-activeedit').find('.caldate-time-holder').html('Time: '+$('.caldate-selectstart option:selected').text()+'-'+$('.caldate-selectend option:selected').text());
	});
	$(document).on('keyup input change', '.caldate-name', function(){
		if ($('.caldate-name').val() == '' || $('.caldate-name').val() == ' ') {
			$('.caldate-activeedit').attr('data-name','Untitled');
			$('.caldate-activeedit').find('.caldate-titletext').html('Untitled');
		} else {
			$('.caldate-activeedit').attr('data-name',$(this).val());
			$('.caldate-activeedit').find('.caldate-titletext').html($(this).val());
		}
	});
	$(document).on('keyup input change', '.caldate-details', function(){
		$('.caldate-activeedit').find('.caldate-details-holder').html($(this).val());
	});
	$(document).on('keyup input change', '.caldate-linktext', function(){
		$('.caldate-activeedit').find('.caldate-link-holder').html($(this).val());
	});
	$(document).on('keyup input change', '.caldate-linkurl', function(){
		$('.caldate-activeedit').find('.caldate-link-holder').attr('data-url',$(this).val());
	});
	$(document).on('change', '.caldate-item-insertevent', function(){
		if ($(this).val() !== 'Insert Event Type') {
			$('.caldate-item-insert-container').prepend($('.caldate-insertevents .'+$(this).val()).clone());
			$('.caldate-calendarevents').find('.'+$(this).val()).removeClass($(this).val());
			$(this).val('');
		}
	});
	// Event tools
	$(document).on('click', '.caldate-tool-clone', function(){
		$($('.caldate-activeedit').clone()).insertAfter('.caldate-activeedit').addClass('caldate-cloned');
		$('.caldate-activeedit').removeClass('caldate-activeedit');
		$('.caldate-cloned').addClass('caldate-activeedit');
		$('.caldate-cloned').removeClass('caldate-cloned');
	});
	$(document).on('click', '.caldate-tool-delete', function(){
		$('.caldate-activeedit').remove();
		$('.caldate-settings').hide();
	});
	$(document).on('click', '.caldate-tool-close', function(){
		$('.caldate-activeedit').removeClass('caldate-activeedit');
		$('.caldate-settings').hide();
	});
	// Save
	$(document).on('click', '#submit', function(){
		$('.caldate-activeedit').removeClass('caldate-activeedit');
		$('.caldate-settings').hide();
		$('#ta_calendarcode').val($('.caldate-item-insert-container').html());
	});
});