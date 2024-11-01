<?php
/**
 * Plugin Name: Tortuga Easy Repeatable Calendar
 * Plugin URI: 
 * Description: Easily create a calendar and display it with [tortuga-recurring-calendar]
 * Version: 1.0.0
 * Author: Tortuga
 * Author URI:
 */

function ta_calendar_create_menu() {
	add_menu_page('Easy Calendar', 'Easy Calendar', 'administrator', __FILE__, 'ta_calendar_settings_page' , 'dashicons-calendar', 10);
	add_action( 'admin_init', 'register_ta_calendar_settings' );
}
add_action('admin_menu', 'ta_calendar_create_menu');

function register_ta_calendar_settings() {
	register_setting( 'ta-calendar-settings-group', 'ta_calendarcodehtml');
}

function ta_calendar_front_enqueue()
{
	wp_register_script( 'ta-calendar-front-script', plugin_dir_url( __FILE__ ) . '/js/calendar-frontend.js', array('jquery'), '3.5.1', true );
	wp_enqueue_script( 'ta-calendar-front-script' );
	
    wp_register_style( 'ta-calendar-front-styles', plugin_dir_url( __FILE__ ) . '/css/styles-frontend.css' );
	wp_enqueue_style( 'ta-calendar-front-styles' );
	
    wp_register_style( 'ta-calendar-front-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'ta-calendar-front-fontawesome' );
}
 
add_action( 'wp_enqueue_scripts', 'ta_calendar_front_enqueue' );

function ta_calendar_admin_enqueue()
{
	wp_register_script( 'ta-calendar-admin-script', plugin_dir_url( __FILE__ ) . '/js/calendar-admin.js', array('jquery'), '3.5.1', true );
	wp_enqueue_script( 'ta-calendar-admin-script' );
	
    wp_register_style( 'ta-calendar-admin-stylesheet', plugin_dir_url( __FILE__ ) . '/css/styles-admin.css' );
	wp_enqueue_style( 'ta-calendar-admin-stylesheet' );
	
    wp_register_style( 'ta-calendar-admin-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'ta-calendar-admin-fontawesome' );
}
 
add_action( 'admin_enqueue_scripts', 'ta_calendar_admin_enqueue' );

function ta_calendar_settings_page() {
?>

<form method="post" action="options.php">
    <?php settings_fields( 'ta-calendar-settings-group' ); ?>
    <?php do_settings_sections( 'ta-calendar-settings-group' ); ?>
	<textarea name="ta_calendarcodehtml" id="ta_calendarcode" style="display:none;">
		<?php $tacalendarsource = get_option('ta_calendarcodehtml');
					$arr = array(
					'div' => array(
						'class' => array(),
						'style'  => array(),
						'data-show'  => array(),
						'data-name'  => array(),
						'data-month'  => array(),
						'data-day'  => array(),
						'data-year'  => array(),
						'data-starttime'  => array(),
						'data-endtime'  => array(),
						'data-sort'  => array(),
						'data-firstxofmonth'  => array(),
						'data-secondxofmonth'  => array(),
						'data-thirdxofmonth'  => array(),
						'data-xofweek'  => array(),
						'data-xofmonth'  => array(),
					),
					'i' => array(
						'class' => array(),
						'style'  => array(),
					),
				);
			echo wp_kses( $tacalendarsource, $arr ); ?>
	</textarea>
	<div class="caldate-submitbutton">
		<?php submit_button(); ?>
	</div>
</form>

<div class="ta-calendar-wrap">
	<div class="caldate-calendarevents">
		<div class="caldate-item-insert">
			<select class="caldate-item-insertevent">
				<option value="">Insert Event Type</option>
				<option value="caldate-show-specificdate">Specific Date</option>
				<option value="caldate-show-lastdayofmonth">Last Day of Month</option>
				<option value="caldate-show-everyday">Everyday</option>
				<option value="caldate-show-firstxofmonth">First x of the Month</option>
				<option value="caldate-show-secondxofmonth">Second x of the Month</option>
				<option value="caldate-show-thirdxofmonth">Third x of the Month</option>
				<option value="caldate-show-everyxofweek">Every x of Week</option>
				<option value="caldate-show-everyxofmonth">Every x of Month</option>
			</select>
		</div>
		<div class="caldate-item-insert-container">
			<?php $tacalendarsource = get_option('ta_calendarcodehtml');
					$arr = array(
					'div' => array(
						'class' => array(),
						'style'  => array(),
						'data-show'  => array(),
						'data-name'  => array(),
						'data-month'  => array(),
						'data-day'  => array(),
						'data-year'  => array(),
						'data-starttime'  => array(),
						'data-endtime'  => array(),
						'data-sort'  => array(),
						'data-firstxofmonth'  => array(),
						'data-secondxofmonth'  => array(),
						'data-thirdxofmonth'  => array(),
						'data-xofweek'  => array(),
						'data-xofmonth'  => array(),
					),
					'i' => array(
						'class' => array(),
						'style'  => array(),
					),
				);
			echo wp_kses( $tacalendarsource, $arr ); ?>
		</div>
	</div>

	<div class="caldate-insertevents">
	<div data-show="caldate-show-specificdate" class="caldate-show-specificdate caldate-item-event caldate-event-ondate-2021-6-26" data-name="Untitled" data-month="7" data-day="20" data-year="2010" data-starttime="000" data-endtime="000">
		<div data-sort="000" class="calcdate-event-inneritem">
			<div class="caldate-expand-content"><div class="caldate-expand-indicator"><i class="fa fa-plus caldate-indicator"></i></div><div class="caldate-titletext">Untitled</div><div class="caldate-spacer">-</div><div class="caldate-eventtype">7/20/2010</div></div>
			<div class="caldate-item-content">
				<div class="caldate-time-holder">Time: None - None</div>
				<div class="caldate-details-holder">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>
				<div class="caldate-link-holder">Link</div>
			</div>
		</div>
	</div>

	<div data-show="caldate-show-lastdayofmonth" class="caldate-show-lastdayofmonth caldate-item-event caldate-event-lastdayofmonth" data-name="Untitled" data-starttime="000" data-endtime="000">
		<div data-sort="000" class="calcdate-event-inneritem">
			<div class="caldate-expand-content"><div class="caldate-expand-indicator"><i class="fa fa-plus caldate-indicator"></i></div><div class="caldate-titletext">Untitled</div><div class="caldate-spacer">-</div><div class="caldate-eventtype">Last Day of Month</div></div>
			<div class="caldate-item-content">
				<div class="caldate-time-holder">Time: None - None</div>
				<div class="caldate-details-holder">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>
				<div class="caldate-link-holder">Link</div>
			</div>
		</div>
	</div>

	<div data-show="caldate-show-everyday" class="caldate-show-everyday caldate-item-event caldate-event-everyday" data-name="Untitled" data-starttime="000" data-endtime="000">
		<div data-sort="000" class="calcdate-event-inneritem">
			<div class="caldate-expand-content"><div class="caldate-expand-indicator"><i class="fa fa-plus caldate-indicator"></i></div><div class="caldate-titletext">Untitled</div><div class="caldate-spacer">-</div><div class="caldate-eventtype">Everyday</div></div>
			<div class="caldate-item-content">
				<div class="caldate-time-holder">Time: None - None</div>
				<div class="caldate-details-holder">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>
				<div class="caldate-link-holder">Link</div>
			</div>
		</div>
	</div>

	<div data-show="caldate-show-firstxofmonth" class="caldate-show-firstxofmonth caldate-item-event caldate-event-every-1-1" data-name="Untitled" data-firstxofmonth="1" data-starttime="000" data-endtime="000">
		<div data-sort="000" class="calcdate-event-inneritem">
			<div class="caldate-expand-content"><div class="caldate-expand-indicator"><i class="fa fa-plus caldate-indicator"></i></div><div class="caldate-titletext">Untitled</div><div class="caldate-spacer">-</div><div class="caldate-eventtype">First Mon of the Month</div></div>
			<div class="caldate-item-content">
				<div class="caldate-time-holder">Time: None - None</div>
				<div class="caldate-details-holder">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>
				<div class="caldate-link-holder">Link</div>
			</div>
		</div>
	</div>

	<div data-show="caldate-show-secondxofmonth" class="caldate-show-secondxofmonth caldate-item-event caldate-event-every-2-1" data-name="Untitled" data-secondxofmonth="1" data-starttime="000" data-endtime="000">
		<div data-sort="000" class="calcdate-event-inneritem">
			<div class="caldate-expand-content"><div class="caldate-expand-indicator"><i class="fa fa-plus caldate-indicator"></i></div><div class="caldate-titletext">Untitled</div><div class="caldate-spacer">-</div><div class="caldate-eventtype">Second Mon of the Month</div></div>
			<div class="caldate-item-content">
				<div class="caldate-time-holder">Time: None - None</div>
				<div class="caldate-details-holder">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>
				<div class="caldate-link-holder">Link</div>
			</div>
		</div>
	</div>

	<div data-show="caldate-show-thirdxofmonth" class="caldate-show-thirdxofmonth caldate-item-event caldate-event-every-3-1" data-name="Untitled" data-thirdxofmonth="1" data-starttime="000" data-endtime="000">
		<div data-sort="000" class="calcdate-event-inneritem">
			<div class="caldate-expand-content"><div class="caldate-expand-indicator"><i class="fa fa-plus caldate-indicator"></i></div><div class="caldate-titletext">Untitled</div><div class="caldate-spacer">-</div><div class="caldate-eventtype">Third Mon of the Month</div></div>
			<div class="caldate-item-content">
				<div class="caldate-time-holder">Time: None - None</div>
				<div class="caldate-details-holder">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>
				<div class="caldate-link-holder">Link</div>
			</div>
		</div>
	</div>

	<div data-show="caldate-show-everyxofweek" class="caldate-show-everyxofweek caldate-item-event caldate-event-every1" data-name="Untitled" data-xofweek="1" data-starttime="000" data-endtime="000">
		<div data-sort="000" class="calcdate-event-inneritem">
			<div class="caldate-expand-content"><div class="caldate-expand-indicator"><i class="fa fa-plus caldate-indicator"></i></div><div class="caldate-titletext">Untitled</div><div class="caldate-spacer">-</div><div class="caldate-eventtype">Every Mon of the Week</div></div>
			<div class="caldate-item-content">
				<div class="caldate-time-holder">Time: None - None</div>
				<div class="caldate-details-holder">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>
				<div class="caldate-link-holder">Link</div>
			</div>
		</div>
	</div>

	<div data-show="caldate-show-everyxofmonth" class="caldate-show-everyxofmonth caldate-item-event caldate-event-everydayof1" data-name="Untitled" data-xofmonth="1" data-starttime="000" data-endtime="000">
		<div data-sort="000" class="calcdate-event-inneritem">
			<div class="caldate-expand-content"><div class="caldate-expand-indicator"><i class="fa fa-plus caldate-indicator"></i></div><div class="caldate-titletext">Untitled</div><div class="caldate-spacer">-</div><div class="caldate-eventtype">Every 1 of the Month</div></div>
			<div class="caldate-item-content">
				<div class="caldate-time-holder">Time: None - None</div>
				<div class="caldate-details-holder">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>
				<div class="caldate-link-holder">Link</div>
			</div>
		</div>
	</div>
	</div>

	<div class="caldate-settings">
		<div class="caldate-tool-clone caldate-tool-icon"><i class="fa fa-clone"></i></div>
		<div class="caldate-tool-delete caldate-tool-icon"><i class="fa fa-trash-o"></i></div>
		<div class="caldate-tool-close caldate-tool-icon"><i class="fa fa-mouse-pointer"></i></div>
		<div class="caldate-show-specificdate caldate-optionbox">
			<label>Specific Date</label>
			<select class='caldate-selectmonth' size='4' style="display:inline-block; width:30%;">
				<option value="1">Jan</option>
				<option value="2">Feb</option>
				<option value="3">Mar</option>
				<option value="4">Apr</option>
				<option value="5">May</option>
				<option value="6">Jun</option>
				<option value="7">Jul</option>
				<option value="8">Aug</option>
				<option value="9">Sep</option>
				<option value="10">Oct</option>
				<option value="11">Nov</option>
				<option value="12">Dec</option>
			</select>
			<select class='caldate-daysinmonth' size='4' style="display:inline-block; width:30%;">
			</select>
			<select class='caldate-selectyear' size='4' style="display:inline-block; width:30%;">
			</select>
		</div>
		<div class="caldate-show-everyday caldate-optionbox"><label>Everyday</label></div>
		<div class="caldate-show-everyxofweek caldate-optionbox">
			<label>Every x of Week</label>
			<select class='caldate-everyxofweek' size='4'>
				<option value="1">Mon</option>
				<option value="2">Tue</option>
				<option value="3">Wed</option>
				<option value="4">Thu</option>
				<option value="5">Fri</option>
				<option value="6">Sat</option>
				<option value="0">Sun</option>
			</select>
		</div>
		<div class="caldate-show-everyxofmonth caldate-optionbox">
			<label>Every x of the Month</label>
			<select class='caldate-everyxofmonth' size='4'>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
				<option value="21">21</option>
				<option value="22">22</option>
				<option value="23">23</option>
				<option value="24">24</option>
				<option value="25">25</option>
				<option value="26">26</option>
				<option value="27">27</option>
				<option value="28">28</option>
			</select>
		</div>
		<div class="caldate-show-firstxofmonth caldate-optionbox">
			<label>First x of the Month</label>
			<select class='caldate-firstxofmonth' size='4'>
				<option value="1">Mon</option>
				<option value="2">Tue</option>
				<option value="3">Wed</option>
				<option value="4">Thu</option>
				<option value="5">Fri</option>
				<option value="6">Sat</option>
				<option value="0">Sun</option>
			</select>
		</div>
		<div class="caldate-show-secondxofmonth caldate-optionbox">
			<label>Second x of the Month</label>
			<select class='caldate-secondxofmonth' size='4'>
				<option value="1">Mon</option>
				<option value="2">Tue</option>
				<option value="3">Wed</option>
				<option value="4">Thu</option>
				<option value="5">Fri</option>
				<option value="6">Sat</option>
				<option value="0">Sun</option>
			</select>
		</div>
		<div class="caldate-show-thirdxofmonth caldate-optionbox">
			<label>Third x of the Month</label>
			<select class='caldate-thirdxofmonth' size='4'>
				<option value="1">Mon</option>
				<option value="2">Tue</option>
				<option value="3">Wed</option>
				<option value="4">Thu</option>
				<option value="5">Fri</option>
				<option value="6">Sat</option>
				<option value="0">Sun</option>
			</select>
		</div>
		<div class="caldate-show-lastdayofmonth caldate-optionbox"><label>Last Day of Month</label></div>
		<label>Start and End Time</label>
		<select class='caldate-selectstart' size='4' style="display:inline-block; width:48%;">
			<option value="000">None</option>
			<option value="010">Midnight</option>
			<option value="030">12:30 AM</option>
			<option value="100">1:00 AM</option>
			<option value="130">1:30 AM</option>
			<option value="200">2:00 AM</option>
			<option value="230">2:30 AM</option>
			<option value="300">3:00 AM</option>
			<option value="330">3:30 AM</option>
			<option value="400">4:00 AM</option>
			<option value="430">4:30 AM</option>
			<option value="500">5:00 AM</option>
			<option value="530">5:30 AM</option>
			<option value="600">6:00 AM</option>
			<option value="630">6:30 AM</option>
			<option value="700">7:00 AM</option>
			<option value="730">7:30 AM</option>
			<option value="800">8:00 AM</option>
			<option value="830">8:30 AM</option>
			<option value="900">9:00 AM</option>
			<option value="930">9:30 AM</option>
			<option value="1000">10:00 AM</option>
			<option value="1030">10:30 AM</option>
			<option value="1100">11:00 AM</option>
			<option value="1130">11:30 AM</option>
			<option value="1200">Noon</option>
			<option value="1230">12:30 PM</option>
			<option value="1300">1:00 PM</option>
			<option value="1330">1:30 PM</option>
			<option value="1400">2:00 PM</option>
			<option value="1430">2:30 PM</option>
			<option value="1500">3:00 PM</option>
			<option value="1530">3:30 PM</option>
			<option value="1600">4:00 PM</option>
			<option value="1630">4:30 PM</option>
			<option value="1700">5:00 PM</option>
			<option value="1730">5:30 PM</option>
			<option value="1800">6:00 PM</option>
			<option value="1830">6:30 PM</option>
			<option value="1900">7:00 PM</option>
			<option value="1930">7:30 PM</option>
			<option value="2000">8:00 PM</option>
			<option value="2030">8:30 PM</option>
			<option value="2100">9:00 PM</option>
			<option value="2130">9:30 PM</option>
			<option value="2200">10:00 PM</option>
			<option value="2230">10:30 PM</option>
			<option value="2300">11:00 PM</option>
			<option value="2350">11:30 PM</option>
		</select>
		<select class='caldate-selectend' size='4' style="display:inline-block; width:48%;">
			<option value="000">None</option>
			<option value="010">Midnight</option>
			<option value="030">12:30 AM</option>
			<option value="100">1:00 AM</option>
			<option value="130">1:30 AM</option>
			<option value="200">2:00 AM</option>
			<option value="230">2:30 AM</option>
			<option value="300">3:00 AM</option>
			<option value="330">3:30 AM</option>
			<option value="400">4:00 AM</option>
			<option value="430">4:30 AM</option>
			<option value="500">5:00 AM</option>
			<option value="530">5:30 AM</option>
			<option value="600">6:00 AM</option>
			<option value="630">6:30 AM</option>
			<option value="700">7:00 AM</option>
			<option value="730">7:30 AM</option>
			<option value="800">8:00 AM</option>
			<option value="830">8:30 AM</option>
			<option value="900">9:00 AM</option>
			<option value="930">9:30 AM</option>
			<option value="1000">10:00 AM</option>
			<option value="1030">10:30 AM</option>
			<option value="1100">11:00 AM</option>
			<option value="1130">11:30 AM</option>
			<option value="1200">Noon</option>
			<option value="1230">12:30 PM</option>
			<option value="1300">1:00 PM</option>
			<option value="1330">1:30 PM</option>
			<option value="1400">2:00 PM</option>
			<option value="1430">2:30 PM</option>
			<option value="1500">3:00 PM</option>
			<option value="1530">3:30 PM</option>
			<option value="1600">4:00 PM</option>
			<option value="1630">4:30 PM</option>
			<option value="1700">5:00 PM</option>
			<option value="1730">5:30 PM</option>
			<option value="1800">6:00 PM</option>
			<option value="1830">6:30 PM</option>
			<option value="1900">7:00 PM</option>
			<option value="1930">7:30 PM</option>
			<option value="2000">8:00 PM</option>
			<option value="2030">8:30 PM</option>
			<option value="2100">9:00 PM</option>
			<option value="2130">9:30 PM</option>
			<option value="2200">10:00 PM</option>
			<option value="2230">10:30 PM</option>
			<option value="2300">11:00 PM</option>
			<option value="2350">11:30 PM</option>
		</select>
		<label>Event Name</label>
		<input class="caldate-name">
		<label>Event Details</label>
		<textarea class="caldate-details"></textarea>
		<label>Event Link Text</label>
		<input class="caldate-linktext">
		<label>Event Link URL</label>
		<input class="caldate-linkurl">
	</div>
</div>
<?php }

function ta_calendarshortcode( $atts ){
	?>
	<div class="caldate-generated">
		<div class="caldate-table">
			<div class="caldate-cell caldate-month">
				<div data-value="1" class="caldate-month-1">Jan</div>
				<div data-value="2" class="caldate-month-2">Feb</div>
				<div data-value="3" class="caldate-month-3">Mar</div>
				<div data-value="4" class="caldate-month-4">Apr</div>
				<div data-value="5" class="caldate-month-5">May</div>
				<div data-value="6" class="caldate-month-6">Jun</div>
				<div data-value="7" class="caldate-month-7">Jul</div>
				<div data-value="8" class="caldate-month-8">Aug</div>
				<div data-value="9" class="caldate-month-9">Sep</div>
				<div data-value="10" class="caldate-month-10">Oct</div>
				<div data-value="11" class="caldate-month-11">Nov</div>
				<div data-value="12" class="caldate-month-12">Dec</div>
			</div>
			<div class="caldate-widthcontrol caldate-cell caldate-year"></div>
		</div>
		<div class="caldate-loadpastdates"><i class="fa fa-refresh"></i> Load Past Events</div>
		<div class="caldate-hidepastdates"><i class="fa fa-eye-slash"></i> Hide Past Events</div>
		<div class="calcdate-append"></div>
	</div>
	<div class="calcdate-eventscontainer">
		<?php $tacalendarsource = get_option('ta_calendarcodehtml');
					$arr = array(
					'div' => array(
						'class' => array(),
						'style'  => array(),
						'data-show'  => array(),
						'data-name'  => array(),
						'data-month'  => array(),
						'data-day'  => array(),
						'data-year'  => array(),
						'data-starttime'  => array(),
						'data-endtime'  => array(),
						'data-sort'  => array(),
						'data-firstxofmonth'  => array(),
						'data-secondxofmonth'  => array(),
						'data-thirdxofmonth'  => array(),
						'data-xofweek'  => array(),
						'data-xofmonth'  => array(),
					),
					'i' => array(
						'class' => array(),
						'style'  => array(),
					),
				);
			echo wp_kses( $tacalendarsource, $arr ); ?>
	</div>
	<?php
}
add_shortcode( 'tortuga-recurring-calendar', 'ta_calendarshortcode' );
?>