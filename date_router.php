<?php
/*
this route to correct date folder and work as date router

*/
//you can change date calender type by adding ?cal_type={calender(jalali|gregorian|hijri)}
$default= 'gregorian' ;
$momentVars['cal_type'] = get_theme_mod( 'rentit_date_type', $default );
if(isset($_GET['cal_type'])){
	$momentVars['cal_type'] = $_GET['cal_type'];
}
//you can change date calender direction by adding ?dircrtion={calender(rtl|ltr|...)}$default= 'eng' ;

$default= 'ltr' ;
$momentVars['cal_direction'] = get_theme_mod( 'rentit_date_direction', $default );
if(isset($_GET['cal_direction'])){
	$momentVars['cal_direction'] = $_GET['cal_direction'];
}

//you can change date calender lang locale by adding ?locale_lang={calender(fa|eng|...)}$default= 'eng' ;

$default= 'en' ;
$momentVars['cal_lang'] = get_theme_mod( 'Other_date_format_lang', $default );
if(isset($_GET['cal_lang'])){
	$momentVars['cal_lang'] = $_GET['cal_lang'];
}

//you can change date calender lang locale by adding ?locale_lang={calender(fa|eng|...)}$default= 'eng' ;

$default= 'MM/DD/YYYY H:mm' ;
$momentVars['cal_format'] = get_theme_mod( 'Other_date_format_calendar', $default );
if(isset($_GET['cal_format'])){
	$momentVars['cal_format'] = $_GET['cal_format'];
}

//var_dump($momentVars);
//die;
//pass variable
add_action( 'wp_enqueue_scripts', 'RentIt_Date_Changer_pass_moment_vars',9999 );
add_action( 'admin_enqueue_scripts', 'RentIt_Date_Changer_pass_moment_vars',9999 );
function RentIt_Date_Changer_pass_moment_vars(){
	global $momentVars;
	wp_localize_script( 'renita_moment-with-locales', 'momentVars',$momentVars );
	//wp_localize_script( 'renita_bootstrap-datetimepicker', 'momentVars',$momentVars );
}
//http://localhost/wp-admin/post.php?post=10131&action=edit&cal_type=jalali&cal_lang=fa&cal_format=YYYY%2FMM%2FDD%20H%3Amm
switch ( $momentVars['cal_type']) {
	case 'jalali':
		require_once( 'jalali/do_all.php' );
	break;

	case 'gregorian':
		//nothing need to do...
	break;
	case 'hijri':
		//Go to see more: https://github.com/xsoh/moment-hijri
	break;
	default:
		//echo '<h1>default: '.$default.'</h1>';
	break;

}
//die;
