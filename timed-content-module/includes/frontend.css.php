<?php
/**
 * Frontend options css
 *
 * @package timed-content-for-beaver-builder
 */

$display = $module->is_expired( $settings );
if ( FLBuilderModel::is_builder_active() && ! $display ) { ?>
	.fl-module-timed-content-module.fl-node-<?php echo $id; ?>::before {
		content: "Click here to edit Timed Content Module";
		position: relative;
		width: 100%;
		min-height: 50px;
		line-height: 50px;
		text-align: center;
	  }
<?php
}

if ( ! empty( $settings->timed_msg_font ) && 'Default' != $settings->timed_msg_font['family'] ) { ?>
.fl-node-<?php echo $id; ?> .timed-content-message p {
	<?php FLBuilderFonts::font_css( $settings->timed_msg_font ); ?>
}
<?php } ?>

.fl-node-<?php echo $id; ?> .timed-content-message p {
	color: #<?php echo $settings->timed_msg_color; ?>;
	font-size: <?php echo $settings->timed_msg_size; ?>px;
	line-height: <?php echo $settings->timed_msg_line_height; ?>px;
	letter-spacing: <?php echo $settings->timed_msg_letter_spacing; ?>px;
}

<?php if ( ! empty( $settings->timed_content_font ) && 'Default' != $settings->timed_content_font['family'] ) { ?>
.fl-node-<?php echo $id; ?> .timed-content-wrapper {
	<?php FLBuilderFonts::font_css( $settings->timed_content_font ); ?>
}
<?php } ?>

.fl-node-<?php echo $id; ?> .timed-content-wrapper {
	color: #<?php echo $settings->timed_content_color; ?>;
	font-size: <?php echo $settings->timed_content_size; ?>px;
	line-height: <?php echo $settings->timed_content_line_height; ?>px;
	letter-spacing: <?php echo $settings->timed_content_letter_spacing; ?>px;
}
