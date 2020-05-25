<div class="registry-monitor">
	<h4>Registro</h4>
<hr>
<?php if (isset($_GET[$this->idsubPanel])): ?>
		<nav class="search-username-monitor">
			<label for=""></label>
			<input type="search" placeholder="Buscar: username" id="search_monitor">
				<span class="spinner" style="visibility: visible; display: none;"></span>
				<span class="dashicons dashicons-yes-alt" id="check-id-monitor"></span>
				<span class="dashicons dashicons-dismiss" id="faild-id-monitor"></span>
		</nav>
<?php endif;	
	if (isset($_GET[$this->idsubPanel])) {
				include_once($this->plugin_url .'/admin/regit.php');
		}?>
</div> 