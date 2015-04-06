<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Instalador_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function probar_conexion($servidor, $base_datos, $usuario, $contrasena){
		$conexion = array(
			'hostname' => $servidor,
			'database' => $base_datos,
			'username' => $usuario,
			'password' => $contrasena,
			'dbdriver' => 'mysql',
			'dbprefix' => '',
			'pconnect' => TRUE,
			'db_debug' => TRUE,
			'cache_on' => FALSE,
			'cachedir' => '',
			'char_set' => 'utf8',
			'dbcollat' => 'utf8_general_ci'
		);
		$this->load->database($conexion);
		$this->load->dbutil();
		return !$this->dbutil->database_exists($base_datos);
	}
}

/* End of file instalador_model.php */
/* Location: ./application/models/instalador_model.php */