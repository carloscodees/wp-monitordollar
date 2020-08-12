<?php

use Firebase\JWT\ExpiredException;
use \Firebase\JWT\JWT;

Class WpMonitorDollarConsultasModels {
	public $version = '0.0.1';
	public $author = 'SeoContenidos';
	public $slug = 'monitor-dollar';
	public $idPanel = 'idMonitor';
	public $idsubPanel = 'submenu';
	public $tableName = 'monitordollar';
	public $dollar = '';
	public $peso = '';
	public $bcv = '';
	public $date = '';
	public $username = '';
	public function returnDollar(){return $this->dollar;}
	public function returnPeso(){return $this->peso;}
	public function returnBcv(){return $this->bcv;}
	public function returnDate(){return $this->date;}
	public function returnUsername(){return $this->username;}
	public function returnSearch($arg_search){
		global $wpdb;
			$nameTable = $wpdb->prefix . $this->tableName . "_registry";
	$search_text = "%" . $arg_search . "%";		

		$results = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT * FROM $nameTable WHERE username LIKE %s ORDER BY id DESC", $search_text
			)
		);

		return json_encode($results);
	}

	public function returnRegistry(){
		global $wpdb;

		 $nameTable = $wpdb->prefix . $this->tableName ."_registry";
		 $results = $wpdb->get_results( "SELECT * FROM  $nameTable ORDER BY id DESC", OBJECT );
		 return json_encode($results);
	}

	public function dbReturn(){
		global $wpdb;
		$nameTable = $wpdb->prefix . $this->tableName;
		$results = $wpdb->get_results( "SELECT * FROM $nameTable", OBJECT );
  			$this->dollar = $results[0]->dollar;
  			$this->peso = $results[0]->peso;
  			$this->bcv = $results[0]->bcv;
  			$this->date = $results[0]->dateinfo;
  			$this->username = $results[0]->username;
	}

	public function update($arg_peso,$arg_dollar,$arg_bcv, $admin = ''){

		global $wpdb;
		if($admin == ''){
			$cu = wp_get_current_user();
			$username = $cu->user_login;
		}else {
			$username = $admin;
		}


		$dateinfo = date_i18n( __( 'm/d/y \a \l\a\s g:ia', 'monitor-dollar-text' ) );
		$nameTable = $wpdb->prefix . $this->tableName;

		 $wpdb->update( $nameTable, 

    // Datos que se remplazarán

    array( 

      'dollar' => $arg_dollar,

      'peso' => $arg_peso,

      'bcv' => $arg_bcv,

      'dateinfo' => $dateinfo,

      'username' => $username

    ),

    // Cuando el ID del campo es igual al número 1

    array( 'ID' => 1 )

	  	);
}
	
	public function insert($arg_peso, $arg_dollar, $arg_bcv, $admin = ''){
		global $wpdb;
		if($admin == ''){
			$cu = wp_get_current_user();
			$username = $cu->user_login;
		}else {
			$username = $admin;
		}
		
		
		

		$dateinfo = date_i18n( __( 'm/d/y \a \l\a\s g:ia', 'monitor-dollar-text' ) );

	
	 $nameTable = $wpdb->prefix . $this->tableName . "_registry";
	
	$results = $wpdb->insert($nameTable,

			array(
			'dollar' => $arg_dollar,

			'peso' => $arg_peso,

			'bcv' => $arg_bcv,

			'dateinfo' => $dateinfo,

			'username' => $username

			)

		);
	if ($results == 1) {
		$data = array(
				'dollar' => $arg_dollar,
				'peso' => $arg_peso,
				'bcv' => $arg_bcv,
				'dateinfo' => $dateinfo,
				'username' => $username 

			);

		return json_encode($data);
	}
}
	public function returnRegistryShortcode(){
		global $wpdb;
	 $nameTable = $wpdb->prefix . $this->tableName . "_registry";
		$results = $wpdb->get_results( "SELECT * FROM  $nameTable ORDER BY id desc LIMIT 2", OBJECT );

		return $results;
	}


	public function returnConfig($arg_config){
		global $wpdb;
	 	$nameTable = $wpdb->prefix . $this->tableName . "_setting";
		$results = $wpdb->get_results( "SELECT * FROM $nameTable WHERE id=$arg_config", OBJECT );

		return $results;
	}

	public function updata_setting_monitor_dollar($arg_peso,$arg_dollar,$arg_bcv){
		global $wpdb;
	 	$nameTable = $wpdb->prefix . $this->tableName . "_setting";

	 $results = $wpdb->update($nameTable,

			array(
			'setting' => 'config-1',

			'arg_one' => $arg_peso,

			'arg_two' => $arg_dollar,

			'arg_three' => $arg_bcv,


			),
			array( 'ID' => 1 )

		);
	 return true;
	}

	public function insert_setting__default_monitor_dollar(){
		global $wpdb;
	 	$nameTable = $wpdb->prefix . $this->tableName . "_setting";
	 	$nameTable_monitor = $wpdb->prefix . $this->tableName;


	 $results = $wpdb->insert($nameTable,

			array(
			'setting' => 'config-1',

			'arg_one' => 1,

			'arg_two' => 1,

			'arg_three' => 1,


			)
			

		);
	  $results = $wpdb->insert($nameTable_monitor,

			array(
			'dollar' => '0',

			'peso' => '0',

			'bcv' => '0',

			'dateinfo' => '0',

			'username' => 'monitordollar'


			)
			

		);
	
	}
	public function returnDataUser_prueba(){
		global $wpdb;

		 $nameTable = $wpdb->prefix . $this->tableName ."_usuarios";
		 $results = $wpdb->get_results( "SELECT * FROM  $nameTable ORDER BY id DESC", OBJECT );
		 return json_encode($results);
	}
	public function crateUserApiToken($email, $password){
		global $wpdb;
		$cu = wp_get_current_user();
		$username = $cu->user_login;
	
		$nameTable = $wpdb->prefix . $this->tableName ."_usuarios";
		$newpasswordmd5 = md5($password);

		$apiToken = $newpasswordmd5 . $wpdb->prefix;
		$results = $wpdb->insert($nameTable,
		
		array(
		'usuario' => $username,

		'email' => $email,

		'password' => $newpasswordmd5,

		'apiToken' => $apiToken

		)
	);
	}
	public function show_Table_models(){
		global $wpdb;

		 $nameTable = $wpdb->prefix . $this->tableName ."_usuarios";
		 $results = $wpdb->get_results( "SELECT * FROM  $nameTable ORDER BY id DESC", OBJECT );
		 return json_encode($results);
	}
	public function deleteusermonitor($id){
		global $wpdb;
		$nameTable = $wpdb->prefix . $this->tableName ."_usuarios";
		
		$results = $wpdb->delete( $nameTable, array( 'id' => $id ) );
		return json_encode($results);
	}
	public function loginapimonitor($username, $password){
		
		$auth = wp_authenticate($username, $password);

		return $auth;
	}
	public function generarToke($user){
		$key = WP_MONITOR_DOLLAR_KEY;
		$time = time();
		$payload = array(
			"exp" => $time + 3600,
			"data" => array( 
				"email" => $user->data->email,
				"id" => $user->data->ID,
				"user_nicename" => $user->data->user_nicename
				)
		);
		// return $user;
		$jwt = JWT::encode($payload, $key);
		return $jwt;
	}
	public function validatetoken($token){
		JWT::$leeway = 3600;
		$timestamp = time();
	
	
	
		try {
			 $decoded = JWT::decode($token, WP_MONITOR_DOLLAR_KEY, array('HS256'));
			
			 return array(
				'success'    => false,
				'statusCode' => 200,
				'code'       => 1,
				'message'    => __( 'token valido' , 'wp_montor_dollar' ),
				'data'       => $decoded
				
			);
		} catch (Exception $e) {
			return  array(
				'success'    => false,
				'statusCode' => 404,
				'code'       => 0,
				'message'    => __( $e->getMessage() , 'wp_montor_dollar' ),
				'data'       => null
				
			);
		}
		
	}
	public function api_rest_montor_inster($arg_peso, $arg_dollar, $arg_bcv, $token){
		
		$validate = $this->validatetoken($token);
		
		if($validate['code'] == 0){
			return $validate;
		}
		if($validate['code'] == 1){
			$admin = $validate['data']->data->user_nicename;
			
			$insert = $this->insert($arg_peso, $arg_dollar, $arg_bcv, $admin);
			$update = $this->update($arg_peso, $arg_dollar, $arg_bcv, $admin);
			return array(
				'success'    => true,
				'statusCode' => 200,
				'code'       => 1,
				'message'    => __( 'Cambiado con exito!' , 'wp_montor_dollar' ),
				'data'       => null
				
			);
		}
	}
	public function api_rest_monitor_returnTable($token){
		$validate = $this->validatetoken($token);
		
		if($validate['code'] == 0){
			return $validate;
		}
		if($validate['code'] == 1){
			return $this->returnRegistryShortcode();
		}
	}
	public function api_rest_monitor_setting($pesoCheck, $dollarCheck, $bcvCheck, $token){
		$validate = $this->validatetoken($token);

		if($validate['code'] == 0){
			return $validate;
		}
		if($validate['code'] == 1){
			return $this->updata_setting_monitor_dollar($pesoCheck, $dollarCheck, $bcvCheck);
		}

	}

}