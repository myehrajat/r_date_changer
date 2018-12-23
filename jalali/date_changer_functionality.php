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
1.$_GET in fist page and widget used needed to be changed
2.Session and custom_data_1 and custom_data_2 used to add order to wc database and post also used in calc
>> NOTE we remove original plugin action and set our plugin to run instead
**********************************************************************************************/
require_once('function_order_fixing.php');
//RentIt_Date_Changer_jalali_to_gregorian_reserve_format( $_POST['jalali_dropoff_date']);
function rentit_init_site_modifier() {
	//$jalali_date = 
	/**********************
	POST
	**********************/
	if ( !empty( $_POST ) && function_exists( 'wc_setcookie' ) ) {
//echo 'sssssssssssss';

		if ( isset( $_POST[ 'dropin_date' ] {
				1
			} ) ) {
			//die;
			$_POST[ 'gregorian_dropin_date' ] = RentIt_Date_Changer_jalali_to_gregorian_reserve_format( $_POST[ 'dropin_date' ] );
			$_POST[ 'jalali_dropin_date' ] = $_POST[ 'dropin_date' ];
			$_POST[ 'dropin_date' ] = $_POST[ 'gregorian_dropin_date' ];

			$_SESSION[ 'gregorian_dropin_date' ] = $_POST[ 'gregorian_dropin_date' ];
			$_SESSION[ 'jalali_dropin_date' ] = sanitize_text_field( $_POST[ 'jalali_dropin_date' ] );
			$_SESSION[ 'dropin_date' ] = sanitize_text_field( $_POST[ 'gregorian_dropin_date' ] );

			$_SESSION[ 'custom_data_1' ][ 'gregorian_dropin_date' ] = sanitize_text_field( urldecode( $_POST[ 'gregorian_dropin_date' ] ) );
			$_SESSION[ 'custom_data_1' ][ 'jalali_dropin_date' ] = sanitize_text_field( urldecode( $_POST[ 'jalali_dropin_date' ] ) );
			$_SESSION[ 'custom_data_1' ][ 'dropin_date' ] = sanitize_text_field( urldecode( $_POST[ 'jalali_dropin_date' ] ) );

			$_SESSION[ 'custom_data_2' ][ 'gregorian_dropin_date' ] = sanitize_text_field( urldecode( $_POST[ 'gregorian_dropin_date' ] ) );
			$_SESSION[ 'custom_data_2' ][ 'jalali_dropin_date' ] = sanitize_text_field( urldecode( $_POST[ 'jalali_dropin_date' ] ) );
			$_SESSION[ 'custom_data_2' ][ 'dropin_date' ] = sanitize_text_field( urldecode( $_POST[ 'jalali_dropin_date' ] ) );

			wc_setcookie( 'gregorian_dropin_date', $_POST[ 'gregorian_dropin_date' ], time() + 62208000, '/', $_SERVER[ 'HTTP_HOST' ] );
			wc_setcookie( 'jalali_dropin_date', $_POST[ 'jalali_dropin_date' ], time() + 62208000, '/', $_SERVER[ 'HTTP_HOST' ] );
			wc_setcookie( 'dropin_date', sanitize_text_field( $_POST[ 'jalali_dropin_date' ] ), time() + 62208000, '/', $_SERVER[ 'HTTP_HOST' ] );//
		}

		if ( isset( $_POST[ 'dropoff_date' ] {
				1
			} ) ) {
			$_POST[ 'gregorian_dropoff_date' ] = RentIt_Date_Changer_jalali_to_gregorian_reserve_format( $_POST[ 'dropoff_date' ] );
			$_POST[ 'jalali_dropoff_date' ] = $_POST[ 'dropoff_date' ];
			$_POST[ 'dropoff_date' ] = $_POST[ 'gregorian_dropoff_date' ];

			$_SESSION[ 'gregorian_dropoff_date' ] = sanitize_text_field( $_POST[ 'gregorian_dropoff_date' ] );
			$_SESSION[ 'jalali_dropoff_date' ] = sanitize_text_field( $_POST[ 'jalali_dropoff_date' ] );
			$_SESSION[ 'dropoff_date' ] = sanitize_text_field( $_POST[ 'gregorian_dropoff_date' ] );

			$_SESSION[ 'custom_data_1' ][ 'gregorian_dropoff_date' ] = $_POST[ 'gregorian_dropoff_date' ];
			$_SESSION[ 'custom_data_1' ][ 'jalali_dropoff_date' ] = $_POST[ 'jalali_dropoff_date' ];
			$_SESSION[ 'custom_data_1' ][ 'dropoff_date' ] = $_POST[ 'jalali_dropoff_date' ];

			$_SESSION[ 'custom_data_2' ][ 'gregorian_dropoff_date' ] = sanitize_text_field( urldecode( $_POST[ 'gregorian_dropoff_date' ] ) );
			$_SESSION[ 'custom_data_2' ][ 'jalali_dropoff_date' ] = sanitize_text_field( urldecode( $_POST[ 'jalali_dropoff_date' ] ) );
			$_SESSION[ 'custom_data_2' ][ 'dropoff_date' ] = sanitize_text_field( urldecode( $_POST[ 'jalali_dropoff_date' ] ) );

			wc_setcookie( 'gregorian_dropoff_date', $_POST[ 'gregorian_dropoff_date' ], time() + 62208000, '/', $_SERVER[ 'HTTP_HOST' ] );
			wc_setcookie( 'jalali_dropoff_date', $_POST[ 'jalali_dropoff_date' ], time() + 62208000, '/', $_SERVER[ 'HTTP_HOST' ] );
			wc_setcookie( 'dropoff_date', $_POST[ 'jalali_dropoff_date' ], time() + 62208000, '/', $_SERVER[ 'HTTP_HOST' ] );//
		}

	}
	//echo '<pre>';
	//var_dump($_POST);
	//echo '</pre>';
	//die;
	/**********************
	GET
	**********************/
	if ( !empty( $_GET ) ) {
		if ( isset( $_GET[ 'start_date' ] {
				1
			} ) ) {
			$_GET[ 'gregorian_start_date' ] = RentIt_Date_Changer_jalali_to_gregorian_reserve_format( $_GET[ 'start_date' ] );
			$_GET[ 'jalali_start_date' ] = $_GET[ 'start_date' ];
			$_GET[ 'start_date' ] = $_GET[ 'jalali_start_date' ];

			$_SESSION[ 'gregorian_dropin_date' ] = sanitize_text_field( urldecode( $_GET[ 'gregorian_start_date' ] ) );
			$_SESSION[ 'jalali_dropin_date' ] = sanitize_text_field( urldecode( $_GET[ 'jalali_start_date' ] ) );
			$_SESSION[ 'dropin_date' ] = sanitize_text_field( urldecode( $_GET[ 'gregorian_start_date' ] ) );

			$_SESSION[ 'custom_data_1' ][ 'gregorian_dropin_date' ] = sanitize_text_field( urldecode( $_GET[ 'gregorian_start_date' ] ) );
			$_SESSION[ 'custom_data_1' ][ 'jalali_dropin_date' ] = sanitize_text_field( urldecode( $_GET[ 'jalali_start_date' ] ) );
			$_SESSION[ 'custom_data_1' ][ 'dropin_date' ] = sanitize_text_field( urldecode( $_GET[ 'jalali_start_date' ] ) );

			$_SESSION[ 'custom_data_2' ][ 'gregorian_dropin_date' ] = sanitize_text_field( urldecode( $_GET[ 'gregorian_start_date' ] ) );
			$_SESSION[ 'custom_data_2' ][ 'jalali_dropin_date' ] = sanitize_text_field( urldecode( $_GET[ 'jalali_start_date' ] ) );
			$_SESSION[ 'custom_data_2' ][ 'dropin_date' ] = sanitize_text_field( urldecode( $_GET[ 'jalali_start_date' ] ) );

			setcookie( 'gregorian_dropin_date', sanitize_text_field( urldecode( $_GET[ 'gregorian_start_date' ] ) ), time() + 62208000, '/', $_SERVER[ 'HTTP_HOST' ] );
			setcookie( 'jalali_dropin_date', sanitize_text_field( urldecode( $_GET[ 'jalali_start_date' ] ) ), time() + 62208000, '/', $_SERVER[ 'HTTP_HOST' ] );
			setcookie( 'dropin_date', sanitize_text_field( urldecode( $_GET[ 'jalali_start_date' ] ) ), time() + 62208000, '/', $_SERVER[ 'HTTP_HOST' ] );

		}
		if ( isset( $_GET[ 'end_date' ] {
				1
			} ) ) {
			$_GET[ 'gregorian_end_date' ] = RentIt_Date_Changer_jalali_to_gregorian_reserve_format( $_GET[ 'end_date' ] );
			$_GET[ 'jalali_end_date' ] = $_GET[ 'end_date' ];
			$_GET[ 'end_date' ] = $_GET[ 'jalali_end_date' ];

			$_SESSION[ 'gregorian_dropoff_date' ] = sanitize_text_field( urldecode( $_GET[ 'gregorian_end_date' ] ) );
			$_SESSION[ 'jalali_dropoff_date' ] = sanitize_text_field( urldecode( $_GET[ 'jalali_end_date' ] ) );
			$_SESSION[ 'dropoff_date' ] = sanitize_text_field( urldecode( $_GET[ 'gregorian_end_date' ] ) );

			$_SESSION[ 'custom_data_1' ][ 'gregorian_dropoff_date' ] = sanitize_text_field( urldecode( $_GET[ 'gregorian_end_date' ] ) );
			$_SESSION[ 'custom_data_1' ][ 'jalali_dropoff_date' ] = sanitize_text_field( urldecode( $_GET[ 'jalali_end_date' ] ) );
			$_SESSION[ 'custom_data_1' ][ 'dropoff_date' ] = sanitize_text_field( urldecode( $_GET[ 'jalali_end_date' ] ) );

			$_SESSION[ 'custom_data_2' ][ 'gregorian_dropoff_date' ] = sanitize_text_field( urldecode( $_GET[ 'gregorian_end_date' ] ) );
			$_SESSION[ 'custom_data_2' ][ 'jalali_dropoff_date' ] = sanitize_text_field( urldecode( $_GET[ 'jalali_end_date' ] ) );
			$_SESSION[ 'custom_data_2' ][ 'dropoff_date' ] = sanitize_text_field( urldecode( $_GET[ 'jalali_end_date' ] ) );

			setcookie( 'gregorian_dropoff_date', sanitize_text_field( urldecode( $_GET[ 'gregorian_end_date' ] ) ), time() + 62208000, '/', $_SERVER[ 'HTTP_HOST' ] );
			setcookie( 'jalali_dropoff_date', sanitize_text_field( urldecode( $_GET[ 'jalali_end_date' ] ) ), time() + 62208000, '/', $_SERVER[ 'HTTP_HOST' ] );
			setcookie( 'dropoff_date', sanitize_text_field( urldecode( $_GET[ 'jalali_end_date' ] ) ), time() + 62208000, '/', $_SERVER[ 'HTTP_HOST' ] );
		}
	}
	if(is_shop()){
		
	}
	if(is_product()){
		
	}
	if(is_cart()){
		
	}
	if(is_checkout()){
		
	}
	//echo '<pre>';
	//var_dump($_SESSION);
	//echo '</pre>';

}



function RentIt_Date_Changer_before_cart_set_session_custom_data( $array ) {
	
	if ( isset( $_POST[ 'dropin_date' ] {
			1
		} ) ) {
		$_SESSION[ 'custom_data_1' ][ 'dropin_date' ] = sanitize_text_field( urldecode( $_POST[ 'jalali_dropin_date' ] ) );
		$_SESSION[ 'custom_data_1' ][ 'gregorian_dropin_date' ] = sanitize_text_field( urldecode( $_POST[ 'gregorian_dropin_date' ] ) );
	}

	if ( isset( $_POST[ 'dropoff_date' ] {
			1
		} ) ) {
		$_SESSION[ 'custom_data_1' ][ 'dropoff_date' ] = $_POST[ 'jalali_dropoff_date' ];
		$_SESSION[ 'custom_data_1' ][ 'gregorian_dropoff_date' ] = $_POST[ 'gregorian_dropoff_date' ];
	}

	return @ array_merge( $array, $_SESSION[ 'custom_data_1' ] );

}














//add_action( 'woocommerce_add_order_item_meta', 'rentit_add_values_to_order_item_meta2_do_it', 2, 3 );
function rentit_add_values_to_order_item_meta2_do_it(){
	//do_action('woocommerce_add_order_item_meta');
}
function rentit_add_values_to_order_item_meta2($item_id,$order_id,$values) {
	wc_update_order_item_meta($item_id, esc_html__( 'Dropping Off Date', 'rentit' ), $values['custom_data_1']['gregorian_dropoff_date'] );
	wc_update_order_item_meta($item_id,  esc_html__( 'Picking Up Date', 'rentit' ), $values['custom_data_1']['gregorian_dropin_date'] );
	wc_add_order_item_meta($item_id, esc_html__( 'Jalali Dropping Off Date', 'rentit' ), $values['custom_data_1']['dropoff_date'] );
	wc_add_order_item_meta($item_id,  esc_html__( 'Jalali Up Date', 'rentit' ), $values['custom_data_1']['dropin_date'] );
	update_post_meta( $order_id, '_dropin_date', $values['custom_data_1']['gregorian_dropin_date'] );
	update_post_meta( $order_id, '_dropoff_date',$values['custom_data_1']['gregorian_dropoff_date'] );
	add_post_meta( $order_id, '_jalali_dropin_date', $values['custom_data_1']['dropin_date'], true );
	add_post_meta( $order_id, '_jalali_dropoff_date', $values['custom_data_1']['dropoff_date'], true );
	
}

function rentit_jalali_archive_product_narrower(){
	return strtotime( sanitize_text_field( urldecode( $_GET['gregorian_start_date'] ) ) );
}
/*****
calculation of days in wc_customData you must make session based on gregorian
******/
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
add_action( 'wp_footer', 'late_var_dump', 3 );