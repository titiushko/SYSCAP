<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estadisticas extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model(array('estadisticas_model', 'departamentos_model'));
        $this->load->model(array('estadisticas_model', 'municipios_model'));
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
				$datos['cantidad_usuarios_municipio'] = $this->estadisticas_model->cantidad_usuarios_municipio('01');
				$datos['cantidad_usuarios_municipio_json'] = '';
				$municipios = 1;
				foreach($datos['cantidad_usuarios_municipio'] as $cantidad_municipio){
					$datos['cantidad_usuarios_municipio_json'] = $datos['cantidad_usuarios_municipio_json'].'{y: \''.$municipios++.'\', a: '.$cantidad_municipio->total.', b: '.$cantidad_municipio->total.'},';
				}
				$datos['usuarios_municipio'] = $this->estadisticas_model->usuarios_municipio('01');
				$datos['lista_departamentos'] = $this->departamentos_model->lista_departamentos();
				
				$datos['id_modal'] = 'myModalChart';
				$datos['titulo_notificacion'] = 'Estad&iacute;stica de '.$datos['nombre_estadistica'];
				$datos['mensaje_notificacion'] = '<div id="morris-bar-chart-estadistica2-2"></div>';
			break;
			case 3: // Total de Usuarios por Departamento y Rango de Fechas
                $datos['tabla'] = $this->estadisticas_model->estaditicas_depertamento_fechas('tabla');
                $datos['grafica_estaditicas_depertamento_json'] = '';
                $contador = 1;
				foreach($datos['tabla'] as $data){
					$datos['grafica_estaditicas_depertamento_json'] = $datos['grafica_estaditicas_depertamento_json'].'{y: \''.($contador++).'\', a: \''.$data->certificados.'\', b: \''.$data->capacitados.'\'},';
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
			case 6: // Usuarios por Tipo de Capacitados, Departamento y Fecha
                $datos['tabla'] = $this->estadisticas_model->estaditicas_depertamento_tipo_fechas('tabla');
                $datos['lista_departamentos'] = $this->departamentos_model->lista_departamentos();
                $datos['lista_tipo_capasitados'] =  array(
                    'Evaluacion' => 'Certificados',
                    'Examen' => 'Capasitados');
                
                $datos['grafica_json'] = '';
                $contador = 1;
				foreach($datos['tabla'] as $data){
					$datos['grafica_json'] = $datos['grafica_json'].'{y: \''.($contador++).'\', a: \''.$data->certificados.'\', b: \''.$data->capacitados.'\'},';
				}
                $datos['id_modal'] = 'myModalChart';
		        $datos['titulo_notificacion'] = 'Estad&iacute;stica de '.$datos['nombre_estadistica'];
				$datos['mensaje_notificacion'] = '<div id="morris-bar-chart-estadistica2-2"></div>';
                
			case 7: // Usuarios por Tipo de Capacitados, Departamento y Municipio
			case 8: // Usuarios por Departamento, Tipo de Capacitados y Fecha
			case 9: // Usuarios por Tipo de Capacitados y Centro Educativo
			case 10: // Usuarios a Nivel Nacional
			case 11: // Usuarios por Grado Digital
			default:
				$datos['habilitar_generar_reporte'] = FALSE;
				break;
		}
		
		$datos['datos'] = $datos;
		$this->load->view('plantilla_pagina_view', $datos);
	}
}

/* End of file estadisticas.php */
/* Location: ./application/controllers/estadisticas.php */