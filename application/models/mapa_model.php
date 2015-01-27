<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapa_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function coordenadas_departamentos(){
		$query = $this->db->query('SELECT mapas.id_mapa id_mapa,
								   mapas.longitud_mapa longitud_mapa,
								   mapas.latitud_mapa latitud_mapa,
								   departamentos.id_departamento id_departamento,
								   acentos(municipios.nombre_municipio) nombre_municipio,
								   acentos(departamentos.nombre_departamento) nombre_departamento
								   FROM mapas INNER JOIN departamentos ON mapas.id_mapa = departamentos.id_mapa
								   INNER JOIN municipios ON mapas.id_mapa = municipios.id_mapa');
		return $query->result();
	}
	
	public function coordenadas_departamento($codigo_departamento){
		$query = $this->db->query('SELECT mapas.longitud_mapa longitud_mapa,
								   mapas.latitud_mapa latitud_mapa
								   FROM mapas INNER JOIN departamentos ON mapas.id_mapa = departamentos.id_mapa
								   WHERE departamentos.id_departamento = ?', array($codigo_departamento));
		return $query->result()[0]->longitud_mapa.', '.$query->result()[0]->latitud_mapa;
	}
	
	function cantidad_usuarios_departamento($codigo_departamento){
		$query = $this->db->query('SELECT SUM(capacitados.total) capacitados, SUM(CASE WHEN certificados.total IS NULL THEN 0 ELSE certificados.total END) certificados, (SUM(capacitados.total) + SUM(CASE WHEN certificados.total IS NULL THEN 0 ELSE certificados.total END)) total
								   FROM (SELECT nombre_municipio, total FROM V_UsuariosCapacitadosDepartamento WHERE id_departamento = ?) capacitados
								   LEFT JOIN (SELECT nombre_municipio, total FROM V_UsuariosCertificadosDepartamento WHERE id_departamento = ?) certificados
								   ON capacitados.nombre_municipio = certificados.nombre_municipio', array($codigo_departamento, $codigo_departamento));
		return $query->result()[0];
	}
	
	public function coordenadas_municipios($codigo_departamento){
		$query = $this->db->query('SELECT mapas.id_mapa id_mapa,
								   mapas.longitud_mapa longitud_mapa,
								   mapas.latitud_mapa latitud_mapa,
								   municipios.id_municipio id_municipio,
								   acentos(municipios.nombre_municipio) nombre_municipio,
								   acentos(departamentos.nombre_departamento) nombre_departamento
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
	
	public function coordenadas_municipio($codigo_municipio){
		$query = $this->db->query('SELECT mapas.longitud_mapa longitud_mapa,
								   mapas.latitud_mapa latitud_mapa
								   FROM mapas INNER JOIN municipios ON mapas.id_mapa = municipios.id_mapa
								   WHERE municipios.id_municipio = ?', array($codigo_municipio));
		return $query->result()[0];
	}
	
	function cantidad_usuarios_municipio($codigo_municipio){
		$query = $this->db->query('SELECT SUM(capacitados.total) capacitados, SUM(CASE WHEN certificados.total IS NULL THEN 0 ELSE certificados.total END) certificados, (SUM(capacitados.total) + SUM(CASE WHEN certificados.total IS NULL THEN 0 ELSE certificados.total END)) total
								   FROM (SELECT nombre_municipio, total FROM V_UsuariosCapacitadosDepartamento WHERE id_municipio = ?) capacitados
								   LEFT JOIN (SELECT nombre_municipio, total FROM V_UsuariosCertificadosDepartamento WHERE id_municipio = ?) certificados
								   ON capacitados.nombre_municipio = certificados.nombre_municipio', array($codigo_municipio, $codigo_municipio));
		return $query->result()[0];
	}
}

/* End of file mapa_model.php */
/* Location: ./application/models/mapa_model.php */