<?php 
$consultas= new  WpMonitorDollarConsultasModels();
$consultas->dbReturn();
 ?>

<div class="contenedor-monitor">
	<header>
		<div class="title-monitor">
			<h2><?php echo esc_html_e('MonitorDollar', 'monitor-dollar-text') ?></h2>
		</div>                                                           
		<div class="version-title">
			<div >
			<p><i class="opacidad-monitor">Versión: <b><?php echo esc_html_e($this->version, 'monitor-dollar-text') ?></b> - Todos los derechos reservados a <b><a href="https://seocontenidos.net" target=""><?php echo esc_html_e( $this->author, 'monitor-dollar-text') ?></b></a> -&nbsp;<?php echo esc_html_e( 'Contacto', 'monitor-dollar-text') ?>:&nbsp;<a href="mailto:support@seocontenidos.net" style="opacity: 1">support@seocontenidos.net</a></i></p>
			</div>
			
		</div>
	</header>
	<div class="main-monitor">
	<div class="nav-menu-monitor">
<?php 
		if (isset($_GET[$this->idPanel])) {
			switch ($_GET[$this->idPanel]) {
				case 1:
					$styleOne = "color: #0073aa;border-left: 1px solid #0073aa;";
					break;
				case 2:
					$styleTwo = "color: #0073aa;border-left: 1px solid #0073aa;";
					break;
				case 3:
					$styleThree = "color: #0073aa;border-left: 1px solid #0073aa;";
					break;
				case 4:
					$styleFour = "color: #0073aa;border-left: 1px solid #0073aa;";

					break;
				case 5:
					$styleFive = "color: #0073aa;border-left: 1px solid #0073aa;";
					break;	
				
				default:
					# code...
					break;
			}
		}
?>
			<a href="?page=<?php echo esc_attr($this->slug); ?>&<?php echo esc_attr($this->idPanel); ?>=1" style=" <?php if (!empty($styleOne)){echo esc_attr($styleOne);}?> "><?php echo esc_html_e('Cambio', 'monitor-dollar-text') ?></a>
			<a href="?page=<?php echo esc_attr($this->slug); ?>&<?php echo esc_attr($this->idPanel); ?>=2&<?php echo esc_attr($this->idsubPanel); ?>" style="<?php if (!empty($styleTwo)){echo esc_attr($styleTwo);}?>"><?php echo esc_html_e('Registro', 'monitor-dollar-text') ?></a>
			<a href="?page=<?php echo esc_attr($this->slug); ?>&<?php echo esc_attr($this->idPanel); ?>=3" style="<?php if (!empty($styleThree)){echo esc_attr($styleThree);}?>"><?php echo esc_html_e('Ajustes', 'monitor-dollar-text') ?></a>
			<a href="?page=<?php echo esc_attr($this->slug); ?>&<?php echo esc_attr($this->idPanel); ?>=4" style="<?php if (!empty($styleFour)){echo esc_attr($styleFour);}?>">Shortcode</a>
			
	</div>
	<div class="panel-monitor">
<?php 
		if(isset($_GET[$this->idPanel])){

			switch ($_GET[$this->idPanel]) {
				case 1:
					include_once(esc_attr($this->plugin_url) . '/class.change.php');
					break;
				case 2:
					include_once(esc_attr($this->plugin_url) . '/class.registry.php');
					break;
				case 3:
				$result = $this->returnConfig(1);
					include_once(esc_attr($this->plugin_url) . '/class.setting.php');
					break;
				case 4:
					 ?>
					 <h4>Shortcode</h4>
					 <hr>
					<input type="text" value="[monitordollar]" disabled>
					 <?php
					 break;
				default:
					break;
			}
		}?>
	</div>	
	</div>
</div>
