<div class="setting-monitor">
	<h4><?php echo esc_html_e('Ajustes', 'monitor-dollar-text'); ?></h4>	
	<hr>
<div class="setting-panel">
	<div class="setting-panel-one">
		<p><?php echo esc_html_e('Salida del cambio de divisas', 'monitor-dollar-text') ?></p>
		<p class="admin-panel-dark"><?php echo esc_html_e('Esta opcion es para habilitar o desabilitar los cambios', 'monitor-dollar-text')?><br><?php echo esc_html_e('por default en la salida.', 'monitor-dollar-text')?></p>
	</div>
	<div class="setting-panel-config">
		<div>
			<label for=""><?php echo esc_html_e('Peso', 'monitor-dollar-text') ?></label>
			<input type="checkbox" id="config_1_checked_monitor_peso" <?php if($result[0]->arg_one == 1){ 
				echo "checked='true'";
			}else{
				echo "";
			}?>>
		</div>
		<div>
			<label for=""><?php echo esc_html_e('Dolar', 'monitor-dollar-text') ?></label>
			<input type="checkbox" id="config_1_checked_monitor_dollar" <?php if($result[0]->arg_two == 1){ 
				echo "checked='true'";
			}else{
				echo "";
			} ?>>
		</div>
		<div>

			<label for=""><?php echo esc_html_e('BCV', 'monitor-dollar-text') ?></label>
			<input type="checkbox" id="config_1_checked_monitor_bcv"<?php if($result[0]->arg_three == 1){ 
				echo "checked='true'";
			}else{
				echo "";
			}?>>
		</div>
	</div>
</div>
<div style="display: flex">
<button class="button button-primary" id="config_all_update_monitor" style="margin-right: 10px;"><?php echo esc_html_e('Guardar cambios', 'monitor-dollar-text') ?></button>
			<span class="spinner" style="visibility: visible; display: none;"></span>
			<span class="dashicons dashicons-yes-alt" id="check-id-monitor"></span>
			<span class="dashicons dashicons-dismiss" id="faild-id-monitor"></span>
</div>
</div>