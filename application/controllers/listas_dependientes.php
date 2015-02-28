<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Listas_dependientes extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->eliminar_cache();
		if(isset($this->session->userdata['conexion_usuario'])){
			if($this->session->userdata['nombre_corto_rol'] == 'admin'){
				$this->load->model(array('municipios_model', 'centros_educativos_model'));
			}
			else{
				$this->acceso_denegado('sin_permiso', utf8($this->session->userdata('nombre_completo_usuario')));
			}
		}
		else{
			$this->acceso_denegado('sin_conexion');
		}
	}
	
	public function municipios(){
		echo json_encode($this->municipios_model->lista_municipios_departamento($this->input->get_post('id_departamento')));
		exit;
	}
}

/* End of file listas_dependientes.php */
/* Location: ./application/controllers/listas_dependientes.php */