<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sesion_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function conectar_usuario($nombre_usuario, $contrasena_usuario){
		if($this->session->userdata('dispositivo_movil')){
			$query = $this->db->select('u.id_usuario, F_NombreCompactoUsuario(u.id_usuario) nombre_completo_usuario, r.nombre_completo_rol, r.nombre_corto_rol');
		}
		else{
			$query = $this->db->select('u.id_usuario, F_NombreCompletoUsuario(u.id_usuario) nombre_completo_usuario, r.nombre_completo_rol, r.nombre_corto_rol');
		}
		$query = $this->db->join('roles_asignados ra', 'u.id_usuario = ra.id_usuario', 'left');
		$query = $this->db->join('roles r', 'ra.id_rol = r.id_rol', 'left');
		$query = $this->db->where('u.nombre_usuario', $nombre_usuario);
		$query = $this->db->where('u.contrasena_usuario', $contrasena_usuario);
		$query = $this->db->get('usuarios u');
		if($query->num_rows() != 0){
			return $query->row();
		}
		else{
			$this->session->set_flashdata('usuario_incorrecto', icono_notificacion('error').'Los datos introducidos son incorrectos.');
			redirect('sesion', 'refresh');
		}
	}
}

/* End of file sesion_model.php */
/* Location: ./application/models/sesion_model.php */