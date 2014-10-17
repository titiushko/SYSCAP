<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	function usuarios(){
		$query = $this->db->select('id_usuario, nombre_usuario, contrasena_usuario, id_tipo_usuario, nombres_usuario, apellido1_usuario, dui_usuario, id_profesion, correo_electronico_usuario, id_centro_educativo, id_departamento, id_municipio, direccion_usuario');
		$query = $this->db->get('usuarios');
		return $query->result();
	}
	
	function usuario($codigo_usuario){
		$query = $this->db->select('id_usuario, nombre_usuario, contrasena_usuario, id_tipo_usuario, nombres_usuario, apellido1_usuario, dui_usuario, id_profesion, correo_electronico_usuario, id_centro_educativo, id_departamento, id_municipio, direccion_usuario');
		$query = $this->db->where('id_usuario', $codigo_usuario);
		$query = $this->db->get('usuarios');
		return $query->result();
	}
	
	function nombre_completo_usuario($codigo_usuario){
		$query = $this->db->query('SELECT F_NombreCompletoUsuario(?) AS nombre_completo_usuario', array($codigo_usuario));
		foreach($query->result() as $usuario){
			$nombre_completo_usuario = $usuario->nombre_completo_usuario;
		}
		return $nombre_completo_usuario;
	}
	
	function modificar($data, $codigo_usuario){
		$this->db->where('id_usuario', $codigo_usuario);
		$this->db->update('usuarios', $data);
	}
}

/* End of file usuarios_model.php */
/* Location: ./application/models/usuarios_model.php */