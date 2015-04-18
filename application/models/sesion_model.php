<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Modelo para obtener de la base de datos de SYSCAP la información de sesión de un usuario
*/
class Sesion_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	/**
	* Método que búsca que un usuario esté registrado en SYSCAP
	* Si el método encuentra el usuario, entonces devuelve la siguiente información del usuario
	* - código
	* - nombre completo
	* - disminutivo del tipo de rol
	* - nombre del tipo de rol
	* Si el método no encuentra el usuario, entonces devuelve un mensaje de error
	* Método utilizado por el controlador: Sesion
	*/
	public function conectar_usuario($nombre_usuario, $contrasena_usuario){
		if($this->session->userdata('dispositivo_movil')){
			$query = $this->db->select('u.id_usuario, F_NombreCompactoUsuario(u.id_usuario) nombre_completo_usuario, r.nombre_completo_rol, r.nombre_corto_rol');
		}
		else{
			$query = $this->db->select('u.id_usuario, F_NombreCompletoUsuario(u.id_usuario) nombre_completo_usuario, r.nombre_completo_rol, r.nombre_corto_rol');
		}
		$query = $this->db->join('roles_asignados ra', 'u.id_usuario = ra.id_usuario', 'left');
		$query = $this->db->join('roles r', 'ra.id_rol = r.id_rol', 'left');
		$query = $this->db->get_where('usuarios u', array('u.nombre_usuario' => $nombre_usuario, 'u.contrasena_usuario' => $contrasena_usuario));
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