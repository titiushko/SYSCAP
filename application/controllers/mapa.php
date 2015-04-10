<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Genera el mapa estadístico utilizando la API de Google Mpas
*/
class Mapa extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->eliminar_cache();
		// DOC: Si hay una conexión de usuario, entonces: permitir acceso al controlador, si no: no permitir acceso al controlador y mostrar el error de acceso
		if(isset($this->session->userdata['conexion_usuario'])){
			// DOC: Si la conexión de usuario no es administrador, entonces: mostrar el error de acceso
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
	
	/**
	* Método default del controlador, genera la capa de primer nivel del mapa estadístico
	*/
	public function index(){
		// DOC: Obtener de la base de datos las coordenadas de los departamentos
		$coordenadas = $this->mapas_model->coordenadas_departamentos();
		// DOC: Obtener los datos en común de todas las vistas que se generan del mapa estadístico, enviando como parámetro:
		// - coordenada de EL Salvador para centrar el mapa
		// - zoom del mapa de 9
		// - coordenadas de los departamentos
		// - generar el breadcrumb: El Salvador /
		$datos = $this->datos_consultar_mapa_view('13.802994, -88.9053364', '9', $coordenadas, array('El Salvador'));
		// DOC: Agregar al mapa la información del marcador de la coordenada de cada departamento
		foreach($coordenadas as $informacion_coordenada){
			$coordenada = array();
			$coordenada['animation'] = 'DROP';
			// DOC: Coordenada del marcador
			$coordenada['position'] = $informacion_coordenada->longitud_mapa.', '.$informacion_coordenada->latitud_mapa;
			// DOC: Identificador del marcador
			$coordenada['id'] = $informacion_coordenada->id_mapa;
			// DOC: Información del marcador
			$coordenada['infowindow_content'] = $this->estadistica_departamento($informacion_coordenada->id_departamento);
			// DOC: Agregar marcador al mapa
			$this->map->add_marker($coordenada);
		}
		// DOC: Crear el mapa
		$datos['mapa'] = $this->map->create_map();
		// DOC: Enviar el mapa creado a la vista del módulo de mapa estadístico
		$this->load->view('plantilla_pagina_view', $datos);
	}
	
	/**
	* Método para generar la información del marcador de la coordenada de cada departamento
	*/
	private function estadistica_departamento($codigo_departamento){
		// DOC: Título del marcador
		$estadistica_departamento = heading(utf8($this->departamentos_model->nombre_departamento($codigo_departamento)), 3).br();
		$estadistica_departamento .= heading('Cantidad de Docentes', 4).br();
		// DOC: Generar la tabla con la consulta estadística de docentes por departamento
		$estadistica_departamento .= $this->tabla($this->mapas_model->cantidad_usuarios_departamento($codigo_departamento)).br();
		// DOC: Crear enlace para avanzar a la capa de segundo nivel del mapa estadístico
		$estadistica_departamento .= anchor('mapa/departamento/'.$codigo_departamento, 'Ver departamento.', '');
		return $estadistica_departamento;
	}
	
	/**
	* Método que genera la capa de segundo nivel del mapa estadístico
	*/
	public function departamento($codigo_departamento = NULL){
		// DOC: Obtener de la base de datos las coordenadas de los municipios
		$coordenadas = $this->mapas_model->coordenadas_municipios($codigo_departamento);
		// DOC: Si el parámetro que se resibe de la URI es un código de departamento válido,
		// entonces: permitir generar la capa de segundo nivel del mapa estadístico, si no: mostrar el mensaje de error
		if($this->validar_parametros($codigo_departamento)){
			// DOC: Agregar al mapa la información del marcador de la coordenada de cada municipio
			foreach($coordenadas as $informacion_coordenada){
				$coordenada = array();
				$coordenada['animation'] = 'DROP';
				$coordenada['position'] = $informacion_coordenada->longitud_mapa.', '.$informacion_coordenada->latitud_mapa;
				$coordenada['id'] = $informacion_coordenada->id_mapa;
				$coordenada['infowindow_content'] = $this->estadistica_municipio($codigo_departamento, $informacion_coordenada->id_municipio);
				$this->map->add_marker($coordenada);
			}
			// DOC: Obtener los datos en común de todas las vistas que se generan del mapa estadístico, enviando como parámetro:
			// - coordenada del departamento seleccionado para centrar el mapa
			// - zoom del mapa de 12
			// - coordenadas de los municipios
			// - generar el breadcrumb: El Salvador / Nombre Departamento /
			$datos = $this->datos_consultar_mapa_view($this->mapas_model->coordenadas_departamento($codigo_departamento), '12', $coordenadas, array('El Salvador', $codigo_departamento));
			$datos['mapa'] = $this->map->create_map();
			$this->load->view('plantilla_pagina_view', $datos);
		}
		else{
			$this->error_404(current_url(), utf8($this->session->userdata('nombre_completo_usuario')), utf8($this->session->userdata('nombre_completo_rol')), $this->session->userdata('nombre_corto_rol'));
		}
	}
	
	/**
	* Método para generar la información del marcador de la coordenada de cada municipio
	*/
	private function estadistica_municipio($codigo_departamento, $codigo_municipio){
		// DOC: Título del marcador
		$estadistica_municipio = heading(utf8($this->municipios_model->nombre_municipio($codigo_municipio)), 3).br();
		$estadistica_municipio .= heading('Cantidad de Docentes', 4).br();
		// DOC: Generar la tabla con la consulta estadística de docentes por municipio
		$estadistica_municipio .= $this->tabla($this->mapas_model->cantidad_usuarios_municipio($codigo_municipio)).br();
		// DOC: Crear enlace para avanzar a la capa de tercer nivel del mapa estadístico
		$estadistica_municipio .= anchor('mapa/municipio/'.$codigo_departamento.'/'.$codigo_municipio, 'Ver municipio.', '');
		return $estadistica_municipio;
	}
	
	/**
	* Método que genera la capa de tercer nivel del mapa estadístico
	*/
	public function municipio($codigo_departamento = NULL, $codigo_municipio = NULL){
		// DOC: Obtener de la base de datos las coordenadas de los centros educativos
		$coordenadas = $this->mapas_model->coordenadas_centros_educativos($codigo_municipio);
		// DOC: Si los parámetros que se resiben de la URI son un código de departamento válido y un código de municipio válido,
		// entonces: permitir generar la capa de tercer nivel del mapa estadístico, si no: mostrar el mensaje de error
		if($this->validar_parametros($codigo_departamento, $codigo_municipio)){
			// DOC: Agregar al mapa la información del marcador de la coordenada de cada centro educativo
			foreach($coordenadas as $informacion_coordenada){
				$coordenada = array();
				$coordenada['animation'] = 'DROP';
				$coordenada['position'] = $informacion_coordenada->longitud_mapa.', '.$informacion_coordenada->latitud_mapa;
				$coordenada['id'] = $informacion_coordenada->id_mapa;
				$coordenada['infowindow_content'] = $this->estadistica_centro_educativo($informacion_coordenada->id_centro_educativo);
				$this->map->add_marker($coordenada);
			}
			// DOC: Obtener los datos en común de todas las vistas que se generan del mapa estadístico, enviando como parámetro:
			// - coordenada del municipio seleccionado para centrar el mapa
			// - zoom del mapa de 15
			// - coordenadas de los centros educativos
			// - generar el breadcrumb: El Salvador / Nombre Departamento / Nombre Municipio
			$datos = $this->datos_consultar_mapa_view($this->mapas_model->coordenadas_municipio($codigo_municipio, $codigo_departamento), '15', $coordenadas, array('El Salvador', $codigo_departamento, $codigo_municipio));
			$datos['mapa'] = $this->map->create_map();
			$this->load->view('plantilla_pagina_view', $datos);
		}
		else{
			$this->error_404(current_url(), utf8($this->session->userdata('nombre_completo_usuario')), utf8($this->session->userdata('nombre_completo_rol')), $this->session->userdata('nombre_corto_rol'));
		}
	}
	
	/**
	* Método para generar la información del marcador de la coordenada de cada centro educativo
	*/
	private function estadistica_centro_educativo($codigo_centro_educativo){
		// DOC: Título del marcador
		$estadistica_centro_educativo = heading(utf8($this->centros_educativos_model->nombre_centro_educativo($codigo_centro_educativo)), 3).br();
		$estadistica_centro_educativo .= heading('Cantidad de Docentes', 4).br();
		// DOC: Generar la tabla con la consulta estadística de docentes por centro educativo
		$estadistica_centro_educativo .= $this->tabla($this->mapas_model->cantidad_usuarios_centro_educativo($codigo_centro_educativo)).br();
		// DOC: Crear enlace para avanzar al módulo de centros educativos
		$estadistica_centro_educativo .= anchor('centros_educativos/mostrar/'.$codigo_centro_educativo, 'Ver centro educativo.', '');
		return $estadistica_centro_educativo;
	}
	
	/**
	* Método que devuelve los datos en común de todas las vistas que se generan del mapa estadístico
	*/
	private function datos_consultar_mapa_view($centro, $zoom, $coordenadas, $breadcrumbs){
		// DOC: Seleccionar la vista que se va a cargar
		$datos['pagina'] = 'mapa/consultar_mapa_view';
		// DOC: Seleccionar la opción del menú
		$datos['opcion_menu'] = modulo_actual('modulo_mapa_estadistico');
		// DOC: Hacer zoom al mapa
		$datos['zoom'] = $zoom + 3;
		// DOC: Lista de coordenadas de los marcadores que se van a mostrar en el mapa
		$datos['coordenadas'] = $coordenadas;
		// DOC: Generar el breadcrumb de cada nivel de las capas del mapa estadístico
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
		// DOC: Establecer la configuración del API de Google Mpas
		$configuracion = array();
		$configuracion['center'] = $centro;
		$configuracion['zoom'] = $zoom;
		$configuracion['map_type'] = 'ROADMAP';
		$configuracion['map_width'] = '100%';
		$configuracion['map_height'] = '600px';
		// DOC: Inicializar la configuración del API de Google Mpas
		$this->map->initialize($configuracion);
		return $datos;
	}
	
	/**
	* Método que devuelve la tabla con la consulta estadística de docentes por cada nivel de las capas del mapa estadístico
	*/
	private function tabla($cantidad_usuarios){
		$total = 0;
		$html = '<table border="1"><thead><tr><th>Tipo de Capacitado</th><th>Tutorizados</th></tr></thead><tbody>';
		foreach($cantidad_usuarios as $cantidad){
			$html .= '<tr><th>'.utf8($cantidad->tipos_capacitados).'</th><td>'.number_format(limpiar_nulo($cantidad->tutorizados), 0, '', ',').'</td></tr>';
			$total += $cantidad->tutorizados;
		}
		$html .= '<tr><th>'.bold('Total').'</th><td>'.bold(number_format(limpiar_nulo($total), 0, '', ',')).'</td></tr>';
		$html .= '</tbody></table>';
		return $html;
	}
	
	/**
	* Método que comprueba que sean válidos los parámetros que se resiben de la URI
	* El método devuelve TRUE si son parámetros válidos, de lo contrario el método devuelve FALSE
	* El método comprueba las siguientes validaciones:
	* - código del departamento:
	* 	- no debe de ser nulo o vacío
	* 	- debe de ser un número entre el 1 y el 14
	* - código del municipio:
	* 	- no debe de ser nulo o vacío
	* 	- debe de ser un número entre el 1 y el 262
	* 	- debe de pertenecer al código del departamento correcto
	*/
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