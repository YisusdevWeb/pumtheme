<?php

// Agregar los estilos y scripts
add_action('wp_enqueue_scripts', 'enqueue_pumtheme_style', 99);
function enqueue_pumtheme_style()
{
    $js_data_passed = array(
        'ajax_url' => admin_url('admin-ajax.php'),
    );

    // Parent and child theme styles
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style', STYLESHEET_URI . '/style.css', array('parent-style'), '1.0.0');
    wp_enqueue_style('child-style-default', STYLESHEET_URI . '/assets/css/style.css', array('parent-style'), '1.0.0');
    wp_enqueue_style('child-style-init', STYLESHEET_URI . '/assets/css/init.css', array('parent-style'), '1.0.0');
    wp_enqueue_style('child-style-main', STYLESHEET_URI . '/assets/css/main.css', array('parent-style'), '1.0.0');
    wp_enqueue_style('child-style-media', STYLESHEET_URI . '/assets/css/media.css', array('parent-style'), '1.0.0');
    wp_enqueue_style('child-style-lite-yt-embed', STYLESHEET_URI . '/assets/libs/lite-yt/css/lite-yt-embed.css', array('parent-style'), '1.0.0');


    // Custom scripts
    wp_enqueue_script('child-main-js', STYLESHEET_URI . '/assets/js/main.js', array(), '1.0.5', true);
    wp_enqueue_script('child-lite-yt-embed-js', STYLESHEET_URI . '/assets/libs/lite-yt/js/lite-yt-embed.js', array(), '1.0.0', true);
    wp_localize_script('child-main-js', 'woo', $js_data_passed);
}
