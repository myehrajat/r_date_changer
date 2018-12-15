<?php
function RentIt_Date_Changer_customizer($wp_customize){
	/*************************************
	Removing 
	**************************************/
	/*default option of theme*/
	$wp_customize->remove_setting('Other_date_format_calendar');
	$wp_customize->remove_control('Other_date_format_calendar_control');
	/*default option of theme*/
	$wp_customize->remove_setting('Other_date_format_lang');
	$wp_customize->remove_control('Other_date_format_lang_control');
	/*************************************
	
	**************************************/
    $tmp_sectionname = "rentit_date";
	
    $wp_customize->add_section($tmp_sectionname . '_section', array(
        'title' => esc_html__('Date settings', 'rentit'),
        'priority' => 1,
        'description' => esc_html__('This is date setting part.', 'rentit')));

    $tmp_settingname = $tmp_sectionname . '_type';
    $wp_customize->add_setting($tmp_settingname, array('default' => 'gregorian',
                                                       'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' =>  esc_html__('Select the calendar type', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'description' => esc_html__('insert calendar type  for example "jalali" or "gregorian"!', 'rentit'),
        'settings' => $tmp_settingname,
        'type' => 'select',
        'choices' => array(
            'jalali' => esc_html__('Jalali', 'rentit'),
            'gregorian' => esc_html__('Gregorian', 'rentit'),
            'hijri' => esc_html__('hijri (we are working on it...)', 'rentit'),
        )));
	/**********************/
    $tmp_settingname = $tmp_sectionname . '_direction';
    $wp_customize->add_setting($tmp_settingname, array('default' => 'ltr',
                                                       'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' =>  esc_html__('Calender direction', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'description' => esc_html__('Calender popup direction', 'rentit') ,
        'settings' => $tmp_settingname,
        'type' => 'select',
        'choices' => array(
            'ltr' => esc_html__('Left to right', 'rentit'),
            'rtl' => esc_html__('Right to left', 'rentit'),
        )));
	/**********************/
	$default_settingname = 'Other';
    $tmp_settingname = $default_settingname . '_date_format_calendar';
    $wp_customize->add_setting($tmp_settingname, array('default' => 'MM/DD/YYYY H:mm ',
                                                       'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' =>  esc_html__('the date format in the calendar', 'rentit'),
        'section' => "rentit_date_section",
        'description' => esc_html__('MM/DD/YYYY H:mm or DD-MM-YYYY H:mm !!!', 'rentit') ,
        'settings' => $tmp_settingname,
        'type' => 'text'));
	
	
	/**********************/
    $tmp_settingname = $default_settingname . '_date_format_lang';
    $wp_customize->add_setting($tmp_settingname, array('default' => 'en',
                                                       'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' =>  esc_html__('Select the calendar language', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'description' => esc_html__('insert language  for example ru or es  ', 'rentit') . "<a href='http://momentjs.com/#multiple-locale-support'> here</a>",
        'settings' => $tmp_settingname,
        'type' => 'text'));
	
}
add_action('customize_register', 'RentIt_Date_Changer_customizer',99999);