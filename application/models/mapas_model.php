<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapas_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function coordenadas_departamentos(){
		$query = $this->db->query('SELECT mapas.id_mapa id_mapa,
								   mapas.longitud_mapa longitud_mapa,
								   mapas.latitud_mapa latitud_mapa,
								   departamentos.id_departamento id_departamento,
								   NULL nombre_municipio,
								   acentos(departamentos.nombre_departamento) nombre_departamento,
								   NULL nombre_centro_educativo
								   FROM mapas INNER JOIN departamentos ON mapas.id_mapa = departamentos.id_mapa
								   INNER JOIN municipios ON mapas.id_mapa = municipios.id_mapa');
		return $query->result();
	}
	
	public function coordenadas_departamento($codigo_departamento){
		$query = $this->db->query('SELECT mapas.longitud_mapa longitud_mapa,
								   mapas.latitud_mapa latitud_mapa
								   FROM mapas INNER JOIN departamentos ON mapas.id_mapa = departamentos.id_mapa
								   WHERE departamentos.id_departamento = ?', array($codigo_departamento));
		$coordenadas_departamento = $query->result();
		$coordenadas_departamento = empty($coordenadas_departamento) ? '13.802994, -88.9053364' : $coordenadas_departamento[0]->longitud_mapa.', '.$coordenadas_departamento[0]->latitud_mapa;
		return $coordenadas_departamento;
	}
	
	function cantidad_usuarios_departamento($codigo_departamento){
		$query = $this->db->query('SELECT SUM(CASE WHEN tipo_capacitado LIKE \'capacitado\' THEN 1 ELSE 0 END) capacitados,
								   SUM(CASE WHEN tipo_capacitado LIKE \'certificado\' THEN 1 ELSE 0 END) certificados,
								   SUM(CASE WHEN tipo_capacitado LIKE \'capacitado\' THEN 1 ELSE 0 END) + SUM(CASE WHEN tipo_capacitado LIKE \'certificado\' THEN 1 ELSE 0 END) total
								   FROM V_EstadisticaDepartamentoFecha
								   WHERE nota_examen_calificacion >= 7.00 AND id_centro_educativo IN(SELECT id_centro_educativo FROM centros_educativos WHERE id_departamento = ?)', array($codigo_departamento));
		return $query->result()[0];
	}
	
	public function coordenadas_municipios($codigo_departamento){
		$query = $this->db->query('SELECT mapas.id_mapa id_mapa,
								   mapas.longitud_mapa longitud_mapa,
								   mapas.latitud_mapa latitud_mapa,
								   municipios.id_municipio id_municipio,
								   acentos(municipios.nombre_municipio) nombre_municipio,
								   acentos(departamentos.nombre_departamento) nombre_departamento,
								   NULL nombre_centro_educativo
								   FROM mapas INNER JOIN municipios ON mapas.id_mapa = municipios.id_mapa
								   INNER JOIN departamentos ON departamentos.id_departamento = municipios.id_departamento
								   WHERE departamentos.id_departamento = ? AND municipios.id_municipio IN(SELECT DISTINCT u.id_municipio id_municipio
								   FROM usuarios u
								   INNER JOIN municipios m ON u.id_municipio = m.id_municipio
								   INNER JOIN departamentos d ON u.id_departamento = d.id_departamento
								   INNER JOIN examenes_calificaciones ec ON u.id_usuario = ec.id_usuario
								   INNER JOIN examenes e ON ec.id_examen = e.id_examen
								   WHERE ec.nota_examen_calificacion >= 7.00)', array($codigo_departamento));
		return $query->result();
	}
	
	public function coordenadas_municipio($codigo_municipio, $codigo_departamento){
		$query = $this->db->query('SELECT mapas.longitud_mapa longitud_mapa,
								   mapas.latitud_mapa latitud_mapa
								   FROM mapas INNER JOIN municipios ON mapas.id_mapa = municipios.id_mapa
								   WHERE municipios.id_municipio = ?', array($codigo_municipio));
		$coordenadas_municipio = $query->result();
		$coordenadas_municipio = empty($coordenadas_municipio) ? $this->coordenadas_departamento($codigo_departamento) : $coordenadas_municipio[0]->longitud_mapa.', '.$coordenadas_municipio[0]->latitud_mapa;
		return $coordenadas_municipio;
	}
	
	function cantidad_usuarios_municipio($codigo_municipio){
		$query = $this->db->query('SELECT SUM(CASE WHEN tipo_capacitado LIKE \'capacitado\' THEN 1 ELSE 0 END) capacitados,
								   SUM(CASE WHEN tipo_capacitado LIKE \'certificado\' THEN 1 ELSE 0 END) certificados,
								   SUM(CASE WHEN tipo_capacitado LIKE \'capacitado\' THEN 1 ELSE 0 END) + SUM(CASE WHEN tipo_capacitado LIKE \'certificado\' THEN 1 ELSE 0 END) total
								   FROM V_EstadisticaDepartamentoFecha
								   WHERE nota_examen_calificacion >= 7.00 AND id_centro_educativo IN(SELECT id_centro_educativo FROM centros_educativos WHERE id_municipio = ?)', array($codigo_municipio));
		return $query->result()[0];
	}
	
	public function coordenadas_centros_educativos($codigo_municipio){
		$query = $this->db->query('SELECT mapas.id_mapa id_mapa,
								   mapas.longitud_mapa longitud_mapa,
								   mapas.latitud_mapa latitud_mapa,
								   centros_educativos.id_centro_educativo id_centro_educativo,
								   acentos(centros_educativos.nombre_centro_educativo) nombre_centro_educativo,
								   acentos(municipios.nombre_municipio) nombre_municipio,
								   departamentos.id_departamento id_departamento,
								   acentos(departamentos.nombre_departamento) nombre_departamento
								   FROM mapas INNER JOIN centros_educativos ON mapas.id_mapa = centros_educativos.id_mapa
								   INNER JOIN municipios ON centros_educativos.id_municipio = municipios.id_municipio
								   INNER JOIN departamentos ON centros_educativos.id_departamento = departamentos.id_departamento
								   WHERE municipios.id_municipio = ? AND centros_educativos.id_centro_educativo IN(SELECT DISTINCT u.id_centro_educativo id_centro_educativo
								   FROM usuarios u
								   INNER JOIN centros_educativos ce ON u.id_centro_educativo = ce.id_centro_educativo
								   INNER JOIN examenes_calificaciones ec ON u.id_usuario = ec.id_usuario
								   INNER JOIN examenes e ON ec.id_examen = e.id_examen
								   WHERE ec.nota_examen_calificacion >= 7.00)', array($codigo_municipio));
		return $query->result();
	}
	
	function cantidad_usuarios_centro_educativo($codigo_centro_educativo){
		$query = $this->db->query('SELECT SUM(CASE WHEN tipo_capacitado LIKE \'capacitado\' THEN 1 ELSE 0 END) capacitados,
								   SUM(CASE WHEN tipo_capacitado LIKE \'certificado\' THEN 1 ELSE 0 END) certificados,
								   SUM(CASE WHEN tipo_capacitado LIKE \'capacitado\' THEN 1 ELSE 0 END) + SUM(CASE WHEN tipo_capacitado LIKE \'certificado\' THEN 1 ELSE 0 END) total
								   FROM V_EstadisticaDepartamentoFecha
								   WHERE nota_examen_calificacion >= 7.00 AND id_centro_educativo = ?', array($codigo_centro_educativo));
		return $query->result()[0];
	}
}

/* End of file mapas_model.php */
/* Location: ./application/models/mapas_model.php */