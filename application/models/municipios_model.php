<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Municipios_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function lista_municipios(){
		$lista_municipios[''] = '';
		$query = $this->db->select('id_municipio, acentos(nombre_municipio) nombre_municipio');
		$query = $this->db->order_by('nombre_municipio', 'asc');
		$query = $this->db->get('municipios');
		foreach($query->result() as $municipio){
			$lista_municipios[$municipio->id_municipio] = utf8($municipio->nombre_municipio);
		}
		return $lista_municipios;
	}
	
	function nombre_municipio($codigo_municipio){
		$query = $this->db->select('acentos(nombre_municipio) nombre_municipio');
		$query = $this->db->where('id_municipio', $codigo_municipio);
		$query = $this->db->get('municipios');
		if($query->row())
			return $query->result()[0]->nombre_municipio;
		else
			return '';
	}
	
	function validar_municipio($codigo_municipio, $codigo_departamento){
		$query = $this->db->where('id_municipio', $codigo_municipio);
		$query = $this->db->where('id_departamento', $codigo_departamento);
		$query = $this->db->get('municipios');
		return $query->result();
	}
	
	function lista_municipios_departamento($id_departamento){
		$query = $this->db->select('id_municipio, nombre_municipio');
		$query = $this->db->where('id_departamento', $id_departamento);
		$query = $this->db->order_by('nombre_municipio', 'asc');
		$query = $this->db->get('municipios');
		return $query->result();
	}
}

/* End of file municipios_model.php */
/* Location: ./application/models/municipios_model.php */