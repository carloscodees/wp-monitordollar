<?php 
$list = $consultas->returnDataUser_prueba();
if(isset($_GET['deletemonitor'])){
  // $con = new 
 $consultas->deleteusermonitor($_GET['deletemonitor']);
}
 ?>
 <div class="id_table_scrool_monitor">
 	


<table class="monitor-table">

  <tr>

    <th><?php echo esc_html('id', 'monitor-dollar-text') ?></th>

    <th><?php echo esc_html('Usuario', 'monitor-dollar-text') ?></th>


    <th><?php echo esc_html_e('Email', 'monitor-dollar-text') ?></th>


    <th><?php echo esc_html_e('Opciones', 'monitor-dollar-text') ?></th>

  </tr>
  
<tbody id="mascara-prueba_usuer">
  
</tbody>


</table>
 </div>