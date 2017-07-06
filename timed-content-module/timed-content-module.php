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
			'name'          => __( 'Timed Content', 'bb-timeline' ),
			'description'   => __( 'To create timed content.', 'bb-timeline' ),
			'category'		=> __( 'Advanced Modules', 'bb-timeline' ),
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
			'title'         => __( 'Content', 'bb-timeline' ), // Tab title.
			'sections'      => array( // Tab Sections.
	  		'content_type' => array(
                    'fields'    => array(
                        'content_type'       => array(
                            'type'          => 'select',
                            'label'         => __('Type', 'uabb'),
                            'default'       => 'content',
                            'options'       => array(
                                'content'       => __('Content', 'uabb'),
                                'photo'         => __('Photo', 'uabb'),
                                'video'         => __('Video Embed Code', 'uabb'),
                                'saved_rows'        => array(
                                    'label'         => __('Saved Rows', 'uabb'),
                                    'premium'       => true
                                ),
                                'saved_modules'     => array(
                                    'label'         => __('Saved Modules', 'uabb'),
                                    'premium'       => true
                                ),
                                'saved_page_templates'      => array(
                                    'label'         => __('Saved Page Templates', 'uabb'),
                                    'premium'       => true
                                ),
                            ),
                            'toggle'        => array(
                                'content'       => array(
                                    'fields'        => array('ct_content')
                                ),
                                'photo'        => array(
                                    'fields'        => array('ct_photo')
                                ),
                                'video'         => array(
                                    'fields'        => array('ct_video')
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
                        'ct_photo'     => array(
                            'type'                  => 'photo',
                            'label'                 => __('Select Photo', 'uabb'),
                            'show_remove'           => true,
                        ),
                        'ct_video'     => array(
                            'type'                  => 'textarea',
                            'label'                 => __('Embed Code / URL', 'uabb'),
                            'rows'                  => 6
                        ),
                        'ct_saved_rows'      => array(
                            'type'                  => 'select',
                            'label'                 => __('Select Row', 'uabb'),
                            'options'               => Timed_Content_Helper::get_saved_row_template(),
                        ),
                        'ct_saved_modules'      => array(
                            'type'                  => 'select',
                            'label'                 => __('Select Module', 'uabb'),
                            'options'               => Timed_Content_Helper::get_saved_module_template(),
                        ),
                        'ct_page_templates'      => array(
                            'type'                  => 'select',
                            'label'                 => __('Select Page Template', 'uabb'),
                            'options'               => Timed_Content_Helper::get_saved_page_template(),
                        )
                    )
                )
			),
		),

		// Timeline Style.
		'settings'     => array(
			'title'         => __( 'Settings', 'bb-timeline' ),
			'sections'      => array(
				// Timeline layout Option.
				'layout'       => array( // Section.
					'title'         => 'Select Time', // Section Title.
					'fields'        => array( // Section Fields
                    'day'          => array(
						'type'          => 'text',
						'label'         => __( 'Day', 'fl-builder' ),
						'default'       => date( 'j' ),
						'maxlength'     => '2',
						'size'          => '5',
						'preview'      => array(
							'type'         => 'none',
						),
					),
					'month'         => array(
						'type'          => 'text',
						'label'         => __( 'Month', 'fl-builder' ),
						'default'       => date( 'n' ),
						'maxlength'     => '2',
						'size'          => '5',
						'preview'      => array(
							'type'         => 'none',
						),
					),
					'year'          => array(
						'type'          => 'text',
						'label'         => __( 'Year', 'fl-builder' ),
						'default'       => date( 'Y' ),
						'maxlength'     => '4',
						'size'          => '5',
						'preview'      => array(
							'type'         => 'none',
						),
					),
					'time'          => array(
						'type'          => 'time',
						'label'         => __( 'Time', 'fl-builder' ),
						'default'		=> array(
							'hours'			=> '15',
							'minutes'		=> '00',
							'day_period'	=> 'am',
						),
					),
                    'time_hours'       => array(
                        'type'          => 'select',
                        'label'         => __('Hour', 'uabb'),
                        'class'         => '',
                        'options'       => array(
                            '0'             => __('0t', 'uabb'),
                            '1'         => __('1', 'uabb'),
                            '2'         => __('2', 'uabb')
                        ),
                    ),
					'time_zone'          => array(
						'type'          => 'timezone',
						'label'         => __( 'Time Zone', 'fl-builder' ),
						'default'		=> 'UTC',
					),
                    'fixed_timer_action'       => array(
                        'type'          => 'select',
                        'label'         => __('Action After Timer Expiry', 'uabb'),
                        'default'       => 'hide',
                        'class'         => '',
                        'options'       => array(
                            'hide'             => __('Hide Content', 'uabb'),
                            'msg'         => __('Display Message', 'uabb'),
                            'redirect'         => __('Redirect User to New URL', 'uabb')
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
                        'default'       => __('Enter message text here.','uabb'),
                        'connections' => array( 'string', 'html' )
                    ),
                    'redirect_link'   => array(
                        'type'          => 'link',
                        'label'         => __('Enter URL', 'uabb'),
                    ),
                    'redirect_link_target'   => array(
                        'type'          => 'select',
                        'label'         => __('Link Target', 'uabb'),
                        'default'       => '_self',
                        'options'       => array(
                            '_self'         => __('Same Window', 'uabb'),
                            '_blank'        => __('New Window', 'uabb')
                        ),
                        'preview'       => array(
                            'type'          => 'none'
                        )
                    ),
				)
				),
			),
		),
	)
);

/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form('bb_timeline_form', array(
	'title' => __( 'Add Timeline', 'bb-timeline' ),
	'tabs'  => array(
		'general'      => array( // Tab.
			'title'         => __( 'General', 'bb-timeline' ), // Tab title.
			'sections'      => array( // Tab Sections.
				// Title.
				'timeline_title_section'       => array( // Section.
					'title'         => __( 'Title', 'bb-timeline' ), // Section Title.
					'fields'        => array( // Section Fields.
						'timeline_title' => array(
							'type'          => 'text',
							'label'         => __( 'Timeline Title', 'bb-timeline' ),
							'default'       => 'Title of section',
							'connections'   => array( 'string', 'html' ),
						),
						'timeline_title_align'     => array(
							'type'          => 'select',
							'label'         => __( 'Title Alignment', 'bb-timeline' ),
							'default'       => 'Left',
							'options'       => array(
								'left'      => __( 'Left', 'bb-timeline' ),
								'center'    => __( 'Center', 'bb-timeline' ),
								'right'     => __( 'Right', 'bb-timeline' ),
							),
						),

					),
				),

				// Description.
				'timeline_editor_section'       => array( // Section.
					'title'         => __( 'Description', 'bb-timeline' ), // Section Title.
					'fields'        => array( // Section Fields.
						'timeline_editor'          => array(
							'type'          => 'editor',
							'rows'          => 5,
							'default'       => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.',
							'connections'   => array( 'string', 'html' ),
						),
					),
				),

				// Timeline Date / Content.
				'timeline_date_area'       => array(
					'title'         => __( 'Date / Content Area', 'bb-timeline' ),
					'fields'        => array(
						'timeline_date_customcontent_type'    => array(
							'type'          => 'select',
							'label'         => __( 'Select Type', 'bb-timeline' ),
							'default'       => 'rsdate',
							'options'       => array(
								'rsdate'            => __( 'Date', 'bb-timeline' ),
								'customcontent'     => __( 'Content', 'bb-timeline' ),
							),
							'toggle'        => array(
								'rsdate'          => array(
									'sections'   => array( 'date' ),
								),
								'customcontent'         => array(
									'sections'   => array( 'custom_content' ),
								),
							),
						),
					),
				),

				// Set Date.
				'date'       => array(
					'fields'        => array(
						'day'          => array(
							'type'          => 'text',
							'label'         => __( 'Day', 'bb-timeline' ),
							'default'       => date( 'd' ),
							'maxlength'     => '2',
							'size'          => '5',
						),
						'month'         => array(
							'type'          => 'text',
							'label'         => __( 'Month', 'bb-timeline' ),
							'default'       => date( 'm' ),
							'maxlength'     => '2',
							'size'          => '5',
						),
						'year'          => array(
							'type'          => 'text',
							'label'         => __( 'Year', 'bb-timeline' ),
							'default'       => date( 'Y' ),
							'maxlength'     => '4',
							'size'          => '5',
							'description'   => __( '<br/><br/>Please fill all three fields to display date.', 'bb-timeline' ),
						),
					),
				),

				// Custom-Content.
				'custom_content'       => array( // Section.
					'fields'        => array( // Section Fields.
						'timeline_custom_content_editor'          => array(
							'type'          => 'editor',
							'rows'          => 5,
							'default'       => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
							'connections'   => array( 'string', 'html' ),
						),
					),
				),
			),
		),

		// Timeline Style.
		'timeline_img_icon'     => array(
			'title'         => __( 'Image / Icon', 'bb-timeline' ),
			'sections'      => array(
				// Timeline Icon / Image.
				'timeline_img_icon'       => array(
					'title'         => __( 'Image / Icon', 'bb-timeline' ),
					'fields'        => array(
						'timeline_img_icon_type'    => array(
							'type'          => 'select',
							'label'         => __( 'Select Type', 'bb-timeline' ),
							'default'       => 'icon',
							'options'       => array(
								'none'          => __( 'None', 'bb-timeline' ),
								'icon'          => __( 'Icon', 'bb-timeline' ),
								'photo'         => __( 'Image', 'bb-timeline' ),
							),
							'toggle'        => array(
								'icon'          => array(
									'sections'   => array( 'timeline_icon' ),
								),
								'photo'         => array(
									'sections'   => array( 'photo' ),
								),
							),
						),
					),
				),

				// Timeline Icon.
				'timeline_icon'       => array(
					'title'         => '', // Section Title.
					'fields'        => array(
						// Select Icon.
						'timeline_icon_style'          => array(
							'type'          => 'icon',
							'label'         => __( 'Icon', 'bb-timeline' ),
							'default' => 'fa fa-circle',
							'show_remove' => true,
						),

						/* Icon Background Style */
						'icon_bg_style'         => array(
							'type'          => 'select',
							'label'         => __( 'Icon Background Style', 'bb-timeline' ),
							'default'       => 'simple',
							'options'       => array(
								'simple'        => __( 'Simple', 'bb-timeline' ),
								'custom'         => __( 'Customize', 'bb-timeline' ),
							),
							'toggle' => array(
								'simple' => array(
									'sections'   => array( '' ),
									'fields' => array( 'timeline_icon_colors', 'timeline_icon_hover_colors' ),
								),

								'custom' => array(
									'sections'   => array( 'icon_boder_settings' ),
									'fields' => array( 'timeline_icon_colors', 'timeline_icon_hover_colors' ),
								),
							),
						),

						// Icon colors.
						'timeline_icon_colors' => array(
							'type'       => 'color',
							'label'      => __( 'Icon Color', 'bb-timeline' ),
							'default'    => '5b9dd9',
							'show_reset' => true,
						),

						// Icon hover colors.
						'timeline_icon_hover_colors' => array(
							'type'       => 'color',
							'label'      => __( 'Icon Hover Color', 'bb-timeline' ),
							'default'    => '',
							'show_reset' => true,
						),
					),
				),

				// Timeline Icon Border.
				'icon_boder_settings'       => array(
					'title'         => '', // Section Title.
					'fields'        => array(
						// Image/icon Background Color.
						'timeline_tmb_icon_bg_color' => array(
							'type'       => 'color',
							'label'         => __( 'Background Color', 'bb-timeline' ),
							'default'    => '',
							'show_reset' => true,
							'help'         => __( 'To manage background color.', 'bb-timeline' ),
						),

						'timeline_tmb_bg_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Background Opacity', 'bb-timeline' ),
							'default'     => '0',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '4',
							'help'         => __( 'To manage background opacity.', 'bb-timeline' ),
						),

						/* Border Style */
						'icon_border_style'   => array(
							'type'          => 'select',
							'label'         => __( 'Border Style', 'bb-timeline' ),
							'default'       => 'none',
							'help'          => __( 'The type of border to use. Double borders must have a width of at least 3px to render properly.', 'bb-timeline' ),
							'options'       => array(
								'none'   => __( 'None', 'bb-timeline' ),
								'solid'  => __( 'Solid', 'bb-timeline' ),
								'dashed' => __( 'Dashed', 'bb-timeline' ),
								'dotted' => __( 'Dotted', 'bb-timeline' ),
								'double' => __( 'Double', 'bb-timeline' ),
							),
							'toggle'        => array(
								'solid'         => array(
									'fields'        => array( 'icon_border_width', 'icon_border_color', 'icon_border_color_opc' ),
								),
								'dashed'        => array(
									'fields'        => array( 'icon_border_width', 'icon_border_color', 'icon_border_color_opc' ),
								),
								'dotted'        => array(
									'fields'        => array( 'icon_border_width', 'icon_border_color', 'icon_border_color_opc' ),
								),
								'double'        => array(
									'fields'        => array( 'icon_border_width', 'icon_border_color', 'icon_border_color_opc' ),
								),
							),
						),

						'icon_border_width'    => array(
							'type'          => 'text',
							'label'         => __( 'Border Width', 'bb-timeline' ),
							'default'       => '',
							'description'   => 'px',
							'maxlength'     => '3',
							'size'          => '4',
							'placeholder'   => '1',
							'preview'       => array(
									'type'      => 'css',
									'selector'  => '.bb-tmicon',
									'property'  => 'border-width',
									'unit'      => 'px',
							),
						),

						'icon_border_color' => array(
							'type'       => 'color',
							'label'         => __( 'Border Color', 'bb-timeline' ),
							'default'    => '',
							'show_reset' => true,
						),

						'icon_border_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Border Color Opacity', 'bb-timeline' ),
							'default'     => '100',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '4',
							'help'         => __( 'To manage connector line opacity.', 'bb-timeline' ),
						),
						// Image/icon Border Radius.
						'connector_border_radius' => array(
							'type'          => 'text',
							'label'         => __( 'Border Radius', 'bb-timeline' ),
							'default'     => '0',
							'maxlength'     => '3',
							'size'          => '4',
							'description'   => '%',
							'help'         => __( 'To manage Icon / Image border corners.', 'bb-timeline' ),
						),
					),
				),

				// Timeline Image.
				'photo'       => array(
					'title'         => '', // Section Title.
					'fields'        => array(
						// Select Image.
						'photo'         => array(
							'type'          => 'photo',
							'label'         => __( 'Image', 'bb-timeline' ),
							'show_remove'   => true,
							'connections'   => array( 'photo' ),
						),

						/* Icon Background Style */
						'img_bg_style'         => array(
							'type'          => 'select',
							'label'         => __( 'Image Background Style', 'bb-timeline' ),
							'default'       => 'simple',
							'options'       => array(
								'imgsimple'        => __( 'Simple', 'bb-timeline' ),
								'imgcustom'         => __( 'Customize', 'bb-timeline' ),
							),
							'toggle' => array(
								'imgsimple' => array(
									'fields' => array(),
								),

								'imgcustom' => array(
									'sections'   => array( 'img_boder_settings' ),
								),
							),
						),
					),
				),

				// Timeline Image Border.
				'img_boder_settings'       => array(
					'title'         => '', // Section Title.
					'fields'        => array(
						// Image/icon Background Color.
						'timeline_tmb_img_bg_color' => array(
							'type'       => 'color',
							'label'         => __( 'Background Color', 'bb-timeline' ),
							'default'    => 'ffffff',
							'show_reset' => true,
							'help'         => __( 'To manage background color.', 'bb-timeline' ),
						),

						'timeline_tmb_img_bg_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Background Opacity', 'bb-timeline' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '4',
							'help'         => __( 'To manage background opacity.', 'bb-timeline' ),
						),

						/* Border Style */
						'img_border_style'   => array(
							'type'          => 'select',
							'label'         => __( 'Border Style', 'bb-timeline' ),
							'default'       => 'solid',
							'help'          => __( 'The type of border to use. Double borders must have a width of at least 3px to render properly.', 'bb-timeline' ),
							'options'       => array(
								'none'   => __( 'None', 'bb-timeline' ),
								'solid'  => __( 'Solid', 'bb-timeline' ),
								'dashed' => __( 'Dashed', 'bb-timeline' ),
								'dotted' => __( 'Dotted', 'bb-timeline' ),
								'double' => __( 'Double', 'bb-timeline' ),
							),
							'toggle'        => array(
								'solid'         => array(
									'fields'        => array( 'img_border_width', 'img_border_color', 'img_border_color_opc', 'img_border_radius' ),
								),
								'dashed'        => array(
									'fields'        => array( 'img_border_width', 'img_border_color', 'img_border_color_opc', 'img_border_radius' ),
								),
								'dotted'        => array(
									'fields'        => array( 'img_border_width', 'img_border_color', 'img_border_color_opc', 'img_border_radius' ),
								),
								'double'        => array(
									'fields'        => array( 'img_border_width', 'img_border_color', 'img_border_color_opc', 'img_border_radius' ),
								),
							),
						),

						'img_border_width'    => array(
							'type'          => 'text',
							'label'         => __( 'Border Width', 'bb-timeline' ),
							'default'       => '',
							'description'   => 'px',
							'maxlength'     => '3',
							'size'          => '4',
							'placeholder'   => '1',
							'preview'       => array(
									'type'      => 'css',
									'selector'  => '.bb-tm-image',
									'property'  => 'border-width',
									'unit'      => 'px',
							),
						),

						'img_border_color' => array(
							'type'       => 'color',
							'label'         => __( 'Border Color', 'bb-timeline' ),
							'default'    => '',
							'show_reset' => true,
						),

						'img_border_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Border Color Opacity', 'bb-timeline' ),
							'default'     => '100',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '4',
							'help'         => __( 'To manage connector line opacity.', 'bb-timeline' ),
						),

						// Image/icon Border Radius.
						'img_border_radius' => array(
							'type'          => 'text',
							'label'         => __( 'Border Radius', 'bb-timeline' ),
							'default'     => '0',
							'maxlength'     => '3',
							'size'          => '4',
							'description'   => '%',
							'help'         => __( 'To manage Icon / Image border corners.', 'bb-timeline' ),
						),
					),
				),
			),
		),

		// Timeline Style.
		'timeline_style'     => array(
			'title'         => __( 'Style', 'bb-timeline' ),
			'sections'      => array(
				// Timeline Section Styling.
				'timeline_bg_sections'     => array(
					'title'         => __( 'Timeline Section', 'bb-timeline' ),
					'fields'        => array(
						'sections_bg_color' => array(
							'type'       => 'color',
							'label'         => __( 'Background Color', 'bb-timeline' ),
							'default'    => '',
							'show_reset' => true,
						),

						'sections_bg_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'bb-timeline' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),

						'timeline_section_border_style'         => array(
							'type'          => 'select',
							'label'         => __( 'Border Style', 'bb-timeline' ),
							'default'       => 'none',
							'options'       => array(
								'none'      => __( 'None', 'bb-timeline' ),
								'solid'     => _x( 'Solid', 'Border type.', 'bb-timeline' ),
								'dashed'    => _x( 'Dashed', 'Border type.', 'bb-timeline' ),
								'dotted'    => _x( 'Dotted', 'Border type.', 'bb-timeline' ),
								'double'    => _x( 'Double', 'Border type.', 'bb-timeline' ),
							),

							'toggle'        => array(
								'solid'        => array(
									'fields'        => array( 'timeline_sections_border_width', 'timeline_sections_border_color' ),
								),
								'dashed'        => array(
									'fields'        => array( 'timeline_sections_border_width', 'timeline_sections_border_color' ),
								),
								'dotted'        => array(
									'fields'        => array( 'timeline_sections_border_width', 'timeline_sections_border_color' ),
								),
								'double'        => array(
									'fields'        => array( 'timeline_sections_border_width', 'timeline_sections_border_color' ),
								),
							),
							'preview'       => array(
								'type'          => 'css',
								'selector'      => '.bb-tmlabel',
								'property'      => 'border-style',
							),
						),

						'timeline_sections_border_color'         => array(
							'type'          => 'color',
							'label'         => __( 'Border Color', 'bb-timeline' ),
							'default'       => 'ffffff',
							'show_reset' => true,
							'preview'       => array(
								'type'          => 'css',
								'selector'      => '.bb-tmlabel',
								'property'      => 'border-color',
							),
						),

						'timeline_sections_border_width'        => array(
							'type'          => 'text',
							'label'         => __( 'Border Size', 'bb-timeline' ),
							'default'       => '0',
							'maxlength'     => '2',
							'size'          => '3',
							'description'   => 'px',
							'preview'       => array(
								'type'          => 'css',
								'selector'      => '.bb-tmlabel',
								'property'      => 'border-width',
								'unit'          => 'px',
							),
						),

						'timeline_sections_border_radius'        => array(
							'type'          => 'text',
							'label'         => __( 'Rounded Corners', 'bb-timeline' ),
							'default'       => '5',
							'maxlength'     => '2',
							'size'          => '3',
							'description'   => 'px',
							'preview'       => array(
								'type'          => 'css',
								'selector'      => '.bb-tmlabel',
								'property'      => 'border-radius',
								'unit'          => 'px',
							),
						),

						'timeline_sections_padding_top' => array(
							'type'              => 'text',
							'label'             => __( 'Top Spacing', 'bb-timeline' ),
							'placeholder'       => '0',
							'maxlength'         => '3',
							'size'              => '4',
							'description'       => 'px',
							'default'    => '10',
							'preview'       => array(
								'type' => 'css',
								'property' => 'padding-top',
								'selector' => '.tm-conatiner-main',
								'unit'       => 'px',
							),
						),

						'timeline_sections_padding_bottom' => array(
							'type'              => 'text',
							'label'             => __( 'Bottom Spacing', 'bb-timeline' ),
							'placeholder'       => '0',
							'maxlength'         => '3',
							'size'              => '4',
							'description'       => 'px',
							'default'    => '0',
							'preview'       => array(
								'type' => 'css',
								'property' => 'badding-bottom',
								'selector' => '.tm-conatiner-main',
								'unit'       => 'px',
							),
						),
					),
				),

				// Separator.
				'timeline_title_border'     => array(
					'title'         => __( 'Separator', 'bb-timeline' ),
					'fields'        => array(
						'timeline_title_border_style'         => array(
							'type'          => 'select',
							'label'         => __( 'Style', 'bb-timeline' ),
							'default'       => 'solid',
							'options'       => array(
								'none'      => __( 'None', 'bb-timeline' ),
								'solid'     => _x( 'Solid', 'Border type.', 'bb-timeline' ),
								'dashed'    => _x( 'Dashed', 'Border type.', 'bb-timeline' ),
								'dotted'    => _x( 'Dotted', 'Border type.', 'bb-timeline' ),
								'double'    => _x( 'Double', 'Border type.', 'bb-timeline' ),
							),
							'help'         => __( 'For Double style effect Separator Height must be above 3px', 'bb-timeline' ),
							'toggle'        => array(
								'solid'        => array(
									'fields'        => array( 'timeline_title_border_width', 'timeline_title_border_color', 'timeline_title_seperator_width', 'timeline_title_border_align' ),
								),
								'dashed'        => array(
									'fields'        => array( 'timeline_title_border_width', 'timeline_title_border_color', 'timeline_title_seperator_width', 'timeline_title_border_align' ),
								),
								'dotted'        => array(
									'fields'        => array( 'timeline_title_border_width', 'timeline_title_border_color', 'timeline_title_seperator_width', 'timeline_title_border_align' ),
								),
								'double'        => array(
									'fields'        => array( 'timeline_title_border_width', 'timeline_title_border_color', 'timeline_title_seperator_width', 'timeline_title_border_align' ),
								),
							),
							'preview'       => array(
								'type'          => 'css',
								'selector'      => '.bb-tmlabel-border-bottom',
								'property'      => 'border-bottom-style',
							),
						),

						'timeline_title_border_color'         => array(
							'type'          => 'color',
							'label'         => __( 'Color', 'bb-timeline' ),
							'default'       => 'ffffff',
							'show_reset' => true,
							'help'         => __( 'To set separator color.', 'bb-timeline' ),
							'preview'       => array(
								'type'          => 'css',
								'selector'      => '.bb-tmlabel-border-bottom',
								'property'      => 'border-bottom-color',
							),
						),

						'timeline_title_border_width'        => array(
							'type'          => 'text',
							'label'         => __( 'Height', 'bb-timeline' ),
							'default'       => '1',
							'maxlength'     => '2',
							'size'          => '3',
							'description'   => 'px',
							'help'         => __( 'To set separator height.', 'bb-timeline' ),
							'preview'       => array(
								'type'          => 'css',
								'selector'      => '.bb-tmlabel-border-bottom',
								'property'      => 'border-bottom-width',
								'unit'          => 'px',
							),
						),

						'timeline_title_seperator_width'        => array(
							'type'          => 'text',
							'label'         => __( 'Width', 'bb-timeline' ),
							'default'       => '10',
							'maxlength'     => '3',
							'size'          => '3',
							'description'   => '%',
							'help'         => __( 'To set separator width.', 'bb-timeline' ),
						),

						'timeline_title_border_align'     => array(
							'type'          => 'select',
							'label'         => __( 'Alignment', 'bb-timeline' ),
							'default'       => 'Left',
							'options'       => array(
								'left'      => __( 'Left', 'bb-timeline' ),
								'center'    => __( 'Center', 'bb-timeline' ),
								'right'     => __( 'Right', 'bb-timeline' ),
							),
							'help'         => __( 'This is the alignment option for title border', 'bb-timeline' ),
						),
					),
				),
			),
		),
	),
));
