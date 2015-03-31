<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resumen_estadistico extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->eliminar_cache();
		if(isset($this->session->userdata['conexion_usuario'])){
			if($this->session->userdata['nombre_corto_rol'] == 'admin'){
				$this->load->model(array('resumen_estadistico_model', 'departamentos_model', 'municipios_model', 'centros_educativos_model'));
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
		$datos['pagina'] = 'estadisticas/resumen_estadistico_view';
		$datos['opcion_menu'] = modulo_actual('modulo_consultas_estadisticas');
		$datos['nombre_estadistica'] = 'Resumen Estad&iacute;stico';
		$datos['resultado_estadistico'] = FALSE;
		if($this->input->post()){
			if($this->input->post('fecha1') && $this->input->post('fecha2')){
				$this->form_validation->set_rules('fecha1', 'Fecha 1', 'trim|required');
				$this->form_validation->set_rules('fecha2', 'Fecha 2', 'trim|required');
				$this->form_validation->set_rules('fecha1', 'Fecha 1', 'callback_validar_fechas['.$this->input->post('fecha2').']');
				if($this->form_validation->run()){
					$datos = array_merge($this->datos_resumen_estadistico_view(
						$this->input->post('id_departamento'),
						$this->input->post('id_municipio'),
						$this->input->post('id_centro_educativo'),
						$this->input->post('tipo_capacitado'),
						$this->input->post('modalidad_usuario'),
						$this->input->post('grado_digital'),
						$this->input->post('fecha1'), $this->input->post('fecha2'),
						$this->input->post('sexo_usuario'),
						$this->input->post('busqueda'),
						'consulta'
					), $datos);
				}
				else{
					$datos = array_merge($this->datos_resumen_estadistico_view(), $datos);
				}
			}
			else{
				$datos = array_merge($this->datos_resumen_estadistico_view(
					$this->input->post('id_departamento'),
					$this->input->post('id_municipio'),
					$this->input->post('id_centro_educativo'),
					$this->input->post('tipo_capacitado'),
					$this->input->post('modalidad_usuario'),
					$this->input->post('grado_digital'),
					$this->input->post('fecha1'), $this->input->post('fecha2'),
					$this->input->post('sexo_usuario'),
					$this->input->post('busqueda'),
					'consulta'
				), $datos);
			}
		}
		else{
			$datos = array_merge($this->datos_resumen_estadistico_view(), $datos);
		}
		if(
			count($datos['tipo_capacitado_x_busqueda']) > 1 ||
			count($datos['modalidad_usuario_x_busqueda']) > 1 ||
			count($datos['grado_digital_x_busqueda']) > 1 ||
			count($datos['sexo_usuario_x_busqueda']) > 1
		) $datos['resultado_estadistico'] = TRUE;
		$busqueda = $this->input->post('busqueda') ? $this->input->post('busqueda') : 'nombre_departamento';
		$datos['notificaciones'] = array(
			mensaje_notificacion('myModalChart1', $datos['nombre_estadistica'].': Tipo de Capacitado por '.$datos['lista_busqueda'][$busqueda], '<div id="morris-bar-chart-estadistica1-2"></div>'),
			mensaje_notificacion('myModalChart2', $datos['nombre_estadistica'].': Modalidades de Capacitaci&oacute;n por '.$datos['lista_busqueda'][$busqueda], '<div id="morris-bar-chart-estadistica2-2"></div>'),
			mensaje_notificacion('myModalChart3', $datos['nombre_estadistica'].': Grado Digital por '.$datos['lista_busqueda'][$busqueda], '<div id="morris-bar-chart-estadistica3-2"></div>'),
			mensaje_notificacion('myModalChart4', $datos['nombre_estadistica'].': Sexo de Usuario por '.$datos['lista_busqueda'][$busqueda], '<div id="morris-bar-chart-estadistica4-2"></div>'),
			mensaje_notificacion(
				'myModalErrorReport',
				icono_notificacion('error').'Error Reporte de '.$datos['nombre_estadistica'],
				tag('p', 'No se puede generar el reporte estad&iacute;stico sin resultados.').br().tag('p', 'Por favor realice una consulta estad&iacute;stica o intente realizar otra consulta estad&iacute;stica con diferentes valores de b&uacute;squeda.')
			)
		);
		$datos['datos'] = $datos;
		$this->load->view('plantilla_pagina_view', $datos);
	}
	
	private function datos_resumen_estadistico_view(
		$codigo_departamento = '',
		$codigo_municipio = '',
		$codigo_centro_educativo = '',
		$tipo_capacitado = '',
		$modalidad_usuario = '',
		$grado_digital = '',
		$fecha1 = '', $fecha2 = '',
		$sexo_usuario = '',
		$busqueda = 'nombre_departamento',
		$metodo = 'consulta'
	){
		$datos['tipo_capacitado_x_busqueda'] = $this->resumen_estadistico_model->tipo_capacitado_x_busqueda(
			$codigo_departamento,
			$codigo_municipio,
			$codigo_centro_educativo,
			$tipo_capacitado,
			$modalidad_usuario,
			$grado_digital,
			$fecha1, $fecha2,
			$sexo_usuario,
			$busqueda
		);
		$indice = 1; $datos['tipo_capacitado_x_busqueda_json'] = '';
		foreach($datos['tipo_capacitado_x_busqueda'] as $resultado){
			if($resultado->nombre_campo != 'Total'){
				$datos['tipo_capacitado_x_busqueda_json'] .= '{y: \''.$indice++.'\', a: '.limpiar_nulo($resultado->capacitados).', b: '.limpiar_nulo($resultado->certificados).'},';
			}
		}
		//--
		$datos['modalidad_usuario_x_busqueda'] = $this->resumen_estadistico_model->modalidad_usuario_x_busqueda(
			$codigo_departamento,
			$codigo_municipio,
			$codigo_centro_educativo,
			$tipo_capacitado,
			$modalidad_usuario,
			$grado_digital,
			$fecha1, $fecha2,
			$sexo_usuario,
			$busqueda
		);
		$indice = 1; $datos['modalidad_usuario_x_busqueda_json'] = '';
		foreach($datos['modalidad_usuario_x_busqueda'] as $resultado){
			if($resultado->nombre_campo != 'Total'){
				$datos['modalidad_usuario_x_busqueda_json'] .= '{y: \''.$indice++.'\', a: '.limpiar_nulo($resultado->tutorizados).', b: '.limpiar_nulo($resultado->autoformacion).'},';
			}
		}
		//--
		$datos['grado_digital_x_busqueda'] = $this->resumen_estadistico_model->grado_digital_x_busqueda(
			$codigo_departamento,
			$codigo_municipio,
			$codigo_centro_educativo,
			$tipo_capacitado,
			$modalidad_usuario,
			$grado_digital,
			$fecha1, $fecha2,
			$sexo_usuario,
			$busqueda
		);
		$indice = 1; $datos['grado_digital_x_busqueda_json'] = '';
		foreach($datos['grado_digital_x_busqueda'] as $resultado){
			if($resultado->nombre_campo != 'Total'){
				$datos['grado_digital_x_busqueda_json'] .= '{y: \''.$indice++.'\', a: '.limpiar_nulo($resultado->uno).', b: '.limpiar_nulo($resultado->dos).', c: '.limpiar_nulo($resultado->tres).', d: '.limpiar_nulo($resultado->cuatro).'},';
			}
		}
		//--
		$datos['sexo_usuario_x_busqueda'] = $this->resumen_estadistico_model->sexo_usuario_x_busqueda(
			$codigo_departamento,
			$codigo_municipio,
			$codigo_centro_educativo,
			$tipo_capacitado,
			$modalidad_usuario,
			$grado_digital,
			$fecha1, $fecha2,
			$sexo_usuario,
			$busqueda
		);
		$indice = 1; $datos['sexo_usuario_x_busqueda_json'] = '';
		foreach($datos['sexo_usuario_x_busqueda'] as $resultado){
			if($resultado->nombre_campo != 'Total'){
				$datos['sexo_usuario_x_busqueda_json'] .= '{y: \''.$indice++.'\', a: '.limpiar_nulo($resultado->hombres).', b: '.limpiar_nulo($resultado->mujeres).'},';
			}
		}
		//--
		$datos['lista_departamentos'] = $this->departamentos_model->lista_departamentos();
		$datos['lista_municipios'] = $this->municipios_model->lista_municipios();
		$datos['lista_busqueda'] = array(
			'nombre_departamento'		=> 'Departamento',
			'nombre_municipio'			=> 'Municipio',
			'nombre_centro_educativo'	=> 'Centro Educativo',
			'tipo_capacitado'			=> 'Tipo de Capacitado',
			'modalidad_usuario'			=> 'Modalidad de Capacitaci&oacute;n',
			'grado_digital'				=> 'Grado Digital',
			'sexo_usuario'				=> 'Sexo de Usuario'
		);
		$nombre_centro_educativo = $codigo_centro_educativo != '' ? $this->centros_educativos_model->nombre_centro_educativo($codigo_centro_educativo) : '';
		if($metodo == 'consulta'){
			$datos['campos'] = array(
				'id_departamento' => $codigo_departamento,
				'id_municipio' => $codigo_municipio,
				'id_centro_educativo' => $codigo_centro_educativo,
				'nombre_centro_educativo' => $nombre_centro_educativo,
				'tipo_capacitado' => $tipo_capacitado,
				'modalidad_usuario' => $modalidad_usuario,
				'grado_digital' => $grado_digital,
				'fecha1' => $fecha1, 'fecha2' => $fecha2,
				'sexo_usuario' => $sexo_usuario,
				'busqueda' => $busqueda
			);
		}
		elseif($metodo == 'imprimir'){
			$datos['nombre_departamento'] = $codigo_departamento != '' ? $this->departamentos_model->nombre_departamento($codigo_departamento) : '';
			$datos['nombre_municipio'] = $codigo_municipio != '' ? $this->municipios_model->nombre_municipio($codigo_municipio) : '';
			$datos['nombre_centro_educativo'] = $nombre_centro_educativo;
			$datos['tipo_capacitado'] = $tipo_capacitado == 'capacitado' ? 'Capacitados' : ($tipo_capacitado == 'certificado' ? 'Certificados' : '');
			$datos['modalidad_usuario'] = $modalidad_usuario == 'tutorizado' ? 'Tutorizados' : ($modalidad_usuario == 'autoformacion' ? 'Autoformaci&oacute;n' : '');
			$datos['grado_digital'] = $grado_digital != '' ? 'Grado Digital '.$grado_digital : '';
			if($fecha1 != '' && $fecha2 != ''){
				$datos['periodo'] = 'Del '.date_format(new DateTime($fecha1), 'd/m/Y').' al '.date_format(new DateTime($fecha2), 'd/m/Y');
			}
			elseif($fecha1 != '' && $fecha2 == ''){
				$datos['periodo'] = 'Desde '.date_format(new DateTime($fecha1), 'd/m/Y');
			}
			elseif($fecha1 == '' && $fecha2 != ''){
				$datos['periodo'] = 'Hasta '.date_format(new DateTime($fecha2), 'd/m/Y');
			}
			$datos['sexo_usuario'] = $sexo_usuario == 'H' ? 'Hombres' : ($sexo_usuario == 'M' ? 'Mujeres' : '');
			$datos['busqueda'] = $busqueda;
		}
		return $datos;
	}
	
	/**/
	public function imprimir(){
		$datos = $this->datos_resumen_estadistico_view(
			$this->input->post('id_departamento_imprimir'),
			$this->input->post('id_municipio_imprimir'),
			$this->input->post('id_centro_educativo_imprimir'),
			$this->input->post('tipo_capacitado_imprimir'),
			$this->input->post('modalidad_usuario_imprimir'),
			$this->input->post('grado_digital_imprimir'),
			$this->input->post('fecha1_imprimir'), $this->input->post('fecha2_imprimir'),
			$this->input->post('sexo_usuario_imprimir'),
			$this->input->post('busqueda_imprimir'),
			'imprimir'
		);
		$this->load->view('estadisticas/imprimir_resumen_estadistico_view', $datos);
		//$this->load->library('excel');
		//$this->excel->setActiveSheetIndex(0);
		//$data = $this->resumen_estadistico_model->grado_digital_x_busqueda('', '', '', '', '', '', '', '', '', 'nombre_departamento', 'imprimir');
		//$this->excel->stream('name_of_file.xls', $data);
	}
	/**/
	
	public function validar_fechas($fecha1, $fecha2){
		$fecha1 = empty($fecha1) ? '0000-00-00' : $fecha1;
		$fecha2 = empty($fecha2) ? '0000-00-00' : $fecha2;
		$valores_fecha1 = explode('-', $fecha1);
		$valores_fecha2 = explode('-', $fecha2);
		$dia1 = $valores_fecha1[2];
		$mes1 = $valores_fecha1[1];
		$anyo1 = $valores_fecha1[0];
		$dia2 = $valores_fecha2[2];
		$mes2 = $valores_fecha2[1];
		$anyo2 = $valores_fecha2[0];
		$dias_fecha1 = gregoriantojd($mes1, $dia1, $anyo1);
		$dias_fecha2 = gregoriantojd($mes2, $dia2, $anyo2);
		if($dias_fecha1 == $dias_fecha2){
			$this->form_validation->set_message('validar_fechas', icono_notificacion('error').'El campo '.bold('%s').' no debe de ser igual al campo '.bold('Fecha 2').'.');
			return FALSE;
		}
		elseif($dias_fecha1 > $dias_fecha2){
			$this->form_validation->set_message('validar_fechas', icono_notificacion('error').'El campo '.bold('%s').' no puede ser mayor al campo '.bold('Fecha 2').'.');
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
}

/* End of file resumen_estadistico.php */
/* Location: ./application/controllers/resumen_estadistico.php */