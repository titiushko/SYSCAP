<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->eliminar_cache();
		$this->load->model(array('municipios_model', 'centros_educativos_model'));
	}
	
	public function lista_municipios(){
		if($this->input->is_ajax_request() && $this->input->get_post('id_departamento')){
			$codigo_departamento = $this->security->xss_clean($this->input->get_post('id_departamento'));
			$municipios = $this->municipios_model->lista_municipios_departamento($codigo_departamento);
			if($municipios !== FALSE){
				echo json_encode($municipios);
			}
		}
		exit;
	}
	
	public function lista_centros_educativos(){
		if($this->input->is_ajax_request() && $this->input->get_post('nombre_centro_educativo')){
			$nombre_centro_educativo = $this->security->xss_clean($this->input->get_post('nombre_centro_educativo'));
			$centros_educativos = $this->centros_educativos_model->buscar_centro_educativo($nombre_centro_educativo);
			if($centros_educativos !== FALSE){
				echo json_encode($centros_educativos);
			}
		}
		exit;
	}
	
	public function boton_menu(){
		if($this->input->is_ajax_request() && $this->input->get_post('boton_menu')){
			if($this->security->xss_clean($this->input->get_post('boton_menu')) == 'TRUE'){
				$this->session->set_userdata('boton_menu', TRUE);
			}
			else{
				$this->session->set_userdata('boton_menu', FALSE);
			}
			echo json_encode($this->session->userdata('boton_menu'));
		}
		exit;
	}
}

/* End of file ajax.php */
/* Location: ./application/controllers/ajax.php */