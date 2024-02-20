<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta name="keywords" content="PUM, PUM!, PUM! Biblioteca ">
    <meta name="author" content="PUM! estudio / http://pumestudio.com">
    <!-- favicon -->
    <link rel="icon" href="<?php echo esc_url(get_site_icon_url()); ?>" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon//manifest.json">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header id="masthead" class="header">
    <nav class="site-nav" role="navigation">
    <div class="logo">
        <?php
        $custom_logo_id = get_theme_mod('custom_logo');
        $logo_url = wp_get_attachment_image_src($custom_logo_id, 'full');

        if ($logo_url) {
            echo '<a href="' . esc_url(home_url('/')) . '" rel="home"><img src="' . esc_url($logo_url[0]) . '" alt="Logo del sitio"></a>';
        } elseif (get_bloginfo('name')) {
            echo '<a href="' . esc_url(home_url('/')) . '" rel="home">' . get_bloginfo('name') . '</a>';
        } else {
            echo '<a href="' . esc_url(home_url('/')) . '" rel="home"><img src="' . esc_url(get_template_directory_uri() . '/assets/img/logo.png') . '" alt="Logo"></a>';
        }
        ?>
    </div>

</nav>

    </header>
    <div id="content" class="site-content">