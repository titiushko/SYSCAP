<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Centros_educativos extends CI_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->helper(array('url', 'html', 'form'));
		$this->load->model(array('centros_educativos_model', 'departamentos_model', 'municipios_model'));
	}
	
	public function index(){
		$data['pagina'] = 'centros_educativos/consultar_centros_educativos_view';
		$data['usuario_actual'] = "&lt;nombre_usuario&gt;";
		$data['opcion_menu'] = array('modulo_usuarios'					=>	'',
									 'modulo_centros_educativos'		=>	'active',
									 'modulo_consultas_estadisticas'	=>	'',
									 'modulo_mapa_estadistico'			=>	'');
		$data['lista_centros_educativos'] = $this->centros_educativos_model->centros_educativos();
		
		$this->load->view('plantilla_pagina_view', $data);
	}
	
	public function mostrar($codigo_centro_educativo = NULL){
		$data['operacion'] = "Mostrar";
		$data['pagina'] = 'centros_educativos/formulario_centros_educativos_view';
		$data['usuario_actual'] = "&lt;nombre_usuario&gt;";
		$data['opcion_menu'] = array('modulo_usuarios'					=>	'',
									 'modulo_centros_educativos'		=>	'active',
									 'modulo_consultas_estadisticas'	=>	'',
									 'modulo_mapa_estadistico'			=>	'');
		$data['centro_educativo'] = $this->centros_educativos_model->centro_educativo($codigo_centro_educativo);
		$data['lista_departamentos'] = $this->departamentos_model->lista_departamentos();
		$data['lista_municipios'] = $this->municipios_model->lista_municipios();
		
		if(empty($data['centro_educativo'])){
			echo 'ID Invalido';		//TODO: crear algo en respuesta, cuando sea un id no valido.
		}
		else{
			$this->load->view('plantilla_pagina_view', $data);
		}
	}
	
	public function modificar($codigo_centro_educativo = NULL){
		$data['operacion'] = "Editar";
		$data['pagina'] = 'centros_educativos/formulario_centros_educativos_view';
		$data['usuario_actual'] = "&lt;nombre_usuario&gt;";
		$data['opcion_menu'] = array('modulo_usuarios'					=>	'',
									 'modulo_centros_educativos'		=>	'active',
									 'modulo_consultas_estadisticas'	=>	'',
									 'modulo_mapa_estadistico'			=>	'');
		$data['lista_departamentos'] = $this->departamentos_model->lista_departamentos();
		$data['lista_municipios'] = $this->municipios_model->lista_municipios();
		
		if($this->input->post('estado', TRUE)){
			$update_centro_educativo = $this->input->post();
			$this->centros_educativos_model->modificar($update_centro_educativo, $codigo_centro_educativo);
			redirect('centros_educativos');
		}
		else{
			$data['centro_educativo'] = $this->centros_educativos_model->centro_educativo($codigo_centro_educativo);
			if(empty($data['centro_educativo'])){
				echo 'ID Invalido';		//TODO: crear algo en respuesta, cuando sea un id no valido. 
			}
			else{
				$this->load->view('plantilla_pagina_view', $data);
			}
		}
	}	
}

/* End of file centros_educativos.php */
/* Location: ./application/controllers/centros_educativos.php */