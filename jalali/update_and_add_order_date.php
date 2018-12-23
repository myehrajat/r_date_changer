<?php
function rentit_add_values_to_order_item_meta2($item_id,$order_id,$values) {
	wc_update_order_item_meta($item_id, esc_html__( 'Dropping Off Date', 'rentit' ), $values['custom_data_1']['gregorian_dropoff_date'] );
	wc_update_order_item_meta($item_id,  esc_html__( 'Picking Up Date', 'rentit' ), $values['custom_data_1']['gregorian_dropin_date'] );
	wc_add_order_item_meta($item_id, esc_html__( 'Jalali Dropping Off Date', 'rentit' ), $values['custom_data_1']['dropoff_date'] );
	wc_add_order_item_meta($item_id,  esc_html__( 'Jalali Picking Up Date', 'rentit' ), $values['custom_data_1']['dropin_date'] );
	update_post_meta( $order_id, '_dropin_date', $values['custom_data_1']['gregorian_dropin_date'] );
	update_post_meta( $order_id, '_dropoff_date',$values['custom_data_1']['gregorian_dropoff_date'] );
	add_post_meta( $order_id, '_jalali_dropin_date', $values['custom_data_1']['dropin_date'], true );
	add_post_meta( $order_id, '_jalali_dropoff_date', $values['custom_data_1']['dropoff_date'], true );
	
}