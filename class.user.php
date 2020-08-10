
<div>
<h4><?php echo esc_html_e('Usuarios', 'monitor-dollar-text'); ?></h4>	
	<hr>
<div id="map_create_usario">
<div class="remover">
<div>
<label for="">Correo Electrónico</label>
<input type="email" id="usuario_id">
</div>

<div>
<label for="">Contraseña</label>
<input type="password" id="password_id">
</div>
</div>


<div>
    <div class="btn_style_new">
            <button type="buttom" class="buttom button-primary" id="btn_crear_username">Crear usuario</button>
                 <span class="spinner" style="visibility: visible; display: none;"></span>
				<span class="dashicons dashicons-yes-alt" id="check-id-monitor"></span>
				<span class="dashicons dashicons-dismiss" id="faild-id-monitor"></span>
    </div>
</div>

  

</div>




<div id="map_mis_usuarios">
<h4><?php echo esc_html_e('Usuarios activos', 'monitor-dollar-text'); ?></h4>	
    <hr>
    <?php 

    include_once($this->plugin_url .'/admin/usertable.php');
    // $list = $const->crateUserApiToken('carl@gmail.com', 'carcode');
    // echo "<script>alert(".$list.")</script>";

    ?>
</div>
