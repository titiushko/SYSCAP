<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Departamentos_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function lista_departamentos(){
		$lista_departamentos[''] = '';
		$this->db->select('id_departamento, nombre_departamento');
		$query = $this->db->get('departamentos');
		foreach($query->result() as $departamento){
			$lista_departamentos[$departamento->id_departamento] = htmlentities($departamento->nombre_departamento, ENT_COMPAT, 'UTF-8');
		}
		return $lista_departamentos;
	}
	
	function nombre_departamento($codigo_departamento = NULL){
		$query = $this->db->select('nombre_departamento');
		$query = $this->db->where('id_departamento', $codigo_departamento);
		$query = $this->db->get('departamentos');
		return $query->result()[0]->nombre_departamento;
	}
}

/* End of file departamentos_model.php */
/* Location: ./application/models/departamentos_model.php */