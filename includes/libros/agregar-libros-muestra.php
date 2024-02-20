<?php
$default_images = array(
    get_template_directory_uri() . '/assets/img/La-sombra-del-viento.png',
    get_template_directory_uri() . '/assets/img/cien-anos-de-soledad.png',
    get_template_directory_uri() . '/assets/img/el-hobbit.png',
    get_template_directory_uri() . '/assets/img/1984.png',


);
global $libros_de_muestra;

function agregar_libros_de_muestra()
{
    global $libros_de_muestra;

    $libros_existentes = get_posts(array('post_type' => 'libro', 'posts_per_page' => 1));

    if (empty($libros_existentes)) {
        // Crear términos de la taxonomía 'genero_libro' si no existen
        $genero_libro_terms = get_terms('genero_libro', array('hide_empty' => false));
        if (empty($genero_libro_terms)) {
            wp_insert_term('misterio', 'genero_libro', array('slug' => 'misterio'));
            wp_insert_term('realismo-magico', 'genero_libro', array('slug' => 'realismo-magico'));
            wp_insert_term('fantasia', 'genero_libro', array('slug' => 'fantasia'));
            wp_insert_term('Ciencia Ficción', 'genero_libro', array('slug' => 'ciencia-ficcion'));
        }

        $libros_de_muestra = array(

            array(
                'post_title'      => 'La Sombra del Viento',
                'post_content'    => 'Una novela de misterio y aventuras escrita por Carlos Ruiz Zafón.',
                'post_status'     => 'publish',
                'post_type'       => 'libro',
                'ano_publicacion' => '2001',
                'genero_libro'    => 'misterio',
                'campos_autores'  => array('Carlos Ruiz Zafón'),
                'imagen_libro'    => get_template_directory_uri() . '/assets/img/La-sombra-del-viento.png',  // URL de la imagen por defecto
            ),
            array(
                'post_title'      => 'Cien años de soledad',
                'post_content'    => 'Una obra maestra del realismo mágico escrita por Gabriel García Márquez.',
                'post_status'     => 'publish',
                'post_type'       => 'libro',
                'ano_publicacion' => '1967',
                'genero_libro'    => 'realismo-magico',
                'campos_autores'  => array('Gabriel García Márquez'),
                'imagen_libro'    => get_template_directory_uri() . '/assets/img/cien-anos-de-soledad.png',  // URL de la imagen por defecto
            ),
            array(
                'post_title'      => 'El Hobbit',
                'post_content'    => 'Una novela de fantasía escrita por J.R.R. Tolkien.',
                'post_status'     => 'publish',
                'post_type'       => 'libro',
                'ano_publicacion' => '1937',
                'genero_libro'    => 'fantasia',
                'campos_autores'  => array('J.R.R. Tolkien'),
                'imagen_libro'    => get_template_directory_uri() . '/assets/img/el-hobbit.png',  // URL de la imagen por defecto
            ),
            array(
                'post_title'      => '1984',
                'post_content'    => 'Una novela distópica escrita por George Orwell.',
                'post_status'     => 'publish',
                'post_type'       => 'libro',
                'ano_publicacion' => '1949',
                'genero_libro'    => 'ciencia-ficcion',
                'campos_autores'  => array('George Orwell'),
                'imagen_libro'    => get_template_directory_uri() . '/assets/img/1984.png',  // URL de la imagen por defecto
            ),
        );

        foreach ($libros_de_muestra as $libro) {
            $post_id = wp_insert_post($libro);

            // Verificar si ACF está activado
            if (function_exists('acf')) {
                update_field('ano_publicacion', $libro['ano_publicacion'], $post_id);

                update_field('imagen_libro', $libro['imagen_libro'], $post_id);
            } else {
                $mensaje_recomendacion = 'Recomendamos activar Advanced Custom Fields y crear los campos de imagen y año de publicación para una mejor experiencia.';
                update_option('mensaje_recomendacion_acf', $mensaje_recomendacion);

                $imagen_libro_default = isset($libro['imagen_libro']) ? $libro['imagen_libro'] : '';

                $imagen_libro = !empty($imagen_libro_default) ? $imagen_libro_default : $default_images[0]; // Aquí usamos $default_images[0] como ejemplo, puedes ajustarlo según tus necesidades

                update_post_meta($post_id, 'imagen_libro', $imagen_libro);

                update_post_meta($post_id, 'ano_publicacion', $libro['ano_publicacion']);
            }

            $term = get_term_by('slug', $libro['genero_libro'], 'genero_libro');
            if ($term) {
                wp_set_post_terms($post_id, $term->term_id, 'genero_libro', true);
            }

            update_post_meta($post_id, 'campos_autores', $libro['campos_autores']);
        }

        // Verificar si ACF está instalado antes de mostrar el aviso
        if (!function_exists('acf')) {
            add_action('admin_notices', 'mostrar_mensaje_recomendacion_acf');
        }
    }
}

function mostrar_mensaje_recomendacion_acf()
{
    // Obtener el mensaje de la opción de WordPress
    $mensaje_recomendacion = get_option('mensaje_recomendacion_acf');

    if ($mensaje_recomendacion) {
        echo '<div class="notice notice-info is-dismissible"><p>' . esc_html($mensaje_recomendacion) . '</p></div>';
    }
}
add_action('after_switch_theme', 'agregar_libros_de_muestra');
