<?php
if(get_post_type( $_GET['post'] )=='product' or $_GET['post_type']== 'product' ){
	add_action( 'admin_enqueue_scripts', 'RentIt_Date_Changer_enqueue_scripts_bothside',9999 );
}
add_action( 'wp_enqueue_scripts', 'RentIt_Date_Changer_enqueue_scripts_bothside',9999 );
function RentIt_Date_Changer_enqueue_scripts_bothside() {

	wp_enqueue_script( 'renita_moment-jalaali',plugins_url("moment-jalaali/build/moment-jalaali.js",__FILE__ ),array('renita_moment-with-locales'),  '0.8.1', true );
	wp_enqueue_script( 'renita_pDate', plugins_url("datetimepicker/bootstrap-datetimepicker-persian.min.js",__FILE__ ), array('renita_moment-jalaali'),'1', true );
	wp_enqueue_script( 'renita_settings_pDate', plugins_url("datetimepicker/settings.js",__FILE__ ), array('renita_pDate'),'0.0.6', true );

}
