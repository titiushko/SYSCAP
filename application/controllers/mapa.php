<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapa extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('map');
		$this->load->model('mapa_model');
	}
	
	public function index(){
		$datos['pagina'] = 'mapa/consultar_mapa_view';
		$datos['usuario_actual'] = "&lt;nombre_usuario&gt;";
		$datos['opcion_menu'] = modulo_actual('modulo_mapa_estadistico');
		
		$configuracion = array();
		$configuracion['center'] = 'cojutepeque, cuscatlan';
		$configuracion['zoom'] = '9';
		$configuracion['map_type'] = 'ROADMAP';
		$configuracion['map_width'] = '890px';
		$configuracion['map_height'] = '600px';
		$this->map->initialize($configuracion);
		
		$coordenadas = $this->mapa_model->obtener_coordenadas();
		foreach($coordenadas as $informacion_coordenada){
			$coordenada = array();
			$coordenada['animation'] = 'DROP';
			$coordenada['position'] = $informacion_coordenada->longitud_mapa.', '.$informacion_coordenada->latitud_mapa;
			$coordenada['id'] = $informacion_coordenada->id_mapa;
			$this->map->add_marker($coordenada);
		}
		
		$datos['coordenadas'] = $this->mapa_model->obtener_coordenadas();
		$datos['mapa'] = $this->map->create_map();
		$this->load->view('plantilla_pagina_view', $datos);
	}
}

/* End of file mapa.php */
/* Location: ./application/controllers/mapa.php */