<?php
// Función para agregar libros de muestra
function agregar_libros_de_muestra()
{
    // Verificar si ya existen libros registrados
    $libros_existentes = get_posts(array('post_type' => 'libro', 'posts_per_page' => 1));

    if (empty($libros_existentes)) {
        $libros_de_muestra = array(
            array(
                'post_title'   => 'Libro de Muestra 1',
                'post_content' => 'Contenido del Libro de Muestra 1.',
                'post_status'  => 'publish',
                'post_type'    => 'libro',
            ),
            array(
                'post_title'   => 'Libro de Muestra 2',
                'post_content' => 'Contenido del Libro de Muestra 2.',
                'post_status'  => 'publish',
                'post_type'    => 'libro',
            ),
            array(
                'post_title'   => 'Libro de Muestra 3',
                'post_content' => 'Contenido del Libro de Muestra 2.',
                'post_status'  => 'publish',
                'post_type'    => 'libro',
            ),
        );

        foreach ($libros_de_muestra as $libro) {
            wp_insert_post($libro);
        }
    }
}
add_action('after_switch_theme', 'agregar_libros_de_muestra');
