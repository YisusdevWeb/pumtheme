<?php get_header(); ?>
<section class="content content-main">
    <div class="content-video col8-12 col12-12-m">
        <?php get_template_part('template-parts/hero-video'); ?>
    </div>
    <div class="content-txt col8-12 col10-12-m col12-12-s">
        <?php
        $custom_text_title = get_theme_mod('custom_text_title', ''); // Obtener el valor del tema modificado
        // Verificar si el valor está vacío y asignar el valor predeterminado en ese caso
        if (empty($custom_text_title)) {
            $custom_text_title = 'Lorem ipsum dolor, sit amet consectetur adipisicing elit.';
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
    $default_images = array(
        get_template_directory_uri() . '/assets/img/libro-1.jpg',
        get_template_directory_uri() . '/assets/img/libro-2.jpg',
        get_template_directory_uri() . '/assets/img/libro-3.jpg',
    );
    if ($libros->have_posts()) :
        $image_index = 0; // Índice para las imágenes predeterminadas
        while ($libros->have_posts()) : $libros->the_post();
            $imagen_libro = get_field('imagen_libro');
            if (!$imagen_libro) {
                // Si el campo 'imagen_libro' está vacío, utiliza una imagen predeterminada de WordPress.
                $imagen_libro = $default_images[$image_index % count($default_images)];
                $image_index++;
            }
    ?>
            <article class="content-grid-item col3-12 col4-12-m col6-12-s">
                <a href="<?php the_permalink(); ?>">
                    <section class="content-grid-item-img">
                        <img src="<?php echo esc_url($imagen_libro); ?>" alt="<?php the_title_attribute(); ?>">
                    </section>
                    <section class="content-grid-item-title">
                        <h2><?php the_title(); ?></h2>
                    </section>
                </a>
            </article>
    <?php
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
    <h3 class="ver-todos-los-libros button"><a href="<?php echo esc_url(get_post_type_archive_link('libro')); ?>"> Ver Todos los libros</a></h3>
</section>
</main>
</div>
<?php get_footer(); ?>