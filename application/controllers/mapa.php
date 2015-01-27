<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapa extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('map');
		$this->load->model(array('mapa_model', 'departamentos_model', 'municipios_model'));
	}
	
	public function index(){
		$datos = $this->datos_consultar_mapa_view();
		$coordenadas = $this->mapa_model->coordenadas_departamentos();
		foreach($coordenadas as $informacion_coordenada){
			$coordenada = array();
			$coordenada['animation'] = 'DROP';
			$coordenada['position'] = $informacion_coordenada->longitud_mapa.', '.$informacion_coordenada->latitud_mapa;
			$coordenada['id'] = $informacion_coordenada->id_mapa;
			$coordenada['infowindow_content'] = $this->estadistica_departamento($informacion_coordenada->id_departamento);
			$this->map->add_marker($coordenada);
		}
		$datos['coordenadas'] = $coordenadas;
		$datos['mapa'] = $this->map->create_map();
		$datos['breadcrumbs'] = str_replace('<li>', '<li class="active">', ol(array('Departamentos'), 'class="breadcrumb"'));
		$this->load->view('plantilla_pagina_view', $datos);
	}
	
	private function estadistica_departamento($codigo_departamento){
		$estadistica_departamento = heading(utf8($this->departamentos_model->nombre_departamento($codigo_departamento)), 3).br();
		$cantidad_usuarios_departamento = $this->mapa_model->cantidad_usuarios_departamento($codigo_departamento);
		$estadistica_departamento .= bold('Usuarios Capacitados: ').$cantidad_usuarios_departamento->capacitados.br();
		$estadistica_departamento .= bold('Usuarios Certificados: ').$cantidad_usuarios_departamento->certificados.br();
		$estadistica_departamento .= bold('Total Usuarios: ').$cantidad_usuarios_departamento->total.br(2);
		$estadistica_departamento .= anchor('mapa/departamento/'.$codigo_departamento, 'Ver departamento.', '');
		return $estadistica_departamento;
	}
	
	public function departamento($codigo_departamento = NULL){
		$datos = $this->datos_consultar_mapa_view($this->mapa_model->coordenadas_departamento($codigo_departamento), '11');
		$coordenadas = $this->mapa_model->coordenadas_municipios($codigo_departamento);
		foreach($coordenadas as $informacion_coordenada){
			$coordenada = array();
			$coordenada['animation'] = 'DROP';
			$coordenada['position'] = $informacion_coordenada->longitud_mapa.', '.$informacion_coordenada->latitud_mapa;
			$coordenada['id'] = $informacion_coordenada->id_mapa;
			$coordenada['infowindow_content'] = $this->estadistica_municipio($informacion_coordenada->id_municipio);
			$this->map->add_marker($coordenada);
		}
		$datos['coordenadas'] = $coordenadas;
		$datos['mapa'] = $this->map->create_map();
		$datos['breadcrumbs'] = str_replace('<li>', '<li class="active">', ol(array(anchor('mapa', 'Departamentos'), 'Municipios'), 'class="breadcrumb"'));
		$this->load->view('plantilla_pagina_view', $datos);
	}
	
	private function estadistica_municipio($codigo_municipio){
		$estadistica_municipio = heading(utf8($this->municipios_model->nombre_municipio($codigo_municipio)), 3).br();
		$cantidad_usuarios_municipio = $this->mapa_model->cantidad_usuarios_municipio($codigo_municipio);
		$estadistica_municipio .= bold('Usuarios Capacitados: ').$cantidad_usuarios_municipio->capacitados.br();
		$estadistica_municipio .= bold('Usuarios Certificados: ').$cantidad_usuarios_municipio->certificados.br();
		$estadistica_municipio .= bold('Total Usuarios: ').$cantidad_usuarios_municipio->total.br(2);
		$estadistica_municipio .= anchor('mapa/municipio/'.$codigo_municipio, 'Ver municipio.', '');
		return $estadistica_municipio;
	}
	
	private function datos_consultar_mapa_view($coordenada = 'cojutepeque, cuscatlan', $zoom = '9'){
		$datos['pagina'] = 'mapa/consultar_mapa_view';
		$datos['usuario_actual'] = "&lt;nombre_usuario&gt;";
		$datos['opcion_menu'] = modulo_actual('modulo_mapa_estadistico');
		
		$configuracion = array();
		$configuracion['center'] = $coordenada;
		$configuracion['zoom'] = $zoom;
		$configuracion['map_type'] = 'ROADMAP';
		$configuracion['map_width'] = '100%';
		$configuracion['map_height'] = '600px';
		$this->map->initialize($configuracion);
		
		return $datos;
	}
}

/* End of file mapa.php */
/* Location: ./application/controllers/mapa.php */