<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Centros_educativos_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function lista_centros_educativos(){
		$lista_centros_educativos[''] = '';
		$query = $this->db->select('id_centro_educativo, acentos(nombre_centro_educativo) nombre_centro_educativo');
		$query = $this->db->order_by('nombre_centro_educativo', 'asc');
		$query = $this->db->get('centros_educativos', 200, 0);
		foreach($query->result() as $centro_educativo){
			$lista_centros_educativos[$centro_educativo->id_centro_educativo] = utf8($centro_educativo->nombre_centro_educativo);
		}
		return $lista_centros_educativos;
	}
	
	function centros_educativos(){
		$query = $this->db->select('id_centro_educativo, codigo_centro_educativo, acentos(nombre_centro_educativo) nombre_centro_educativo, id_departamento, id_municipio');
		$query = $this->db->get('centros_educativos', 200, 0);
		return $query->result();
	}
	
	function centro_educativo($codigo_centro_educativo){
		$query = $this->db->select('id_centro_educativo, codigo_centro_educativo, acentos(nombre_centro_educativo) nombre_centro_educativo, id_departamento, id_municipio');
		$query = $this->db->where('id_centro_educativo', $codigo_centro_educativo);
		$query = $this->db->get('centros_educativos');
		return $query->result();
	}
	
	function nombre_centro_educativo($codigo_centro_educativo){
		$query = $this->db->query('SELECT acentos(F_NombreCentroEducativo(?)) nombre_centro_educativo', array($codigo_centro_educativo));
		if($query->row())
			return utf8($query->result()[0]->nombre_centro_educativo);
		else
			return '';
	}
	
	function modificar($datos, $codigo_centro_educativo){
		$this->db->where('id_centro_educativo', $codigo_centro_educativo);
		$this->db->update('centros_educativos', $datos);
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
		$nombre_certificacion = '';
		for($i = 0; $i < count($tipo_usuario); $i++){
			if($tipo_usuario[$i] == 'ciudadano'){
				$tipos_usuarios = 'AND u_id_tipo_usuario = 1'.' '.$tipos_usuarios;
			}
			if($tipo_usuario[$i] == 'estudiantes'){
				$tipos_usuarios = 'AND u_id_tipo_usuario BETWEEN 2 AND 4'.' '.$tipos_usuarios;
			}
			if($tipo_usuario[$i] == 'docentes'){
				$tipos_usuarios = 'AND u_id_tipo_usuario BETWEEN 5 AND 8'.' '.$tipos_usuarios;
				if($tipo_capacitado == 'Examen%')
					$nombre_certificacion = ', (CASE WHEN c_nombre_completo_curso LIKE \'Examen%\' THEN SUBSTRING(c_nombre_completo_curso, LOCATE(\' \', c_nombre_completo_curso) + 1) ELSE c_nombre_completo_curso END) certificacion_usuario';
			}
		}
		$query = $this->db->query('SELECT DISTINCT u_id_usuario id_usuario, acentos(F_NombreCompletoUsuario(u_id_usuario)) nombre_completo_usuario
								  '.$nombre_certificacion.'
								  FROM V_UsuariosCursosExamenesCalificaciones
								  WHERE u_id_centro_educativo = ?
								  AND ec_nota_examen_calificacion >= ?
								  AND e_nombre_examen LIKE ?
								  '.$tipos_usuarios.'
								  AND u_modalidad_usuario LIKE ?
								  ORDER BY nombre_completo_usuario', array($codigo_centro_educativo, $nota_minima, $tipo_capacitado, $tipo_modalidad));
		return $query->result();
	}
	
	function validar_centro_educativo($codigo_centro_educativo){
		$query = $this->db->where('id_centro_educativo', $codigo_centro_educativo);
		$query = $this->db->get('centros_educativos');
		return $query->result();
	}
	
	public function buscar_centro_educativo($nombre_centro_educativo){
		$query = $this->db->select('id_centro_educativo, nombre_centro_educativo')->like('LOWER(nombre_centro_educativo)', strtolower($nombre_centro_educativo))->get('centros_educativos');
		if($query->num_rows() > 0) {
			return $query->result();
		}
		else{
			return FALSE;
		}
	}
}

/* End of file centros_educativos_model.php */
/* Location: ./application/models/centros_educativos_model.php */