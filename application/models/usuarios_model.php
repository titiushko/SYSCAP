<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function lista_usuarios(){
		$query = $this->db->select('id_usuario, nombre_usuario, F_NombreCompletoUsuario(id_usuario) nombre_completo_usuario, dui_usuario, correo_electronico_usuario, F_NombreCentroEducativo(id_centro_educativo) nombre_centro_educativo');
		$query = $this->db->get('usuarios');
		return $query->result();
	}
	
	function usuario($codigo_usuario){
		$query = $this->db->select('id_usuario, nombre_usuario, contrasena_usuario, id_tipo_usuario, nombres_usuario nombres_usuario, apellido1_usuario apellido1_usuario, dui_usuario, id_profesion, correo_electronico_usuario, id_centro_educativo, id_departamento, id_municipio, direccion_usuario direccion_usuario, initcap(modalidad_usuario) modalidad_usuario');
		$query = $this->db->where('id_usuario', $codigo_usuario);
		$query = $this->db->get('usuarios');
		return $query->result();
	}
	
	function nombre_completo_usuario($codigo_usuario){
		$query = $this->db->query('SELECT F_NombreCompletoUsuario(?) nombre_completo_usuario', array($codigo_usuario));
		if($query->row())
			return $query->result()[0]->nombre_completo_usuario;
		else
			return '';
	}
	
	function modificar($datos_usuario, $codigo_usuario){
		$this->db->where('id_usuario', $codigo_usuario);
		$this->db->update('usuarios', $datos_usuario);
	}
	
	/**
	 * Método que utiliza la vista MySQL V_UsuariosCursosExamenesCalificaciones de la base de datos de SYSCAP y devuelve el listado de cursos recibidos y calificaciones obtenidas un usuario.
	 * @param codigo_usuario: id_usuario.
	 * @return array de objetos con el listado de cursos recibidos y calificaciones obtenidas de un usuario.
	 */
	function calificaciones_usuario($codigo_usuario){
		$query = $this->db->query('SELECT c_nombre_completo_curso nombre, ROUND(ec_nota_examen_calificacion, 2) nota
								   FROM V_UsuariosCursosExamenesCalificaciones
								   WHERE ec_id_usuario = ?', array($codigo_usuario));
		return $query->result();
	}
	
	/**
	 * Método que utiliza la vista MySQL V_UsuariosCursosExamenesCalificaciones de la base de datos de SYSCAP y devuelve el listado de certificaciones obtenidas un usuario.
	 * @param codigo_usuario: id_usuario.
	 * @return array de objetos con el listado de certificaciones obtenidas de un usuario.
	 */
	function certificaciones_usuario($codigo_usuario){
		$query = $this->db->query('SELECT DISTINCT (CASE WHEN c_nombre_completo_curso LIKE \'Examen%\' THEN SUBSTRING(c_nombre_completo_curso, LOCATE(\' \', c_nombre_completo_curso, LENGTH(\'Examen\') + 2) + 1) ELSE (CASE WHEN c_nombre_completo_curso LIKE \'Certificaci%\' THEN SUBSTRING(c_nombre_completo_curso, LOCATE(\' \', c_nombre_completo_curso) + 1) ELSE c_nombre_completo_curso END) END) nombre
								   FROM V_UsuariosCursosExamenesCalificaciones
								   WHERE u_id_usuario = ?
								   AND e_nombre_examen LIKE \'Examen%\'
								   AND ec_nota_examen_calificacion >= 7
								   AND u_modalidad_usuario LIKE \'tutorizado\'
								   ORDER BY c_nombre_completo_curso', array($codigo_usuario));
		return $query->result();
	}
	
	function validar_usuario($codigo_usuario){
		$query = $this->db->where('id_usuario', $codigo_usuario);
		$query = $this->db->get('usuarios');
		return $query->result();
	}
}

/* End of file usuarios_model.php */
/* Location: ./application/models/usuarios_model.php */