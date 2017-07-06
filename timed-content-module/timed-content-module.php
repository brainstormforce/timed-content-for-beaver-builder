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
	 * Summary
	 *
	 * @method update
	 * @param object $settings Setting object.
	 * @return object
	 */
	public function update( $settings ) {
		return $settings;
	}
}



/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('BSFBBTimedModule',
	array(

		// Add Timeline.
		'content'      => array( // Tab.
			'title'         => __( 'Content', 'timed-content-for-beaver-builder' ), // Tab title.
			'sections'      => array( // Tab Sections.
	  		'content_type' => array(
                    'fields'    => array(
                        'content_type'       => array(
                            'type'          => 'select',
                            'label'         => __('Type', 'timed-content-for-beaver-builder'),
                            'default'       => 'content',
                            'options'       => array(
                                'content'       => __('Content', 'timed-content-for-beaver-builder'),
                                'saved_rows'        => array(
                                    'label'         => __('Saved Rows', 'timed-content-for-beaver-builder'),
                                    'premium'       => true
                                ),
                                'saved_modules'     => array(
                                    'label'         => __('Saved Modules', 'timed-content-for-beaver-builder'),
                                    'premium'       => true
                                ),
                                'saved_page_templates'      => array(
                                    'label'         => __('Saved Page Templates', 'timed-content-for-beaver-builder'),
                                    'premium'       => true
                                ),
                            ),
                            'toggle'        => array(
                                'content'       => array(
                                    'fields'        => array('ct_content')
                                ),
                                'saved_rows'     => array(
                                    'fields'        => array('ct_saved_rows')
                                ),
                                'saved_modules'     => array(
                                    'fields'        => array('ct_saved_modules')
                                ),
                                'saved_page_templates'     => array(
                                    'fields'        => array('ct_page_templates')
                                )
                            )
                        ),
                        'ct_content'   => array(
                            'type'                  => 'editor',
                            'label'                 => '',
                            'default'               => '',
                            'connections'           => array( 'string', 'html' )
                        ),
                        'ct_saved_rows'      => array(
                            'type'                  => 'select',
                            'label'                 => __('Select Row', 'timed-content-for-beaver-builder'),
                            'options'               => Timed_Content_Helper::get_saved_row_template(),
                        ),
                        'ct_saved_modules'      => array(
                            'type'                  => 'select',
                            'label'                 => __('Select Module', 'timed-content-for-beaver-builder'),
                            'options'               => Timed_Content_Helper::get_saved_module_template(),
                        ),
                        'ct_page_templates'      => array(
                            'type'                  => 'select',
                            'label'                 => __('Select Page Template', 'timed-content-for-beaver-builder'),
                            'options'               => Timed_Content_Helper::get_saved_page_template(),
                        )
                    )
                )
			),
		),

		// Timeline Style.
		'settings'     => array(
			'title'         => __( 'Settings', 'timed-content-for-beaver-builder' ),
			'sections'      => array(
				// Timeline layout Option.
				'layout'       => array( // Section.
					'title'         => 'Select Time', // Section Title.
					'fields'        => array( // Section Fields
	                    'day'       => array(
	                        'type'          => 'select',
	                        'label'         => __('Day', 'timed-content-for-beaver-builder'),
	                        'class'         => '',
	                        'options'       => Timed_Content_Helper::get_dropdown_options( 1, 31),
	                    ),
						'month'       => array(
	                        'type'          => 'select',
	                        'label'         => __('Month', 'timed-content-for-beaver-builder'),
	                        'class'         => '',
	                        'options'       => Timed_Content_Helper::get_dropdown_options( 1, 12),
	                    ),
						'year'          => array(
							'type'          => 'text',
							'label'         => __( 'Year', 'timed-content-for-beaver-builder' ),
							'default'       => date( 'Y' ),
							'maxlength'     => '4',
							'size'          => '5',
							'preview'      => array(
								'type'         => 'none',
							),
						),
	                    'hours'       => array(
	                        'type'          => 'select',
	                        'label'         => __('Hour', 'timed-content-for-beaver-builder'),
	                        'class'         => '',
	                        'options'       => Timed_Content_Helper::get_dropdown_options( 0, 24),
	                    ),
	                    'minutes'   => array(
	                        'type'          => 'select',
	                        'label'         => __('Minutes', 'timed-content-for-beaver-builder'),
	                        'class'         => '',
	                        'options'       => Timed_Content_Helper::get_dropdown_options( 1, 60),
	                    ),
						'time_zone'          => array(
							'type'          => 'timezone',
							'label'         => __( 'Time Zone', 'timed-content-for-beaver-builder' ),
							'default'		=> 'UTC',
						),
	                    'fixed_timer_action'       => array(
	                        'type'          => 'select',
	                        'label'         => __('Action After Timer Expiry', 'timed-content-for-beaver-builder'),
	                        'default'       => 'hide',
	                        'class'         => '',
	                        'options'       => array(
	                            'hide'             => __('Hide Content', 'timed-content-for-beaver-builder'),
	                            'msg'         => __('Display Message', 'timed-content-for-beaver-builder'),
	                            'redirect'         => __('Redirect User to New URL', 'timed-content-for-beaver-builder')
	                        ),
	                      	'toggle'        => array(
	                            'msg'      => array(
	                                //'tabs'      => array( 'testimonials' ),
	                                'fields'     => array('expire_message')
	                            ),
	                            'redirect'      => array(
	                                'fields'     => array( 'redirect_link', 'redirect_link_target' ), //, 'icon_position_half_box'
	                            )
	                        ),
	                    ),
	                    'expire_message'          => array(
	                        'type'          => 'editor',
	                        'label'         => '',
	                        'media_buttons' => false,
	                        'rows'          => 6,
	                        'default'       => __('Enter message text here.','timed-content-for-beaver-builder'),
	                        'connections' => array( 'string', 'html' )
	                    ),
	                    'redirect_link'   => array(
	                        'type'          => 'link',
	                        'label'         => __('Enter URL', 'timed-content-for-beaver-builder'),
	                    ),
	                    'redirect_link_target'   => array(
	                        'type'          => 'select',
	                        'label'         => __('Link Target', 'timed-content-for-beaver-builder'),
	                        'default'       => '_self',
	                        'options'       => array(
	                            '_self'         => __('Same Window', 'timed-content-for-beaver-builder'),
	                            '_blank'        => __('New Window', 'timed-content-for-beaver-builder')
	                        ),
	                        'preview'       => array(
	                            'type'          => 'none'
	                        )
	                    ),
				)
				),
			),
		),

		// Typography
		'timed_typography'         => array(
			'title'         => __( 'Typography', 'timed-content-for-beaver-builder' ),
			'sections'      => array(
				// Timeline Date.
				'timed_message_typography'     => array(
					'title'         => __( 'Message', 'timed-content-for-beaver-builder' ),
					'fields'        => array(
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
							'default'           => '18',
							'maxlength'         => '3',
							'size'              => '4',
							'description'       => 'px',
						),

						'timed_msg_line_height' => array(
							'type'          => 'text',
							'label'         => __( 'Line Height', 'timed-content-for-beaver-builder' ),
							'maxlength'     => '4',
							'size'          => '4',
							'description'   => 'px',
						),

						'timed_msg_letter_spacing' => array(
							'type'          => 'text',
							'label'         => __( 'Letter Spacing', 'timed-content-for-beaver-builder' ),
							'default'       => '0',
							'maxlength'     => '3',
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
			),
		),
	)
);