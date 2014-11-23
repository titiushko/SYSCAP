<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Estadisticas_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
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
}

/* End of file estadisticas_model.php */
/* Location: ./application/models/estadisticas_model.php */