<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Controlador que devuelve resultado de peticiones que se realizan con AJAX
*/
class Ajax extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->eliminar_cache();
		$this->load->model(array('municipios_model', 'centros_educativos_model'));
	}
	
	/**
	* Método utilizado con AJAX desde las vistas:
	* - centros_educativos/formulario_centros_educativos_view
	* - estadisticas/estadistica_04_view
	* - estadisticas/estadistica_07_view
	* - estadisticas/resumen_estadistico_view
	* El método devuelve la lista de municipios dependientes de un departamento
	*/
	public function lista_municipios(){
		// DOC: Si es una petición por medio de AJAX y el párametro id_departamento contiene algún valor,
		// entonces: obtener la lista de municipios dependientes de un departamento, si no: salir del método
		if($this->input->is_ajax_request() && $this->input->get_post('id_departamento')){
			// DOC: Obtener el contenido del párametro id_departamento
			$codigo_departamento = $this->security->xss_clean($this->input->get_post('id_departamento'));
			// DOC: Buscar los municipios del departamento seleccionado
			$municipios = $this->municipios_model->lista_municipios_departamento($codigo_departamento);
			// DOC: Si se obtuvo una lista de municipios,
			// entonces: convertir a formato JSON la lista de municipios y enviarlo a la vista
			if($municipios !== FALSE){
				echo json_encode($municipios);
			}
		}
		exit;
	}
	
	/**
	* Método utilizado con AJAX desde las vistas:
	* - estadisticas/estadistica_09_view
	* - estadisticas/resumen_estadistico_view
	* - usuarios/consultar_usuarios_view
	* - usuarios/formulario_usuarios_view
	* El método devuelve la lista de centros educativos que coicidan con la búsqueda del nombre de un centro educativo
	*/
	public function lista_centros_educativos(){
		// DOC: Si es una petición por medio de AJAX y el párametro nombre_centro_educativo contiene algún valor,
		// entonces: obtener la lista de centros educativos que coicidan con la búsqueda del nombre de un centro educativo, si no: salir del método
		if($this->input->is_ajax_request() && $this->input->get_post('nombre_centro_educativo')){
			// DOC: Obtener el contenido del párametro nombre_centro_educativo
			$nombre_centro_educativo = $this->security->xss_clean($this->input->get_post('nombre_centro_educativo'));
			// DOC: Buscar los centros educativos que coicidan con el nombre del centro educativo de la búsqueda
			$centros_educativos = $this->centros_educativos_model->buscar_centro_educativo($nombre_centro_educativo);
			// DOC: Si se obtuvo una lista de centros educativos,
			// entonces: convertir a formato JSON la lista de centros educativos y enviarlo a la vista
			if($centros_educativos !== FALSE){
				echo json_encode($centros_educativos);
			}
		}
		exit;
	}
	
	/**
	* Método utilizado con AJAX desde la vista: plantilla_pagina_view
	* El método establece y devuelve el contenido de la variable de sesión del botón toggle del menú principal
	*/
	public function boton_menu(){
		// DOC: Si es una petición por medio de AJAX y el párametro boton_menu contiene algún valor,
		// entonces: obtener el contenido del párametro boton_menu, si no: salir del método
		if($this->input->is_ajax_request() && $this->input->get_post('boton_menu')){
			// DOC: Si el botón toggle del menú principal está activado,
			// entonces: establecer a TRUE la variable de sesión del botón toggle del menú principal,
			// si no: establecer a FALSE la variable de sesión del botón toggle del menú principal
			if($this->security->xss_clean($this->input->get_post('boton_menu')) == 'TRUE'){
				$this->session->set_userdata('boton_menu', TRUE);
			}
			else{
				$this->session->set_userdata('boton_menu', FALSE);
			}
			// DOC: Convertir a formato JSON el contenido de la variable de sesión del botón toggle del menú principal y enviarlo a la vista
			echo json_encode($this->session->userdata('boton_menu'));
		}
		exit;
	}
}

/* End of file ajax.php */
/* Location: ./application/controllers/ajax.php */