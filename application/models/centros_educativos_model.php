<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Modelo para obtener de la base de datos de SYSCAP la información de la tabla centros_educativos
*/
class Centros_educativos_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	/**
	* Método que devuelve un array unidimencional con el listado de centros educativos para ser utilizado en listas desplegables
	*/
	function lista_centros_educativos(){
		$lista_centros_educativos[''] = '';
		$query = $this->db->select('id_centro_educativo, nombre_centro_educativo')->order_by('nombre_centro_educativo', 'asc')->get('centros_educativos');
		foreach($query->result() as $centro_educativo){
			$lista_centros_educativos[$centro_educativo->id_centro_educativo] = utf8($centro_educativo->nombre_centro_educativo);
		}
		return $lista_centros_educativos;
	}
	
	/**
	* Método que devuelve el listado de centros educativos
	* Método utilizado por el controlador: Centros_educativos
	*/
	function centros_educativos(){
		$query = $this->db->select('id_centro_educativo, codigo_centro_educativo, nombre_centro_educativo, id_departamento, id_municipio')->get('centros_educativos');
		return $query->result();
	}
	
	/**
	* Método que devuelve la información de un centro educativo
	* Método utilizado por el controlador: Centros_educativos
	*/
	function centro_educativo($codigo_centro_educativo){
		$query = $this->db->select('id_centro_educativo, codigo_centro_educativo, nombre_centro_educativo, id_departamento, id_municipio')
						  ->get_where('centros_educativos', array('id_centro_educativo' => $codigo_centro_educativo));
		return $query->result();
	}
	
	/**
	* Método que devuelve el nombre de un centro educativo
	* Método utilizado por los controladores:
	* - Centros_educativos
	* - Estadisticas
	* - Mapa
	* - Resumen_estadistico
	* - Usuarios
	*/
	function nombre_centro_educativo($codigo_centro_educativo){
		$query = $this->db->query('SELECT F_NombreCentroEducativo(?) nombre_centro_educativo', array($codigo_centro_educativo));
		if($query->row())
			return utf8($query->result()[0]->nombre_centro_educativo);
		else
			return '';
	}
	
	/**
	* Método que realiza update a la tabla centros_educativos para actualizar la información de un centro educativo
	* Método utilizado por el controlador: Centros_educativos
	*/
	function modificar($datos, $codigo_centro_educativo){
		$this->db->update('centros_educativos', $datos, array('id_centro_educativo' => $codigo_centro_educativo));
	}
	
	/**
	* Método que devuelve el listado de docentes capacitados
	* Método utilizado por el controlador: Centros_educativos
	*/
	function docentes_capacitados($codigo_centro_educativo){
		return $this->_listado_docentes($codigo_centro_educativo, 'capacitado');
	}
	
	/**
	* Método que devuelve el listado de docentes certificados
	* Método utilizado por el controlador: Centros_educativos
	*/
	function docentes_certificados($codigo_centro_educativo){
		return $this->_listado_docentes($codigo_centro_educativo, 'certificado');
	}
	
	/**
	* Método que devuelve el resultado de docentes capacitados o certificados
	* Docentes: usuarios con los siguientes tipos de usuario
	* +-----------------+-----------------------+
	* | id_tipo_usuario | nombre_tipo_usuario   |
	* +-----------------+-----------------------+
	* |               5 | Docente de Básica     |
	* |               6 | Docente de Media      |
	* |               7 | Docente Tecnólogo     |
	* |               8 | Docente Universitario |
	* +-----------------+-----------------------+
	*/
	private function _listado_docentes($codigo_centro_educativo, $tipo_capacitado){
		$certificacion_usuario = $tipo_capacitado == 'certificado' ? ', nombre_examen certificacion_usuario' : '';
		$query = $this->db->distinct(TRUE)
						  ->select('id_usuario, F_NombreCompletoUsuario(id_usuario) nombre_completo_usuario'.$certificacion_usuario)
						  ->like('tipo_capacitado', $tipo_capacitado, 'none')
						  ->where(array('id_tipo_usuario BETWEEN 5 AND 8 AND 1 =' => '1', 'modalidad_usuario' => 'tutorizado', 'id_centro_educativo' => $codigo_centro_educativo))
						  ->order_by('nombre_completo_usuario', 'asc')
						  ->get('V_Estadisticas');
		return $query->result();
	}
	
	/**
	* Método que valida que el código de un centro educativo exista
	* Método utilizado por el controlador: Centros_educativos
	*/
	function validar_centro_educativo($codigo_centro_educativo){
		$query = $this->db->get_where('centros_educativos', array('id_centro_educativo' => $codigo_centro_educativo));
		return $query->result();
	}
	
	/**
	* Método que devuelve los centros educativos que coicidan con el nombre del centro educativo de búsqueda
	* Método utilizado por el controlador: Ajax
	*/
	public function buscar_centro_educativo($nombre_centro_educativo){
		$query = $this->db->select('id_centro_educativo, nombre_centro_educativo')->like('LOWER(nombre_centro_educativo)', strtolower($nombre_centro_educativo))->get('centros_educativos', 50);
		if($query->num_rows() > 0) {
			return $query->result();
		}
		else{
			return FALSE;
		}
	}
}

/* End of file centros_educativos_model.php */
/* Location: ./application/models/centros_educativos_model.php */