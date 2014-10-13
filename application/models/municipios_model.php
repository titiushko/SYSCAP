<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Municipios_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	function lista_municipios(){
		$lista_municipios[''] = '';
		$this->db->select('id_municipio, nombre_municipio');
		$query = $this->db->get('municipios');
		foreach($query->result() as $municipio){
			$lista_municipios[$municipio->id_municipio] = $municipio->nombre_municipio;
		}
		return $lista_municipios;
	}
	
	function nombre_municipio($codigo_municipio = NULL){
		$this->db->select('nombre_municipio');
		$this->db->where('id_municipio', $codigo_municipio);
		$query = $this->db->get('municipios');
		foreach($query->result() as $municipio){
			$nombre_municipio = $municipio->nombre_municipio;
		}
		return $nombre_municipio;
	}
}

/* End of file municipios_model.php */
/* Location: ./application/models/municipios_model.php */