<?php
/*
important NOTE:
in original theme at first called rentit_add_user_custom_data_options_callback then rentit_init_site in rentit_add_user_custom_data_options_callback we use post vars to calculate the cart page duration of rental car and any change to rentit_init_site will not applied to this calculation so  i found a way to remove the action hooked and hook again with correct order firstly rentit_init_site and then rentit_add_user_custom_data_options_callback to can affect the calculation of rentit_add_user_custom_data_options_callback by changing variables in rentit_init_site

*/
add_action( 'init','RentIt_Date_Changer_remove_rentit_init_site_func',1);
function RentIt_Date_Changer_remove_rentit_init_site_func() {
	remove_action( 'init', 'rentit_add_user_custom_data_options_callback');
	remove_action( 'init', 'rentit_init_site');
	add_action( 'init', 'rentit_init_site');
	add_action( 'init', 'rentit_add_user_custom_data_options_callback');
}