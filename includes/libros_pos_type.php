<?php


include get_template_directory() . '/includes/libros/register-post-types.php';
include get_template_directory() . '/includes/libros/autores-custom-fields.php';
include get_template_directory() . '/includes/libros/register-taxonomies.php';
include get_template_directory() . '/includes/libros/agregar-libros-muestra.php';


add_action('init', 'registrar_libros');

