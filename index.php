<?php get_header(); ?>
<section class="content content-main">
    <div class="content-video col8-12 col12-12-m">
        <?php get_template_part('template-parts/video'); ?>
    </div>
    <div class="content-txt col8-12 col10-12-m col12-12-s">
        <?php
        $custom_text_title = get_theme_mod('custom_text_title', '');

        if (empty($custom_text_title)) {
            $custom_text_title = '¡Bienvenido a nuestra biblioteca de prueba en línea! Edita este texto en su personalizador de WordPress';
        }
        ?>
        <h1><?php echo wp_kses_post($custom_text_title); ?></h1>
    </div>
</section>
<section class="content content-grid">
    <?php

    $args = array(
        'post_type'      => 'libro',
        'posts_per_page' => 8,
    );
    $libros = new WP_Query($args);

    if ($libros->have_posts()) :
        $image_index = 0;
        while ($libros->have_posts()) : $libros->the_post();

            $imagen_libro = function_exists('get_field') ? get_field('imagen_libro') : '';

            if (!$imagen_libro) {
                $imagen_libro_default = isset($libros_de_muestra[$image_index]['imagen_libro']) ? $libros_de_muestra[$image_index]['imagen_libro'] : '';
                $imagen_libro = !empty($imagen_libro_default) ? $imagen_libro_default : $default_images[$image_index % count($default_images)];
            }
    ?>
            <article class="content-grid-item col3-12 col4-12-m col6-12-s  ">
                <section class="content-book ">
                    <a href="<?php the_permalink(); ?>">
                        <header class="content-grid-item-img">
                            <img src="<?php echo esc_url($imagen_libro); ?>" alt="<?php the_title_attribute(); ?>">
                        </header>

                        <article class="content-grid-item-title">
                            <h2><?php the_title(); ?></h2>

                        </article>
                    </a>
                </section>
            </article>
    <?php
            $image_index++;
        endwhile;
        wp_reset_postdata();
    else :
        echo '<p>No se encontraron libros.</p>';
    endif;
    ?>





</section>

<div class="content-button">

    <a class="button" href="<?php echo esc_url(get_post_type_archive_link('libro')); ?>"> Ver Todos Tus LIbros </a>
</div>
<section class="content content-grid">
    <div id="topics"><a href="" class="topic" title="Artículos sobre React.js">
            <h4></h4>
        </a></div>

</section>
</main>
</div>
<?php get_footer(); ?>