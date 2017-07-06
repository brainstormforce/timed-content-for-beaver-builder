<?php

// if not expired


// $time = $module->get_time();

$maintime= time();
$time = date('h-i-n-j-Y-a',$maintime);
$time = explode("-", $time);
$display = false;

date_default_timezone_set($settings->time_zone);

if( $settings->year > $time[5] ) {
	$display = true;
}
elseif ( $settings->month > $time[2] ) {
	$display = true;
}
elseif ( $settings->day > $time[3] ) {
	$display = true;
}
// elseif () {
// check time
// }

/*
echo $settings->time['hours'];
echo '-';
echo $settings->time['minutes'];
echo '-';
echo $settings->time['day_period'];
echo '-';*/
// print_r($settings);

if ( $display ) {
	echo Timed_Content_Helper::get_timed_content( $settings );
}
elseif( isset( $settings->fixed_timer_action ) && $settings->fixed_timer_action == "msg" ) {

// expired message
	echo $settings->expire_message;
}
// else redirect url
?>