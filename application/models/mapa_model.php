<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapa_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function obtener_coordenadas(){
		$query = $this->db->query('SELECT mapas.id_mapa id_mapa,
								   mapas.longitud_mapa longitud_mapa,
								   mapas.latitud_mapa latitud_mapa,
								   municipios.nombre_municipio nombre_municipio,
								   departamentos.nombre_departamento nombre_departamento
								   FROM mapas LEFT JOIN municipios ON mapas.id_mapa = municipios.id_mapa
								   LEFT JOIN departamentos ON departamentos.id_departamento = municipios.id_departamento');
		return $query->result();
	}
}

/* End of file mapa_model.php */
/* Location: ./application/models/mapa_model.php */