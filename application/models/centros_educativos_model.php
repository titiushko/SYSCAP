<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Centros_educativos_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function lista_centros_educativos(){
		$lista_centros_educativos[''] = '';
		$query = $this->db->select('id_centro_educativo, nombre_centro_educativo nombre_centro_educativo');
		$query = $this->db->order_by('nombre_centro_educativo', 'asc');
		$query = $this->db->get('centros_educativos');
		foreach($query->result() as $centro_educativo){
			$lista_centros_educativos[$centro_educativo->id_centro_educativo] = utf8($centro_educativo->nombre_centro_educativo);
		}
		return $lista_centros_educativos;
	}
	
	function centros_educativos(){
		$query = $this->db->select('id_centro_educativo, codigo_centro_educativo, nombre_centro_educativo nombre_centro_educativo, id_departamento, id_municipio');
		$query = $this->db->get('centros_educativos');
		return $query->result();
	}
	
	function centro_educativo($codigo_centro_educativo){
		$query = $this->db->select('id_centro_educativo, codigo_centro_educativo, nombre_centro_educativo nombre_centro_educativo, id_departamento, id_municipio');
		$query = $this->db->where('id_centro_educativo', $codigo_centro_educativo);
		$query = $this->db->get('centros_educativos');
		return $query->result();
	}
	
	function nombre_centro_educativo($codigo_centro_educativo){
		$query = $this->db->query('SELECT F_NombreCentroEducativo(?) nombre_centro_educativo', array($codigo_centro_educativo));
		if($query->row())
			return utf8($query->result()[0]->nombre_centro_educativo);
		else
			return '';
	}
	
	function modificar($datos, $codigo_centro_educativo){
		$this->db->where('id_centro_educativo', $codigo_centro_educativo);
		$this->db->update('centros_educativos', $datos);
	}
	
	function docentes_capacitados($codigo_centro_educativo){
		$query = $this->db->query('SELECT DISTINCT id_usuario, F_NombreCompletoUsuario(id_usuario) nombre_completo_usuario
								   FROM V_Estadisticas
								   WHERE nombre_examen LIKE \'Evaluaci%\' AND nota_examen_calificacion >= 7.00 AND id_tipo_usuario BETWEEN 5 AND 8
								   AND modalidad_usuario = \'tutorizado\' AND id_centro_educativo = ?
								   ORDER BY nombre_completo_usuario', array($codigo_centro_educativo));
		return $query->result();
	}
	
	function docentes_certificados($codigo_centro_educativo){
		$query = $this->db->query('SELECT DISTINCT id_usuario, F_NombreCompletoUsuario(id_usuario) nombre_completo_usuario,
								   REPLACE(REPLACE(nombre_examen, \'Examen Certificación\', \'\'), \'Examen De Certificación\', \'\') certificacion_usuario
								   FROM V_Estadisticas
								   WHERE nombre_examen LIKE \'Examen%\' AND nota_examen_calificacion >= 7.00 AND id_tipo_usuario BETWEEN 5 AND 8
								   AND modalidad_usuario = \'tutorizado\' AND id_centro_educativo = ?
								   ORDER BY nombre_completo_usuario', array($codigo_centro_educativo));
		return $query->result();
	}
	
	function validar_centro_educativo($codigo_centro_educativo){
		$query = $this->db->where('id_centro_educativo', $codigo_centro_educativo);
		$query = $this->db->get('centros_educativos');
		return $query->result();
	}
	
	public function buscar_centro_educativo($nombre_centro_educativo){
		$query = $this->db->select('id_centro_educativo, nombre_centro_educativo')->like('LOWER(nombre_centro_educativo)', strtolower($nombre_centro_educativo))->get('centros_educativos', 50);
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