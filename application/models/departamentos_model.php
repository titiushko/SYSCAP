<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Departamentos_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function lista_departamentos(){
		$lista_departamentos[''] = '';
		$query = $this->db->select('id_departamento, acentos(nombre_departamento) nombre_departamento');
		$query = $this->db->order_by('nombre_departamento', 'asc');
		$query = $this->db->get('departamentos');
		foreach($query->result() as $departamento){
			$lista_departamentos[$departamento->id_departamento] = utf8($departamento->nombre_departamento);
		}
		return $lista_departamentos;
	}
	
	function nombre_departamento($codigo_departamento){
		$query = $this->db->select('acentos(nombre_departamento) nombre_departamento');
		$query = $this->db->where('id_departamento', $codigo_departamento);
		$query = $this->db->get('departamentos');
		if($query->row())
			return $query->result()[0]->nombre_departamento;
		else
			return '';
	}
}

/* End of file departamentos_model.php */
/* Location: ./application/models/departamentos_model.php */