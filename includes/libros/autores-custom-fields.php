<?php
function agregar_meta_box_autores()
{
    add_meta_box(
        'autores',
        'Autores',
        'renderizar_autores',
        'libro',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'agregar_meta_box_autores');
// Renderizar campos personalizados
function renderizar_autores($post)
{
    // Obtener los valores actuales de los campos personalizados
    $campos_autores = get_post_meta($post->ID, 'campos_autores', true);
?>
    <label for="campos_autores"></label>
    <div id="repetidor-container">
        <?php
        if ($campos_autores) {
            foreach ($campos_autores as $campo) {
        ?>
                <div class="campo-repetidor">
                    <input type="text" name="campos_autores[]" value="<?php echo esc_attr($campo); ?>" />
                    <span class="eliminar-campo" onclick="eliminarCampo(this)">Eliminar</span>
                </div>
            <?php
            }
        } else {
            ?>
            <div class="campo-repetidor">
                <input type="text" name="campos_autores[]" value="" />
                <span class="eliminar-campo" onclick="eliminarCampo(this)">Eliminar</span>
            </div>
        <?php
        }
        ?>
    </div>
    <button type=" button" onclick="agregarautor()">Agregar Autor</button>
    <script>
        function agregarautor() {
            var container = document.getElementById('repetidor-container');
            var nuevoCampo = document.createElement('div');
            nuevoCampo.className = 'campo-repetidor';
            nuevoCampo.innerHTML = '<input type="text" name="campos_autores[]" value="" />' +
                '<span class="eliminar-campo" onclick="eliminarCampo(this)">Eliminar</span>';
            container.appendChild(nuevoCampo);
        }

        function eliminarCampo(elemento) {
            var container = document.getElementById('repetidor-container');
            var campo = elemento.parentNode;
            container.removeChild(campo);
        }
    </script>
<?php
}
function guardar_datos_autores($post_id)
{
    if (isset($_POST['campos_autores'])) {
        update_post_meta($post_id, 'campos_autores', $_POST['campos_autores']);
    }
}
add_action('save_post_libro', 'guardar_datos_autores');
