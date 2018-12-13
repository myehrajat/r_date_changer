<?php
/**
 * @package RentIt_Date_Changer
 * @version 1.0
 */

/*https://github.com/roozbeh360/Gregorian-Jalali-Date-Convertor*/
require_once( plugin_dir_path( __FILE__ ) . 'Gregorian-Jalali-Date-Convertor\gregorian_jalali.php' );
function RentIt_Date_Changer_jalali_to_gregorian_reserve_format($date_time) {
	global $momentVars ;
	$jdate_time_arr = date_parse( $date_time );//make array detect format automatically
	$gdate_time_arr = jalali_to_gregorian( $jdate_time_arr[ 'year' ], $jdate_time_arr[ 'month' ], $jdate_time_arr[ 'day' ], false );
	if (  $jdate_time_arr[ 'minute' ] < 10 ) { //correct time with leading zero
		$jdate_time_arr[ 'minute' ] = '0' . $jdate_time_arr[ 'minute' ];
	}
	$gdate_obj = date_create( $gdate_time_arr[0].'/'.$gdate_time_arr[1].'/'.$gdate_time_arr[2] . ' ' . intval( $jdate_time_arr[ 'hour' ] ) . ':' . $jdate_time_arr[ 'minute' ] );
	$momentVars[ 'cal_format' ]; //its moment format which is differ from  php format
	$php_format = RentIt_Date_Changer_moment_to_php_format( $momentVars[ 'cal_format' ] );//create php format
	$gdate_formatted = $gdate_obj->format( $php_format );
	return $gdate_formatted;
}

		/*
		*Note: {start_date} and {gergorian_dropin_date} are gergorian
		*Note: {jalali_start_date} and {dropin_date} are jalali
		*/

function RentIt_Date_Changer_set_get_jalali_dates(){
	if(isset($_GET['start_date'])){
		$_GET['jalali_start_date']=sanitize_text_field( urldecode($_GET['start_date']));
		$_GET['start_date']=sanitize_text_field( urldecode(RentIt_Date_Changer_jalali_to_gregorian_reserve_format($_GET['start_date'])));
	}
	if(isset($_GET['end_date'])){
		$_GET['jalali_end_date']=sanitize_text_field( urldecode($_GET['end_date']));
		$_GET['end_date']=sanitize_text_field( urldecode(RentIt_Date_Changer_jalali_to_gregorian_reserve_format($_GET['end_date'])));
	}
}
function RentIt_Date_Changer_set_post_jalali_dates(){
	if(isset($_POST['start_date'])){
		$_POST['jalali_start_date']=sanitize_text_field( urldecode($_POST['start_date']));
		$_POST['start_date']=sanitize_text_field( urldecode(RentIt_Date_Changer_jalali_to_gregorian_reserve_format($_POST['start_date'])));
	}
	if(isset($_POST['end_date'])){
		$_POST['jalali_end_date']=sanitize_text_field( urldecode($_POST['end_date']));
		$_POST['end_date']=sanitize_text_field( urldecode(RentIt_Date_Changer_jalali_to_gregorian_reserve_format($_POST['end_date'])));
	}
}
function RentIt_Date_Changer_set_request_jalali_dates(){
	if(isset($_REQUEST['start_date'])){
		$_REQUEST['jalali_start_date']=sanitize_text_field( urldecode($_REQUEST['start_date']));
		$_REQUEST['start_date']=sanitize_text_field( urldecode(RentIt_Date_Changer_jalali_to_gregorian_reserve_format($_REQUEST['start_date'])));
	}
	if(isset($_REQUEST['end_date'])){
		$_REQUEST['jalali_end_date']=sanitize_text_field( urldecode($_REQUEST['end_date']));
		$_REQUEST['end_date']=sanitize_text_field( urldecode(RentIt_Date_Changer_jalali_to_gregorian_reserve_format($_REQUEST['end_date'])));
	}
}


function RentIt_Date_Changer_set_cookie_jalali_dates(){
	//before it has been sanitize_text_field and urldecode
	if(isset($_REQUEST['start_date'])){
		setcookie('dropin_date', $_REQUEST['jalali_start_date'], time() + 86400, "/");
		setcookie('gregorian_dropin_date', $_REQUEST['start_date'], time() + 86400, "/");
	}
	if(isset($_REQUEST['end_date'])){
		setcookie('dropoff_date', $_REQUEST['jalali_end_date'], time() + 86400, "/");
		setcookie('gregorian_dropoff_date', $_REQUEST['end_date'], time() + 86400, "/");
	}
	/**********************/
}
function RentIt_Date_Changer_set_get_and_post_jalali_dates_based_on_cookies(){
	if(!isset($_GET['start_date']) and isset($_COOKIE['gregorian_dropin_date'])){
		$_GET['start_date'] = $_COOKIE['gregorian_dropin_date'];
		$_GET['jalali_start_date'] = $_COOKIE['dropin_date'];
	}
	if(!isset($_GET['end_date']) and isset($_COOKIE['gregorian_dropoff_date'])){
		$_GET['end_date'] = $_COOKIE['gregorian_dropoff_date'];
		$_GET['jalali_end_date'] = $_COOKIE['dropoff_date'];
	}
	if(!isset($_POST['start_date']) and isset($_COOKIE['gregorian_dropup_date'])){
		$_POST['start_date'] = $_COOKIE['gregorian_dropup_date'];
		$_POST['jalali_start_date'] = $_COOKIE['dropup_date'];
	}
	if(!isset($_POST['end_date']) and isset($_COOKIE['gregorian_dropoff_date'])){
		$_POST['end_date'] = $_COOKIE['gregorian_dropoff_date'];
		$_POST['jalali_end_date'] = $_COOKIE['dropoff_date'];
	}
}
function late_var_dump(){
	echo '<pre>';
	var_dump($_GET);
	echo '</pre>';
}
/**
after submitting home page we go to {http://localhost/shop/} and there is a widget there which can't be modified (or at least i can Not) and even get and cookie are jalali show gregorian dates to show jalali date we trick wp load by gregorian but by a simple jquery we change its value to jalali. thats tricky way to not modify the originat theme => As we have always said we try to NOT modify the theme
Original link affected
http://localhost/shop/?dropin=&start_date=1397%2F09%2F28+21%3A36&dropoff=&end_date=1397%2F09%2F29+21%3A36 
**/
add_action( 'wp_head', 'RentIt_Date_Changer_change_widget_date_to_jalali',PHP_INT_MAX );
function RentIt_Date_Changer_change_widget_date_to_jalali() {
  echo '<script>';?>

	jQuery( document ).ready( function( $ ) {
		jQuery('input[type=text]#formSearchUpDate30').val('<?php echo $_GET['jalali_start_date']; ?>');
		jQuery('input[type=text]#formSearchOffDate300').val('<?php echo $_GET['jalali_end_date']; ?>');
	} );
<?php
	echo '</script>';
}

RentIt_Date_Changer_set_get_jalali_dates();
RentIt_Date_Changer_set_post_jalali_dates();
RentIt_Date_Changer_set_request_jalali_dates();
//cookie in theme set by enqueued js so we should change it after loading thats js so use of PHP_INT_MAX right now make sense
add_action( 'wp_enqueue_scripts', 'RentIt_Date_Changer_set_cookie_jalali_dates', 1);
add_action( 'wp_enqueue_scripts', 'RentIt_Date_Changer_set_get_and_post_jalali_dates_based_on_cookies', 2);

//add_action( 'wp_enqueue_scripts', 'late_var_dump', 3);
/*





















*/
