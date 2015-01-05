<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Estadisticas_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function modalidades_capacitados($tipo_resultado = ''){
		if($tipo_resultado == 'participantes'){
			$sql = 'SELECT initcap(modalidad_usuario) modalidad, count(*) participantes FROM usuarios GROUP BY modalidad_usuario';
		}
		else{
			$sql = 'SELECT initcap(modalidad_usuario) modalidad FROM usuarios GROUP BY modalidad_usuario';
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function cantidad_usuarios_municipio($id_departamento){
		/* 
		$this->db->select('m.nombre_municipio, COUNT(u.id_municipio) total');
		$this->db->from('usuarios u');
		$this->db->join('municipios m', 'u.id_municipio = m.id_municipio', 'inner');
		$this->db->where('u.id_departamento', $id_departamento);
		$this->db->order_by('m.nombre_municipio', 'asc');
		$query = $this->db->get();
		 */
		$query = $this->db->query('SELECT m.nombre_municipio, COUNT(u.id_municipio) total
								   FROM usuarios u INNER JOIN municipios m ON(u.id_municipio = m.id_municipio)
								   WHERE u.id_departamento = ?
								   GROUP BY m.nombre_municipio', array($id_departamento));
		return $query->result();
	}
	
	function usuarios_municipio($id_departamento){
		$query = $this->db->query('SELECT m.nombre_municipio, F_NombreCompletoUsuario(u.id_usuario) nombre_usuario, initcap(u.modalidad_usuario) modalidad_usuario
								   FROM usuarios u INNER JOIN municipios m ON(u.id_municipio = m.id_municipio)
								   WHERE u.id_departamento = ?
								   ORDER BY 1', array($id_departamento));
		return $query->result();
	}
}

/* End of file estadisticas_model.php */
/* Location: ./application/models/estadisticas_model.php */