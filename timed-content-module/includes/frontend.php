<?php

// if not expired

date_default_timezone_set('Asia/Kolkata');

// $time = $module->get_time();

$maintime= time();
$time = date('h-i-n-j-Y-a',$maintime);

$display = false;

if( $settings->year > $time[4] ) {
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

/*$time = explode("-", $time);
print_r($time);
echo '---';
echo $settings->day;
echo '-';
echo $settings->month;
echo '-';
echo $settings->year;
echo '-';
echo $settings->time['hours'];
echo '-';
echo $settings->time['minutes'];
echo '-';
echo $settings->time['day_period'];
echo '-';*/
	

echo Timed_Content_Helper::get_timed_content( $settings );
// elseif ( isset( $settings->fixed_timer_action ) && $settings->fixed_timer_action == "msg" ){

// expired message

//}

// else redirect url
?>