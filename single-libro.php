<?php get_header(); ?>
<section class="content content-libro">
    <div class="content-libro-img col6-12 col12-12-s">
        <?php
        // Obtener la imagen destacada del libro
        $imagen_libro = get_field('imagen_libro');
        if (!$imagen_libro) {
            // Si el campo 'imagen_libro' está vacío, utiliza una imagen predeterminada de WordPress.
            $default_images = array(
                get_template_directory_uri() . '/assets/img/libro-1.jpg',
                get_template_directory_uri() . '/assets/img/libro-2.jpg',
                get_template_directory_uri() . '/assets/img/libro-3.jpg',
            );
            $imagen_libro = $default_images[0]; // Puedes ajustar este índice según tus necesidades.
        }
        ?>
        <img src="<?php echo esc_url($imagen_libro); ?>" alt="<?php the_title_attribute(); ?>">
    </div>
    <div class="content-libro-info col6-12 col12-12-s">
        <h1><?php the_title(); ?></h1>
        <ul>
            <li>
                <h2>Autor/es</h2>
            </li>
            <li><?php
                // Obtener los autores del libro
                $autores = get_post_meta(get_the_ID(), 'repetidor_de_campos', true);

                if ($autores) {
                    echo esc_html(implode(', ', $autores));
                }
                ?></li>
            <li><?php echo get_post_meta(get_the_ID(), 'ano_libro', true); ?></li>
            <li><?php echo get_post_meta(get_the_ID(), 'genero_libro', true); ?></li>
        </ul>
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
</section>
<?php get_footer(); ?>