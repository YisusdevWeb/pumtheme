<?php get_header(); ?>
<section class="content content-main">
    <div class="content-txt col8-12 col10-12-m col12-12-s">
        <h1> Todos Los Libros</h1>
    </div>
</section>
<section class="content content-grid">
    <?php
    // Consulta para mostrar libros
    $args = array(
        'post_type'      => 'libro',
        'posts_per_page' => -1,
    );
    $libros = new WP_Query($args);

    if ($libros->have_posts()) :
        $image_index = 0;
        while ($libros->have_posts()) : $libros->the_post();
            // Obtener la imagen del libro
            $imagen_libro = function_exists('get_field') ? get_field('imagen_libro') : '';

            if (!$imagen_libro) {
                $imagen_libro_default = isset($libros_de_muestra[$image_index]['imagen_libro']) ? $libros_de_muestra[$image_index]['imagen_libro'] : '';
                $imagen_libro = !empty($imagen_libro_default) ? $imagen_libro_default : $default_images[$image_index % count($default_images)];
            }

            $autores = get_post_meta(get_the_ID(), 'campos_autores', true);
            if (empty($autores) && isset($libros_de_muestra[$image_index]['campos_autores'])) {
                $autores = $libros_de_muestra[$image_index]['campos_autores'];
            }

            $autores = !empty($autores) ? $autores : (isset($libros_de_muestra[$image_index]['campos_autores']) ? $libros_de_muestra[$image_index]['campos_autores'] : array());

            $ano_publicacion = function_exists('get_field') ? get_field('ano_publicacion') : get_post_meta(get_the_ID(), 'ano_publicacion', true);

            $generos = wp_get_post_terms(get_the_ID(), 'genero_libro');

            $genero_names = ($generos) ? array_map(function ($genero) {
                return esc_html($genero->name);
            }, $generos) : array();

    ?>
            <article class="content-grid-item col3-12 col4-12-m col6-12-s ">
                <section class="content-book">
                    <a href="<?php the_permalink(); ?>">
                        <header class="content-grid-item-img">
                            <img src="<?php echo esc_url($imagen_libro); ?>" alt="<?php the_title_attribute(); ?>">
                        </header>
                        <article class="content-grid-item-title cuerpo-book">
                            <h2><?php the_title(); ?></h2>
                            <?php
                            if ($autores) {
                                echo '<p>Autores: ' . esc_html(implode(', ', $autores)) . '</p>';
                            }
                            ?>
                            <p><strong>Año de publicación:</strong> <?php echo esc_html($ano_publicacion); ?></p>
                            <p><strong>Género:</strong> <?php echo implode(', ', $genero_names); ?></p>
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


</section>

</main>
</div>
<?php get_footer(); ?>