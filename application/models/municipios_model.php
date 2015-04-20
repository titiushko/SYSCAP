<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Modelo para obtener de la base de datos de SYSCAP la información de la tabla municipios
*/
class Municipios_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	/**
	* Método que devuelve un array unidimencional con el listado de municipios para ser utilizado en listas desplegables
	* Método utilizado por los controladores:
	* - Centros_educativos
	* - Estadisticas
	* - Resumen_estadistico
	*/
	function lista_municipios(){
		$lista_municipios[''] = '';
		$query = $this->db->select('id_municipio, nombre_municipio')->order_by('nombre_municipio', 'asc')->get('municipios');
		foreach($query->result() as $municipio){
			$lista_municipios[$municipio->id_municipio] = utf8($municipio->nombre_municipio);
		}
		return $lista_municipios;
	}
	
	/**
	* Método que devuelve el nombre de un municipio
	* Método utilizado por los controladores:
	* - Centros_educativos
	* - Estadisticas
	* - Mapa
	* - Resumen_estadistico
	*/
	function nombre_municipio($codigo_municipio){
		$query = $this->db->select('nombre_municipio')->where('id_municipio', $codigo_municipio)->get('municipios');
		if($query->row())
			return $query->result()[0]->nombre_municipio;
		else
			return '';
	}
	
	/**
	* Método que valida que un municipio pertenezca a un departamento
	* Método utilizado por el controlador: Mapa
	*/
	function validar_municipio($codigo_municipio, $codigo_departamento){
		$query = $this->db->get_where('municipios', array('id_municipio' => $codigo_municipio, 'id_departamento' => $codigo_departamento));
		return $query->result();
	}
	
	/**
	* Método que devuelve el listado de municipios de un departamento
	* Método utilizado por el controlador: Ajax
	*/
	function lista_municipios_departamento($codigo_departamento){
		$query = $this->db->select('id_municipio, nombre_municipio')->order_by('nombre_municipio', 'asc')->get_where('municipios', array('id_departamento' => $codigo_departamento));
		return $query->result();
	}
}

/* End of file municipios_model.php */
/* Location: ./application/models/municipios_model.php */