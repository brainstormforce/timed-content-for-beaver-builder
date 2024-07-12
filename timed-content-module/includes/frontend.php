<?php
/**
 * Frontend view
 *
 * @package timed-content-for-beaver-builder
 */

$display = $module->is_expired( $settings );
$is_start = $module->is_start( $settings );
if ( $display ) {
	if ( isset( $settings->content_type ) && 'content' == $settings->content_type ) {
		echo '<div class="timed-content-wrapper">' . Timed_Content_Helper::get_timed_content( $settings ) . '</div>';
	} else {
		echo Timed_Content_Helper::get_timed_content( $settings );
	}
} elseif ( isset( $settings->expire_content_action ) && 'msg' == $settings->expire_content_action && $is_start ) {
	echo '<' . esc_attr($settings->timed_tag_selection) . ' class="timed-content-message">' . wp_kses_post( $settings->expire_message ). '</' . esc_attr($settings->timed_tag_selection) . '>';
}

