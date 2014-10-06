<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Centros_educativos_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	function centros_educativos(){
		$query = $this->db->get('mdl_cat_educativa', 100, 0);
		return $query->result();
	}
	
	function centro_educativo($codigo_centro_educativo){
		$query = $this->db->where('row_id', $codigo_centro_educativo);
		$query = $this->db->get('mdl_cat_educativa');
		return $query->result();
	}
	
	function modificar($data, $codigo_centro_educativo){
		$this->db->where('row_id', $codigo_centro_educativo);
		$this->db->update('mdl_cat_educativa', $data);
	}
}

/* End of file centros_educativos_model.php */
/* Location: ./application/models/centros_educativos_model.php */