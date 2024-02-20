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
        'menu_icon'           => 'dashicons-book-alt',
        'supports'            => array('title', 'thumbnail'),
        'rewrite'             => array('slug' => 'libros'),
    );
    register_post_type('libro', $args);
}
add_action('init', 'registrar_libros');


function cambiar_texto_admin_bar($wp_admin_bar)
{
    $args = $wp_admin_bar->get_node('archive');

    if ($args) {
        $args->title = 'Ver Libros';
        $wp_admin_bar->add_node($args);
    }
}

add_action('admin_bar_menu', 'cambiar_texto_admin_bar', 999);
