<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Centros_educativos extends CI_Controller{
	function __construct(){
		parent::__construct();

		$this->load->helper(array('url', 'html', 'form'));
		$this->load->model('centros_educativos_model');
	}
	
	public function index(){
		$data['pagina'] = 'centros_educativos/consultar_centros_educativos_view';
		$data['usuario_actual'] = "Tito Miguel";
		$data['opcion_menu'] = array('modulo_usuarios'					=>	'',
									 'modulo_centros_educativos'		=>	'active',
									 'modulo_consultas_estadisticas'	=>	'',
									 'modulo_mapa_estadistico'			=>	''
									 );
		$data['lista_centros_educativos'] = $this->centros_educativos_model->centros_educativos();
		
		$this->load->view('plantilla_pagina_view', $data);
	}
	
	public function modificar($codigo_centro_educativo = NULL){
		$data['pagina'] = 'centros_educativos/formulario_centros_educativos_view';
		$data['usuario_actual'] = "Tito Miguel";
		$data['opcion_menu'] = array('modulo_usuarios'					=>	'',
									 'modulo_centros_educativos'		=>	'active',
									 'modulo_consultas_estadisticas'	=>	'',
									 'modulo_mapa_estadistico'			=>	''
									 );
		
		if ($this->input->post('estado') == '1'){
			$update_centro_educativo = $this->input->post('row_id');
			$this->centros_educativos_model->modificar($update_centro_educativo);
			redirect('centros_educativos');
		}
		else{
			$data['centro_educativo'] = $this->centros_educativos_model->centro_educativo($codigo_centro_educativo);
			if(empty($data['centro_educativo'])){
				echo 'ID Invalido';
			}
			else{
				$this->load->view('plantilla_pagina_view', $data);
			}
		}
	}	
}

/* End of file centros_educativos.php */
/* Location: ./application/controllers/centros_educativos.php */