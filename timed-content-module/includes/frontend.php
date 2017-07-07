<?php
/**
 * Frontend view
 *
 * @package timed-content-for-beaver-builder
 */

$display = $module->is_expired( $settings );

if ( $display ) {
	echo '<div class="timed-content-wrapper">' . Timed_Content_Helper::get_timed_content( $settings ) . '</div>';
} elseif ( isset( $settings->fixed_timer_action ) && 'msg' == $settings->fixed_timer_action ) {
	echo '<' . $settings->timed_tag_selection . ' class="timed-content-message">' . $settings->expire_message . '</' . $settings->timed_tag_selection . '>';
}

