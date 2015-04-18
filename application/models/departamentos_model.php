<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Modelo para obtener de la base de datos de SYSCAP la información de la tabla departamentos
*/
class Departamentos_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	/**
	* Método que devuelve un array unidimencional con el listado de profesiones para ser utilizado en listas desplegables
	* Método utilizado por los controladores:
	* - Centros_educativos
	* - Estadisticas
	* - Resumen_estadistico
	*/
	function lista_departamentos(){
		$lista_departamentos[''] = '';
		$query = $this->db->select('id_departamento, nombre_departamento')->order_by('nombre_departamento', 'asc')->get('departamentos');
		foreach($query->result() as $departamento){
			$lista_departamentos[$departamento->id_departamento] = utf8($departamento->nombre_departamento);
		}
		return $lista_departamentos;
	}
	
	/**
	* Método que devuelve el nombre de una profesion
	* Método utilizado por los controladores:
	* - Centros_educativos
	* - Estadisticas
	* - Mapa
	* - Resumen_estadistico
	*/
	function nombre_departamento($codigo_departamento){
		$query = $this->db->select('nombre_departamento')->get_where('departamentos', array('id_departamento' => $codigo_departamento));
		if($query->row())
			return $query->result()[0]->nombre_departamento;
		else
			return '';
	}
}

/* End of file departamentos_model.php */
/* Location: ./application/models/departamentos_model.php */