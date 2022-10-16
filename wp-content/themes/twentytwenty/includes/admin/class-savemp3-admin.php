<?php
    /**
     * Admin Class
     *
     * Handles the Admin side functionality of theme
     *
     * @package Savemp3 
     * @since 1.0
     */
    
    // Exit if accessed directly
    if ( !defined( 'ABSPATH' ) ) exit;
    
    class MLT_Admin {
        function __construct() {
            // Action to add metabox
            add_action( 'add_meta_boxes', array($this, 'mlt_add_meta_box') );

            add_action( 'save_post', array($this, 'savemp3_save_metabox_value') );
        }
    
    

        /**
         * Post Metabox
         * 
         * @package Savemp3
         * @since 1.0
         */
        function mlt_add_meta_box() {
            global $post;
            add_meta_box( 'mlt-add-faq', __('FAQs', 'mlt'), array($this, 'mlt_add_faq'), array(MLT_FAQ_POST_TYPE), 'normal', 'high' );
            
        }
    
        /**
         * Post Metabox addoninfo HTML
         * 
         * @package Savemp3
         * @since 1.0
         */
        function mlt_add_faq(){

            include_once( MY_LEARN_THEME_INC_DIR .'/admin/metabox/wpos-addon-add-faq.php');
        }
        function savemp3_save_metabox_value( $post_id ) {
            global $post_type;
    
            //$registered_posts = array(SVMP3_DEFAULT_POST_TYPE,SVMP3_WEBSITE_POST_TYPE); // Getting registered post types
    
            if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
            || ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
            || ( !current_user_can('edit_post', $post_id) )        			// Check if user can edit the post.
            ) {
              return $post_id;
            }
    
            $prefix = MLT_META_PREFIX; // Taking metabox prefix
    
            if( MLT_FAQ_POST_TYPE == $post_type || MLT_PAGE_POST_TYPE == $post_type){
                // Taking variables
                $input_placeholder 			= isset($_POST[$prefix.'input_placeholder']) ? $_POST[$prefix.'input_placeholder'] : '';	
                $download_video_url 		= isset($_POST[$prefix.'download_video_url']) ? $_POST[$prefix.'download_video_url'] : '';	
                $show_extensions_card 		= isset($_POST[$prefix.'show_extensions_card']) ? $_POST[$prefix.'show_extensions_card'] : '';	
                $related_articles 			= isset($_POST[$prefix.'related_articles']) ? $_POST[$prefix.'related_articles'] : '';	
            
    
                update_post_meta($post_id, $prefix.'input_placeholder', $input_placeholder);				
                update_post_meta($post_id, $prefix.'download_video_url', $download_video_url);				
                update_post_meta($post_id, $prefix.'show_extensions_card', $show_extensions_card);				
                update_post_meta($post_id, $prefix.'related_articles', $related_articles);				
                
                            
            }
    
            if( MLT_FAQ_POST_TYPE == $post_type){
                // Taking variables
                $faq_control 			= isset($_POST[$prefix.'faq_control']) ? $_POST[$prefix.'faq_control'] : '';	
                update_post_meta($post_id, $prefix.'faq_control', $faq_control);				
            }
            
        }
    }
    $mlt_admin = new MLT_Admin();