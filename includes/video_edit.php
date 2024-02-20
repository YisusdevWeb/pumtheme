<?php



function pumtheme_customize_register($wp_customize) {
    
    $wp_customize->add_section('video_section', array(
        'title' => __('Video Ajuste', 'pumtheme'),
        'priority' => 30,
    ));

    $wp_customize->add_setting('video_enabled', array(
        'default' => true,
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('video_enabled', array(
        'label' => __('Enable video', 'pumtheme'),
        'section' => 'video_section',
        'type' => 'checkbox',
    ));

    $wp_customize->add_setting('video_videoid', array(
        'default' => 'ogfYd705cRs',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('video_videoid', array(
        'label' => __('Video Video ID', 'pumtheme'),
        'section' => 'video_section',
        'type' => 'text',
    ));

$wp_customize->add_setting('video_background_style', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field',
));

    $wp_customize->add_control('video_background_style', array(
        'label' => __('video img Style', 'pumtheme'),
        'section' => 'video_section',
        'type' => 'text',
    ));
}
add_action('customize_register', 'pumtheme_customize_register');
