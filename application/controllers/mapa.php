<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapa extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->eliminar_cache();
		if(isset($this->session->userdata['conexion_usuario'])){
			if($this->session->userdata['nombre_corto_rol'] == 'admin'){
				$this->load->library('map');
				$this->load->model(array('mapas_model', 'departamentos_model', 'municipios_model', 'centros_educativos_model'));
			}
			else{
				$this->acceso_denegado('sin_permiso', utf8($this->session->userdata('nombre_completo_usuario')), utf8($this->session->userdata('nombre_completo_rol')));
			}
		}
		else{
			$this->acceso_denegado('sin_conexion');
		}
	}
	
	public function index(){
		$coordenadas = $this->mapas_model->coordenadas_departamentos();
		$datos = $this->datos_consultar_mapa_view('13.802994, -88.9053364', 9, $coordenadas, array('El Salvador'));
		foreach($coordenadas as $informacion_coordenada){
			$coordenada = array();
			$coordenada['animation'] = 'DROP';
			$coordenada['position'] = $informacion_coordenada->longitud_mapa.', '.$informacion_coordenada->latitud_mapa;
			$coordenada['id'] = $informacion_coordenada->id_mapa;
			$coordenada['infowindow_content'] = $this->estadistica_departamento($informacion_coordenada->id_departamento);
			$this->map->add_marker($coordenada);
		}
		$datos['mapa'] = $this->map->create_map();
		$this->load->view('plantilla_pagina_view', $datos);
	}
	
	private function estadistica_departamento($codigo_departamento){
		$estadistica_departamento = heading(utf8($this->departamentos_model->nombre_departamento($codigo_departamento)), 3).br();
		$estadistica_departamento .= heading('Cantidad de Docentes', 4).br();
		$estadistica_departamento .= $this->tabla($this->mapas_model->cantidad_usuarios_departamento($codigo_departamento)).br();
		$estadistica_departamento .= anchor('mapa/departamento/'.$codigo_departamento, 'Ver departamento.', '');
		return $estadistica_departamento;
	}
	
	public function departamento($codigo_departamento = NULL){
		$coordenadas = $this->mapas_model->coordenadas_municipios($codigo_departamento);
		if($this->validar_parametros($codigo_departamento)){
			foreach($coordenadas as $informacion_coordenada){
				$coordenada = array();
				$coordenada['animation'] = 'DROP';
				$coordenada['position'] = $informacion_coordenada->longitud_mapa.', '.$informacion_coordenada->latitud_mapa;
				$coordenada['id'] = $informacion_coordenada->id_mapa;
				$coordenada['infowindow_content'] = $this->estadistica_municipio($codigo_departamento, $informacion_coordenada->id_municipio);
				$this->map->add_marker($coordenada);
			}
			$datos = $this->datos_consultar_mapa_view($this->mapas_model->coordenadas_departamento($codigo_departamento), '12', $coordenadas, array('El Salvador', $codigo_departamento));
			$datos['mapa'] = $this->map->create_map();
			$this->load->view('plantilla_pagina_view', $datos);
		}
		else{
			show_404(current_url(), TRUE, utf8($this->session->userdata('nombre_completo_usuario')), utf8($this->session->userdata('nombre_completo_rol')), $this->session->userdata('nombre_corto_rol'));
		}
	}
	
	private function estadistica_municipio($codigo_departamento, $codigo_municipio){
		$estadistica_municipio = heading(utf8($this->municipios_model->nombre_municipio($codigo_municipio)), 3).br();
		$estadistica_municipio .= heading('Cantidad de Docentes', 4).br();
		$estadistica_municipio .= $this->tabla($this->mapas_model->cantidad_usuarios_municipio($codigo_municipio)).br();
		$estadistica_municipio .= anchor('mapa/municipio/'.$codigo_departamento.'/'.$codigo_municipio, 'Ver municipio.', '');
		return $estadistica_municipio;
	}
	
	public function municipio($codigo_departamento = NULL, $codigo_municipio = NULL){
		$coordenadas = $this->mapas_model->coordenadas_centros_educativos($codigo_municipio);
		if($this->validar_parametros($codigo_departamento, $codigo_municipio)){
			foreach($coordenadas as $informacion_coordenada){
				$coordenada = array();
				$coordenada['animation'] = 'DROP';
				$coordenada['position'] = $informacion_coordenada->longitud_mapa.', '.$informacion_coordenada->latitud_mapa;
				$coordenada['id'] = $informacion_coordenada->id_mapa;
				$coordenada['infowindow_content'] = $this->estadistica_centro_educativo($informacion_coordenada->id_centro_educativo);
				$this->map->add_marker($coordenada);
			}
			$datos = $this->datos_consultar_mapa_view($this->mapas_model->coordenadas_municipio($codigo_municipio, $codigo_departamento), '15', $coordenadas, array('El Salvador', $codigo_departamento, $codigo_municipio));
			$datos['mapa'] = $this->map->create_map();
			$this->load->view('plantilla_pagina_view', $datos);
		}
		else{
			show_404(current_url(), TRUE, utf8($this->session->userdata('nombre_completo_usuario')), utf8($this->session->userdata('nombre_completo_rol')), $this->session->userdata('nombre_corto_rol'));
		}
	}
	
	private function estadistica_centro_educativo($codigo_centro_educativo){
		$estadistica_centro_educativo = heading(utf8($this->centros_educativos_model->nombre_centro_educativo($codigo_centro_educativo)), 3).br();
		$estadistica_centro_educativo .= heading('Cantidad de Docentes', 4).br();
		$estadistica_centro_educativo .= $this->tabla($this->mapas_model->cantidad_usuarios_centro_educativo($codigo_centro_educativo)).br();
		$estadistica_centro_educativo .= anchor('centros_educativos/mostrar/'.$codigo_centro_educativo, 'Ver centro educativo.', '');
		return $estadistica_centro_educativo;
	}
	
	private function datos_consultar_mapa_view($centro, $zoom, $coordenadas, $breadcrumbs){
		$datos['pagina'] = 'mapa/consultar_mapa_view';
		$datos['opcion_menu'] = modulo_actual('modulo_mapa_estadistico');
		$datos['zoom'] = $zoom + 3;
		$datos['coordenadas'] = $coordenadas;
		switch(count($breadcrumbs)){
			case 1:
				$datos['breadcrumbs'] = str_replace('<li>', '<li class="active">', ol(array($breadcrumbs[0]), 'class="breadcrumb"'));
				break;
			case 2:
				$datos['breadcrumbs'] = str_replace('<li>', '<li class="active">', ol(array(anchor('mapa', $breadcrumbs[0]), utf8($this->departamentos_model->nombre_departamento($breadcrumbs[1]))), 'class="breadcrumb"'));
				break;
			case 3:
				$datos['breadcrumbs'] = str_replace('<li>', '<li class="active">', ol(array(anchor('mapa', $breadcrumbs[0]), anchor('mapa/departamento/'.$breadcrumbs[1], utf8($this->departamentos_model->nombre_departamento($breadcrumbs[1]))), utf8($this->municipios_model->nombre_municipio($breadcrumbs[2]))), 'class="breadcrumb"'));
				break;
		}
		$configuracion = array();
		$configuracion['center'] = $centro;
		$configuracion['zoom'] = $zoom;
		$configuracion['map_type'] = 'ROADMAP';
		$configuracion['map_width'] = '100%';
		$configuracion['map_height'] = '600px';
		$this->map->initialize($configuracion);
		return $datos;
	}
	
	private function tabla($cantidad_usuarios){
		$html = '<table border="1"><thead><tr><th></th><th colspan="2">Modalidad de Capacitaci&oacute;n</th></tr><tr><th rowspan="2">Tipo de Capacitado</th><th>Tutorizados</th><th>Autoformaci&oacute;n</th></tr></thead><tbody>';
		foreach($cantidad_usuarios as $cantidad){
			if($cantidad->tipos_capacitados != 'TOTAL'){
				$html .= '<tr><th>'.utf8($cantidad->tipos_capacitados).'</th><td>'.limpiar_nulo($cantidad->tutorizados).'</td><td>'.limpiar_nulo($cantidad->autoformacion).'</td></tr>';
			}
			else{
				$html .= '<tr><th>'.bold(utf8($cantidad->tipos_capacitados)).'</th><td>'.bold(limpiar_nulo($cantidad->tutorizados)).'</td><td>'.bold(limpiar_nulo($cantidad->autoformacion)).'</td></tr>';
			}
		}
		$html .= '</tbody></table>';
		return $html;
	}
	
	private function validar_parametros($codigo_departamento, $codigo_municipio = FALSE){
		if(!$codigo_municipio){
			$opcional = $codigo_municipio;
			$codigo_municipio = '01';
		}
		else{
			$opcional = TRUE;
		}
		if(!empty($codigo_departamento) && ($codigo_departamento >= 1 && $codigo_departamento <= 14) && !empty($codigo_municipio) && ($codigo_municipio >= 1 && $codigo_municipio <= 262)){
			if($opcional){
				$validar_municipio = $this->municipios_model->validar_municipio($codigo_municipio, $codigo_departamento);
				if(!empty($validar_municipio)){
					return TRUE;
				}
				else{
					return FALSE;
				}
			}
			else{
				return TRUE;
			}
		}
		else{
			return FALSE;
		}
	}
}

/* End of file mapa.php */
/* Location: ./application/controllers/mapa.php */