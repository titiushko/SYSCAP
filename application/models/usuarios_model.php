<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function usuarios(){
		$query = $this->db->select('id_usuario, nombre_usuario, nombres_usuario, apellido1_usuario, dui_usuario, correo_electronico_usuario');
		$query = $this->db->where('id_usuario in(1156, 1381, 812, 1893, 1809, 1811, 1806, 827, 1188, 661, 832, 1808, 665, 1304, 645, 816, 1141, 368, 369, 410, 841, 1417, 388, 1467, 1844, 1604, 907, 60, 1228, 1781, 397, 1672, 850, 1220, 1206, 1690, 1783, 1788, 1731, 1597, 1736, 1723, 1691, 1435, 1372, 1522, 1805, 1678, 182, 412)');
		$query = $this->db->get('usuarios');
		return $query->result();
	}
	
	function usuario($codigo_usuario){
		$query = $this->db->select('id_usuario, nombre_usuario, contrasena_usuario, id_tipo_usuario, nombres_usuario, apellido1_usuario, dui_usuario, id_profesion, correo_electronico_usuario, id_centro_educativo, id_departamento, id_municipio, direccion_usuario, initcap(modalidad_usuario) modalidad_usuario');
		$query = $this->db->where('id_usuario', $codigo_usuario);
		$query = $this->db->get('usuarios');
		return $query->result();
	}
	
	function nombre_completo_usuario($codigo_usuario){
		$nombre_completo_usuario = '';
		$query = $this->db->query('SELECT F_NombreCompletoUsuario(?) AS nombre_completo_usuario', array($codigo_usuario));
		foreach($query->result() as $usuario){
			$nombre_completo_usuario = $usuario->nombre_completo_usuario;
		}
		return $nombre_completo_usuario;
	}
	
	function modificar($datos_usuario, $codigo_usuario){
		$this->db->where('id_usuario', $codigo_usuario);
		$this->db->update('usuarios', $datos_usuario);
	}
	
	/**
	* Método que utiliza la vista MySQL V_UsuariosCursosExamenesCalificaciones de la base de datos de SYSCAP y devuelve el listado de usuarios capacitados o certificados.
	* @param codigo_centro_educativo: id_centro_educativo.
	* @param nota_minima: para buscar usuarios certificados nota_minima debe ser 7, de lo contrario será 0.
	* @param tipo_capacitado: para buscar usuarios certificados tipo_capacitado de ser '%certificacion%', de lo contrario será '%'.
	* @param tipo_usuario: array con los tipos de usuarios a buscar.
	* valores:
	* 		'ciudadano',
	* 		'estudiantes',
	* 		'docentes'
	* ejemplos:
	* 		array('ciudadano'),
	* 		array('ciudadano', 'estudiantes'),
	* 		array('ciudadano', 'estudiantes', 'docentes'),
	* 		array('ciudadano', 'docentes'),
	* 		array('estudiantes', 'docentes')
	* @param tipo_modalidad: para buscar usuarios en la modalidad de tutorizado o autoformacion.
	* valores:
	* 		'tutorizado',
	* 		'autoformacion',
	* 		'%': busca por los dos tipos de modalidad.
	* @return array de objetos con el listado de usuarios capacitados o certificados.
	*/
	function tipos_capacitados_usuarios($codigo_centro_educativo, $nota_minima, $tipo_capacitado, $tipo_usuario, $tipo_modalidad){
		$tipos_usuarios = '';
		for($i = 0; $i < count($tipo_usuario); $i++){
			if($tipo_usuario[$i] == 'ciudadano'){
				$tipos_usuarios = 'AND u_id_tipo_usuario = 1'.' '.$tipos_usuarios;
			}
			if($tipo_usuario[$i] == 'estudiantes'){
				$tipos_usuarios = 'AND u_id_tipo_usuario BETWEEN 2 AND 4'.' '.$tipos_usuarios;
			}
			if($tipo_usuario[$i] == 'docentes'){
				$tipos_usuarios = 'AND u_id_tipo_usuario BETWEEN 5 AND 8'.' '.$tipos_usuarios;
			}
		}
		$sql = 'SELECT CONCAT(IF(u_nombres_usuario IS NOT NULL, u_nombres_usuario, \'\'), \' \',
				IF(u_apellido1_usuario IS NOT NULL, u_apellido1_usuario, \'\'), \' \',
				IF(u_apellido2_usuario IS NOT NULL, u_apellido2_usuario, \'\')) nombre_completo_usuario
				FROM V_UsuariosCursosExamenesCalificaciones
				WHERE u_id_centro_educativo = ?
				AND ec_nota_examen_calificacion >= ?
				AND e_nombre_examen LIKE ?
				'.$tipos_usuarios.'
				AND u_modalidad_usuario LIKE ?
				ORDER BY c_nombre_completo_curso';
		$query = $this->db->query($sql, array($codigo_centro_educativo, $nota_minima, $tipo_capacitado, $tipo_modalidad));
		return $query->result();
	}
	
	/**
	 * Método que utiliza la vista MySQL V_UsuariosCursosExamenesCalificaciones de la base de datos de SYSCAP y devuelve el listado de cursos recibidos y calificaciones obtenidas un usuario.
	 * @param codigo_usuario: id_usuario.
	 * @return array de objetos con el listado de cursos recibidos y calificaciones obtenidas un usuario.
	 */
	function calificaciones_usuario($codigo_usuario){
		$sql = 'SELECT c_nombre_completo_curso nombre, ROUND(ec_nota_examen_calificacion, 2) nota
				FROM V_UsuariosCursosExamenesCalificaciones
				WHERE ec_id_usuario = ?';
		$query = $this->db->query($sql, array($codigo_usuario));
		return $query->result();
	}
	
	/**
	 * Método que utiliza la vista MySQL V_UsuariosCursosExamenesCalificaciones de la base de datos de SYSCAP y devuelve el listado de certificaciones obtenidas un usuario.
	 * @param codigo_usuario: id_usuario.
	 * @return array de objetos con el listado de certificaciones obtenidas un usuario.
	 */
	function certificaciones_usuario($codigo_usuario){
		$sql = 'SELECT SUBSTRING(c.nombre_completo_curso, LENGTH(\'Examen de Certificación\')+2) nombre
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