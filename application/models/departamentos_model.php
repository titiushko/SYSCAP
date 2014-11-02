<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Departamentos_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	function lista_departamentos(){
		$lista_departamentos[''] = '';
		$this->db->select('id_departamento, nombre_departamento');
		$query = $this->db->get('departamentos');
		foreach($query->result() as $departamento){
			$lista_departamentos[$departamento->id_departamento] = $departamento->nombre_departamento;
		}
		return $lista_departamentos;
	}
	
	function nombre_departamento($codigo_departamento = NULL){
		$nombre_departamento = '';
		$this->db->select('nombre_departamento');
		$this->db->where('id_departamento', $codigo_departamento);
		$query = $this->db->get('departamentos');
		foreach($query->result() as $departamento){
			$nombre_departamento = $departamento->nombre_departamento;
		}
		return $nombre_departamento;
	}
}

/* End of file departamentos_model.php */
/* Location: ./application/models/departamentos_model.php */