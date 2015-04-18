<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Modelo para obtener de la base de datos de SYSCAP la información de la tabla tipos_usuarios
*/
class Tipos_usuarios_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	/**
	* Método que devuelve un array unidimencional con el listado de tipos de usuario para ser utilizado en listas desplegables
	* Método utilizado por el controlador: Usuarios
	*/
	function lista_tipos_usuarios(){
		$lista_tipos_usuarios[''] = '';
		$query = $this->db->select('id_tipo_usuario, nombre_tipo_usuario')->order_by('nombre_tipo_usuario', 'asc')->get('tipos_usuarios');
		foreach($query->result() as $tipo_usuario){
			$lista_tipos_usuarios[$tipo_usuario->id_tipo_usuario] = utf8($tipo_usuario->nombre_tipo_usuario);
		}
		return $lista_tipos_usuarios;
	}
	
	/**
	* Método que devuelve el nombre de un tipo de usuario
	* Método utilizado por el controlador: Usuarios
	*/
	function nombre_tipo_usuario($codigo_tipo_usuario){
		if($codigo_tipo_usuario != 0){
			$query = $this->db->select('nombre_tipo_usuario')->get_where('tipos_usuarios', array('id_tipo_usuario' => $codigo_tipo_usuario));
			if($query->row())
				return $query->result()[0]->nombre_tipo_usuario;
			else
				return '';
		}
	}
}

/* End of file tipos_usuarios_model.php */
/* Location: ./application/models/tipos_usuarios_model.php */