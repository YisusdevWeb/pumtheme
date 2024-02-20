<?php
function registrar_taxonomia_genero_libro()
{
    $labels = array(
        'name'              => 'Géneros',
        'singular_name'     => 'Género',
        'search_items'      => 'Buscar Géneros',
        'all_items'         => 'Todos los Géneros',
        'edit_item'         => 'Editar Género',
        'update_item'       => 'Actualizar Género',
        'add_new_item'      => 'Agregar Nuevo Género',
        'new_item_name'     => 'Nuevo Género',
        'menu_name'         => 'Géneros',
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'genero-libro'),
    );
    register_taxonomy('genero_libro', 'libro', $args);
}
add_action('init', 'registrar_taxonomia_genero_libro');
function cargar_plantilla_libro($template)
{
    if (is_singular('libro') && !file_exists(get_template_directory() . '/single-libro.php')) {
        $template = plugin_dir_path(__FILE__) . '/single-libro.php';
    }
    return $template;
}
add_filter('single_template', 'cargar_plantilla_libro');
