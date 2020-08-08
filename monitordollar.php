<?php 
/*
Plugin Name: WP Monitor Dollar
Description: Monitoriar el cambio de divisas: Dolar, Peso Colombiano, Banco central de venezula
Author: SeoContenidos
Version: 0.0.1
Author URI: https://seocontenidos.net/
License: GPLv2 or later
Text Domain: monitor-dollar-text
*/
if(!class_exists('WpMonitorDollarInitClass')){
	if(!class_exists('WpMonitorDollarConsultasModels')){
		include_once( dirname(__FILE__) . '/class.models.php');

class WpMonitorDollarInitClass extends  WpMonitorDollarConsultasModels {
	public $monitordollar_lenguaje = ''; 
	public $notice = array();
	public $failed_edit = false;
	public $plugin_url = '';
	public $plugin_dir_path ='';
	function __construct(){$this->init();}
	public function init(){
		$this->plugin_dir_path = plugin_dir_path( __FILE__ );
		$this->plugin_url = dirname( __FILE__ );
		register_activation_hook( __FILE__ , array($this, 'db_monitor_dollar'));
		add_action('admin_menu', array( $this, 'monitor_menu'));
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ), 11 );
		add_action( 'wp_enqueue_scripts', array( $this, 'admin_enqueue_scripts_dos' ), 11 );
		add_shortcode( 'monitordollar', array($this, 'custom_shortcode_monitor'));
		add_action('wp_ajax_nopriv_monitor_ajax_submit', array($this, 'monitor_submit_models_ajax'));
		add_action('wp_ajax_monitor_ajax_submit', array($this, 'monitor_submit_models_ajax'));
		add_action('wp_ajax_nopriv_monitor_ajax_submit_setting', array($this, 'monitor_submit_models_ajax_setting_ex'));
		add_action('wp_ajax_monitor_ajax_submit_setting', array($this, 'monitor_submit_models_ajax_setting_ex'));
		add_action('wp_ajax_nopriv_monitor_ajax_submit_buscar', array($this, 'monitor_submit_models_ajax_buscar'));
		add_action('wp_ajax_monitor_ajax_submit_buscar', array($this, 'monitor_submit_models_ajax_buscar'));
	}
	public function monitor_menu(){
		$page_title = __( 'Monitor Dollar', 'monitor-dollar' );
		$menu_title = __( 'Monitor Dollar', 'monitor-dollar' );
		$capability = 'edit_others_posts';
		$menu_slug  = $this->slug;
		$function   = array( $this, 'dasboard' );
		add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, 'dashicons-chart-bar', 5);
	}
	public function dasboard(){
		include_once( $this->plugin_url . '/class.dasboard.php');
	}
	public function admin_enqueue_scripts(){
		wp_enqueue_style( 'monitor-dollar', plugin_dir_url( __FILE__ ) . 'include/style/style.css', array(), $this->version );
		wp_enqueue_style( 'monitor-dollar-font-admin', plugin_dir_url( __FILE__ ) . 'include/font/font/css/all.css', array(), $this->version );	
		wp_enqueue_script( 'monitor_dollar_ajax_js', plugin_dir_url( __FILE__ ) . 'include/js/js.js', array( 'jquery' ), $this->version, true );
		wp_localize_script('monitor_dollar_ajax_js','monitor_vars',['ajaxurl'=>admin_url('admin-ajax.php')]);

	}
	public function admin_enqueue_scripts_dos(){
		wp_enqueue_style( 'monitor-dollar-font', plugin_dir_url( __FILE__ ) . 'include/font/font/css/all.css', array(), $this->version );
		wp_enqueue_style( 'dashicons' );
	}
	public function monitor_submit_models_ajax(){
	
		
		   	$peso =wp_filter_nohtml_kses(sanitize_text_field($_POST['peso']));
		  	 $dollar = wp_filter_nohtml_kses(sanitize_text_field($_POST['dollar']));
			$bcv = wp_filter_nohtml_kses(sanitize_text_field($_POST['bcv']));

		if(!$peso == '' && !$dollar == '' && !$bcv == ''){

			echo $this->update(wp_filter_nohtml_kses(sanitize_text_field($_POST['peso'])),wp_filter_nohtml_kses(sanitize_text_field($_POST['dollar'])),wp_filter_nohtml_kses(sanitize_text_field($_POST['bcv'])));
			echo $this->insert(wp_filter_nohtml_kses(sanitize_text_field($_POST['peso'])),wp_filter_nohtml_kses(sanitize_text_field($_POST['dollar'])),wp_filter_nohtml_kses(sanitize_text_field($_POST['bcv'])));
		}else {
			echo false;
		}
		

		
	
		die();
	}
	public function monitor_submit_models_ajax_buscar(){
		if($_POST['buscar'] == ''){
				echo $this->returnRegistry();
		}else {
				echo $this->returnSearch((sanitize_title_for_query($_POST['buscar'])));
		}
		die();
	}
	public function monitor_submit_models_ajax_setting_ex(){
		$arg_peso = wp_filter_nohtml_kses(sanitize_text_field($_POST['config_1_checked_monitor_peso']));
		$arg_dollar = wp_filter_nohtml_kses(sanitize_text_field($_POST['config_1_checked_monitor_dollar']));
		$arg_bcv = wp_filter_nohtml_kses(sanitize_text_field($_POST['config_1_checked_monitor_bcv']));
		if(!$arg_peso == '' || !$arg_dollar == '' || !$arg_bcv == ''){
		echo $this->updata_setting_monitor_dollar($arg_peso,$arg_dollar,$arg_bcv);
		}else {
			echo false;
		}
		die();
	}
	public function db_monitor_dollar() {
        global $wpdb;
        $ptbd_table_name = $wpdb->prefix . $this->tableName;
        if ($wpdb->get_var("SHOW TABLES LIKE '". $ptbd_table_name ."'"  ) != $ptbd_table_name ) {
            $sql  = 'CREATE TABLE '.$ptbd_table_name.' (
            id int(9) NOT NULL AUTO_INCREMENT,
            dollar  varchar(55) NOT NULL,
            peso varchar(55) NOT NULL,
            bcv varchar(55) NOT NULL,
            dateinfo varchar(100) NOT NULL,
            username varchar(200) NOT NULL,
            PRIMARY KEY(id))';
            if(!function_exists('dbDelta')) {
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            }
            dbDelta($sql);
            update_option('tables_created', true);
        }
        $ptbd_table_name = $wpdb->prefix . $this->tableName. "_registry";
        if ($wpdb->get_var("SHOW TABLES LIKE '". $ptbd_table_name ."'"  ) != $ptbd_table_name ) {
            $sql  = 'CREATE TABLE '.$ptbd_table_name.' (
            id int(9) NOT NULL AUTO_INCREMENT,
            dollar  varchar(55) NOT NULL,
            peso varchar(55) NOT NULL,
            bcv varchar(55) NOT NULL,
            dateinfo varchar(100) NOT NULL,
            username varchar(200) NOT NULL,
            PRIMARY KEY(id))';
            if(!function_exists('dbDelta')) {
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            }
            dbDelta($sql);
            update_option('tables_created', true);
        }
         $ptbd_table_name = $wpdb->prefix . $this->tableName. "_setting";
        if ($wpdb->get_var("SHOW TABLES LIKE '". $ptbd_table_name ."'"  ) != $ptbd_table_name ) {
            $sql  = 'CREATE TABLE '.$ptbd_table_name.' (
            id int(9) NOT NULL AUTO_INCREMENT,
            setting varchar(255) NOT NULL,
            arg_one varchar(255) NOT NULL,
            arg_two varchar(255) NOT NULL,
            arg_three varchar(255) NOT NULL,
            PRIMARY KEY(id))';
            if(!function_exists('dbDelta')) {
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            }
            dbDelta($sql);
            update_option('tables_created', true);
            $this->insert_setting__default_monitor_dollar();
		}
		$ptbd_table_name = $wpdb->prefix . $this->tableName. "_usuarios";

		if ($wpdb->get_var("SHOW TABLES LIKE '". $ptbd_table_name ."'"  ) != $ptbd_table_name ) {
            $sql  = 'CREATE TABLE '.$ptbd_table_name.' (
            id int(9) NOT NULL AUTO_INCREMENT,
            usuario varchar(255) NOT NULL,
            email varchar(255) NOT NULL,
            fecha varchar(255) NOT NULL,
            apiToken text NOT NULL,
            PRIMARY KEY(id))';
            if(!function_exists('dbDelta')) {
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            }
            dbDelta($sql);
            update_option('tables_created', true);
            $this->insert_setting__default_monitor_dollar();
		}
		
        $img_monitor_dollar = dirname(__FILE__)."/../../uploads/monitordollar_img";

				if(!file_exists($img_monitor_dollar)) {
  				  mkdir($img_monitor_dollar, 0777, true);
  				  $destiono = dirname(__FILE__)."/../../uploads/monitordollar_img/";
  				  $origen = dirname(__FILE__)."/include/img/bandera-colombia.jpg";
  				  $origen_two = dirname(__FILE__)."/include/img/bandera-usa.jpg";
  				  $origen_theree = dirname(__FILE__)."/include/img/bcv.gif";
				  if(copy($origen, $destiono."bandera-colombia.jpg")){}
				  if(copy($origen_two, $destiono."bandera-usa.jpg")){}
				  if(copy($origen_theree, $destiono."bcv.gif")){}
			}
// file_put_contents( __DIR__ . '/myg_loggg.txt', ob_get_contents() );
}
public function custom_shortcode_monitor(){
	$this->dbReturn();
	
	if(content_url()){
		$colombia = content_url('uploads/monitordollar_img/bandera-colombia.jpg');
		$usa =  content_url('uploads/monitordollar_img/bandera-usa.jpg');
		$bcv =  content_url('uploads/monitordollar_img/bcv.gif');
	}
	
	$arriba = 'dashicons-arrow-up-alt2';
	$abajo = 'dashicons-arrow-down-alt2';
	$igual = 'dashicons-controls-pause';
    $value = $this->returnRegistryShortcode();
    $config = $this->returnConfig(1);
	$bcvCalucular = $value[0]->bcv;
	$pesoCalucular = $value[0]->peso;
	$dollarCalcular = $value[0]->dollar;
	$bcvCalucularAnterior = $value[1]->bcv;
	$pesoCalucularAnterior = $value[1]->peso;
	$dollarCalcularAnterior = $value[1]->dollar;
	if($config[0]->arg_one == 1){
		$none_one = "display:flex";
	}else {
		$none_one = "display:none";
	}
	if($config[0]->arg_two == 1){
		$none_two = "display:flex";
	}else {
		$none_two = "display:none";
	}
	if($config[0]->arg_three == 1){
		$none_three = "display:flex";
	}else {
		$none_three = "display:none";
	}
	if($config[0]->arg_one != 1 && $config[0]->arg_two != 1 && $config[0]->arg_three != 1){
		$none_monitor_dollar = "display:none";
	}else {
		$none_monitor_dollar = "display:flex";

	}
	if ($bcvCalucular > $bcvCalucularAnterior) {
	$iconBCV = $arriba;
	$styleBCV = "color: #0daf38 !important;font-size:23px;margin-right: 23px;margin-left: 3px;";
}else if($bcvCalucular == $bcvCalucularAnterior) {
	$iconBCV = $igual;
	$styleBCV = "color: #ffd71e !important;font-size: 23px;margin-left: 3px;margin-right: 23px;transform: rotate(90deg);";
}else {
	$iconBCV = $abajo;
	$styleBCV = "color: #be0a16 !important;font-size: 23px;margin-right: 23px;margin-left: 3px;";
}
if ($pesoCalucular > $pesoCalucularAnterior) {
	$iconPeso = $arriba;
	$stylePeso = "color: #0daf38 !important;font-size:23px;margin-right: 23px;margin-left: 3px;";
}else if($pesoCalucular == $pesoCalucularAnterior) {
	$iconPeso = $igual;
	$stylePeso = "color: #ffd71e !important;font-size: 23px;margin-left: 3px;margin-right: 23px;transform: rotate(90deg);";
}else {
	$iconPeso = $abajo;
		$stylePeso = "color: #be0a16 !important;font-size: 23px;margin-right: 23px;margin-left: 3px;";
}
if ($dollarCalcular > $dollarCalcularAnterior) {
	$iconDollar = $arriba;
	$styleDollar = "color: #0daf38 !important;font-size:23px;margin-right: 23px;margin-left: 3px;";
}else if($dollarCalcular == $dollarCalcularAnterior) {
	$iconDollar = $igual;
	$styleDollar = "color: #ffd71e !important;font-size: 23px;margin-left: 3px;margin-right: 23px;transform: rotate(90deg);";
}else {
	$iconDollar = $abajo;
		$styleDollar = "color: #be0a16 !important;font-size: 23px;margin-right: 23px;margin-left: 3px;";
}


	$resultado = "<div style='".$none_monitor_dollar.";justify-content: center;align-items: center;font-weight: bold;font-size:15px'><span style='margin-right: 10px;' class='admin-cool-cn-letf'>Cambio del día:</span><div style='".$none_one.";align-items:center;'><img style='width: 30px;height: 20px;margin-right: 3px;' src='".$colombia."' alt='' style='width: 30px;height: 20px;'> BS a Pesos ".esc_html($this->returnPeso())."<span class='dashicons ".$iconPeso."' style='".$stylePeso."'></span></div><div style='".$none_two.";align-items:center;'><img src='".$usa."' style='width: 30px;height: 20px;margin-right: 3px;' alt=''>BS a $ ".esc_html($this->returnDollar())." <span class='dashicons ".$iconDollar."' style='".$styleDollar."'></span></div><div style='".$none_three.";align-items: center;'><img src='".$bcv."' style='width: 30px;height: 30px;margin-right: 3px;' alt=''>$ BCV a BsS. ".esc_html($this->returnBcv())." <span class='dashicons ".$iconBCV."' style='".$styleBCV."'></span></div><span class='fecha-monitordollar' style='font-weight: normal;'>Act: ".esc_html($this->returnDate())."</span></div>";
	return $resultado;
}
}

$init = new WpMonitorDollarInitClass();

}
	
}
