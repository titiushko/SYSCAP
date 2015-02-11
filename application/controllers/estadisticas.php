<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estadisticas extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->model(array('estadisticas_model', 'departamentos_model', 'municipios_model', 'centros_educativos_model'));
	}
	
	public function consulta($opcion = 1){
		$datos['pagina'] = 'estadisticas/consultar_estadisticas_view';
		$datos['usuario_actual'] = "&lt;nombre_usuario&gt;";
		$datos['opcion_menu'] = modulo_actual('modulo_consultas_estadisticas');
		
		if($opcion >= 1 && $opcion <= 11){
			$datos['nombre_estadistica'] = listado_estadisticas($opcion);
			$datos['estadistica'] = array($opcion => 'active');
			$datos['habilitar_generar_reporte'] = TRUE;
		}
		else{
			show_404();
		}
	
		switch($opcion){
			case 1: // Usuarios por Modalidad de Capacitación
				$datos['certificados'] = $this->estadisticas_model->modalidades_capacitados('certificados');
				$datos['capacitados'] = $this->estadisticas_model->modalidades_capacitados('capacitados');
				$datos['total'] = $this->estadisticas_model->modalidades_capacitados('total');
				$datos['grafica_json']  = '{y: \'Tutorizados\', a: '.$datos['capacitados'][0]->tutorizado.', b: '.$datos['capacitados'][0]->autoformacion.'},';
				$datos['grafica_json'] .= '{y: \'Autoformacion\', a: '.$datos['certificados'][0]->tutorizado.', b: '.$datos['certificados'][0]->autoformacion.'},';
				$datos['id_modal'] = 'myModalChart';
				$datos['titulo_notificacion'] = 'Estad&iacute;stica de '.$datos['nombre_estadistica'];
				$datos['mensaje_notificacion'] = '<div id="morris-bar-chart-estadistica1-2"></div>';
				break;
			case 2: // Usuarios por Departamento y Rango de Fechas
				if($this->input->post()){
					$this->form_validation->set_rules('id_departamento', 'Departamento', 'trim|required');
					$this->form_validation->set_rules('fecha1', 'Fecha 1', 'trim|required');
					$this->form_validation->set_rules('fecha2', 'Fecha 2', 'trim|required');
					$this->form_validation->set_rules('fecha1', 'Fecha 1', 'callback_validar_fechas['.$this->input->post('fecha2').']');
					if ($this->form_validation->run() == TRUE){
						$datos = array_merge($this->datos_estadistica_02_view($this->input->post('id_departamento'), $this->input->post('fecha1'), $this->input->post('fecha2', 'consulta')), $datos);
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
				$datos['tabla'] = $this->estadisticas_model->estaditicas_departamento_fechas('tabla');
				$datos['grafica_estaditicas_departamento_json'] = '';
				$contador = 1;
				foreach($datos['tabla'] as $data){
					$datos['grafica_estaditicas_departamento_json'] = $datos['grafica_estaditicas_departamento_json'].'{y: \''.($contador++).'\', a: \''.$data->capacitados.'\', b: \''.$data->certificados.'\'},';
				}
				$datos['id_modal'] = 'myModalChart';
		        $datos['titulo_notificacion'] = 'Estad&iacute;stica de '.$datos['nombre_estadistica'];
				$datos['mensaje_notificacion'] = '<div id="morris-bar-chart-estadistica3-2"></div>';
				break;
			case 4: // Usuarios por Departamento, Municipio y Rango de Fechas
				$datos['tabla'] = $this->estadisticas_model->usuarios_departamento_municipio('tabla');
				$datos['listado'] = $this->estadisticas_model->usuarios_departamento_municipio('listado');
				$datos['lista_departamentos'] = $this->departamentos_model->lista_departamentos();
				$datos['lista_municipios'] = $this->municipios_model->lista_municipios();
				$datos['grafica_json'] = '';
				$centroseducativos = 1;
				foreach($datos['tabla'] as $data){
					if($data->nombre_centro_educativo != 'TOTAL'){
						$datos['grafica_json'] = $datos['grafica_json'].'{y: \''.($centroseducativos++).'\', a: '.$data->capacitados.', b: '.$data->certificados.'},';
					}
				}
				$datos['id_modal'] = 'myModalChart';
				$datos['titulo_notificacion'] = 'Estad&iacute;stica de '.$datos['nombre_estadistica'];
				$datos['mensaje_notificacion'] = '<div id="morris-bar-chart-estadistica4-2"></div>';
				break;
			case 5: // Usuarios por Tipo de Capacitados y Fecha a Nivel Nacional
				break;
			case 6: // Usuarios por Tipo de Capacitados, Departamento y Fecha
				$datos['lista_tipo_capacitados'] =  array(
						'Evaluacion' => 'Certificados',
						'Examen' => 'Capacitados'
				);
				$datos['lista_departamentos'] = $this->departamentos_model->lista_departamentos();
				/*
				$datos['tabla'] = $this->estadisticas_model->estaditicas_departamento_tipo_fechas('tabla');
				$datos['grafica_json'] = '';
				$contador = 1;
				foreach($datos['tabla'] as $data){
					$datos['grafica_json'] = $datos['grafica_json'].'{y: \''.$contador++.'\', a: \''.$data->certificados.'\', b: \''.$data->capacitados.'\'},';
				}
				$datos['id_modal'] = 'myModalChart';
				$datos['titulo_notificacion'] = 'Estad&iacute;stica de '.$datos['nombre_estadistica'];
				$datos['mensaje_notificacion'] = '<div id="morris-bar-chart-estadistica6-2"></div>';
				*/
				break;
			case 7: // Usuarios por Tipo de Capacitados, Departamento y Municipio
				$datos['tabla'] = $this->estadisticas_model->usuarios_departamento_municipio('tabla');
				$datos['listado'] = $this->estadisticas_model->usuarios_departamento_municipio('listado');
				$datos['lista_departamentos'] = $this->departamentos_model->lista_departamentos();
				$datos['lista_municipios'] = $this->municipios_model->lista_municipios();
				$datos['lista_tipo_capacitados'] =  array(
					'Evaluacion' => 'Certificados',
					'Examen' => 'Capacitados'
					);
				$datos['grafica_json'] = '';
				$centroseducativos = 1;
				foreach($datos['tabla'] as $data){
					if($data->nombre_centro_educativo != 'TOTAL'){
						$datos['grafica_json'] = $datos['grafica_json'].'{y: \''.($centroseducativos++).'\', a: '.$data->capacitados.', b: '.$data->certificados.'},';
					}
				}
				$datos['id_modal'] = 'myModalChart';
		        $datos['titulo_notificacion'] = 'Estad&iacute;stica de '.$datos['nombre_estadistica'];
				$datos['mensaje_notificacion'] = '<div id="morris-bar-chart-estadistica7-2"></div>';
				break;
			case 8: // Usuarios por Departamento, Tipo de Capacitados y Fecha
				$datos['tabla'] = $this->estadisticas_model->estaditicas_departamento_fechas('tabla');
				$datos['grafica_estaditicas_departamento_json'] = '';
				$datos['lista_tipo_capacitados'] =  array(
					'Evaluacion' => 'Capacitados',
					'Examen' => 'Certificados'
					);
				$contador = 1;
				foreach($datos['tabla'] as $data){
					$datos['grafica_estaditicas_departamento_json'] = $datos['grafica_estaditicas_departamento_json'].'{y: \''.($contador++).'\', a: \''.$data->capacitados.'\', b: \''.$data->certificados.'\'},';
				}
				$datos['id_modal'] = 'myModalChart';
		        $datos['titulo_notificacion'] = 'Estad&iacute;stica de '.$datos['nombre_estadistica'];
				$datos['mensaje_notificacion'] = '<div id="morris-bar-chart-estadistica8-2"></div>';
				break;
			case 9: // Usuarios por Tipo de Capacitados y Centro Educativo
				$datos['capacitados'] = $this->estadisticas_model->centro_educativo_capacitado('capacitados');
				$datos['certificados'] = $this->estadisticas_model->centro_educativo_capacitado('certificados');
				$datos['total'] = $this->estadisticas_model->centro_educativo_capacitado('total');
				$datos['lista_tipo_capacitados'] =  array(
					'Evaluacion' => 'Capacitados',
					'Examen' => 'Certificados'
				);
  		        $datos['lista_centros_educativos'] = $this->centros_educativos_model->lista_centros_educativos();				    
				$datos['grafica_json'] = '';
				$datos['grafica_json']  = '{y: \'Tutorizados\', a: '.$datos['capacitados'][0]->tutorizado.'},{y: \'Autoformacion\', a: '.$datos['certificados'][0]->tutorizado.'},';
				$datos['id_modal'] = 'myModalChart';
				$datos['titulo_notificacion'] = 'Estad&iacute;stica de '.$datos['nombre_estadistica'];
				$datos['mensaje_notificacion'] = '<div id="morris-bar-chart-estadistica9-2"></div>';
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
			default:
				$datos['habilitar_generar_reporte'] = FALSE;
				break;
		}
		
		$datos['datos'] = $datos;
		$this->load->view('plantilla_pagina_view', $datos);
	}
	
	public function formulario(){
		$opcion = $this->input->get_post('opcion');
		switch($opcion){
			case 1: // Usuarios por Modalidad de Capacitación
			case 2: // Usuarios por Departamento y Rango de Fechas
			case 3: // Total de Usuarios por Departamento y Rango de Fechas
			case 4: // Usuarios por Departamento, Municipio y Rango de Fechas
			case 5: // Usuarios por Tipo de Capacitados y Fecha a Nivel Nacional
			case 6: // Usuarios por Tipo de Capacitados, Departamento y Fecha
				$id_tipo_capacitados=$this->input->get_post('id_tipo_capacitados');
				$id_departamento=$this->input->get_post('id_departamento');
				$fecha_ini=$this->input->get_post('fecha_ini');
				$fecha_fin=$this->input->get_post('fecha_fin');
				$datos['json_data'] = json_encode($this->estadisticas_model->estaditicas_departamento_tipo_fechas('tabla'));
				$this->load->view('estadisticas/json', $datos);
				break;
			case 7: // Usuarios por Tipo de Capacitados, Departamento y Municipio
			case 8: // Usuarios por Departamento, Tipo de Capacitados y Fecha
			case 9: // Usuarios por Tipo de Capacitados y Centro Educativo
			case 10: // Usuarios a Nivel Nacional
				$id_tipo_capacitados=$this->input->get_post('id_tipo_capacitados');
				$id_departamento=$this->input->get_post('id_departamento');
				$id_municipio=$this->input->get_post('id_municipio');
				$fecha_ini=$this->input->get_post('fecha_ini');
				$fecha_fin=$this->input->get_post('fecha_fin');
				$datos['certificados'] = $this->estadisticas_model->usuarios_nivel_nacional($id_tipo_capacitados,$id_departamento,$id_municipio,$fecha_ini,$fecha_fin);
				$datos['json_data'] = json_encode($datos['certificados']);
				$this->load->view('estadisticas/json', $datos);
				break;
			case 11: // Usuarios por Grado Digital
				$id_tipo_capacitados=$this->input->get_post('id_tipo_capacitados');
				$id_departamento=$this->input->get_post('id_departamento');
				$id_municipio=$this->input->get_post('id_municipio');
				$fecha_ini=$this->input->get_post('fecha_ini');
				$fecha_fin=$this->input->get_post('fecha_fin');
				$datos['certificados'] = $this->estadisticas_model->usuarios_nivel_nacional($id_tipo_capacitados,$id_departamento,$id_municipio,$fecha_ini,$fecha_fin);
				$datos['json_data'] = json_encode($datos['certificados']);
				$this->load->view('estadisticas/json', $datos);
				break;
			default:
				break;
		}
	}	
	
	public function lista_municipios_departamentos(){
		$id_departamento = $this->input->get_post('id_departamento');
		$datos['json_data'] = json_encode($this->municipios_model->lista_municipios_departamentos($id_departamento));
		$this->load->view('estadisticas/json', $datos);
	}
	
	private function datos_estadistica_02_view($codigo_departamento = '', $fecha1 = '', $fecha2 = '', $metodo = 'consulta'){
		$datos['cantidad_usuarios_municipio'] = $this->estadisticas_model->cantidad_usuarios_municipio($codigo_departamento, $fecha1, $fecha2);
		$municipios = 1;
		$datos['cantidad_usuarios_municipio_json'] = '';
		foreach($datos['cantidad_usuarios_municipio'] as $cantidad_municipio){
			if($cantidad_municipio->nombre_municipio != 'TOTAL'){
				$datos['cantidad_usuarios_municipio_json'] = $datos['cantidad_usuarios_municipio_json'].'{y: \''.$municipios++.'\', a: '.$cantidad_municipio->capacitados.', b: '.$cantidad_municipio->certificados.'},';
			}
		}
		$datos['usuarios_municipio'] = $this->estadisticas_model->usuarios_municipio($codigo_departamento, $fecha1, $fecha2);
		$datos['lista_departamentos'] = $this->departamentos_model->lista_departamentos();
		if($metodo == 'consulta'){
			$datos['campos'] = array('id_departamento' => $codigo_departamento, 'fecha1' => $fecha1, 'fecha2' => $fecha2);
			$datos['id_modal'] = 'myModalChart';
			$datos['titulo_notificacion'] = 'Estad&iacute;stica de '.listado_estadisticas(2);
			$datos['mensaje_notificacion'] = '<div id="morris-bar-chart-estadistica2-2"></div>';
		}
		elseif($metodo == 'imprimir'){
			$datos['nombre_departamento'] = $codigo_departamento != '' ? $this->departamentos_model->nombre_departamento($codigo_departamento) : '';
			$datos['periodo'] = 'Del '.($fecha1 != '' ? date_format(new DateTime($fecha1), 'd/m/Y') : '').' al '.($fecha2 != '' ? date_format(new DateTime($fecha2), 'd/m/Y') : '');
		}
		return $datos;
	}
	
	public function imprimir($opcion = 1){
		if(empty($opcion)){
			show_404();
		}
		else{
			if(is_numeric($opcion)){
				switch($opcion){
					case 1: // Usuarios por Modalidad de Capacitación
					case 2: // Usuarios por Departamento y Rango de Fechas
						$pagina = 'estadisticas/imprimir_estadistica_02_view';
						$datos = $this->datos_estadistica_02_view($this->input->post('codigo_departamento'), $this->input->post('fecha_1'), $this->input->post('fecha_2'), 'imprimir');
						if(empty($datos['cantidad_usuarios_municipio'])){
							show_404();
						}
						break;
					case 3: // Total de Usuarios por Departamento y Rango de Fechas
					case 4: // Usuarios por Departamento, Municipio y Rango de Fechas
					case 5: // Usuarios por Tipo de Capacitados y Fecha a Nivel Nacional
					case 6: // Usuarios por Tipo de Capacitados, Departamento y Fecha
					case 7: // Usuarios por Tipo de Capacitados, Departamento y Municipio
					case 8: // Usuarios por Departamento, Tipo de Capacitados y Fecha
					case 9: // Usuarios por Tipo de Capacitados y Centro Educativo
					case 10: // Usuarios a Nivel Nacional
					case 11: // Usuarios por Grado Digital
				}
				$this->load->view($pagina, $datos);
			}
			else{
				show_404();
			}
		}
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
}

/* End of file estadisticas.php */
/* Location: ./application/controllers/estadisticas.php */