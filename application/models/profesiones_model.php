<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Profesiones_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	function lista_profesiones(){
		$lista_profesiones[''] = '';
		$this->db->select('row_id, descripcion');
		$query = $this->db->get('mdl_cat_profesion');
		foreach($query->result() as $profesion){
			$lista_profesiones[$profesion->row_id] = $profesion->descripcion;
		}
		return $lista_profesiones;
	}
}

/* End of file profesiones_model.php */
/* Location: ./application/models/profesiones_model.php */