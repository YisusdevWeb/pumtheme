<?php 
// Agrega acciones a la sección "Theme Actions"
add_action('after_theme_row', 'add_custom_theme_buttons', 10, 3);

function add_custom_theme_buttons($theme_key, $theme, $status) {
    if ($theme_key === get_stylesheet()) {
        $activate_url = wp_nonce_url(admin_url('themes.php?action=activate&stylesheet=' . urlencode($theme_key)), 'activate-theme_' . $theme_key);
        $preview_url = admin_url('customize.php?theme=' . urlencode($theme_key));
        $delete_url = wp_nonce_url(admin_url('themes.php?action=delete&stylesheet=' . urlencode($theme_key)), 'delete-theme_' . $theme_key);
        echo '<tr class="theme-actions">';
        echo '<td colspan="4">';
        echo '<div class="theme-action-links">';
        echo '<a href="' . esc_url($preview_url) . '" class="button">' . esc_html__('Vista previa', 'text-domain') . '</a>';
        if ($status !== 'active') {
            echo '<a href="' . esc_url($delete_url) . '" class="button" onclick="return confirm(\'' . esc_attr__('¿Estás seguro de que deseas borrar este tema?', 'text-domain') . '\');">' . esc_html__('Borrar', 'text-domain') . '</a>';
        }
        echo '</div>';
        echo '</td>';
        echo '</tr>';
    }
}
