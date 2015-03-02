<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->eliminar_cache();
		if(isset($this->session->userdata['conexion_usuario'])){
			if($this->session->userdata['nombre_corto_rol'] == 'admin'){
				$this->load->model(array('municipios_model', 'centros_educativos_model', 'usuarios_model'));
			}
			else{
				$this->acceso_denegado('sin_permiso', utf8($this->session->userdata('nombre_completo_usuario')));
			}
		}
		else{
			$this->acceso_denegado('sin_conexion');
		}
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
	
	public function lista_usuarios(){
		if($this->input->is_ajax_request() && $this->input->get_post('codigo_centro_educativo')){
			$codigo_centro_educativo = $this->security->xss_clean($this->input->get_post('codigo_centro_educativo'));
			$usuarios = $this->usuarios_model->lista_usuarios($codigo_centro_educativo);
			if($usuarios !== FALSE){
				echo json_encode($usuarios);
			}
		}
		exit;
	}
	
	public function lista_centros_educativos(){
		if($this->input->is_ajax_request() && $this->input->get_post('nombre_centro_educativo')){
			$nombre_centro_educativo = $this->security->xss_clean($this->input->get_post('nombre_centro_educativo'));
			$centros_educativos = $this->centros_educativos_model->buscar_centro_educativo($nombre_centro_educativo);
			if($centros_educativos !== FALSE){
				echo '<div class="'.(count($centros_educativos) < 5 ? 'contenedor-centro-educativo-1' : 'contenedor-centro-educativo-2').'">';
				foreach($centros_educativos as $centro_educativo) {
					echo p($centro_educativo->nombre_centro_educativo);
				}
				echo '</div>';
			}
		}
		exit;
	}
}

/* End of file ajax.php */
/* Location: ./application/controllers/ajax.php */