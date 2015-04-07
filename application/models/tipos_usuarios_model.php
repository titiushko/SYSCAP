<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Tipos_usuarios_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	function lista_tipos_usuarios(){
		$lista_tipos_usuarios[''] = '';
		$query = $this->db->select('id_tipo_usuario, nombre_tipo_usuario nombre_tipo_usuario');
		$query = $this->db->order_by('nombre_tipo_usuario', 'asc');
		$query = $this->db->get('tipos_usuarios');
		foreach($query->result() as $tipo_usuario){
			$lista_tipos_usuarios[$tipo_usuario->id_tipo_usuario] = utf8($tipo_usuario->nombre_tipo_usuario);
		}
		return $lista_tipos_usuarios;
	}
	
	function nombre_tipo_usuario($codigo_tipo_usuario){
		if($codigo_tipo_usuario != 0){
			$query = $this->db->select('nombre_tipo_usuario nombre_tipo_usuario');
			$query = $this->db->where('id_tipo_usuario', $codigo_tipo_usuario);
			$query = $this->db->get('tipos_usuarios');
			if($query->row())
				return $query->result()[0]->nombre_tipo_usuario;
			else
				return '';
		}
	}
}

/* End of file tipos_usuarios_model.php */
/* Location: ./application/models/tipos_usuarios_model.php */