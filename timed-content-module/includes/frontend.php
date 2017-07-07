<?php

$display = true;
$year = isset( $settings->year ) ? $settings->year : date( 'Y' );
$month = isset( $settings->month ) ? $settings->month : date( 'n' );
$day = isset( $settings->day ) ? $settings->day : date( 'j' );
$hour = isset( $settings->hours ) ? $settings->hours :'24';
$minutes = isset( $settings->minutes ) ? $settings->minutes :'0';

date_default_timezone_set( $settings->time_zone );
$date = new DateTime();
$date->format('Y-n-j H:i');
$now = $date->getTimestamp();

$set_time = $year. '-' . $month . '-' . $day . ' ' . $hour . ':' . $minutes; 
$date1 = new DateTime( $set_time );
$expire = $date1->getTimestamp();

if( $now > $expire ) {
	$display = false;
}

if ( $display ) {
	echo Timed_Content_Helper::get_timed_content( $settings );
}
elseif( isset( $settings->fixed_timer_action ) && $settings->fixed_timer_action == "msg" ) { ?>
	<div class='timed-content-message'><?php echo $settings->expire_message; ?></div>
<?php }
// else redirect url
?>