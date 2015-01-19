<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Municipios_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function lista_municipios(){
		$lista_municipios[''] = '';
		$this->db->select('id_municipio, nombre_municipio');
		$query = $this->db->get('municipios');
		foreach($query->result() as $municipio){
			$lista_municipios[$municipio->id_municipio] = htmlentities($municipio->nombre_municipio, ENT_COMPAT, 'UTF-8');
		}
		return $lista_municipios;
	}
	
	function nombre_municipio($codigo_municipio = NULL){
		$query = $this->db->select('nombre_municipio');
		$query = $this->db->where('id_municipio', $codigo_municipio);
		$query = $this->db->get('municipios');
		return $query->result()[0]->nombre_municipio;
	}
}

/* End of file municipios_model.php */
/* Location: ./application/models/municipios_model.php */