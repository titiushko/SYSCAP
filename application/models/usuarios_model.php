<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Modelo para obtener de la base de datos de SYSCAP la información de la tabla usuarios
*/
class Usuarios_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	/**
	* Método que devuelve el listado de usuarios
	* Método utilizado por el controlador: Usuarios
	*/
	function usuarios(){
		$query = $this->db->select('id_usuario, nombre_usuario, F_NombreCompletoUsuario(id_usuario) nombre_completo_usuario, dui_usuario, correo_electronico_usuario, F_NombreCentroEducativo(id_centro_educativo) nombre_centro_educativo')
						  ->get('usuarios');
		return $query->result();
	}
	
	/**
	* Método que devuelve la información de un usuario
	* Método utilizado por el controlador: Usuarios
	*/
	function usuario($codigo_usuario){
		$query = $this->db->select('id_usuario, nombre_usuario, contrasena_usuario, id_tipo_usuario, nombres_usuario, apellido1_usuario, dui_usuario, id_profesion, correo_electronico_usuario, id_centro_educativo, id_departamento, id_municipio, direccion_usuario, initcap(modalidad_usuario) modalidad_usuario')
						  ->get_where('usuarios', array('id_usuario' => $codigo_usuario));
		return $query->result();
	}
	
	/**
	* Método que devuelve el nombre completo de un usuario
	* Método utilizado por el controlador: Usuarios
	*/
	function nombre_completo_usuario($codigo_usuario){
		$query = $this->db->query('SELECT F_NombreCompletoUsuario(?) nombre_completo_usuario', array($codigo_usuario));
		if($query->row())
			return $query->result()[0]->nombre_completo_usuario;
		else
			return '';
	}
	
	/**
	* Método que realiza update a la tabla usuarios para actualizar la información de un usuario
	* Método utilizado por el controlador: Usuarios
	*/
	function modificar($datos_usuario, $codigo_usuario){
		$this->db->update('usuarios', $datos_usuario, array('id_usuario' => $codigo_usuario));
	}
	
	/**
	* Método que devuelve el listado de calificaciones de un usuario
	* Método utilizado por el controlador: Usuarios
	*/
	function calificaciones_usuario($codigo_usuario){
		$query = $this->db->select('c_nombre_completo_curso nombre, ec_nota_examen_calificacion nota')
						  ->get_where('V_UsuariosCursosExamenesCalificaciones', array('ec_id_usuario' => $codigo_usuario));
		return $query->result();
	}
	
	/**
	* Método que devuelve el listado de certificaciones un usuario
	* Método utilizado por el controlador: Usuarios
	*/
	function certificaciones_usuario($codigo_usuario){
		$query = $this->db->distinct(TRUE)
						  ->select('c_nombre_completo_curso nombre')
						  ->like('e_nombre_examen', 'Examen', 'after')
						  ->like('u_modalidad_usuario', 'tutorizado', 'none')
						  ->order_by('c_nombre_completo_curso', 'asc')
						  ->get_where('V_UsuariosCursosExamenesCalificaciones', array('ec_nota_examen_calificacion >=' => '7.00', 'u_id_usuario' => $codigo_usuario));
		return $query->result();
	}
	
	/**
	* Método que valida que el código de un usuario exista
	* Método utilizado por el controlador: Usuarios
	*/
	function validar_codigo_usuario($codigo_usuario){
		$query = $this->db->get_where('usuarios', array('id_usuario' => $codigo_usuario));
		return $query->result();
	}
	
	/**
	* Método para validar que no se repita un nombre de usuario
	* Método utilizado por el controlador: Usuarios
	*/
	function validar_nombre_usuario($nombre_usuario, $codigo_usuario){
		$query = $this->db->where_not_in('id_usuario', $codigo_usuario);
		$query = $this->db->get_where('usuarios', array('nombre_usuario' => $nombre_usuario));
		return $query->result();
	}
	
	/**
	* Método para validar si se ha cambiado la contraseña de un usuario
	* Método utilizado por el controlador: Usuarios
	*/
	function validar_contrasena_usuario($contrasena_usuario, $codigo_usuario){
		$query = $this->db->get_where('usuarios', array('contrasena_usuario' => $contrasena_usuario, 'id_usuario' => $codigo_usuario));
		return $query->result();
	}
}

/* End of file usuarios_model.php */
/* Location: ./application/models/usuarios_model.php */