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
//die;
