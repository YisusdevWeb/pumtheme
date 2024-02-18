<?php

function agregar_enlace_duplicar($actions, $post)
{
    if (current_user_can('edit_posts')) {
        $actions['duplicate'] = '<a href="' . wp_nonce_url(admin_url('admin.php?action=duplicar_post_page&post=' . $post->ID), 'duplicar_nonce') . '" title="Duplicar esta entrada" rel="permalink">Duplicar</a>';
    }
    return $actions;
}
add_filter('page_row_actions', 'agregar_enlace_duplicar', 10, 2);
add_filter('post_row_actions', 'agregar_enlace_duplicar', 10, 2);

function duplicar_post_page()
{
    if (!isset($_GET['post']) || empty($_GET['post'])) {
        return;
    }
    $post_id = $_GET['post'];
    if (!current_user_can('edit_post', $post_id) || !wp_verify_nonce($_REQUEST['_wpnonce'], 'duplicar_nonce')) {
        return;
    }
    $post = get_post($post_id);
    if (!$post) {
        return;
    }
    $new_post_id = wp_insert_post(array(
        'post_title' => $post->post_title . ' (Duplicado)',
        'post_content' => $post->post_content,
        'post_status' => $post->post_status,
        'post_type' => $post->post_type,
    ));
    if (!is_wp_error($new_post_id)) {
        wp_redirect(admin_url('post.php?action=edit&post=' . $new_post_id));
        exit;
    } else {
        wp_die('Error al duplicar la entrada.');
    }
}

add_action('admin_action_duplicar_post_page', 'duplicar_post_page');
