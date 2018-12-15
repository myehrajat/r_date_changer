<?php
/**
 * @package RentIt_Date_Changer
 * @version 1.0
 */
/*
Plugin Name: RentIt Date Changer
Plugin URI: https://wordpress.org/plugins/hello-dolly/
Description: this make renit theme completely jalali compatible
Version: 1.0
Author URI: https://ma.tt/
Text Domain: RentIt_Date_Changer
*/
/*
Note: The strategy is that we send all date for storing and processing by gregorian and only showing by custom date that we need. this strategy is the best method for preventing multiple process of calculation and storing data and even we can use the same database in future for multiple lang

*/
/*in this part we decide how the theme should work persian or English all default existing and all added functionality*/
include_once('customizer.php');
include_once('moment_format_convertor.php');
include_once('date_router.php');
include_once('wc_date_changer.php');


/* add forntend */
add_action( 'wp_enqueue_scripts', 'RentIt_Date_Changer_dequeue_scripts_rtl_support', 400 );
add_action( 'wp_enqueue_scripts', 'RentIt_Date_Changer_enqueue_scripts_rtl_support', 400 );

/* add backend */
add_action( 'admin_enqueue_scripts', 'RentIt_Date_Changer_dequeue_scripts_rtl_support', 400 );
add_action( 'admin_enqueue_scripts', 'RentIt_Date_Changer_enqueue_scripts_rtl_support', 400 );

function RentIt_Date_Changer_dequeue_scripts_rtl_support() {
	wp_deregister_script( 'renita_bootstrap-datetimepicker' );
}
function RentIt_Date_Changer_enqueue_scripts_rtl_support() {
	//need to be in header because in body it use .datetimepicker() method
		wp_enqueue_script( 'renita_bootstrap-datetimepicker', plugins_url("bootstrap-datetimepicker-MYEDIT/bootstrap-datetimepicker-rtl-ltr-by-var.min.js",__FILE__ ), array( 'renita_moment-with-locales' ), '4.7.14', true );

}
