<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Profesiones_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function lista_profesiones(){
		$lista_profesiones[''] = '';
		$query = $this->db->select('id_profesion, acentos(nombre_profesion) nombre_profesion');
		$query = $this->db->order_by('nombre_profesion', 'asc');
		$query = $this->db->get('profesiones');
		foreach($query->result() as $profesion){
			$lista_profesiones[$profesion->id_profesion] = utf8($profesion->nombre_profesion);
		}
		return $lista_profesiones;
	}
	
	function nombre_profesion($codigo_profesion){
		if($codigo_profesion != NULL){
			$query = $this->db->select('acentos(nombre_profesion) nombre_profesion');
			$query = $this->db->where('id_profesion', $codigo_profesion);
			$query = $this->db->get('profesiones');
			if($query->row())
				return $query->result()[0]->nombre_profesion;
			else
				return '';
		}
	}
}

/* End of file profesiones_model.php */
/* Location: ./application/models/profesiones_model.php */