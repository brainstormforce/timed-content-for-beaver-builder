<?php

date_default_timezone_set($settings->time_zone);

$maintime= time();
$time = date('G-i-n-j-Y',$maintime);
$time = explode("-", $time);
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
elseif ( $settings->hours > $time[0] ) {
	$display = true;
}
elseif ( $settings->minutes > $time[1] ) {
	$display = true;
}

if ( $display ) {
	echo Timed_Content_Helper::get_timed_content( $settings );
}
elseif( isset( $settings->fixed_timer_action ) && $settings->fixed_timer_action == "msg" ) { ?>
	<div class='timed-content-message'><?php echo $settings->expire_message; ?></div>
<?php }
// else redirect url
?>