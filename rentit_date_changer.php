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

/*in this part we decide how the theme should work persian or English all default existing and all added functionality*/


//you can change date calender type by adding ?cal_type={calender(jalali|gregorian|hijri)}
$default= 'gregorian' ;
$date_type = get_theme_mod( 'rentit_rlt_cal_type', $default );
if(isset($_GET['cal_type'])){
	$date_type = $_GET['cal_type'];
}
define( 'cal_type', $date_type );


//you can change date calender lang locale by adding ?locale_lang={calender(fa|eng|...)}$default= 'eng' ;

$default= 'en' ;
$cal_lang = get_theme_mod( 'Other_date_format_lang', $default );
if(isset($_GET['cal_lang'])){
	$cal_lang = $_GET['cal_lang'];
}
define( 'cal_lang', $cal_lang );

//you can change date calender lang locale by adding ?locale_lang={calender(fa|eng|...)}$default= 'eng' ;

$default= 'MM/DD/YYYY H:mm' ;
$cal_format = get_theme_mod( 'Other_date_format_calendar', $default );
if(isset($_GET['cal_format'])){
	$cal_format = $_GET['cal_format'];
}
define( 'cal_format', $cal_format );
//pass variable
add_action( 'admin_enqueue_scripts', 'RentIt_Date_Changer_pass_moment_vars',9999 );
function RentIt_Date_Changer_pass_moment_vars(){
	//pass momentVars object to js
	$momentVars = array(
		//rentit_rlt_cal_type
		'cal_type' =>cal_type,
		//Other_date_format_lang
		'cal_lang' =>cal_lang,
		//Other_date_format_calendar
		'cal_format' =>cal_format
	);
	wp_localize_script( 'renita_moment-with-locales', 'momentVars',$momentVars );
}
//http://localhost/wp-admin/post.php?post=10131&action=edit&cal_type=jalali&cal_lang=fa&cal_format=YYYY%2FMM%2FDD%20H%3Amm
switch ( cal_type) {
	case 'jalali':
		include_once( plugin_dir_path(__FILE__) . 'jalali/enqueue.php' );
	break;

	case 'gregorian':
		//nothing need to do...
	break;
	case 'hijri':
		//Go to see more: https://github.com/xsoh/moment-hijri
	break;
	default:
		//echo '<h1>default: '.$default.'</h1>';
	break;

}
