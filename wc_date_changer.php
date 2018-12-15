<?php
/*
add_filter( 'woocommerce_add_cart_item_data', 'misha_save_field_value_to_cart_data', 10, 3 );
function misha_save_field_value_to_cart_data(){

	if ( !empty( $_POST['dropin_date'] ) ) { // here could be another validation if you need
		$cart_item_data['dropin_date'] = sanitize_text_field( '2222222222222'.$_POST['dropin_date']);
	}
 
	return $cart_item_data;
 

}
*/