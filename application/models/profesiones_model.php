<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Profesiones_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function lista_profesiones(){
		$lista_profesiones[''] = '';
		$this->db->select('id_profesion, nombre_profesion');
		$query = $this->db->get('profesiones');
		foreach($query->result() as $profesion){
			$lista_profesiones[$profesion->id_profesion] = $profesion->nombre_profesion;
		}
		return $lista_profesiones;
	}
}

/* End of file profesiones_model.php */
/* Location: ./application/models/profesiones_model.php */