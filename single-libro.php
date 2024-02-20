<?php
global $libros_de_muestra;

get_header();
?>

<section class="content content-grid ">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();

            $book_id = get_the_ID();

            $imagen_libro = function_exists('get_field') ? get_field('imagen_libro', $book_id) : '';

            if (!$imagen_libro) {
                $imagen_libro_default = isset($libros_de_muestra[$book_id]['imagen_libro']) ? $libros_de_muestra[$book_id]['imagen_libro'] : '';
                $imagen_libro = !empty($imagen_libro_default) ? $imagen_libro_default : $default_images[$book_id % count($default_images)];
            }

            $autores = get_post_meta($book_id, 'campos_autores', true);

            $ano_publicacion = function_exists('get_field') ? get_field('ano_publicacion', $book_id) : get_post_meta($book_id, 'ano_publicacion', true);

            $generos = wp_get_post_terms($book_id, 'genero_libro');
            $genero_names = ($generos) ? array_map(function ($genero) {
                return esc_html($genero->name);
            }, $generos) : array();
    ?>

            <aside class="content-libro-img col6-12 col12-12-s ">

                <img src="<?php echo esc_url($imagen_libro); ?>" alt="<?php the_title_attribute(); ?>">
            </aside>
            <aside class="content-libro-info col6-12 col12-12-s">
                <h1><?php the_title(); ?></h1>

                <div class="contenido-libro">

                    <ul>
                        <li>
                            <h2>Autor/es</h2>
                        </li>
                        <li>
                            <?php
                            if ($autores) {
                                echo '<p>' . esc_html(implode(', ', $autores)) . '</p>';
                            }
                            ?>
                        </li>
                        <li>
                            <p><strong>Año de publicación:</strong> <?php echo esc_html($ano_publicacion); ?></p>
                        </li>
                        <li><strong>Género:</strong> <?php echo esc_html(implode(', ', $genero_names)); ?></li>
                    </ul>
                    <p>
                        <?php the_content(); ?>
                    </p>
                </div>
            </aside>

    <?php
        endwhile;
    else :
        echo '<p>No se encontraron libros.</p>';
    endif;
    ?>
</section>

<?php get_footer(); ?>