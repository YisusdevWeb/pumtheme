<?php
function registrar_libros()
{
    $labels = array(
        'name'               => 'Libros',
        'singular_name'      => 'Libro',
        'menu_name'          => 'Libros',
        'add_new'            => 'Añadir Nuevo',
        'add_new_item'       => 'Añadir Nuevo Libro',
        'edit_item'          => 'Editar Libro',
        'new_item'           => 'Nuevo Libro',
        'view_item'          => 'Ver Libro',
        'search_items'       => 'Buscar Libros',
        'not_found'          => 'No se encontraron libros',
        'not_found_in_trash' => 'No se encontraron libros en la papelera',
    );
    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => true,
        'menu_icon'           => 'dashicons-book-alt', // Puedes cambiar el icono según tu preferencia
        'supports'            => array('title', 'thumbnail'),
        'rewrite'             => array('slug' => 'libros'),
    );
    register_post_type('libro', $args);
}
add_action('init', 'registrar_libros');
