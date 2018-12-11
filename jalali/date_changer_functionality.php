<?php
/**
 * @package RentIt_Date_Changer
 * @version 1.0
 */

/*https://github.com/roozbeh360/Gregorian-Jalali-Date-Convertor*/
require_once( plugin_dir_path( __FILE__ ) . 'Gregorian-Jalali-Date-Convertor\gregorian_jalali.php' );
function RentIt_Date_Changer_jalali_to_gregorian_reserve_format($date_time) {

	global $momentVars ;
	//var_dump($date_time);
	$jdate_time_arr = date_parse( $date_time );//make array detect format automatically
	//var_dump($jdate_time_arr);
	//return in this format 'Y/j/n H:i'
	$gdate_time_arr = jalali_to_gregorian( $jdate_time_arr[ 'year' ], $jdate_time_arr[ 'month' ], $jdate_time_arr[ 'day' ], false );
	//var_dump(  $jdate_time_arr[ 'minute' ]);
	if (  $jdate_time_arr[ 'minute' ] < 10 ) { //correct time with leading zero
		//var_dump('ssssssss');
		$jdate_time_arr[ 'minute' ] = '0' . $jdate_time_arr[ 'minute' ];
	}
	
	//var_dump(  $gdate_time_arr[0].'/'.$gdate_time_arr[1].'/'.$gdate_time_arr[2] . ' ' . intval( $jdate_time_arr[ 'hour' ] ) . ':' . $jdate_time_arr[ 'minute' ]);

	$gdate_obj = date_create_from_format( 'Y/j/n H:i', $gdate_time_arr[0].'/'.$gdate_time_arr[1].'/'.$gdate_time_arr[2] . ' ' . intval( $jdate_time_arr[ 'hour' ] ) . ':' . $jdate_time_arr[ 'minute' ] );

	$momentVars[ 'cal_format' ]; //its moment format which is differ from  php format
	$php_format = RentIt_Date_Changer_moment_to_php_format( $momentVars[ 'cal_format' ] );//create php format
	$gdate_formatted = $gdate_obj->format( $php_format );
	//var_dump($gdate_formatted);

	return $gdate_formatted;
}
if(isset($_GET['start_date'])){
	$_GET['jalali_start_date']=$_GET['start_date'];//set this for further usage eg api of tbt rental sys date
	$_GET['start_date']=RentIt_Date_Changer_jalali_to_gregorian_reserve_format($_GET['start_date']);//for original theme and plugin
}
if(isset($_GET['end_date'])){
	$_GET['jalali_end_date']=$_GET['end_date'];//set this for further usage eg api of tbt rental sys date
	$_GET['end_date']=RentIt_Date_Changer_jalali_to_gregorian_reserve_format($_GET['end_date']);//for original theme and plugin
}