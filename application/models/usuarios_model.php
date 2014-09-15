<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	function usuarios(){
		$query = $this->db->get('mdl_user', 10, 81);
		return $query->result();
	}
	
	function usuario($codigo_usuario){
		$query = $this->db->where('id', $codigo_usuario);
		$query = $this->db->get('mdl_user');
		return $query->result();
	}
	
	function agregar($insert_usuario){
		$this->db->insert('mdl_user', $insert_usuario);
		return $this->db->insert_id();
	}
	
	function eliminar($codigo_usuario){
		$this->db->where('id', $codigo_usuario);
		$this->db->delete('mdl_user');
	}
	
	function modificar($data, $codigo_usuario){
		$this->db->where('id', $codigo_usuario);
		$this->db->update('mdl_user', $data);
	}
}

/* End of file usuarios_model.php */
/* Location: ./application/models/usuarios_model.php */