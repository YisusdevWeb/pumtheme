<?php
function text_edit_customize_register($wp_customize)
{
    $wp_customize->add_section('custom_title_section', array(
        'title'    => __('Escribe aquí tu texto', 'text_edit'),
        'priority' => 30,
    ));

    $wp_customize->add_setting('custom_text_title', array(
        'default'           => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit.',
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('custom_text_title', array(
        'label'    => __('Escribe aquí tu texto', 'text_edit'),
        'section'  => 'custom_title_section',
        'type'     => 'textarea',
    ));
}
add_action('customize_register', 'text_edit_customize_register');
