<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Centros_educativos_model extends CI_Model{
	function __construct(){
		parent::__construct();
		//$this->load->database();
	}
	
	function lista_centros_educativos(){
		$lista_centros_educativos[''] = '';
		$this->db->select('id_centro_educativo, nombre_centro_educativo');
		$query = $this->db->get('centros_educativos', 100, 0);
		foreach($query->result() as $centro_educativo){
			$lista_centros_educativos[$centro_educativo->id_centro_educativo] = $centro_educativo->nombre_centro_educativo;
		}
		return $lista_centros_educativos;
	}
	
	function centros_educativos(){
		$query = $this->db->get('centros_educativos', 100, 0);
		return $query->result();
	}
	
	function centro_educativo($codigo_centro_educativo){
		$query = $this->db->where('id_centro_educativo', $codigo_centro_educativo);
		$query = $this->db->get('centros_educativos');
		return $query->result();
	}
	
	function nombre_centro_educativo($codigo_centro_educativo){
		$nombre_centro_educativo = '';
		$query = $this->db->query('SELECT F_NombreCentroEducativo(?) AS nombre_centro_educativo', array($codigo_centro_educativo));
		foreach($query->result() as $centro_educativo){
			$nombre_centro_educativo = $centro_educativo->nombre_centro_educativo;
		}
		return $nombre_centro_educativo;
	}
	
	function modificar($datos, $codigo_centro_educativo){
		$this->db->where('id_centro_educativo', $codigo_centro_educativo);
		$this->db->update('centros_educativos', $datos);
	}
}

/* End of file centros_educativos_model.php */
/* Location: ./application/models/centros_educativos_model.php */