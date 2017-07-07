<?php
/**
 * Timed Content Module for Beaver Builder
 *
 * @package timed-content-for-beaver-builder
 */

/**
 * Timed Content Module for Beaver Builder
 *
 * @since 1.0.0
 */
class BSFBBTimedModule extends FLBuilderModule {
	/**
	 * Constructor function for the module. You must pass the
	 * name, description, dir and url in an array to the parent class.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(array(
			'name'          => __( 'Timed Content', 'timed-content-for-beaver-builder' ),
			'description'   => __( 'To create timed content.', 'timed-content-for-beaver-builder' ),
			'category'		=> __( 'Advanced Modules', 'timed-content-for-beaver-builder' ),
			'dir'           => TIMED_CONTENT_BEAVER_BUILDER_DIR . 'timed-content-module/',
			'url'           => TIMED_CONTENT_BEAVER_BUILDER_URL . 'timed-content-module/',
			'partial_refresh' => false,// Defaults to false and can be omitted.
		));
	}

	/**
	 * Check module expiry
	 *
	 * @param object $settings Setting object.
	 * @return object
	 */
	public function is_expired( $settings ) {
		$display = true;
		$year = isset( $settings->year ) ? $settings->year : date( 'Y' );
		$month = isset( $settings->month ) ? $settings->month : date( 'n' );
		$day = isset( $settings->day ) ? $settings->day : date( 'j' );
		$hour = isset( $settings->hours ) ? $settings->hours :'24';
		$minutes = isset( $settings->minutes ) ? $settings->minutes :'0';

		date_default_timezone_set( $settings->time_zone );
		$date = new DateTime();
		$date->format( 'Y-n-j H:i' );
		$now = $date->getTimestamp();

		$set_time = $year . '-' . $month . '-' . $day . ' ' . $hour . ':' . $minutes;
		$date1 = new DateTime( $set_time );
		$expire = $date1->getTimestamp();

		if ( $expire < $now ) {
			$display = false;
		}
		return $display;
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('BSFBBTimedModule',
	array(

		// Add Timed.
		'content'      => array( // Tab.
			'title'         => __( 'Content', 'timed-content-for-beaver-builder' ), // Tab title.
			'sections'      => array( // Tab Sections.
			  'content_type' => array(
					'fields'    => array(
						'content_type'       => array(
							'type'          => 'select',
							'label'         => __( 'Type', 'timed-content-for-beaver-builder' ),
							'default'       => 'content',
							'options'       => array(
								'content'       => __( 'Content', 'timed-content-for-beaver-builder' ),
								'saved_rows'        => array(
									'label'         => __( 'Saved Rows', 'timed-content-for-beaver-builder' ),
									'premium'       => true,
								),
								'saved_modules'     => array(
									'label'         => __( 'Saved Modules', 'timed-content-for-beaver-builder' ),
									'premium'       => true,
								),
								'saved_page_templates'      => array(
									'label'         => __( 'Saved Page Templates', 'timed-content-for-beaver-builder' ),
									'premium'       => true,
								),
							),
							'toggle'        => array(
								'content'       => array(
									'fields'        => array( 'ct_content' ),
									'sections'		=> array( 'timed_content_typography' ),
								),
								'saved_rows'     => array(
									'fields'        => array( 'ct_saved_rows' ),
								),
								'saved_modules'     => array(
									'fields'        => array( 'ct_saved_modules' ),
								),
								'saved_page_templates'     => array(
									'fields'        => array( 'ct_page_templates' ),
								),
							),
						),
						'ct_content'   => array(
							'type'                  => 'editor',
							'label'                 => '',
							'default'               => '',
							'connections'           => array( 'string', 'html' ),
						),
						'ct_saved_rows'      => array(
							'type'                  => 'select',
							'label'                 => __( 'Select Row', 'timed-content-for-beaver-builder' ),
							'options'               => Timed_Content_Helper::get_saved_row_template(),
						),
						'ct_saved_modules'      => array(
							'type'                  => 'select',
							'label'                 => __( 'Select Module', 'timed-content-for-beaver-builder' ),
							'options'               => Timed_Content_Helper::get_saved_module_template(),
						),
						'ct_page_templates'      => array(
							'type'                  => 'select',
							'label'                 => __( 'Select Page Template', 'timed-content-for-beaver-builder' ),
							'options'               => Timed_Content_Helper::get_saved_page_template(),
						),
					),
				),
			),
		),

		// Timed Style.
		'settings'     => array(
			'title'         => __( 'Settings', 'timed-content-for-beaver-builder' ),
			'sections'      => array(
				// Timed layout Option.
				'layout'       => array( // Section.
					'title'         => 'Select Time', // Section Title.
					'fields'        => array( // Section Fields.
						'day'       => array(
							'type'          => 'select',
							'label'         => __( 'Day', 'timed-content-for-beaver-builder' ),
							'default'		=> date( 'j' ),
							'options'       => Timed_Content_Helper::get_dropdown_options( 1, 31 ),
						),
						'month'       => array(
							'type'          => 'select',
							'label'         => __( 'Month', 'timed-content-for-beaver-builder' ),
							'class'         => '',
							'default'		=> date( 'n' ),
							'options'       => Timed_Content_Helper::get_dropdown_options( 1, 12 ),
						),
						'year'          => array(
							'type'          => 'text',
							'label'         => __( 'Year', 'timed-content-for-beaver-builder' ),
							'default'       => date( 'Y' ),
							'maxlength'     => '4',
							'size'          => '5',
						),
						'hours'       => array(
							'type'          => 'select',
							'default'       => '23',
							'label'         => __( 'Hour', 'timed-content-for-beaver-builder' ),
							'options'       => Timed_Content_Helper::get_dropdown_options( 0, 23 ),
						),
						'minutes'   => array(
							'type'          => 'select',
							'default'       => '0',
							'label'         => __( 'Minutes', 'timed-content-for-beaver-builder' ),
							'options'       => Timed_Content_Helper::get_dropdown_options( 0, 59 ),
						),
						'time_zone'          => array(
							'type'          => 'timezone',
							'label'         => __( 'Time Zone', 'timed-content-for-beaver-builder' ),
							'default'		=> 'UTC',
						),
						'expire_content_action'       => array(
							'type'          => 'select',
							'label'         => __( 'Action After Timer Expiry', 'timed-content-for-beaver-builder' ),
							'default'       => 'hide',
							'class'         => '',
							'options'       => array(
								'hide'             => __( 'Hide Content', 'timed-content-for-beaver-builder' ),
								'msg'         => __( 'Display Expiry Message', 'timed-content-for-beaver-builder' ),
							),
							  'toggle'        => array(
								'msg'      => array(
									'fields'     => array( 'expire_message' ),
									'sections'	=> array( 'timed_message_typography' ),
								),
							),
						),
						'expire_message'          => array(
							'type'          => 'editor',
							'label'         => '',
							'media_buttons' => false,
							'rows'          => 6,
							'default'       => __( 'Enter message text here.','timed-content-for-beaver-builder' ),
							'connections' => array( 'string', 'html' ),
						),
				),
				),
			),
		),

		// Typography.
		'timed_typography'         => array(
			'title'         => __( 'Typography', 'timed-content-for-beaver-builder' ),
			'sections'      => array(
				// Timed Date.
				'timed_message_typography'     => array(
					'title'         => __( 'Expiry Message', 'timed-content-for-beaver-builder' ),
					'fields'        => array(
						'timed_tag_selection'   => array(
							'type'          => 'select',
							'label'         => __( 'Message Tag', 'timed-content-for-beaver-builder' ),
							'default'       => 'h4',
							'options'       => array(
								'h1'      => __( 'H1', 'timed-content-for-beaver-builder' ),
								'h2'      => __( 'H2', 'timed-content-for-beaver-builder' ),
								'h3'      => __( 'H3', 'timed-content-for-beaver-builder' ),
								'h4'      => __( 'H4', 'timed-content-for-beaver-builder' ),
								'h5'      => __( 'H5', 'timed-content-for-beaver-builder' ),
								'h6'      => __( 'H6', 'timed-content-for-beaver-builder' ),
								'div'     => __( 'Div', 'timed-content-for-beaver-builder' ),
								'p'       => __( 'p', 'timed-content-for-beaver-builder' ),
								'span'    => __( 'span', 'timed-content-for-beaver-builder' ),
							),
						),
						'timed_msg_font'          => array(
							'type'          => 'font',
							'default'       => array(
								'family'        => 'Default',
								'weight'        => 300,
							),
							'label'         => __( 'Font Family', 'timed-content-for-beaver-builder' ),
							'preview'         => array(
								'type'            => 'font',
								'selector'        => '.timed-content-message p',
							),
						),

						'timed_msg_size' => array(
							'type'              => 'text',
							'label'             => __( 'Font Size', 'timed-content-for-beaver-builder' ),
							'maxlength'         => '3',
							'size'              => '4',
							'description'       => 'px',
						),

						'timed_msg_line_height' => array(
							'type'          => 'text',
							'label'         => __( 'Line Height', 'timed-content-for-beaver-builder' ),
							'maxlength'     => '4',
							'default'    => '',
							'size'          => '4',
							'description'   => 'px',
						),

						'timed_msg_letter_spacing' => array(
							'type'          => 'text',
							'label'         => __( 'Letter Spacing', 'timed-content-for-beaver-builder' ),
							'maxlength'     => '3',
							'default'    => '',
							'size'          => '4',
							'description'   => 'px',
						),

						'timed_msg_color'    => array(
							'type'       => 'color',
							'label'         => __( 'Text Color', 'timed-content-for-beaver-builder' ),
							'default'    => '',
							'show_reset' => true,
							'preview'       => array(
								'type' => 'css',
								'property' => 'color',
								'selector' => '.timed-content-message p',
							),
						),
					),
				),
				// Timed Date.
				'timed_content_typography'     => array(
					'title'         => __( 'Content', 'timed-content-for-beaver-builder' ),
					'fields'        => array(
						'timed_content_font'          => array(
							'type'          => 'font',
							'default'       => array(
								'family'        => 'Default',
								'weight'        => 300,
							),
							'label'         => __( 'Font Family', 'timed-content-for-beaver-builder' ),
							'preview'         => array(
								'type'            => 'font',
								'selector'        => '.timed-content-wrapper',
							),
						),

						'timed_content_size' => array(
							'type'              => 'text',
							'label'             => __( 'Font Size', 'timed-content-for-beaver-builder' ),
							'maxlength'         => '3',
							'size'              => '4',
							'description'       => 'px',
						),

						'timed_content_line_height' => array(
							'type'          => 'text',
							'label'         => __( 'Line Height', 'timed-content-for-beaver-builder' ),
							'maxlength'     => '4',
							'size'          => '4',
							'description'   => 'px',
						),

						'timed_content_letter_spacing' => array(
							'type'          => 'text',
							'label'         => __( 'Letter Spacing', 'timed-content-for-beaver-builder' ),
							'default'       => '',
							'maxlength'     => '3',
							'size'          => '4',
							'description'   => 'px',
						),

						'timed_content_color'    => array(
							'type'       => 'color',
							'label'         => __( 'Text Color', 'timed-content-for-beaver-builder' ),
							'default'    => '',
							'show_reset' => true,
							'preview'       => array(
								'type' => 'css',
								'property' => 'color',
								'selector' => '.timed-content-wrapper',
							),
						),
					),
				),
			),
		),
	)
);
