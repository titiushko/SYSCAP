<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Modelo para obtener de la base de datos de SYSCAP la información de la tabla niveles_estudios
*/
class Niveles_estudios_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	/**
	* Método que devuelve un array unidimencional con el listado de niveles academicos para ser utilizado en listas desplegables
	* Método utilizado por el controlador: Resumen_estadistico
	*/
	function lista_niveles_estudios(){
		$lista_niveles_estudios[''] = '';
		$query = $this->db->select('id_nivel_estudio, nombre_nivel_estudio')->order_by('nombre_nivel_estudio', 'asc')->get('niveles_estudios');
		foreach($query->result() as $nivel_estudio){
			$lista_niveles_estudios[$nivel_estudio->id_nivel_estudio] = utf8($nivel_estudio->nombre_nivel_estudio);
		}
		return $lista_niveles_estudios;
	}
	
	/**
	* Método que devuelve el nombre de un nivel de estudio
	* Método utilizado por el controlador: Resumen_estadistico
	*/
	function nombre_nivel_estudio($codigo_nivel_estudio){
		if($codigo_nivel_estudio != 0){
			$query = $this->db->select('nombre_nivel_estudio')->get_where('niveles_estudios', array('id_nivel_estudio' => $codigo_nivel_estudio));
			if($query->row())
				return $query->result()[0]->nombre_nivel_estudio;
			else
				return '';
		}
	}
}

/* End of file niveles_estudios_model.php */
/* Location: ./application/models/niveles_estudios_model.php */