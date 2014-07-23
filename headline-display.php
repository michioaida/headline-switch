<?php
/*
Plugin Name: Headline Display
Plugin URI: http://www.michioaida.com
Description: It allows you to change the headline posts to show at the top of your homepage. 
Version: 1.0
Author: Michio Aida
Author URI: http://www.michioaida.com
*/

if(!class_exists('Headline_Plugin')) {
    class Headline_Plugin {        
        
        /**
         * Load initial plugin settings by registering values, adding the menu
         * under the Appearance menu, and load css and javascript files
         */ 
        public function __construct() {
            add_action('admin_init', array($this, 'admin_init'));
            add_action('admin_menu', array($this, 'add_menu'));
            add_action('admin_enqueue_scripts', array($this, 'm_load_scripts'));
        }

        /**
         * Load multiple settings... in this case there's one. 
         */ 
        public function admin_init() {
            $this->headline_settings();
        }
        
        /**
         * Register the 3 group settings for each option set which 
         * will be saved under the headline_setting
         */
        public function headline_settings() {
            register_setting('headline_setting_group-1', 'headline_setting');
            register_setting('headline_setting_group-2', 'headline_setting');
            register_setting('headline_setting_group-3', 'headline_setting');
        }
        
        /**
         * Add menu under the Appearance menu
         */
        public function add_menu() {
            $page = add_theme_page('Headline Settings', 'Headline', 'manage_options', 'headline_plugin', array($this, 'plugin_settings_page'));
        }
        
        /**
         * Check if user has proper settings... in this case if they can manage options.  
         */
        public function plugin_settings_page() {
            // If user does not have capabilities to manage options deny access.
            if(!current_user_can('manage_options'))
            {
                wp_die(__('You don\'t have permissions to access this page. Please contact the admin.'));
            } else {
               
                include(sprintf("%s/pages/settings.php", dirname(__FILE__)));
            }
        }
        
        /**
         * Only load scripts if they are on the Headline Plugin settings page
         * and not throughout the Admin section.  
         */
        function m_load_scripts() {
            // Get current page the user is on.
            $screen = get_current_screen();    
            
            //If the current page is within the plugin page, load the following JS and CSS files.        
            if ($screen->id == "appearance_page_headline_plugin") {
                wp_enqueue_script( 'main_js_script', 
                                    plugins_url( '/assets/scripts/main.js', __FILE__ ), 
                                    array('jquery'), 
                                    '1.0.0', 
                                    true
                );
                wp_enqueue_style( 'main_css', 
                                  plugins_url( '/assets/css/style.css', __FILE__ ), 
                                  '', 
                                  '1.0.0'
                );
            }
        }

        /**
         * Necessary for plugin activation. Not having it produces the 
         * header has been sent error. Wordpress recommends this for singleton class
         */
        public static function activate() {
            //No output   
        }

        /**
         * Necessary for plugin deactivation. Not having it produces the 
         * header has been sent error. Wordpress recommends this for singleton class
         */
        public static function deactivate() {
            // No output   
        }
    }
}

/**
 * Register the activation and deactivation hooks and instantiate the plugin. 
 */
if(class_exists('Headline_Plugin'))
{
    // Activate and Deactivate Headline Plugin
    register_activation_hook(__FILE__, array('Headline_Plugin', 'activate'));
    register_deactivation_hook(__FILE__, array('Headline_Plugin', 'deactivate'));

    // Instantiate Headline Plugin
    $headline_plugin = new Headline_Plugin();
}