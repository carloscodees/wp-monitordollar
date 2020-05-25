<div style="display: flex;align-items: center;">
<h4><?php echo esc_html_e('Cambio', 'monitor-dollar-text') ?> </h4><span class="dashicons dashicons-warning" id="monitor-warning-id-monitor" title="<?php echo esc_attr_e('Para fines de seguridad y auditoría, sus cambios de divisas están siendo registrados. El registro de auditoría incluye username, fecha y cambios realizados en las divisas.', 'monitor-dollar-text') ?>" style="cursor: help;"></span>
</div>
<hr>
<div class="change-monitor">
	<div class="change-act">
		<div class="change-title">
			<h4><?php echo esc_html_e('Cambio Actual', 'monitor-dollar-text') ?>: </h4>
		</div>
		<div class="change-act-panel" style="width: 212px;">
			<p><?php echo esc_html_e('Peso', 'monitor-dollar-text') ?>:<i id="output-peso-monitor-peso"><?php echo esc_html_e($consultas->returnPeso() , 'monitor-dollar-text') ?></i></p>
			<p><?php echo esc_html_e('Dolar', 'monitor-dollar-text') ?>:<i id="output-peso-monitor-dollar"><?php echo esc_html_e($consultas->returnDollar() , 'monitor-dollar-text') ?></i></p>
			<p><?php echo esc_html_e('BCV', 'monitor-dollar-text') ?>:<i id="output-peso-monitor-bcv"><?php echo esc_html_e($consultas->returnBcv() , 'monitor-dollar-text') ?></i></p>
			<p><?php echo esc_html_e('Fecha', 'monitor-dollar-text') ?>:<mark><i id="output-peso-monitor-dateinfo"><?php echo esc_html_e($consultas->returnDate() , 'monitor-dollar-text') ?></i></mark></p>
			<p><?php echo esc_html_e('Usuario', 'monitor-dollar-text') ?>:<i id="output-peso-monitor-username"><?php echo esc_html_e($consultas->returnUsername() , 'monitor-dollar-text') ?></i></p>
		</div>
	</div>
	<div class="change-new">
		<div class="change-new-title">
			<h4><?php echo esc_html_e('Nuevo cambio', 'monitor-dollar-text') ?>:</h4>
		</div>
		<div class="change-new-panel" >
			<div class="peso-change">
				<label for=""><?php echo esc_html_e('Peso', 'monitor-dollar-text') ?></label>
				<input type="text" placeholder="Peso" id="monitor-peso" value="<?php echo esc_attr_e($consultas->returnPeso(), 'monitor-dollar-text') ?>">
			</div>
			<div class="dollar-change">
				<label for=""><?php echo esc_html_e('Dolar', 'monitor-dollar-text') ?></label>
				<input type="text" placeholder="Dollar" id="monitor-dollar" value="<?php echo esc_attr_e($consultas->returnDollar(), 'monitor-dollar-text') ?>">
			</div>
			<div class="bcv-change">
				<label for=""><?php echo esc_html_e('BCV', 'monitor-dollar-text') ?></label>
				<input type="text" placeholder="BCV" id="monitor-bcv" value="<?php echo esc_attr_e($consultas->returnBcv(), 'monitor-dollar-text') ?>">
			</div>
			<div style="display: flex;flex-direction: row;">	
			<div class="btn-monitor" style="display: flex;">			
		<button class="buttom button-primary button-monitor-center" id="btn-submit-monitor" ><?php echo esc_html_e('Actualizar', 'monitor-dollar-text') ?></button></div>
			<div style="display: flex;justify-content: center;align-items: center;">
			<span class="spinner" style="visibility: visible; display: none;"></span>
			<span class="dashicons dashicons-yes-alt" id="check-id-monitor"></span>
			<span class="dashicons dashicons-dismiss" id="faild-id-monitor"></span>
			</div>
				</div>	
		</div>
	</div>
</div>
	<style>
		#rev_slider_33_1_wrapper .nav-pos-ver-bottom {
			display: none;
		}
	</style>