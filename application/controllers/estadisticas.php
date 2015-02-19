<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estadisticas extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->eliminar_cache();
		if(isset($this->session->userdata['conexion_usuario'])){
			if($this->session->userdata['nombre_corto_rol'] == 'admin'){
				$this->load->model(array('estadisticas_model', 'departamentos_model', 'municipios_model', 'centros_educativos_model'));
			}
			else{
				$this->acceso_denegado('sin_permiso', utf8($this->session->userdata('nombre_completo_usuario')));
			}
		}
		else{
			$this->acceso_denegado('sin_conexion');
		}
	}
	
	public function consulta($opcion = 1){
		$datos['pagina'] = 'estadisticas/consultar_estadisticas_view';
		$datos['opcion_menu'] = modulo_actual('modulo_consultas_estadisticas');
		if($this->validar_parametros($opcion)){
			$datos['nombre_estadistica'] = listado_estadisticas($opcion);
			$datos['estadistica'] = array($opcion => 'active');
			$datos['id_modal'] = 'myModalChart';
			$datos['titulo_notificacion'] = 'Estad&iacute;stica de '.$datos['nombre_estadistica'];
			$datos['mensaje_notificacion'] = '<div id="morris-bar-chart-estadistica'.$opcion.'-2"></div>';
			switch($opcion){
				case 1: // Usuarios por Modalidad de Capacitación
					if($this->input->post()){
						$this->form_validation->set_rules('fecha1', 'Fecha 1', 'trim|required');
						$this->form_validation->set_rules('fecha2', 'Fecha 2', 'trim|required');
						$this->form_validation->set_rules('fecha1', 'Fecha 1', 'callback_validar_fechas['.$this->input->post('fecha2').']');
						if($this->form_validation->run()){
							$datos = array_merge($this->datos_estadistica_01_view($this->input->post('fecha1'), $this->input->post('fecha2'), 'consulta'), $datos);
						}
						else{
							$datos = array_merge($this->datos_estadistica_01_view(), $datos);
						}
					}
					else{
						$datos = array_merge($this->datos_estadistica_01_view(), $datos);
					}
					break;
				case 2: // Usuarios por Departamento y Rango de Fechas
					if($this->input->post()){
						$this->form_validation->set_rules('id_departamento', 'Departamento', 'trim|required');
						$this->form_validation->set_rules('fecha1', 'Fecha 1', 'trim|required');
						$this->form_validation->set_rules('fecha2', 'Fecha 2', 'trim|required');
						$this->form_validation->set_rules('fecha1', 'Fecha 1', 'callback_validar_fechas['.$this->input->post('fecha2').']');
						if($this->form_validation->run()){
							$datos = array_merge($this->datos_estadistica_02_view($this->input->post('id_departamento'), $this->input->post('fecha1'), $this->input->post('fecha2'), 'consulta'), $datos);
						}
						else{
							$datos = array_merge($this->datos_estadistica_02_view(), $datos);
						}
					}
					else{
						$datos = array_merge($this->datos_estadistica_02_view(), $datos);
					}
					break;
				case 3: // Total de Usuarios por Departamento y Rango de Fechas
					if($this->input->post()){
						$this->form_validation->set_rules('fecha1', 'Fecha 1', 'trim|required');
						$this->form_validation->set_rules('fecha2', 'Fecha 2', 'trim|required');
						$this->form_validation->set_rules('fecha1', 'Fecha 1', 'callback_validar_fechas['.$this->input->post('fecha2').']');
						if($this->form_validation->run()){
							$datos = array_merge($this->datos_estadistica_03_view($this->input->post('fecha1'), $this->input->post('fecha2'), 'consulta'), $datos);
						}
						else{
							$datos = array_merge($this->datos_estadistica_03_view(), $datos);
						}
					}
					else{
						$datos = array_merge($this->datos_estadistica_03_view(), $datos);
					}
					break;
				case 4: // Usuarios por Departamento, Municipio y Rango de Fechas
					if($this->input->post()){
						$this->form_validation->set_rules('id_departamento', 'Departamento', 'trim|required');
						$this->form_validation->set_rules('id_municipio', 'Municipio', 'trim|required');
						$this->form_validation->set_rules('fecha1', 'Fecha 1', 'trim|required');
						$this->form_validation->set_rules('fecha2', 'Fecha 2', 'trim|required');
						$this->form_validation->set_rules('fecha1', 'Fecha 1', 'callback_validar_fechas['.$this->input->post('fecha2').']');
						if($this->form_validation->run()){
							$datos = array_merge($this->datos_estadistica_04_view($this->input->post('id_departamento'), $this->input->post('id_municipio'), $this->input->post('fecha1'), $this->input->post('fecha2'), 'consulta'), $datos);
						}
						else{
							$datos = array_merge($this->datos_estadistica_04_view(), $datos);
						}
					}
					else{
						$datos = array_merge($this->datos_estadistica_04_view(), $datos);
					}
					break;
				case 5: // Usuarios por Tipo de Capacitados y Fecha a Nivel Nacional
					break;
				case 6: // Usuarios por Tipo de Capacitados, Departamento y Fecha
					if($this->input->post()){
						$this->form_validation->set_rules('tipo_capacitado', 'Tipo de Capacitado', 'trim|required');
						$this->form_validation->set_rules('id_departamento', 'Departamento', 'trim|required');
						$this->form_validation->set_rules('fecha1', 'Fecha 1', 'trim|required');
						$this->form_validation->set_rules('fecha2', 'Fecha 2', 'trim|required');
						$this->form_validation->set_rules('fecha1', 'Fecha 1', 'callback_validar_fechas['.$this->input->post('fecha2').']');
						if($this->form_validation->run()){
							$datos = array_merge($this->datos_estadistica_06_view($this->input->post('tipo_capacitado'), $this->input->post('id_departamento'), $this->input->post('fecha1'), $this->input->post('fecha2'), 'consulta'), $datos);
						}
						else{
							$datos = array_merge($this->datos_estadistica_06_view(), $datos);
						}
					}
					else{
						$datos = array_merge($this->datos_estadistica_06_view(), $datos);
					}
					break;
				case 7: // Usuarios por Tipo de Capacitados, Departamento y Municipio
					if($this->input->post()){
						$this->form_validation->set_rules('tipo_capacitado', 'Tipo de Capacitado', 'trim|required');
						$this->form_validation->set_rules('id_departamento', 'Departamento', 'trim|required');
						$this->form_validation->set_rules('id_municipio', 'Municipio', 'trim|required');
						$this->form_validation->set_rules('fecha1', 'Fecha 1', 'trim|required');
						$this->form_validation->set_rules('fecha2', 'Fecha 2', 'trim|required');
						$this->form_validation->set_rules('fecha1', 'Fecha 1', 'callback_validar_fechas['.$this->input->post('fecha2').']');
						if($this->form_validation->run()){
							$datos = array_merge($this->datos_estadistica_04_view($this->input->post('id_departamento'), $this->input->post('id_municipio'), $this->input->post('fecha1'), $this->input->post('fecha2'), 'consulta', $this->input->post('tipo_capacitado')), $datos);
						}
						else{
							$datos = array_merge($this->datos_estadistica_04_view(), $datos);
						}
					}
					else{
						$datos = array_merge($this->datos_estadistica_04_view(), $datos);
					}
					break;
				case 8: // Usuarios por Departamento, Tipo de Capacitados y Fecha
					if($this->input->post()){
						$this->form_validation->set_rules('tipo_capacitado', 'Tipo de Capacitado', 'trim|required');
						$this->form_validation->set_rules('fecha1', 'Fecha 1', 'trim|required');
						$this->form_validation->set_rules('fecha2', 'Fecha 2', 'trim|required');
						$this->form_validation->set_rules('fecha1', 'Fecha 1', 'callback_validar_fechas['.$this->input->post('fecha2').']');
						if($this->form_validation->run()){
							$datos = array_merge($this->datos_estadistica_03_view($this->input->post('fecha1'), $this->input->post('fecha2'), 'consulta', $this->input->post('tipo_capacitado')), $datos);
						}
						else{
							$datos = array_merge($this->datos_estadistica_03_view(), $datos);
						}
					}
					else{
						$datos = array_merge($this->datos_estadistica_03_view(), $datos);
					}
					break;
				case 9: // Usuarios por Tipo de Capacitados y Centro Educativo
					if($this->input->post()){
						$this->form_validation->set_rules('tipo_capacitado', 'Tipo de Capacitado', 'trim|required');
						$this->form_validation->set_rules('id_centro_educativo', 'Centro Educativo', 'trim|required');
						if($this->form_validation->run()){
							$datos = array_merge($this->datos_estadistica_09_view($this->input->post('tipo_capacitado'), $this->input->post('id_centro_educativo'), 'consulta'), $datos);
						}
						else{
							$datos = array_merge($this->datos_estadistica_09_view(), $datos);
						}
					}
					else{
						$datos = array_merge($this->datos_estadistica_09_view(), $datos);
					}
					break;
				case 10: // Usuarios a Nivel Nacional
					$datos['lista_departamentos'] = $this->departamentos_model->lista_departamentos();
					$datos['lista_municipios'] = $this->municipios_model->lista_municipios();
					//$datos['certificados'] = $this->estadisticas_model->usuarios_nivel_nacional('certificados');
					//$datos['capacitados'] = $this->estadisticas_model->usuarios_nivel_nacional('capacitados');
					//$datos['total'] = $this->estadisticas_model->usuarios_nivel_nacional('total');
					$datos['lista_tipo_capacitados'] =  array(
						'Evaluacion' => 'Capacitados',
						'Examen' => 'Certificados'
						);
					/*
					$datos['grafica_json'] = '';
					$centroseducativos = 1;
					foreach($datos['grafica'] as $data){
						$datos['grafica_json'] = $datos['grafica_json'].'{y: \''.($centroseducativos++).'\', a: '.$data->capacitados.', b: '.$data->certificados.'},';
					}
					*/
					/*
					$datos['id_modal'] = 'myModalChart';
					$datos['titulo_notificacion'] = 'Estad&iacute;stica de '.$datos['nombre_estadistica'];
					$datos['mensaje_notificacion'] = '<div id="morris-bar-chart-estadistica10-2"></div>';
					*/
					break;
				case 11: // Usuarios por Grado Digital
			}
			$datos['datos'] = $datos;
			$this->load->view('plantilla_pagina_view', $datos);
		}
		else{
			show_404(current_url(), utf8($this->session->userdata('nombre_completo_usuario')));
		}
	}
	
	private function datos_estadistica_01_view($fecha1 = '', $fecha2 = '', $metodo = 'consulta'){
		$datos['modalidades_capacitados'] = $this->estadisticas_model->modalidades_capacitados($fecha1, $fecha2);
		$datos['modalidades_capacitados_json'] = '';
		foreach($datos['modalidades_capacitados'] as $modalidad_capacitado){
			if($modalidad_capacitado->tipos_capacitados != 'TOTAL'){
				$datos['modalidades_capacitados_json'] .= '{y: \''.$modalidad_capacitado->tipos_capacitados.'\', a: '.$modalidad_capacitado->tutorizados.', b: '.$modalidad_capacitado->autoformacion.'},';
			}
		}
		if($metodo == 'consulta'){
			$datos['campos'] = array('fecha1' => $fecha1, 'fecha2' => $fecha2);
		}
		elseif($metodo == 'imprimir'){
			$datos['periodo'] = $fecha1 != '' && $fecha2 != '' ? 'Del '.date_format(new DateTime($fecha1), 'd/m/Y').' al '.date_format(new DateTime($fecha2), 'd/m/Y') : '';
		}
		return $datos;
	}
	
	private function datos_estadistica_02_view($codigo_departamento = '', $fecha1 = '', $fecha2 = '', $metodo = 'consulta'){
		$datos['cantidad_usuarios_municipio'] = $this->estadisticas_model->cantidad_usuarios_municipio($codigo_departamento, $fecha1, $fecha2);
		$municipios = 1; $datos['cantidad_usuarios_municipio_json'] = '';
		foreach($datos['cantidad_usuarios_municipio'] as $cantidad_municipio){
			if($cantidad_municipio->nombre_municipio != 'TOTAL'){
				$datos['cantidad_usuarios_municipio_json'] .= '{y: \''.$municipios++.'\', a: '.$cantidad_municipio->capacitados.', b: '.$cantidad_municipio->certificados.'},';
			}
		}
		$datos['usuarios_municipio'] = $this->estadisticas_model->usuarios_municipio($codigo_departamento, $fecha1, $fecha2);
		$datos['lista_departamentos'] = $this->departamentos_model->lista_departamentos();
		if($metodo == 'consulta'){
			$datos['campos'] = array('id_departamento' => $codigo_departamento, 'fecha1' => $fecha1, 'fecha2' => $fecha2);
		}
		elseif($metodo == 'imprimir'){
			$datos['nombre_departamento'] = $codigo_departamento != '' ? $this->departamentos_model->nombre_departamento($codigo_departamento) : '';
			$datos['periodo'] = $fecha1 != '' && $fecha2 != '' ? 'Del '.date_format(new DateTime($fecha1), 'd/m/Y').' al '.date_format(new DateTime($fecha2), 'd/m/Y') : '';
		}
		return $datos;
	}
	
	private function datos_estadistica_03_view($fecha1 = '', $fecha2 = '', $metodo = 'consulta', $tipo_capacitado = ''){
		$datos['estaditicas_departamento_fechas'] = $this->estadisticas_model->estaditicas_departamento_fechas($fecha1, $fecha2, $tipo_capacitado);
		$datos['estaditicas_departamento_fechas_json'] = '';
		foreach($datos['estaditicas_departamento_fechas'] as $estaditica_departamento_fecha){
			$datos['estaditicas_departamento_fechas_json'] .= '{y: \''.$estaditica_departamento_fecha->indice.'\', a: \''.$estaditica_departamento_fecha->capacitados.'\', b: \''.$estaditica_departamento_fecha->certificados.'\'},';
		}
		if($metodo == 'consulta'){
			$datos['campos'] = array('fecha1' => $fecha1, 'fecha2' => $fecha2, 'tipo_capacitado' => $tipo_capacitado);
		}
		elseif($metodo == 'imprimir'){
			$datos['tipo_capacitado'] = $tipo_capacitado != '' ? $tipo_capacitado == 'Evaluaci' ? 'Capacitados' : 'Certificados' : '';
			$datos['periodo'] = $fecha1 != '' && $fecha2 != '' ? 'Del '.date_format(new DateTime($fecha1), 'd/m/Y').' al '.date_format(new DateTime($fecha2), 'd/m/Y') : '';
		}
		return $datos;
	}
	
	private function datos_estadistica_04_view($codigo_departamento = '', $codigo_municipio = '', $fecha1 = '', $fecha2 = '', $metodo = 'consulta', $tipo_capacitado = ''){
		$datos['usuarios_departamento_municipio'] = $this->estadisticas_model->usuarios_departamento_municipio($codigo_departamento, $codigo_municipio, $fecha1, $fecha2, $tipo_capacitado);
		$centros_educativos = 1; $datos['usuarios_departamento_municipio_json'] = '';
		foreach($datos['usuarios_departamento_municipio'] as $usuario_departamento_municipio){
			if($usuario_departamento_municipio->nombre_centro_educativo != 'TOTAL'){
				$datos['usuarios_departamento_municipio_json'] .= '{y: \''.$centros_educativos++.'\', a: '.$usuario_departamento_municipio->capacitados.', b: '.$usuario_departamento_municipio->certificados.'},';
			}
		}
		$datos['lista_departamentos'] = $this->departamentos_model->lista_departamentos();
		$datos['lista_municipios'] = $this->municipios_model->lista_municipios();
		$datos['usuarios_centro_educativo'] = $this->estadisticas_model->usuarios_centro_educativo($codigo_departamento, $codigo_municipio, $fecha1, $fecha2, $tipo_capacitado);
		if($metodo == 'consulta'){
			$datos['campos'] = array('id_departamento' => $codigo_departamento, 'id_municipio' => $codigo_municipio, 'fecha1' => $fecha1, 'fecha2' => $fecha2, 'tipo_capacitado' => $tipo_capacitado);
		}
		elseif($metodo == 'imprimir'){
			$datos['tipo_capacitado'] = $tipo_capacitado != '' ? $tipo_capacitado == 'Evaluaci' ? 'Capacitados' : 'Certificados' : '';
			$datos['nombre_departamento'] = $codigo_departamento != '' ? $this->departamentos_model->nombre_departamento($codigo_departamento) : '';
			$datos['nombre_municipio'] = $codigo_municipio != '' ? $this->municipios_model->nombre_municipio($codigo_municipio) : '';
			$datos['periodo'] = $fecha1 != '' && $fecha2 != '' ? 'Del '.date_format(new DateTime($fecha1), 'd/m/Y').' al '.date_format(new DateTime($fecha2), 'd/m/Y') : '';
		}
		return $datos;
	}
	
	private function datos_estadistica_06_view($tipo_capacitado = '', $codigo_departamento = '', $fecha1 = '', $fecha2 = '', $metodo = 'consulta'){
		$datos['estaditicas_departamento_tipo_fechas'] = $this->estadisticas_model->estaditicas_departamento_tipo_fechas($tipo_capacitado, $codigo_departamento, $fecha1, $fecha2);
		$estaditicas = 1; $datos['estaditicas_departamento_tipo_fechas_json'] = '';
		foreach($datos['estaditicas_departamento_tipo_fechas'] as $estaditica_departamento_tipo_fecha){
			if($estaditica_departamento_tipo_fecha->nombre_municipio != 'TOTAL'){
				$datos['estaditicas_departamento_tipo_fechas_json'] .= '{y: \''.$estaditicas++.'\', a: '.$estaditica_departamento_tipo_fecha->tutorizado.', b: '.$estaditica_departamento_tipo_fecha->autoformacion.'},';
			}
		}
		$datos['lista_departamentos'] = $this->departamentos_model->lista_departamentos();
		if($metodo == 'consulta'){
			$datos['campos'] = array('tipo_capacitado' => $tipo_capacitado, 'id_departamento' => $codigo_departamento, 'fecha1' => $fecha1, 'fecha2' => $fecha2);
		}
		elseif($metodo == 'imprimir'){
			$datos['tipo_capacitado'] = $tipo_capacitado != '' ? $tipo_capacitado == 'Evaluaci' ? 'Capacitados' : 'Certificados' : '';
			$datos['nombre_departamento'] = $codigo_departamento != '' ? $this->departamentos_model->nombre_departamento($codigo_departamento) : '';
			$datos['periodo'] = $fecha1 != '' && $fecha2 != '' ? 'Del '.date_format(new DateTime($fecha1), 'd/m/Y').' al '.date_format(new DateTime($fecha2), 'd/m/Y') : '';
		}
		return $datos;
	}
	
	private function datos_estadistica_09_view($tipo_capacitado = '', $codigo_centro_educativo = '', $metodo = 'consulta'){
		$datos['tipos_capacitados_centro_educativo'] = $this->estadisticas_model->tipos_capacitados_centro_educativo($tipo_capacitado, $codigo_centro_educativo);
		$datos['centro_educativo_capacitado_json']  = '';
		$datos['tipos_capacitados_centro_educativo_json'] = '';
		foreach($datos['tipos_capacitados_centro_educativo'] as $tipo_capacitado_centro_educativo){
			if($tipo_capacitado_centro_educativo->modalidad_capacitado != 'TOTAL'){
				$datos['tipos_capacitados_centro_educativo_json'] .= '{y: \''.acentos($tipo_capacitado_centro_educativo->modalidad_capacitado).'\', a: '.$tipo_capacitado_centro_educativo->total.'},';
			}
		}
		$datos['lista_centros_educativos'] = $this->centros_educativos_model->lista_centros_educativos();				    
		if($metodo == 'consulta'){
			$datos['campos'] = array('tipo_capacitado' => $tipo_capacitado, 'id_centro_educativo' => $codigo_centro_educativo);
		}
		elseif($metodo == 'imprimir'){
			$datos['tipo_capacitado'] = $tipo_capacitado != '' ? $tipo_capacitado == 'Evaluaci' ? 'Capacitados' : 'Certificados' : '';
			$datos['nombre_centro_educativo'] = $codigo_centro_educativo != '' ? $this->centros_educativos_model->nombre_centro_educativo($codigo_centro_educativo) : '';
		}
		return $datos;
	}
	
	public function imprimir($opcion = 1){
		if(!$this->session->userdata('dispositivo_movil')){
			if($this->validar_parametros($opcion)){
				switch($opcion){
					case 1: // Usuarios por Modalidad de Capacitación
						$pagina = 'estadisticas/imprimir_estadistica_01_view';
						$datos = $this->datos_estadistica_01_view($this->input->post('fecha_1'), $this->input->post('fecha_2'), 'imprimir');
						if(empty($datos['modalidades_capacitados'])){
							show_404(current_url(), utf8($this->session->userdata('nombre_completo_usuario')));
						}
						break;
					case 2: // Usuarios por Departamento y Rango de Fechas
						$pagina = 'estadisticas/imprimir_estadistica_02_view';
						$datos = $this->datos_estadistica_02_view($this->input->post('codigo_departamento'), $this->input->post('fecha_1'), $this->input->post('fecha_2'), 'imprimir');
						if(empty($datos['cantidad_usuarios_municipio'])){
							show_404(current_url(), utf8($this->session->userdata('nombre_completo_usuario')));
						}
						break;
					case 3: // Total de Usuarios por Departamento y Rango de Fechas
						$pagina = 'estadisticas/imprimir_estadistica_03_view';
						$datos = $this->datos_estadistica_03_view($this->input->post('fecha_1'), $this->input->post('fecha_2'), 'imprimir');
						if(empty($datos['estaditicas_departamento_fechas'])){
							show_404(current_url(), utf8($this->session->userdata('nombre_completo_usuario')));
						}
						break;
					case 4: // Usuarios por Departamento, Municipio y Rango de Fechas
						$pagina = 'estadisticas/imprimir_estadistica_04_view';
						$datos = $this->datos_estadistica_04_view($this->input->post('codigo_departamento'), $this->input->post('codigo_municipio'), $this->input->post('fecha_1'), $this->input->post('fecha_2'), 'imprimir');
						if(empty($datos['usuarios_departamento_municipio'])){
							show_404(current_url(), utf8($this->session->userdata('nombre_completo_usuario')));
						}
						break;
					case 5: // Usuarios por Tipo de Capacitados y Fecha a Nivel Nacional
					case 6: // Usuarios por Tipo de Capacitados, Departamento y Fecha
						$pagina = 'estadisticas/imprimir_estadistica_06_view';
						$datos = $this->datos_estadistica_06_view($this->input->post('tipo_de_capacitado'), $this->input->post('codigo_departamento'), $this->input->post('fecha_1'), $this->input->post('fecha_2'), 'imprimir');
						if(empty($datos['estaditicas_departamento_tipo_fechas'])){
							show_404(current_url(), utf8($this->session->userdata('nombre_completo_usuario')));
						}
						break;
					case 7: // Usuarios por Tipo de Capacitados, Departamento y Municipio
						$pagina = 'estadisticas/imprimir_estadistica_07_view';
						$datos = $this->datos_estadistica_04_view($this->input->post('codigo_departamento'), $this->input->post('codigo_municipio'), $this->input->post('fecha_1'), $this->input->post('fecha_2'), 'imprimir', $this->input->post('tipo_de_capacitado'));
						if(empty($datos['usuarios_departamento_municipio'])){
							show_404(current_url(), utf8($this->session->userdata('nombre_completo_usuario')));
						}
						break;
					case 8: // Usuarios por Departamento, Tipo de Capacitados y Fecha
						$pagina = 'estadisticas/imprimir_estadistica_08_view';
						$datos = $this->datos_estadistica_03_view($this->input->post('fecha_1'), $this->input->post('fecha_2'), 'imprimir', $this->input->post('tipo_de_capacitado'));
						if(empty($datos['estaditicas_departamento_fechas'])){
							show_404(current_url(), utf8($this->session->userdata('nombre_completo_usuario')));
						}
						break;
					case 9: // Usuarios por Tipo de Capacitados y Centro Educativo
						$pagina = 'estadisticas/imprimir_estadistica_09_view';
						$datos = $this->datos_estadistica_09_view($this->input->post('tipo_de_capacitado'), $this->input->post('codigo_centro_educativo'), 'imprimir');
						if(empty($datos)){
							show_404(current_url(), utf8($this->session->userdata('nombre_completo_usuario')));
						}
						break;
					case 10: // Usuarios a Nivel Nacional
					case 11: // Usuarios por Grado Digital
				}
				$this->load->view($pagina, $datos);
			}
			else{
				show_404(current_url(), utf8($this->session->userdata('nombre_completo_usuario')));
			}
		}
		else{
			$this->show_error_mobile(current_url(), utf8($this->session->userdata('nombre_completo_usuario')));
		}
	}
	
	public function exportar($opcion = 1){
		if($this->validar_parametros($opcion)){
			$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, TRUE, 'UTF-8', FALSE);
			$pdf->setPrintHeader(FALSE);
			$pdf->setPrintFooter(FALSE);
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
			$pdf->SetFont('helvetica', '', 13, '', true);
			$pdf->AddPage();
			switch($opcion){
				case 1: // Usuarios por Modalidad de Capacitación
					$plantilla_pdf = $this->cargar_plantilla_pdf($opcion, array('fecha1' => $this->input->post('fecha_1'), 'fecha2' => $this->input->post('fecha_2')));
					break;
				case 2: // Usuarios por Departamento y Rango de Fechas
					$plantilla_pdf = $this->cargar_plantilla_pdf($opcion, array('codigo_departamento' => $this->input->post('codigo_departamento'), 'fecha1' => $this->input->post('fecha_1'), 'fecha2' => $this->input->post('fecha_2')));
					break;
				case 3: // Total de Usuarios por Departamento y Rango de Fechas
					$plantilla_pdf = $this->cargar_plantilla_pdf($opcion, array('fecha1' => $this->input->post('fecha_1'), 'fecha2' => $this->input->post('fecha_2')));
					break;
				case 4: // Usuarios por Departamento, Municipio y Rango de Fechas
					$plantilla_pdf = $this->cargar_plantilla_pdf($opcion, array('codigo_departamento' => $this->input->post('codigo_departamento'), 'codigo_municipio' => $this->input->post('codigo_municipio'), 'fecha1' => $this->input->post('fecha_1'), 'fecha2' => $this->input->post('fecha_2')));
					break;
				case 5: // Usuarios por Tipo de Capacitados y Fecha a Nivel Nacional
				case 6: // Usuarios por Tipo de Capacitados, Departamento y Fecha
					$plantilla_pdf = $this->cargar_plantilla_pdf($opcion, array('tipo_capacitado' => $this->input->post('tipo_de_capacitado'), 'codigo_departamento' => $this->input->post('codigo_departamento'), 'fecha1' => $this->input->post('fecha_1'), 'fecha2' => $this->input->post('fecha_2')));
					break;
				case 7: // Usuarios por Tipo de Capacitados, Departamento y Municipio
					$plantilla_pdf = $this->cargar_plantilla_pdf($opcion, array('codigo_departamento' => $this->input->post('codigo_departamento'), 'codigo_municipio' => $this->input->post('codigo_municipio'), 'fecha1' => $this->input->post('fecha_1'), 'fecha2' => $this->input->post('fecha_2'), 'tipo_capacitado' => $this->input->post('tipo_de_capacitado')));
					break;
				case 8: // Usuarios por Departamento, Tipo de Capacitados y Fecha
					$plantilla_pdf = $this->cargar_plantilla_pdf($opcion, array('fecha1' => $this->input->post('fecha_1'), 'fecha2' => $this->input->post('fecha_2'), 'tipo_capacitado' => $this->input->post('tipo_de_capacitado')));
					break;
				case 9: // Usuarios por Tipo de Capacitados y Centro Educativo
					$plantilla_pdf = $this->cargar_plantilla_pdf($opcion, array('tipo_capacitado' => $this->input->post('tipo_de_capacitado'), 'codigo_centro_educativo' => $this->input->post('codigo_centro_educativo')));
					break;
				case 10: // Usuarios a Nivel Nacional
				case 11: // Usuarios por Grado Digital
			}
			$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $plantilla_pdf, $border = 0, $ln = 1, $fill = 0, $reseth = TRUE, $align = '', $autopadding = TRUE);
			$nombre_archivo = utf8_decode(acentos('Estadística '.listado_estadisticas($opcion)).'.pdf');
			$pdf->Output($nombre_archivo, 'I');
		}
		else{
			show_404(current_url(), utf8($this->session->userdata('nombre_completo_usuario')));
		}
	}
	
	private function cargar_plantilla_pdf($opcion, $parametros){
		switch($opcion){
			case 1: // Usuarios por Modalidad de Capacitación
				$modalidades_capacitados = $this->estadisticas_model->modalidades_capacitados($parametros['fecha1'], $parametros['fecha2']);
				$lista_modalidades_capacitados = '';
				foreach($modalidades_capacitados as $modalidad_capacitado){
					if($modalidad_capacitado->tipos_capacitados != 'TOTAL'){
						$lista_modalidades_capacitados .= '<tr><th>'.bold(utf8($modalidad_capacitado->tipos_capacitados)).'</th><td>'.$modalidad_capacitado->tutorizados.'</td><td>'.$modalidad_capacitado->autoformacion.'</td></tr>';
					}
					else{
						$lista_modalidades_capacitados .= '<tr><th>'.bold($modalidad_capacitado->tipos_capacitados).'</th><td>'.bold($modalidad_capacitado->tutorizados).'</td><td>'.bold($modalidad_capacitado->autoformacion).'</td></tr>';
					}
				}
				if($lista_modalidades_capacitados == ''){
					$lista_modalidades_capacitados = 'No hay resultados para ésta estadística.';
				}
				$plantilla_pdf = read_file('resources/templates/pdf/estadistica_01.php');
				$plantilla_pdf = str_replace(array('<ENCABEZADO_REPORTE>',
												   '<PERIODO>',
												   '<MODALIDADES_CAPACITADOS>'),
											 array(encabezado_reporte(),
												   $parametros['fecha1'] != '' && $parametros['fecha2'] != '' ? 'Del '.date_format(new DateTime($parametros['fecha1']), 'd/m/Y').' al '.date_format(new DateTime($parametros['fecha2']), 'd/m/Y') : '',
												   $lista_modalidades_capacitados),
											 $plantilla_pdf);
				break;
			case 2: // Usuarios por Departamento y Rango de Fechas
				$cantidad_usuarios_municipio = $this->estadisticas_model->cantidad_usuarios_municipio($parametros['codigo_departamento'], $parametros['fecha1'], $parametros['fecha2']);
				$lista_cantidad_usuarios_municipio = ''; $cantidades = 1;
				foreach($cantidad_usuarios_municipio as $cantidad_municipio){
					if($cantidad_municipio->nombre_municipio != 'TOTAL'){
						$lista_cantidad_usuarios_municipio .= '<tr><td>'.$cantidades++.'</td><td>'.utf8($cantidad_municipio->nombre_municipio).'</td><td>'.$cantidad_municipio->capacitados.'</td><td>'.$cantidad_municipio->certificados.'</td></tr>';
					}
					else{
						$lista_cantidad_usuarios_municipio .= '<tr><td style="opacity: 0.0;">'.$cantidades++.'</td><td>'.bold($cantidad_municipio->nombre_municipio).'</td><td>'.bold($cantidad_municipio->capacitados).'</td><td>'.bold($cantidad_municipio->certificados).'</td></tr>';
					}
				}
				if($lista_cantidad_usuarios_municipio == ''){
					$lista_cantidad_usuarios_municipio = 'No hay resultados para ésta estadística.';
				}
				$usuarios_municipio = $this->estadisticas_model->usuarios_municipio($parametros['codigo_departamento'], $parametros['fecha1'], $parametros['fecha2']);
				$lista_usuarios_municipio = ''; $usuarios = 1;
				foreach($usuarios_municipio as $usuario_municipio){
					$lista_usuarios_municipio .= '<tr><td>'.$usuarios++.'</td><td>'.utf8($usuario_municipio->nombre_municipio).'</td><td>'.utf8($usuario_municipio->nombre_usuario).'</td><td>'.utf8($usuario_municipio->modalidad_usuario).'</td></tr>';
				}
				if($lista_usuarios_municipio == ''){
					$lista_usuarios_municipio = 'No hay resultados para ésta estadística.';
				}
				$plantilla_pdf = read_file('resources/templates/pdf/estadistica_02.php');
				$plantilla_pdf = str_replace(array('<ENCABEZADO_REPORTE>',
												   '<DEPARTAMENTO>',
												   '<PERIODO>',
												   '<CANTIDAD_USUARIOS_MUNICIPIO>',
												   '<USUARIOS_MUNICIPIO>'),
											 array(encabezado_reporte(),
												   utf8($parametros['codigo_departamento'] != '' ? $this->departamentos_model->nombre_departamento($parametros['codigo_departamento']) : ''),
												   $parametros['fecha1'] != '' && $parametros['fecha2'] != '' ? 'Del '.date_format(new DateTime($parametros['fecha1']), 'd/m/Y').' al '.date_format(new DateTime($parametros['fecha2']), 'd/m/Y') : '',
												   $lista_cantidad_usuarios_municipio,
												   $lista_usuarios_municipio),
											 $plantilla_pdf);
				break;
			case 3: // Total de Usuarios por Departamento y Rango de Fechas
				$estaditicas_departamento_fechas = $this->estadisticas_model->estaditicas_departamento_fechas($parametros['fecha1'], $parametros['fecha2']);
				$lista_estaditicas_departamento_fechas = '';
				foreach($estaditicas_departamento_fechas as $estaditica_departamento_fecha){
					$lista_estaditicas_departamento_fechas .= '<tr><td>'.$estaditica_departamento_fecha->indice.'</td><td>'.utf8($estaditica_departamento_fecha->nombre_departamento).'</td><td>'.$estaditica_departamento_fecha->capacitados.'</td><td>'.$estaditica_departamento_fecha->certificados.'</td></tr>';
				}
				if($lista_estaditicas_departamento_fechas == ''){
					$lista_estaditicas_departamento_fechas = 'No hay resultados para ésta estadística.';
				}
				$plantilla_pdf = read_file('resources/templates/pdf/estadistica_03.php');
				$plantilla_pdf = str_replace(array('<ENCABEZADO_REPORTE>',
												   '<PERIODO>',
												   '<ESTADITICAS_DEPARTAMENTO_FECHAS>'),
											 array(encabezado_reporte(),
												   $parametros['fecha1'] != '' && $parametros['fecha2'] != '' ? 'Del '.date_format(new DateTime($parametros['fecha1']), 'd/m/Y').' al '.date_format(new DateTime($parametros['fecha2']), 'd/m/Y') : '',
												   $lista_estaditicas_departamento_fechas),
											 $plantilla_pdf);
				break;
			case 4: // Usuarios por Departamento, Municipio y Rango de Fechas
				$usuarios_departamento_municipio = $this->estadisticas_model->usuarios_departamento_municipio($parametros['codigo_departamento'], $parametros['codigo_municipio'], $parametros['fecha1'], $parametros['fecha2']);
				$lista_usuarios_departamento_municipio = ''; $centros_educativos = 1;
				foreach($usuarios_departamento_municipio as $usuario_departamento_municipio){
					if($usuario_departamento_municipio->nombre_centro_educativo != 'TOTAL'){
						$lista_usuarios_departamento_municipio .= '<tr><td>'.$centros_educativos++.'</td><td>'.utf8($usuario_departamento_municipio->nombre_centro_educativo).'</td><td>'.$usuario_departamento_municipio->capacitados.'</td><td>'.$usuario_departamento_municipio->certificados.'</td></tr>';
					}
					else{
						$lista_usuarios_departamento_municipio .= '<tr><td style="opacity: 0.0;">'.$centros_educativos++.'</td><td>'.bold($usuario_departamento_municipio->nombre_centro_educativo).'</td><td>'.bold($usuario_departamento_municipio->capacitados).'</td><td>'.bold($usuario_departamento_municipio->certificados).'</td></tr>';
					}
				}
				if($lista_usuarios_departamento_municipio == ''){
					$lista_usuarios_departamento_municipio = 'No hay resultados para ésta estadística.';
				}
				$usuarios_centro_educativo = $this->estadisticas_model->usuarios_centro_educativo($parametros['codigo_departamento'], $parametros['codigo_municipio'], $parametros['fecha1'], $parametros['fecha2']);
				$lista_usuarios_centro_educativo = ''; $usuarios = 1;
				foreach($usuarios_centro_educativo as $usuario_centro_educativo){
					$lista_usuarios_centro_educativo .= '<tr><td>'.$usuarios++.'</td><td>'.utf8($usuario_centro_educativo->nombre_centro_educativo).'</td><td>'.utf8($usuario_centro_educativo->nombre_usuario).'</td><td>'.utf8($usuario_centro_educativo->tipo_capacitado).'</td><td>'.utf8($usuario_centro_educativo->modalidad_usuario).'</td></tr>';
				}
				if($lista_usuarios_centro_educativo == ''){
					$lista_usuarios_centro_educativo = 'No hay resultados para ésta estadística.';
				}
				$plantilla_pdf = read_file('resources/templates/pdf/estadistica_04.php');
				$plantilla_pdf = str_replace(array('<ENCABEZADO_REPORTE>',
												   '<DEPARTAMENTO>',
												   '<MUNICIPIO>',
												   '<PERIODO>',
												   '<USUARIOS_DEPARTAMENTO_MUNICIPIO>',
												   '<USUARIOS_CENTRO_EDUCATIVO>'),
											 array(encabezado_reporte(),
												   utf8($parametros['codigo_departamento'] != '' ? $this->departamentos_model->nombre_departamento($parametros['codigo_departamento']) : ''),
												   utf8($parametros['codigo_municipio'] != '' ? $this->municipios_model->nombre_municipio($parametros['codigo_municipio']) : ''),
												   $parametros['fecha1'] != '' && $parametros['fecha2'] != '' ? 'Del '.date_format(new DateTime($parametros['fecha1']), 'd/m/Y').' al '.date_format(new DateTime($parametros['fecha2']), 'd/m/Y') : '',
												   $lista_usuarios_departamento_municipio,
												   $lista_usuarios_centro_educativo),
											 $plantilla_pdf);
				break;
			case 5: // Usuarios por Tipo de Capacitados y Fecha a Nivel Nacional
			case 6: // Usuarios por Tipo de Capacitados, Departamento y Fecha
				$estaditicas_departamento_tipo_fechas = $this->estadisticas_model->estaditicas_departamento_tipo_fechas($parametros['tipo_capacitado'], $parametros['codigo_departamento'], $parametros['fecha1'], $parametros['fecha2']);
				$estaditicas = 1; $lista_estaditicas_departamento_tipo_fechas = '';
				foreach($estaditicas_departamento_tipo_fechas as $estaditica_departamento_tipo_fecha){
					if($estaditica_departamento_tipo_fecha->nombre_municipio != 'TOTAL'){
						$lista_estaditicas_departamento_tipo_fechas .= '<tr><td>'.$estaditicas++.'</td><td>'.utf8($estaditica_departamento_tipo_fecha->nombre_municipio).'</td><td>'.$estaditica_departamento_tipo_fecha->tutorizado.'</td><td>'.$estaditica_departamento_tipo_fecha->autoformacion.'</td></tr>';
					}
					else{
						$lista_estaditicas_departamento_tipo_fechas .= '<tr><td style="opacity: 0.0;">'.$estaditicas++.'</td><td>'.utf8($estaditica_departamento_tipo_fecha->nombre_municipio).'</td><td>'.$estaditica_departamento_tipo_fecha->tutorizado.'</td><td>'.$estaditica_departamento_tipo_fecha->autoformacion.'</td></tr>';
					}
				}
				if($lista_estaditicas_departamento_tipo_fechas == ''){
					$lista_estaditicas_departamento_tipo_fechas = 'No hay resultados para ésta estadística.';
				}
				$plantilla_pdf = read_file('resources/templates/pdf/estadistica_06.php');
				$plantilla_pdf = str_replace(array('<ENCABEZADO_REPORTE>',
												   '<TIPO_CAPACITADO>',
												   '<DEPARTAMENTO>',
												   '<PERIODO>',
												   '<ESTADITICAS_DEPARTAMENTO_TIPO_FECHAS>'),
											 array(encabezado_reporte(),
												   $parametros['tipo_capacitado'] == 'Evaluaci' ? 'Capacitados' : $parametros['tipo_capacitado'] == 'Examen' ? 'Certificados' : '',
												   utf8($parametros['codigo_departamento'] != '' ? $this->departamentos_model->nombre_departamento($parametros['codigo_departamento']) : ''),
												   $parametros['fecha1'] != '' && $parametros['fecha2'] != '' ? 'Del '.date_format(new DateTime($parametros['fecha1']), 'd/m/Y').' al '.date_format(new DateTime($parametros['fecha2']), 'd/m/Y') : '',
												   $lista_estaditicas_departamento_tipo_fechas),
											 $plantilla_pdf);
				break;
			case 7: // Usuarios por Tipo de Capacitados, Departamento y Municipio
				$usuarios_departamento_municipio = $this->estadisticas_model->usuarios_departamento_municipio($parametros['codigo_departamento'], $parametros['codigo_municipio'], $parametros['fecha1'], $parametros['fecha2'], $parametros['tipo_capacitado']);
				$lista_usuarios_departamento_municipio = ''; $centros_educativos = 1;
				foreach($usuarios_departamento_municipio as $usuario_departamento_municipio){
					if($usuario_departamento_municipio->nombre_centro_educativo != 'TOTAL'){
						$lista_usuarios_departamento_municipio .= '<tr><td>'.$centros_educativos++.'</td><td>'.utf8($usuario_departamento_municipio->nombre_centro_educativo).'</td><td>'.$usuario_departamento_municipio->capacitados.'</td><td>'.$usuario_departamento_municipio->certificados.'</td></tr>';
					}
					else{
						$lista_usuarios_departamento_municipio .= '<tr><td style="opacity: 0.0;">'.$centros_educativos++.'</td><td>'.bold($usuario_departamento_municipio->nombre_centro_educativo).'</td><td>'.bold($usuario_departamento_municipio->capacitados).'</td><td>'.bold($usuario_departamento_municipio->certificados).'</td></tr>';
					}
				}
				if($lista_usuarios_departamento_municipio == ''){
					$lista_usuarios_departamento_municipio = 'No hay resultados para ésta estadística.';
				}
				$usuarios_centro_educativo = $this->estadisticas_model->usuarios_centro_educativo($parametros['codigo_departamento'], $parametros['codigo_municipio'], $parametros['fecha1'], $parametros['fecha2'], $parametros['tipo_capacitado']);
				$lista_usuarios_centro_educativo = ''; $usuarios = 1;
				foreach($usuarios_centro_educativo as $usuario_centro_educativo){
					$lista_usuarios_centro_educativo .= '<tr><td>'.$usuarios++.'</td><td>'.utf8($usuario_centro_educativo->nombre_centro_educativo).'</td><td>'.utf8($usuario_centro_educativo->nombre_usuario).'</td><td>'.utf8($usuario_centro_educativo->tipo_capacitado).'</td><td>'.utf8($usuario_centro_educativo->modalidad_usuario).'</td></tr>';
				}
				if($lista_usuarios_centro_educativo == ''){
					$lista_usuarios_centro_educativo = 'No hay resultados para ésta estadística.';
				}
				$plantilla_pdf = read_file('resources/templates/pdf/estadistica_07.php');
				$plantilla_pdf = str_replace(array('<ENCABEZADO_REPORTE>',
												   '<TIPO_CAPACITADO>',
												   '<DEPARTAMENTO>',
												   '<MUNICIPIO>',
												   '<PERIODO>',
												   '<USUARIOS_DEPARTAMENTO_MUNICIPIO>',
												   '<USUARIOS_CENTRO_EDUCATIVO>'),
											 array(encabezado_reporte(),
												   $parametros['tipo_capacitado'] == 'capacitados' ? 'Capacitados' : $parametros['tipo_capacitado'] == 'certificados' ? 'Certificados' : '',
												   utf8($parametros['codigo_departamento'] != '' ? $this->departamentos_model->nombre_departamento($parametros['codigo_departamento']) : ''),
												   utf8($parametros['codigo_municipio'] != '' ? $this->municipios_model->nombre_municipio($parametros['codigo_municipio']) : ''),
												   $parametros['fecha1'] != '' && $parametros['fecha2'] != '' ? 'Del '.date_format(new DateTime($parametros['fecha1']), 'd/m/Y').' al '.date_format(new DateTime($parametros['fecha2']), 'd/m/Y') : '',
												   $lista_usuarios_departamento_municipio,
												   $lista_usuarios_centro_educativo),
											 $plantilla_pdf);
				break;
			case 8: // Usuarios por Departamento, Tipo de Capacitados y Fecha
				$estaditicas_departamento_fechas = $this->estadisticas_model->estaditicas_departamento_fechas($parametros['fecha1'], $parametros['fecha2'], $parametros['tipo_capacitado']);
				$lista_estaditicas_departamento_fechas = '';
				foreach($estaditicas_departamento_fechas as $estaditica_departamento_fecha){
					$lista_estaditicas_departamento_fechas .= '<tr><td>'.$estaditica_departamento_fecha->indice.'</td><td>'.utf8($estaditica_departamento_fecha->nombre_departamento).'</td><td>'.$estaditica_departamento_fecha->capacitados.'</td><td>'.$estaditica_departamento_fecha->certificados.'</td></tr>';
				}
				if($lista_estaditicas_departamento_fechas == ''){
					$lista_estaditicas_departamento_fechas = 'No hay resultados para ésta estadística.';
				}
				$plantilla_pdf = read_file('resources/templates/pdf/estadistica_08.php');
				$plantilla_pdf = str_replace(array('<ENCABEZADO_REPORTE>',
												   '<TIPO_CAPACITADO>',
												   '<PERIODO>',
												   '<ESTADITICAS_DEPARTAMENTO_FECHAS>'),
											 array(encabezado_reporte(),
												   $parametros['tipo_capacitado'] == 'Evaluaci' ? 'Capacitados' : $parametros['tipo_capacitado'] == 'Examen' ? 'Certificados' : '',
												   $parametros['fecha1'] != '' && $parametros['fecha2'] != '' ? 'Del '.date_format(new DateTime($parametros['fecha1']), 'd/m/Y').' al '.date_format(new DateTime($parametros['fecha2']), 'd/m/Y') : '',
												   $lista_estaditicas_departamento_fechas),
											 $plantilla_pdf);
				break;
			case 9: // Usuarios por Tipo de Capacitados y Centro Educativo
				$tipos_capacitados_centro_educativo = $this->estadisticas_model->tipos_capacitados_centro_educativo($parametros['tipo_capacitado'], $parametros['codigo_centro_educativo']);
				$lista_tipos_capacitados_centro_educativo = '';
				foreach($tipos_capacitados_centro_educativo as $tipo_capacitado_centro_educativo){
					if($tipo_capacitado_centro_educativo->modalidad_capacitado != 'TOTAL'){
						$lista_tipos_capacitados_centro_educativo .= '<tr><td>'.utf8($tipo_capacitado_centro_educativo->modalidad_capacitado).'</td><td>'.$tipo_capacitado_centro_educativo->total.'</td></tr>';
					}
					else{
						$lista_tipos_capacitados_centro_educativo .= '<tr><td>'.bold(utf8($tipo_capacitado_centro_educativo->modalidad_capacitado)).'</td><td>'.bold($tipo_capacitado_centro_educativo->total).'</td></tr>';
					}
				}
				if($lista_tipos_capacitados_centro_educativo == ''){
					$lista_tipos_capacitados_centro_educativo = 'No hay resultados para ésta estadística.';
				}
				$plantilla_pdf = read_file('resources/templates/pdf/estadistica_09.php');
				$plantilla_pdf = str_replace(array('<ENCABEZADO_REPORTE>',
												   '<TIPO_CAPACITADO>',
												   '<CENTRO_EDUCATIVO>',
												   '<TIPOS_CAPACITADOS_CENTRO_EDUCATIVO>'),
											 array(encabezado_reporte(),
												   $parametros['tipo_capacitado'] == 'Evaluaci' ? 'Capacitados' : $parametros['tipo_capacitado'] == 'Examen' ? 'Certificados' : '',
												   $parametros['codigo_centro_educativo'] != '' ? $this->centros_educativos_model->nombre_centro_educativo($parametros['codigo_centro_educativo']) : '',
												   $lista_tipos_capacitados_centro_educativo),
											 $plantilla_pdf);
				break;
			case 10: // Usuarios a Nivel Nacional
			case 11: // Usuarios por Grado Digital
		}
		return $plantilla_pdf;
	}
	
	public function validar_fechas($fecha1, $fecha2){
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
	
	private function validar_parametros($opcion){
		if(empty($opcion)){
			return FALSE;
		}
		elseif(is_numeric($opcion)){
			if(($opcion >= 1 && $opcion <= 4) || ($opcion >= 6 && $opcion <= 11)){
				return TRUE;
			}
			else{
				return FALSE;
			}
		}
		else{
			return FALSE;
		}
	}
}

/* End of file estadisticas.php */
/* Location: ./application/controllers/estadisticas.php */