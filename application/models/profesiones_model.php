<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Modelo para obtener de la base de datos de SYSCAP la información de la tabla profesiones
*/
class Profesiones_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	/**
	* Método que devuelve un array unidimencional con el listado de profesiones para ser utilizado en listas desplegables
	* Método utilizado por el controlador: Usuarios
	*/
	function lista_profesiones(){
		$lista_profesiones[''] = '';
		$query = $this->db->select('id_profesion, nombre_profesion')->order_by('nombre_profesion', 'asc')->get('profesiones');
		foreach($query->result() as $profesion){
			$lista_profesiones[$profesion->id_profesion] = utf8($profesion->nombre_profesion);
		}
		return $lista_profesiones;
	}
	
	/**
	* Método que devuelve el nombre de una profesion
	* Método utilizado por el controlador: Usuarios
	*/
	function nombre_profesion($codigo_profesion){
		if($codigo_profesion != NULL){
			$query = $this->db->select('nombre_profesion')->get_where('profesiones', array('id_profesion' => $codigo_profesion));
			if($query->row())
				return $query->result()[0]->nombre_profesion;
			else
				return '';
		}
	}
}

/* End of file profesiones_model.php */
/* Location: ./application/models/profesiones_model.php */