<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function usuarios(){
		$query = $this->db->select('id_usuario, nombre_usuario, acentos(nombres_usuario) nombres_usuario, acentos(apellido1_usuario) apellido1_usuario, dui_usuario, correo_electronico_usuario');
		$query = $this->db->where('id_usuario in(1156, 1381, 812, 1893, 1809, 1811, 1806, 827, 1188, 661, 832, 1808, 665, 1304, 645, 816, 1141, 368, 369, 410, 841, 1417, 388, 1467, 1844, 1604, 907, 60, 1228, 1781, 397, 1672, 850, 1220, 1206, 1690, 1783, 1788, 1731, 1597, 1736, 1723, 1691, 1435, 1372, 1522, 1805, 1678, 182, 412)');
		$query = $this->db->get('usuarios');
		return $query->result();
	}
	
	function usuario($codigo_usuario){
		$query = $this->db->select('id_usuario, nombre_usuario, contrasena_usuario, id_tipo_usuario, acentos(nombres_usuario) nombres_usuario, acentos(apellido1_usuario) apellido1_usuario, dui_usuario, id_profesion, correo_electronico_usuario, id_centro_educativo, id_departamento, id_municipio, acentos(direccion_usuario) direccion_usuario, initcap(modalidad_usuario) modalidad_usuario');
		$query = $this->db->where('id_usuario', $codigo_usuario);
		$query = $this->db->get('usuarios');
		return $query->result();
	}
	
	function nombre_completo_usuario($codigo_usuario){
		$query = $this->db->query('SELECT acentos(F_NombreCompletoUsuario(?)) nombre_completo_usuario', array($codigo_usuario));
		return $query->result()[0]->nombre_completo_usuario;
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
		$sql = 'SELECT acentos(c_nombre_completo_curso) nombre, ROUND(ec_nota_examen_calificacion, 2) nota
				FROM V_UsuariosCursosExamenesCalificaciones
				WHERE ec_id_usuario = ?';
		$query = $this->db->query($sql, array($codigo_usuario));
		return $query->result();
	}
	
	/**
	 * Método que utiliza la vista MySQL V_UsuariosCursosExamenesCalificaciones de la base de datos de SYSCAP y devuelve el listado de certificaciones obtenidas un usuario.
	 * @param codigo_usuario: id_usuario.
	 * @return array de objetos con el listado de certificaciones obtenidas de un usuario.
	 */
	function certificaciones_usuario($codigo_usuario){
		$sql = 'SELECT acentos(SUBSTRING(c.nombre_completo_curso, LENGTH(\'Examen de Certificación\') + 2)) nombre
				FROM matriculas m LEFT JOIN roles_asignados ra ON(m.id_matricula = ra.id_matricula)
				LEFT JOIN cursos c ON(m.id_curso = c.id_curso)
				WHERE ra.id_usuario = ?
				AND c.nombre_completo_curso LIKE \'Examen%\'';
		$query = $this->db->query($sql, array($codigo_usuario));
		return $query->result();
	}
}

/* End of file usuarios_model.php */
/* Location: ./application/models/usuarios_model.php */