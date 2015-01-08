<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estadisticas extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model(array('estadisticas_model', 'departamentos_model'));
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
				$datos['modalidades_capacitados'] = $this->estadisticas_model->modalidades_capacitados('');
				$datos['participantes_modalidades'] = $this->estadisticas_model->modalidades_capacitados('participantes');
				break;
			case 2: // Usuarios por Departamento y Rango de Fechas
				$datos['cantidad_usuarios_municipio'] = $this->estadisticas_model->cantidad_usuarios_municipio('01');
				$datos['cantidad_usuarios_municipio_json'] = '';
				$municipios = 1;
				foreach($datos['cantidad_usuarios_municipio'] as $cantidad_municipio){
					$datos['cantidad_usuarios_municipio_json'] = $datos['cantidad_usuarios_municipio_json'].'{y: \''.$municipios.'\', a: '.$cantidad_municipio->total.', b: '.$cantidad_municipio->total.'},';
					$municipios++;
				}
				$datos['usuarios_municipio'] = $this->estadisticas_model->usuarios_municipio('01');
				$datos['lista_departamentos'] = $this->departamentos_model->lista_departamentos();
				
				$datos['id_modal'] = 'myModalChart';
				$datos['titulo_notificacion'] = 'Estad&iacute;stica de '.$datos['nombre_estadistica'];
				$datos['mensaje_notificacion'] = '<div id="morris-bar-chart-estadistica2-2"></div>';
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