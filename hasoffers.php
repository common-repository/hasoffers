<?php
/*
  Plugin Name: HasOffers
  Plugin URI:  http://www.brainvire.com
  Description: HasOffers gives a thousands of businesses around the world and the ability to track and manage their own publisher relashionships.
  Version:     1.0
  Author:      brainvireinfo
  Author URI:  http://www.brainvire.com
  License:     GPLv2 or later
*/

if( !defined( 'ABSPATH' ) ) exit;

define( 'WPHO_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WPHO_PLUGIN_BASEURL', plugin_dir_url( __FILE__ ) );
define( 'PREFIX', 'wpho_' );

include( WPHO_PLUGIN_DIR.'templates/mortgage.php' );
include( WPHO_PLUGIN_DIR.'include/functions.php' );

register_activation_hook( __FILE__, "wpho_hasoffer_activation" );
if( !function_exists( 'wpho_hasoffer_activation' ) ) {
    function wpho_hasoffer_activation() {
        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
        global $wpdb;
        $db_table_name = PREFIX . 'mortgage';
        if( $wpdb->get_var( "SHOW TABLES LIKE '$db_table_name'" ) != $db_table_name ) { 
            if ( ! empty( $wpdb->charset ) )
                    $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
            if ( ! empty( $wpdb->collate ) )
                    $charset_collate .= " COLLATE $wpdb->collate";

            $sql = "CREATE TABLE " . $db_table_name . " (
                    mortgageid bigint(22) NOT NULL AUTO_INCREMENT,
                    property_type varchar(100) NOT NULL DEFAULT '',
                    rate varchar(20) NOT NULL DEFAULT '',
                    homevalue text NOT NULL,
                    loanamt text NOT NULL,
                    loaninterest varchar(20) NOT NULL DEFAULT '',
                    veteran varchar(5) NOT NULL DEFAULT '',
                    your_mortgage varchar(50) NOT NULL DEFAULT '',
                    lender varchar(100) NOT NULL DEFAULT '',
                    streetaddress varchar(150) NOT NULL DEFAULT '',
                    zipcode varchar(10) NOT NULL DEFAULT '',
                    firstname varchar(100) NOT NULL DEFAULT '',
                    lastname varchar(100) NOT NULL DEFAULT '',
                    email varchar(320) NOT NULL DEFAULT '',
                    primaryphone varchar(25) NOT NULL DEFAULT '',
                    createddate datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                    result varchar(10) NOT NULL DEFAULT '',
                    transactionid varchar(320) NOT NULL DEFAULT '',
                    extrainfo text NOT NULL,
                    PRIMARY KEY ( mortgageid )
            ) $charset_collate;";
            dbDelta( $sql );
        } 
    }  
}

function wpho_scripts()
{  
    wp_register_style( 'wpho-custom-style', WPHO_PLUGIN_BASEURL.'css/wpho_style.css' );
    wp_enqueue_style( 'wpho-custom-style' );
    
    wp_register_script('wpho-custom', WPHO_PLUGIN_BASEURL.'js/wpho_custom.js', array(), '', 1);
    wp_enqueue_script('wpho-custom');
    
    wp_register_script('wpho-jquery-validate', WPHO_PLUGIN_BASEURL.'js/jquery.validate.js', array(), '', 1);
    wp_enqueue_script('wpho-jquery-validate');
    
    wp_register_script('wpho-jquery', WPHO_PLUGIN_BASEURL.'js/wpho_formvalidation.js', array(), '', 1);
    wp_enqueue_script('wpho-jquery');
}
add_action( 'wp_enqueue_scripts', 'wpho_scripts' );

add_shortcode( "hasoffer-form", "wpho_reg_function" );
if( !function_exists( 'wpho_reg_function' ) ) {
    function wpho_reg_function() {
            $wpho_reg_output = wpho_registration_form_fields();
            return $wpho_reg_output;
    }
}
 
// Add settings link on HasOffers plugin page
if( !function_exists( 'wpho_settings_link' ) ) {
    function wpho_settings_link( $links ) { 
            $settings_link = '<a href="options-general.php?page=wpho-plugin-setting">Settings</a>'; 
            array_unshift( $links, $settings_link ); 
            return $links; 
    }
}
 
$plugin = plugin_basename(__FILE__); 
add_filter( "plugin_action_links_$plugin", "wpho_settings_link" ); 
add_action( "admin_menu", "wpho_add_admin_menu" );

if( !function_exists( 'wpho_add_admin_menu' ) ) {
    function wpho_add_admin_menu(  ) { 
            add_options_page(
            'HasOffers',
            'HasOffers Settings',
            'manage_options',
            'wpho-plugin-setting',
            'wpho_setting_page_callback'
            );
    }
} ?>
