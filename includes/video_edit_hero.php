<?php



function pumtheme_customize_register($wp_customize) {
    // Sección del héroe
    $wp_customize->add_section('video_section', array(
        'title' => __('Video Ajuste', 'pumtheme'),
        'priority' => 30,
    ));

    // Campo para activar/desactivar el héroe
    $wp_customize->add_setting('hero_enabled', array(
        'default' => true,
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('hero_enabled', array(
        'label' => __('Enable Hero', 'pumtheme'),
        'section' => 'hero_section',
        'type' => 'checkbox',
    ));

    // Campo para el videoid
    $wp_customize->add_setting('hero_videoid', array(
        'default' => 'ogfYd705cRs',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('hero_videoid', array(
        'label' => __('Video Video ID', 'pumtheme'),
        'section' => 'video_section',
        'type' => 'text',
    ));

   // Campo para el estilo de fondo e imagen
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
