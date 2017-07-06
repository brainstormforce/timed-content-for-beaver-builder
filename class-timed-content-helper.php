<?php
/**
 *  Timed Content Helper
 *
 * 	Helper functions, actions & filter hooks.
 */

if( !class_exists( 'Timed_Content_Helper' ) ) {

	class Timed_Content_Helper
	{
		public static $bb_global_settings;

		/*
		* Constructor function that initializes required actions and hooks
		* @Since 1.0.0
		*/
		function __construct() {

			// Initialize BB Global Setting static variable
			Timed_Content_Helper::$bb_global_settings = FLBuilderModel::get_global_settings();
		}

		/**
		 * Get Templates based on category
		 */
		static public function get_post_template( $type = 'layout' ) {
			$posts = get_posts( array(
					'post_type'      => 'fl-builder-template',
					'orderby'        => 'title',
					'order'          => 'ASC',
					'posts_per_page' => '-1',
					'tax_query'      => array(
						array(
							'taxonomy' => 'fl-builder-template-type',
							'field'    => 'slug',
							'terms'    => $type
						)
					)
				) );

			$templates = array();
		
			foreach ( $posts as $post ) {
				
				$templates[] = array(
					'id'     => $post->ID,
					'name'   => $post->post_title,
					'global' => get_post_meta( $post->ID, '_fl_builder_template_global', true ),
				);
			}	
			return $templates;
		}

		/**
		 * Get - Saved row templates
		 *
		 * @return  $option_array
		 * @since 	1.0.0
		 */		
		static public function get_saved_page_template() {
			if ( FLBuilderModel::node_templates_enabled() ) {
				
				$page_templates = Timed_Content_Helper::get_post_template( 'layout' );
				
				$options = array();
				
				if ( count($page_templates) ) {
					foreach ($page_templates as $page_template) {
                		$options[$page_template['id']] = $page_template['name'];
					}
				}else{
					$options['no_template'] = "It seems that, you have not saved any template yet.";
				}
        		return $options;
			}
		}

		/**
		 *	Get - Saved row templates
		 *
		 * @return  $option_array
		 * @since 	1.0.0
		 */		
		static public function get_saved_row_template() {
			if ( FLBuilderModel::node_templates_enabled() ) {

				$saved_rows    = Timed_Content_Helper::get_post_template( 'row' );

				$options = array();
				if ( count($saved_rows) ) {
					foreach ($saved_rows as $saved_row) {
						$options[$saved_row['id']] = $saved_row['name'];
					}
				} else {
					$options['no_template'] = "It seems that, you have not saved any template yet.";
				}
				return $options;
			}
		}

		/**
		 *	Get - Saved module templates
		 *
		 * @return  $option_array
		 * @since 	1.0.0
		 */		
		static public function get_saved_module_template() {
			if ( FLBuilderModel::node_templates_enabled() ) {
			
				$saved_modules = Timed_Content_Helper::get_post_template( 'module' );
				$options = array();
				if ( count($saved_modules) ) {
					foreach ($saved_modules as $saved_module) {
						$options[$saved_module['id']] = $saved_module['name'];
					}
				}else{
					$options['no_template'] = "It seems that, you have not saved any template yet.";
				}
        		return $options;
			}
		}
	    /**
	     *
	     * @method get_timed_content
	     */
	    static public function get_timed_content( $settings ) {
	        $content_type = $settings->content_type;
	        switch($content_type) {
	            case 'content':
	                global $wp_embed;
	                return wpautop( $wp_embed->autoembed( $settings->ct_content ) );
	            break;
	            case 'photo':
	                if ( isset( $settings->ct_photo_src ) ) {
	                    return '<img src="' . $settings->ct_photo_src . '" />';
	                }
	                return '<img src="" />';
	            break;
	            case 'video':
	                global $wp_embed;
	                return $wp_embed->autoembed($settings->ct_video);
	            break;
	            case 'saved_rows':
	                ob_start();
	                echo do_shortcode('[fl_builder_insert_layout id="'.$settings->ct_saved_rows.'" type="fl-builder-template"]');
	                return ob_get_clean();
	            case 'saved_modules':
	                ob_start();
	                echo do_shortcode('[fl_builder_insert_layout id="'.$settings->ct_saved_modules.'" type="fl-builder-template"]');
	                return ob_get_clean();
	            case 'saved_page_templates':
	                ob_start();
	                echo do_shortcode('[fl_builder_insert_layout id="'.$settings->ct_page_templates.'" type="fl-builder-template"]');
	                return ob_get_clean();
	            break;
	            default:
	                return;
	            break;
	        }
	    }
	}
	new Timed_Content_Helper();
}