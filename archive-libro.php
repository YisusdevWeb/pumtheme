<?php get_header(); ?>
<section class="content content-main">
    <div class="content-txt col8-12 col10-12-m col12-12-s">
        <h1> Todos Los Libros</h1>
    </div>
</section>
<section class="content content-grid">
    <?php
    $args = array(
        'post_type'      => 'libro',
        'posts_per_page' => -1,
    );
    $libros = new WP_Query($args);
    $default_images = array(
        get_template_directory_uri() . '/assets/img/libro-1.jpg',
        get_template_directory_uri() . '/assets/img/libro-2.jpg',
        get_template_directory_uri() . '/assets/img/libro-3.jpg',
    );
    if ($libros->have_posts()) :
        $image_index = 0;
        while ($libros->have_posts()) : $libros->the_post();
            $imagen_libro = get_field('imagen_libro');
            if (!$imagen_libro) {
                $imagen_libro = $default_images[$image_index % count($default_images)];
                $image_index++;
            }
    ?>
            <div class="content-grid-item col3-12 col4-12-m col6-12-s">
                <a href="<?php the_permalink(); ?>">
                    <div class="content-grid-item-img">
                        <img src="<?php echo esc_url($imagen_libro); ?>" alt="<?php the_title_attribute(); ?>">
                    </div>
                    <div class="content-grid-item-title">
                        <h2><?php the_title(); ?></h2>
                        <?php
                        // Obtener los autores del libro
                        $autores = get_post_meta(get_the_ID(), 'repetidor_de_campos', true);
                        if ($autores) {
                            echo '<p>Autores: ' . esc_html(implode(', ', $autores)) . '</p>';
                        }
                        ?>
                        <p><strong>Año de publicación:</strong> <?php echo esc_html(get_field('ano_publicacion')); ?></p>
                        <p><strong>Género:</strong> <?php
                                                    $generos = get_the_terms(get_the_ID(), 'genero_libro');
                                                    if ($generos) {
                                                        foreach ($generos as $genero) {
                                                            echo esc_html($genero->name) . ', ';
                                                        }
                                                    }
                                                    ?></p>
                    </div>
                </a>
            </div>
    <?php
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
</section>
</main>
</div>
<?php get_footer(); ?>