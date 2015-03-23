<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapas_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function coordenadas_departamentos(){
		$query = $this->db->query('SELECT ma.id_mapa id_mapa,
								   ma.longitud_mapa longitud_mapa,
								   ma.latitud_mapa latitud_mapa,
								   de.id_departamento id_departamento,
								   NULL nombre_municipio,
								   de.nombre_departamento nombre_departamento,
								   NULL nombre_centro_educativo
								   FROM mapas ma INNER JOIN departamentos de ON ma.id_mapa = de.id_mapa
								   INNER JOIN municipios mu ON ma.id_mapa = mu.id_mapa');
		return $query->result();
	}
	
	public function coordenadas_departamento($codigo_departamento){
		$query = $this->db->query('SELECT ma.longitud_mapa longitud_mapa,
								   ma.latitud_mapa latitud_mapa
								   FROM mapas ma INNER JOIN departamentos de ON ma.id_mapa = de.id_mapa
								   WHERE de.id_departamento = ?', array($codigo_departamento));
		$coordenadas_departamento = $query->result();
		$coordenadas_departamento = empty($coordenadas_departamento) ? '13.802994, -88.9053364' : $coordenadas_departamento[0]->longitud_mapa.', '.$coordenadas_departamento[0]->latitud_mapa;
		return $coordenadas_departamento;
	}
	
	function cantidad_usuarios_departamento($codigo_departamento){
		$query = $this->db->query('SELECT \'Capacitados\' tipos_capacitados, COUNT(*) tutorizados
								   FROM (SELECT DISTINCT id_usuario, F_NombreCompletoUsuario(id_usuario) nombre_completo_usuario FROM V_Estadisticas
								   WHERE nombre_examen LIKE \'Evaluaci%\' AND nota_examen_calificacion >= 7.00 AND id_tipo_usuario BETWEEN 5 AND 8
								   AND modalidad_usuario = \'tutorizado\' AND id_centro_educativo IN(SELECT id_centro_educativo FROM centros_educativos WHERE id_departamento = ?)) capacitados
								   UNION
								   SELECT \'Certificados\' tipos_capacitados, COUNT(*) tutorizados
								   FROM (SELECT DISTINCT id_usuario, F_NombreCompletoUsuario(id_usuario) nombre_completo_usuario,
								   REPLACE(REPLACE(nombre_examen, \'Examen Certificación\', \'\'), \'Examen De Certificación\', \'\') certificacion_usuario
								   FROM V_Estadisticas
								   WHERE nombre_examen LIKE \'Examen%\' AND nota_examen_calificacion >= 7.00 AND id_tipo_usuario BETWEEN 5 AND 8
								   AND modalidad_usuario = \'tutorizado\' AND id_centro_educativo IN(SELECT id_centro_educativo FROM centros_educativos WHERE id_departamento = ?)) certificados',
								   array($codigo_departamento, $codigo_departamento));
		return $query->result();
	}
	
	public function coordenadas_municipios($codigo_departamento){
		$query = $this->db->query('SELECT ma.id_mapa id_mapa,
								   ma.longitud_mapa longitud_mapa,
								   ma.latitud_mapa latitud_mapa,
								   mu.id_municipio id_municipio,
								   mu.nombre_municipio nombre_municipio,
								   de.nombre_departamento nombre_departamento,
								   NULL nombre_centro_educativo
								   FROM mapas ma INNER JOIN municipios mu ON ma.id_mapa = mu.id_mapa
								   INNER JOIN departamentos de ON de.id_departamento = mu.id_departamento
								   WHERE de.id_departamento = ? AND mu.id_municipio IN(SELECT DISTINCT u.id_municipio id_municipio
								   FROM usuarios u
								   INNER JOIN municipios mu ON u.id_municipio = mu.id_municipio
								   INNER JOIN departamentos de ON u.id_departamento = de.id_departamento
								   INNER JOIN examenes_calificaciones ec ON u.id_usuario = ec.id_usuario
								   INNER JOIN examenes e ON ec.id_examen = e.id_examen
								   WHERE ec.nota_examen_calificacion >= 7.00)', array($codigo_departamento));
		return $query->result();
	}
	
	public function coordenadas_municipio($codigo_municipio, $codigo_departamento){
		$query = $this->db->query('SELECT ma.longitud_mapa longitud_mapa,
								   ma.latitud_mapa latitud_mapa
								   FROM mapas ma INNER JOIN municipios mu ON ma.id_mapa = mu.id_mapa
								   WHERE mu.id_municipio = ?', array($codigo_municipio));
		$coordenadas_municipio = $query->result();
		$coordenadas_municipio = empty($coordenadas_municipio) ? $this->coordenadas_departamento($codigo_departamento) : $coordenadas_municipio[0]->longitud_mapa.', '.$coordenadas_municipio[0]->latitud_mapa;
		return $coordenadas_municipio;
	}
	
	function cantidad_usuarios_municipio($codigo_municipio){
		$query = $this->db->query('SELECT \'Capacitados\' tipos_capacitados, COUNT(*) tutorizados
								   FROM (SELECT DISTINCT id_usuario, F_NombreCompletoUsuario(id_usuario) nombre_completo_usuario FROM V_Estadisticas
								   WHERE nombre_examen LIKE \'Evaluaci%\' AND nota_examen_calificacion >= 7.00 AND id_tipo_usuario BETWEEN 5 AND 8
								   AND modalidad_usuario = \'tutorizado\' AND id_centro_educativo IN(SELECT id_centro_educativo FROM centros_educativos WHERE id_municipio = ?)) capacitados
								   UNION
								   SELECT \'Certificados\' tipos_capacitados, COUNT(*) tutorizados
								   FROM (SELECT DISTINCT id_usuario, F_NombreCompletoUsuario(id_usuario) nombre_completo_usuario,
								   REPLACE(REPLACE(nombre_examen, \'Examen Certificación\', \'\'), \'Examen De Certificación\', \'\') certificacion_usuario
								   FROM V_Estadisticas
								   WHERE nombre_examen LIKE \'Examen%\' AND nota_examen_calificacion >= 7.00 AND id_tipo_usuario BETWEEN 5 AND 8
								   AND modalidad_usuario = \'tutorizado\' AND id_centro_educativo IN(SELECT id_centro_educativo FROM centros_educativos WHERE id_municipio = ?)) certificados',
								   array($codigo_municipio, $codigo_municipio));
		return $query->result();
	}
	
	public function coordenadas_centros_educativos($codigo_municipio){
		$query = $this->db->query('SELECT ma.id_mapa id_mapa,
								   ma.longitud_mapa longitud_mapa,
								   ma.latitud_mapa latitud_mapa,
								   ce.id_centro_educativo id_centro_educativo,
								   ce.nombre_centro_educativo nombre_centro_educativo,
								   mu.nombre_municipio nombre_municipio,
								   de.id_departamento id_departamento,
								   de.nombre_departamento nombre_departamento
								   FROM mapas ma INNER JOIN centros_educativos ce ON ma.id_mapa = ce.id_mapa
								   INNER JOIN municipios mu ON ce.id_municipio = mu.id_municipio
								   INNER JOIN departamentos de ON ce.id_departamento = de.id_departamento
								   WHERE mu.id_municipio = ? AND ce.id_centro_educativo IN(SELECT DISTINCT u.id_centro_educativo id_centro_educativo
								   FROM usuarios u
								   INNER JOIN centros_educativos ce ON u.id_centro_educativo = ce.id_centro_educativo
								   INNER JOIN examenes_calificaciones ec ON u.id_usuario = ec.id_usuario
								   INNER JOIN examenes e ON ec.id_examen = e.id_examen
								   WHERE ec.nota_examen_calificacion >= 7.00)', array($codigo_municipio));
		return $query->result();
	}
	
	function cantidad_usuarios_centro_educativo($codigo_centro_educativo){
		$query = $this->db->query('SELECT \'Capacitados\' tipos_capacitados, COUNT(*) tutorizados
								   FROM (SELECT DISTINCT id_usuario, F_NombreCompletoUsuario(id_usuario) nombre_completo_usuario FROM V_Estadisticas
								   WHERE nombre_examen LIKE \'Evaluaci%\' AND nota_examen_calificacion >= 7.00 AND id_tipo_usuario BETWEEN 5 AND 8
								   AND modalidad_usuario = \'tutorizado\' AND id_centro_educativo = ?) capacitados
								   UNION
								   SELECT \'Certificados\' tipos_capacitados, COUNT(*) tutorizados
								   FROM (SELECT DISTINCT id_usuario, F_NombreCompletoUsuario(id_usuario) nombre_completo_usuario,
								   REPLACE(REPLACE(nombre_examen, \'Examen Certificación\', \'\'), \'Examen De Certificación\', \'\') certificacion_usuario
								   FROM V_Estadisticas
								   WHERE nombre_examen LIKE \'Examen%\' AND nota_examen_calificacion >= 7.00 AND id_tipo_usuario BETWEEN 5 AND 8
								   AND modalidad_usuario = \'tutorizado\' AND id_centro_educativo = ?) certificados',
								   array($codigo_centro_educativo, $codigo_centro_educativo));
		return $query->result();
	}
}

/* End of file mapas_model.php */
/* Location: ./application/models/mapas_model.php */