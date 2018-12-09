<?php
function RentIt_Date_Changer_customizer($wp_customize){
/*MYEDIT>*/
    $tmp_sectionname = "rentit_rlt";

    $tmp_settingname = $tmp_sectionname . '_cal_type';
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
/*<MYEDIT*/
}
add_action('customize_register', 'RentIt_Date_Changer_customizer');