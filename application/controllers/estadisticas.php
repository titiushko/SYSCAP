<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estadisticas extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->model(array('estadisticas_model', 'departamentos_model','municipios_model','centros_educativos_model'));
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
                
                $datos['estadistica']  = '{y: \'1\', a: '.$datos['capacitados'][0]->tutorizado.', b: '.$datos['certificados'][0]->tutorizado.'},';
                $datos['estadistica'] .= '{y: \'2\', a: '.$datos['capacitados'][0]->autoformacion.', b: '.$datos['certificados'][0]->autoformacion.'},';
                    
                $datos['id_modal'] = 'myModalChart';
		        $datos['titulo_notificacion'] = 'Estad&iacute;stica de '.$datos['nombre_estadistica'];
				$datos['mensaje_notificacion'] = '<div id="morris-bar-chart-estadistica2-2"></div>';
    
			break;
			case 2: // Usuarios por Departamento y Rango de Fechas
				if($this->input->post()){
					$this->form_validation->set_rules('id_departamento', 'Departamento', 'trim|required');
					$this->form_validation->set_rules('fecha1', 'Fecha 1', 'trim|required');
					$this->form_validation->set_rules('fecha2', 'Fecha 2', 'trim|required');
					
					if ($this->form_validation->run() == TRUE){
						$datos = array_merge($this->datos_estadistica_02_view($this->input->post('id_departamento'), $this->input->post('fecha1'), $this->input->post('fecha2')), $datos);
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
					$datos['grafica_estaditicas_departamento_json'] = $datos['grafica_estaditicas_departamento_json'].'{y: \''.($contador++).'\', a: \''.$data->certificados.'\', b: \''.$data->capacitados.'\'},';
				}
                            
                $datos['id_modal'] = 'myModalChart';
		        $datos['titulo_notificacion'] = 'Estad&iacute;stica de '.$datos['nombre_estadistica'];
				$datos['mensaje_notificacion'] = '<div id="morris-bar-chart-estadistica2-2"></div>';
            break;
			case 4: // Usuarios por Departamento, Municipio y Rango de Fechas
				$datos['tabla'] = $this->estadisticas_model->usuarios_departamento_municipio('tabla');
				$datos['grafica'] = $this->estadisticas_model->usuarios_departamento_municipio('grafica');
				$datos['listado'] = $this->estadisticas_model->usuarios_departamento_municipio('listado');
			                
				$datos['lista_departamentos'] = $this->departamentos_model->lista_departamentos();
                $datos['lista_municipios'] = $this->municipios_model->lista_municipios();
				$datos['grafica_json'] = '';
                $centroseducativos = 1;
				foreach($datos['grafica'] as $data){
					$datos['grafica_json'] = $datos['grafica_json'].'{y: \''.($centroseducativos++).'\', a: '.$data->capacitados.', b: '.$data->certificados.'},';
				}
                    
                $datos['id_modal'] = 'myModalChart';
		        $datos['titulo_notificacion'] = 'Estad&iacute;stica de '.$datos['nombre_estadistica'];
				$datos['mensaje_notificacion'] = '<div id="morris-bar-chart-estadistica2-2"></div>';
			
			break;
			case 5: // Usuarios por Tipo de Capacitados y Fecha a Nivel Nacional
            break;
			case 6: // Usuarios por Tipo de Capacitados, Departamento y Fecha
				
				$datos['lista_tipo_capacitados'] =  array(
						'Evaluacion' => 'Certificados',
						'Examen' => 'Capacitados'
				);
				
				//$datos['tabla'] = $this->estadisticas_model->estaditicas_departamento_tipo_fechas('tabla');
				$datos['lista_departamentos'] = $this->departamentos_model->lista_departamentos();
				/*
				$datos['grafica_json'] = '';
				
				$contador = 1;
				foreach($datos['tabla'] as $data){
					$datos['grafica_json'] = $datos['grafica_json'].'{y: \''.$contador++.'\', a: \''.$data->certificados.'\', b: \''.$data->capacitados.'\'},';
				}
				*/
				$datos['id_modal'] = 'myModalChart';
				$datos['titulo_notificacion'] = 'Estad&iacute;stica de '.$datos['nombre_estadistica'];
				$datos['mensaje_notificacion'] = '<div id="morris-bar-chart-estadistica2-2"></div>';
				
            break;    
			case 7: // Usuarios por Tipo de Capacitados, Departamento y Municipio
                $datos['tabla'] = $this->estadisticas_model->usuarios_departamento_municipio('tabla');
				$datos['grafica'] = $this->estadisticas_model->usuarios_departamento_municipio('grafica');
				$datos['listado'] = $this->estadisticas_model->usuarios_departamento_municipio('listado');
			                
				$datos['lista_departamentos'] = $this->departamentos_model->lista_departamentos();
                $datos['lista_municipios'] = $this->municipios_model->lista_municipios();
                $datos['lista_tipo_capacitados'] =  array(
                    'Evaluacion' => 'Certificados',
                    'Examen' => 'Capacitados'
					);                    
				$datos['grafica_json'] = '';
                $centroseducativos = 1;
				foreach($datos['grafica'] as $data){
					$datos['grafica_json'] = $datos['grafica_json'].'{y: \''.($centroseducativos++).'\', a: '.$data->capacitados.', b: '.$data->certificados.'},';
				}
                    
                $datos['id_modal'] = 'myModalChart';
		        $datos['titulo_notificacion'] = 'Estad&iacute;stica de '.$datos['nombre_estadistica'];
				$datos['mensaje_notificacion'] = '<div id="morris-bar-chart-estadistica2-2"></div>';
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
					$datos['grafica_estaditicas_departamento_json'] = $datos['grafica_estaditicas_departamento_json'].'{y: \''.($contador++).'\', a: \''.$data->certificados.'\', b: \''.$data->capacitados.'\'},';
				}
                            
                $datos['id_modal'] = 'myModalChart';
		        $datos['titulo_notificacion'] = 'Estad&iacute;stica de '.$datos['nombre_estadistica'];
				$datos['mensaje_notificacion'] = '<div id="morris-bar-chart-estadistica2-2"></div>';
            break;    
			case 9: // Usuarios por Tipo de Capacitados y Centro Educativo
				$datos['certificados'] = $this->estadisticas_model->centro_educativo_capacitado('certificados');
				$datos['capacitados'] = $this->estadisticas_model->centro_educativo_capacitado('capacitados');
				$datos['total'] = $this->estadisticas_model->centro_educativo_capacitado('total');
                
                $datos['lista_tipo_capacitados'] =  array(
                    'Evaluacion' => 'Capacitados',
                    'Examen' => 'Certificados'
				);
					
  		        $datos['lista_centros_educativos'] = $this->centros_educativos_model->lista_centros_educativos();                    
				$datos['grafica_json'] = '';
                $datos['estadistica']  = '{y: \'1\', a: '.$datos['capacitados'][0]->tutorizado.', b: '.$datos['certificados'][0]->tutorizado.'},';
                //$datos['estadistica'] .= '{y: \'2\', a: '.$datos['capacitados'][0]->autoformacion.', b: '.$datos['certificados'][0]->autoformacion.'},';     
				
                $datos['id_modal'] = 'myModalChart';
		        $datos['titulo_notificacion'] = 'Estad&iacute;stica de '.$datos['nombre_estadistica'];
				$datos['mensaje_notificacion'] = '<div id="morris-bar-chart-estadistica2-2"></div>';
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
                $datos['id_modal'] = 'myModalChart';
		        $datos['titulo_notificacion'] = 'Estad&iacute;stica de '.$datos['nombre_estadistica'];
				//$datos['mensaje_notificacion'] = '<div id="morris-bar-chart-estadistica2-2"></div>';
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
	
	public function lista_municipios_departamentos (){
		$id_departamento = $this->input->get_post('id_departamento');
		$datos['json_data'] = json_encode($this->municipios_model->lista_municipios_departamentos($id_departamento));
		$this->load->view('estadisticas/json', $datos);
	}
	
	private function datos_estadistica_02_view($codigo_departamento = '', $fecha1 = '', $fecha2 = ''){
		$datos['campos'] = array('id_departamento' => $codigo_departamento, 'fecha1' => $fecha1, 'fecha2' => $fecha2);
		$datos['cantidad_usuarios_municipio'] = $this->estadisticas_model->cantidad_usuarios_municipio($codigo_departamento, $fecha1, $fecha2);
		
		$municipios = 1;
		$datos['cantidad_usuarios_municipio_json'] = '';
		foreach($datos['cantidad_usuarios_municipio'] as $cantidad_municipio){
			if($cantidad_municipio->nombre_municipio != 'TOTAL'){
				$datos['cantidad_usuarios_municipio_json'] = $datos['cantidad_usuarios_municipio_json'].'{y: \''.$municipios++.'\', a: '.$cantidad_municipio->capacitados.', b: '.$cantidad_municipio->certificados.'},';
			}
		}
		
		$datos['usuarios_municipio'] = $this->estadisticas_model->usuarios_municipio($codigo_departamento);
		$datos['lista_departamentos'] = $this->departamentos_model->lista_departamentos();
		
		$datos['id_modal'] = 'myModalChart';
		$datos['titulo_notificacion'] = 'Estad&iacute;stica de '.listado_estadisticas(2);
		$datos['mensaje_notificacion'] = '<div id="morris-bar-chart-estadistica2-2"></div>';
		
		return $datos;
	}
}


/* End of file estadisticas.php */
/* Location: ./application/controllers/estadisticas.php */