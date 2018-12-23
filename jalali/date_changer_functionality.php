<?php
/**
 * @package RentIt_Date_Changer
 * @version 1.0
 */

/*https://github.com/roozbeh360/Gregorian-Jalali-Date-Convertor*/
require_once( plugin_dir_path( __FILE__ ) . 'Gregorian-Jalali-Date-Convertor\gregorian_jalali.php' );

function RentIt_Date_Changer_jalali_to_gregorian_reserve_format( $date_time ) {
	global $momentVars;
	$jdate_time_arr = date_parse( $date_time ); //make array detect format automatically
	$gdate_time_arr = jalali_to_gregorian( $jdate_time_arr[ 'year' ], $jdate_time_arr[ 'month' ], $jdate_time_arr[ 'day' ], false );
	if ( $jdate_time_arr[ 'minute' ] < 10 ) { //correct time with leading zero
		$jdate_time_arr[ 'minute' ] = '0' . $jdate_time_arr[ 'minute' ];
	}
	$gdate_obj = date_create( $gdate_time_arr[ 0 ] . '/' . $gdate_time_arr[ 1 ] . '/' . $gdate_time_arr[ 2 ] . ' ' . intval( $jdate_time_arr[ 'hour' ] ) . ':' . $jdate_time_arr[ 'minute' ] );
	$momentVars[ 'cal_format' ]; //its moment format which is differ from  php format
	$php_format = RentIt_Date_Changer_moment_to_php_format( $momentVars[ 'cal_format' ] ); //create php format
	$gdate_formatted = $gdate_obj->format( $php_format );
	return trim( $gdate_formatted );
}



/*********************************************************************************************
Process of making jalali in submitting order from first step to end
1.$_GET in first page and widget used needed to be changed
2.Session and custom_data_1 and custom_data_2 used to add order to wc database and post also used in calc
>> NOTE we remove original plugin action and set our plugin to run instead
**********************************************************************************************/
require_once('function_order_fixing.php');
require_once('process_vars_modifier.php');
require_once('before_cart_set_session.php');
require_once('update_and_add_order_date.php');

function late_var_dump() {

	echo '<h2>_GET</h2><pre>';
	var_dump( $_GET );
	echo '</pre>';
	echo '<h2>_POST</h2><pre>';
	var_dump( $_POST );
	echo '</pre>';
	echo '<h2>_COOKIE</h2><pre>';
	var_dump( $_COOKIE );
	echo '</pre>';
	echo '<h2>_SESSION</h2><pre>';
	var_dump( $_SESSION );
	echo '</pre>';
	//echo '<h2>_REQUEST</h2><pre>';
	//var_dump($_REQUEST);
	//echo '</pre>';
}
//add_action( 'wp_footer', 'late_var_dump', 3 );