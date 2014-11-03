<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Tipos_usuarios_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	function lista_tipos_usuarios(){
		$lista_tipos_usuarios[''] = '';
		$this->db->select('id_tipo_usuario, nombre_tipo_usuario');
		$query = $this->db->get('tipos_usuarios');
		foreach($query->result() as $tipo_usuario){
			$lista_tipos_usuarios[$tipo_usuario->id_tipo_usuario] = $tipo_usuario->nombre_tipo_usuario;
		}
		return $lista_tipos_usuarios;
	}
}

/* End of file tipos_usuarios_model.php */
/* Location: ./application/models/tipos_usuarios_model.php */