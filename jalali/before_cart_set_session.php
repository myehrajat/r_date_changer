<?php
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
