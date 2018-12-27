<?php
/*
this function change variable in process of making order to submit coorectly and show field correctly
our method is showing jalali and acting on gregorian !
*/
function RentIt_Date_Changer_rentit_init_site_modifier() {
	/**********************
	POST
	**********************/
	if ( !empty( $_POST ) && function_exists( 'wc_setcookie' ) ) {
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
